<?php
namespace App\Controller;

use App\Controller\AppController;
use phpDocumentor\Reflection\File;
use Cake\Mailer\Email;
/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 *
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
    public function initialize(){
        parent::initialize();

        // Include the FlashComponent
        $this->loadComponent('Flash');

        // Load Files model
        $this->loadModel('Files');

    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $userId = $this->Auth->user('id');

        $userFiles = $this->Files->find()->contain(['Users'])->where('Files.user_id='.$userId);

        $files = $this->paginate($userFiles);

        $this->set(compact('files'));
    }

    /**
     * View method
     *
     * @param string|null $id Files id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ['Users']
        ]);
        $extension=pathinfo($file->name,PATHINFO_EXTENSION);
        $img_extension=array('jpeg','jfif','tiff','gif','bmp','png','ppm','pgm','pbm','pnm','webp','jpg');
        $pdf=array('pdf');
        $type=0;
        if(in_array($extension,$img_extension))
            $type=2;
        else if (in_array($extension,$pdf))
            $type=3;
        else
            $type=1;

        $this->set('type',$type);
        $this->set('file', $file);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   $uploadPath=WWW_ROOT.DS.'upload/files/';
        $file = $this->Files->newEntity();
        if ($this->request->is('post')) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            $fileArr=$this->request->getData(['name']);
            $uploadFile =$uploadPath.$fileArr['name'];

            if(move_uploaded_file($fileArr['tmp_name'],$uploadFile)){
                $file->name = $fileArr['name'];
                $file->path = $uploadPath;
                $file->user_id=$this->request->getSession()->read('Auth.User.id');
                $file->created = date("Y-m-d H:i:s");
                $file->modified = date("Y-m-d H:i:s");
                if ($this->Files->save($file)) {
                    $this->Flash->success(__('File has been uploaded and inserted successfully.'));
                }else{
                    $this->Flash->error(__('Unable to upload file1, please try again.'));
                }
            }else{
                $this->Flash->error(__('Unable to upload file2, please try again.'));
            }

            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));
                $email=new Email('gmail');
                $email->addTo($this->Auth->user('username'))->setSubject('Notify Upload New File')->send('We Need to tell you got new file in your cloud  
                    File is'.$file->name);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $users = $this->Files->Users->find();

        $this->set(compact('file', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Files id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $users = $this->Files->Users->find('list', ['limit' => 200]);
        $this->set(compact('file', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Files id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);
        if ($this->Files->delete($file)) {
            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

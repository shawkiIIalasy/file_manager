<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\I18n;
use phpDocumentor\Reflection\File;
use Cake\Mailer\Email;
use App\View\Helper;
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
        $this->loadComponent('Gmail');
        $this->loadComponent('FileUpload');
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
    {
        $file = $this->Files->newEntity();
        if ($this->request->is('post')) {

            $file = $this->Files->patchEntity($file, $this->request->getData('name'));
            $fileArr=$this->request->getData(['name']);
            if($this->FileUpload->file($fileArr['name'],$fileArr['tmp_name'])){
                $file->name = $fileArr['name'];
                $file->path = $this->FileUpload->getPath();
                $file->user_id=$this->request->getSession()->read('Auth.User.id');
                if ($this->Files->save($file)) {

                    $gmail=$this->Auth->user('username');
                    $this->Gmail->sentToGmail($gmail,"Upload New File","We Need to tell you got new file in your cloud".$file->name);
                    $this->Flash->success(__('File has been uploaded and inserted successfully.'));
                    return $this->redirect(['action' => 'index']);
                }else{
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                }
            }else{
                $this->Flash->error(__('Unable to upload file, please try again.'));
            }

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
    public function deleteAll()
    {
        $this->request->allowMethod(['post', 'delete']);
        $files=$this->request->getData('select');
        $filesSelected=array();
        foreach ($files as $fileIndex =>$fileId)
        {
            if($fileId>0 && $fileIndex>0)
                $filesSelected[]=$fileId;
        }
        //var_dump($filesSelected);die();
        if ($this->Files->deleteAll(['Files.id IN'=>$filesSelected])) {
            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file/s could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

<?php
namespace App\Controller;

use App\Controller\AppController;
use function MongoDB\BSON\toJSON;

/**
 * Notificatons Controller
 *
 *
 * @method \App\Model\Entity\Notificaton[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotificationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        //$userFiles = $this->Files->find()->contain(['Users'])->where('Files.user_id='.$userId);
        $not=$this->Notifications->find()->contain(['Users'])->where('Notifications.user_id='.$this->Auth->user('id'));
        //var_dump($not);
        $output="";
        foreach ($not as $t)
            {
                $output .= '<a class="dropdown-item" style="background:white" href="#">'.$t->id.'</a><br>';
            }
        $data = array(
            'notification' => $output
        );


        echo json_encode($data['notification']);
        die();
        // var_dump(json_encode($notifications));


        //$this->set(compact('notificatons'));
        return $this->redirect("/files");
    }

    /**
     * View method
     *
     * @param string|null $id Notificaton id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notificaton = $this->Notificatons->get($id, [
            'contain' => []
        ]);

        $this->set('notificaton', $notificaton);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notificaton = $this->Notificatons->newEntity();
        if ($this->request->is('post')) {
            $notificaton = $this->Notificatons->patchEntity($notificaton, $this->request->getData());
            if ($this->Notificatons->save($notificaton)) {
                $this->Flash->success(__('The notificaton has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notificaton could not be saved. Please, try again.'));
        }
        $this->set(compact('notificaton'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Notificaton id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notificaton = $this->Notificatons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notificaton = $this->Notificatons->patchEntity($notificaton, $this->request->getData());
            if ($this->Notificatons->save($notificaton)) {
                $this->Flash->success(__('The notificaton has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notificaton could not be saved. Please, try again.'));
        }
        $this->set(compact('notificaton'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Notificaton id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notificaton = $this->Notificatons->get($id);
        if ($this->Notificatons->delete($notificaton)) {
            $this->Flash->success(__('The notificaton has been deleted.'));
        } else {
            $this->Flash->error(__('The notificaton could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

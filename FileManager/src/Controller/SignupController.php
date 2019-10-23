<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use App\Model\Entity\User;
use App\Model\Table\UsersTable;
use Cake\Validation\Validator;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

class SignupController extends AppController
{
    var $components = array('Auth');
    public function index(){
    }
    public function signup(){

    }
    public function add()
    {
        $this->loadModel('Users');
        if ($this->checkValid($this->request->getData()))
            return $this->redirect(['action' => 'signup']);
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        return $this->redirect(['action' => 'signup']);
    }

    public function checkValid($user)
    {
        $validator=new Validator();
        $validator
            ->notBlank('username','The User Name Cannot Be Empty')
            ->maxLength('username',200,'The Max Length is 200')
            ->regex('username','/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
                'Please The Correct Email')
            ->maxLength('password',20,'The max length of password is 20 Please Check.')
            ->regex('password','([A-Z]{1}[A-Za-z0-9]*)' ,'The password must be the first letter capital and the max length is 20')
            ->notBlank('password','The password cannot be empty')
            ->equalToField('password','cPassword','The Confirm Password not match');
        $errorsUser=$validator->errors($user);

        $checkFlag=0;
        if(isset($errorsUser['username']) )
        {
            foreach ($errorsUser['username'] as $e) {

            $this->Flash->error($e);
             }
            $checkFlag=1;
        }


        if(isset($errorsUser['password'])  )
        {
            foreach ($errorsUser['password'] as $e) {

                $this->Flash->error($e);
            }
            $checkFlag=1;
        }

        return $checkFlag;
    }

}

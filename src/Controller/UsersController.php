<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function isAuthorized($user){
        if(isset($user['role']) and $user['role'] === 'user'){
            if(in_array($this->request->action, ['home', 'logout', 'index', 'view'])) //acciones que se le permiten a cada user, el this request action devuelve la accion a la que se intentó acceder, y para pdoer acceder tiene q ue estar en la lista
            {
                return true;
            }
        }
        if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
            // Prior to 3.4.0 $this->request->params('pass.0')
            $userId = (int)$this->request->getParam('pass.0');

            if ($userId === $user['id']) {
                return true;
            }
        }
        return parent::isAuthorized($user);

    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['add', 'logout']);//permite a cualquier usuario registrarse
        $this->set('current_user', $this->Auth->user());
    }



// public function beforeFilter(Event $event)
// {
//     $this->Auth->allow(['add']); 
// }

    public function login(){
        if($this->request->is('post')){
            
            $user = $this->Auth->identify();
            if($user)
            {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }else{
 debug($user);
                $this->Flash->error('Invalid credentials, please try again', ['key' => 'auth']);
            }
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

    
    $query = $this->Users->find('all')->contain(['Cars']);
    foreach ($query as $usersandcar) {
        debug($usersandcar);
    }
         $this->Users->recursive = 1;
      $users = $this->Users->find('all');
      debug($users);

        $users = $this->Users->find('all');
        $this->set('users', $users);
        
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
       // $user = $this->Users->get($id, [
         //   'contain' => ['Cars']
        //]);
        $user = $this->Users->get($id);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
            debug($this->request->getData());
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**

    */

    public function home(){
        // debug($this->Auth->user());
        $this->render();
        // $this->redirect(['controller' => 'Pages', 'action' => '']);
    }
    public function logout(){
        return $this->redirect($this->Auth->logout());
    }
}

<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * CarsUsers Controller
 *
 * @property \App\Model\Table\CarsUsersTable $CarsUsers
 *
 * @method \App\Model\Entity\CarsUser[] paginate($object = null, array $settings = [])
 */
class CarsUsersController extends AppController
{

     public function isAuthorized($user){
        // los de registrado 
        if(isset($user['role']) and $user['role'] === 'user'){
            if(in_array($this->request->action, ['index', 'view', 'add', 'delete'])) //acciones que se le permiten a cada user, el this request action devuelve la accion a la que se intentó acceder, y para pdoer acceder tiene q ue estar en la lista
            {
                return true;
            }
        
           if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
            // Prior to 3.4.0 $this->request->params('pass.0')
            $carId = (int)$this->request->getParam('pass.0');
            if ($this->Cars->isOwnedBy($carId, $user['id'])) {
                return true;
            }
        }
    }
        return parent::isAuthorized($user);

    }
    
    public function beforeFilter(Event $event)
    {//los de no registrado
        $this->Auth->allow(['home', 'search', 'view', 'index', 'howTo']);
        $this->set('current_user', $this->Auth->user());
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('CarsUsers');
              
        $this->paginate = [
            'contain' => ['Cars', 'Users']
        ];
        $carsUsers = $this->paginate($this->CarsUsers);
debug($carsUsers);
        $this->set(compact('carsUsers'));
        $this->set('_serialize', ['carsUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Cars User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
  /* metodo inicial
    public function view($id = null)
    {
        $this->loadModel('CarsUsers');
        $carsUser = $this->CarsUsers->get($id, [
            'contain' => ['Cars', 'Users']
        ]);

        $this->set('carsUser', $carsUser);
        $this->set('_serialize', ['carsUser']);
    }
*/

    public function view($id = null)
    {
        $this->loadModel('CarsUsers');
        $carsUser = $this->CarsUsers->get($id, [
            'contain' => ['Cars', 'Users']
        ]);


        $this->set('carsUser', $carsUser);
        $this->set('_serialize', ['carsUser']);
    }

    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('CarsUsers');
        $carsUser = $this->CarsUsers->newEntity();
        if ($this->request->is('post')) {
            $carsUser = $this->CarsUsers->patchEntity($carsUser, $this->request->getData());
            if ($this->CarsUsers->save($carsUser)) {
                $this->Flash->success(__('The cars user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cars user could not be saved. Please, try again.'));
        }
        $cars = $this->CarsUsers->Cars->find('list', ['limit' => 200]);
        $users = $this->CarsUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('carsUser', 'cars', 'users'));
        $this->set('_serialize', ['carsUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cars User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('CarsUsers');
        $carsUser = $this->CarsUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $carsUser = $this->CarsUsers->patchEntity($carsUser, $this->request->getData());
            if ($this->CarsUsers->save($carsUser)) {
                $this->Flash->success(__('The cars user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cars user could not be saved. Please, try again.'));
        }
        $cars = $this->CarsUsers->Cars->find('list', ['limit' => 200]);
        $users = $this->CarsUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('carsUser', 'cars', 'users'));
        $this->set('_serialize', ['carsUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cars User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->loadModel('CarsUsers');
        $this->request->allowMethod(['post', 'delete']);
        $carsUser = $this->CarsUsers->get($id);
        if ($this->CarsUsers->delete($carsUser)) {
            $this->Flash->success(__('The cars user has been deleted.'));
        } else {
            $this->Flash->error(__('The cars user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

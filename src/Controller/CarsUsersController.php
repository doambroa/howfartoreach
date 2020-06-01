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
            if(in_array($this->request->action, ['index', 'view', 'add'])) //acciones que se le permiten a cada user, el this request action devuelve la accion a la que se intentó acceder, y para pdoer acceder tiene q ue estar en la lista
            {
                return true;
            }
          
           if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {

                $id = (int)$this->request->getParam('pass.0');
                $carId = (int)$this->request->getParam('pass.1');
                $userId = (int)$this->request->getParam('pass.2');

                if ( ( isset($user['id']) and ($userId == $user['id'])) || (isset($user['role']) and $user['role'] === 'admin') ) {
                    return true;
                }
            }
        }
        return parent::isAuthorized($user);
    }
    
    public function beforeFilter(Event $event)
    {//los de no registrado
        $this->Auth->allow(['view', 'index']);
        $this->set('current_user', $this->Auth->user());
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('Cars');
        $this->loadModel('CarsUsers');
              
        $this->paginate = [
            'contain' => ['Cars', 'Users']
        ];
        $carsUsers = $this->paginate($this->CarsUsers);

      // $query = $this->CarsUsers->find()->select(['car_id' => 'cars.id', 
      //   'marca' => 'cars.marca',
      //   'modelo' => 'cars.modelo',
      //   'AVG(contribution.consumoCiudad)' => 'avgCity',
      //   'AVG(contribution.consumoAutopista)' => 'avgHighway',
      //   'AVG(contribution.combinado)' => 'avgCombined',
      //   'cars.combustible' => 'combustible'])
      // ->innerJoinWith('Cars')
      // ->group(['cars.modelo'.'cars.combustible']);


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
    public function view($id = null)
    {

        return $this->redirect(['controller' => 'cars', 'action' => 'view',$id]);
    }
    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        return $this->redirect(['controller' => 'cars', 'action' => 'addContribution']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cars User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $car_id=null, $user_id=null)
    {
        $this->loadModel('CarsUsers');

        $carsUser = $this->CarsUsers->get([$id, $car_id, $user_id], [
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
    public function delete($id = null, $car_id=null, $user_id=null)
    {
        $this->loadModel('CarsUsers');
        $this->request->allowMethod(['post', 'delete']);
        $carsUser = $this->CarsUsers->get([$id, $car_id, $user_id]);
        if ($this->CarsUsers->delete($carsUser)) {
            $this->Flash->success(__('The controbution has been deleted.'));
        } else {
            $this->Flash->error(__('The contribution could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Cars', 'action' => 'contributions']);
    }
}
















// <?php
// namespace App\Controller;

// use App\Controller\AppController;

// /**
//  * CarsUsers Controller
//  *
//  * @property \App\Model\Table\CarsUsersTable $CarsUsers
//  *
//  * @method \App\Model\Entity\CarsUser[] paginate($object = null, array $settings = [])
//  */
// class CarsUsersController extends AppController
// {

//     /**
//      * Index method
//      *
//      * @return \Cake\Http\Response|void
//      */
//     public function index()
//     {
//         $this->paginate = [
//             'contain' => ['Cars', 'Users']
//         ];
//         $carsUsers = $this->paginate($this->CarsUsers);

//         $this->set(compact('carsUsers'));
//         $this->set('_serialize', ['carsUsers']);
//     }

//     /**
//      * View method
//      *
//      * @param string|null $id Cars User id.
//      * @return \Cake\Http\Response|void
//      * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//      */
//     public function view($id = null)
//     {
//         $carsUser = $this->CarsUsers->get($id, [
//             'contain' => ['Cars', 'Users']
//         ]);

//         $this->set('carsUser', $carsUser);
//         $this->set('_serialize', ['carsUser']);
//     }

//     /**
//      * Add method
//      *
//      * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
//      */
//     public function add()
//     {
//         $carsUser = $this->CarsUsers->newEntity();
//         if ($this->request->is('post')) {
//             $carsUser = $this->CarsUsers->patchEntity($carsUser, $this->request->getData());
//             if ($this->CarsUsers->save($carsUser)) {
//                 $this->Flash->success(__('The cars user has been saved.'));

//                 return $this->redirect(['action' => 'index']);
//             }
//             $this->Flash->error(__('The cars user could not be saved. Please, try again.'));
//         }
//         $cars = $this->CarsUsers->Cars->find('list', ['limit' => 200]);
//         $users = $this->CarsUsers->Users->find('list', ['limit' => 200]);
//         $this->set(compact('carsUser', 'cars', 'users'));
//         $this->set('_serialize', ['carsUser']);
//     }

//     /**
//      * Edit method
//      *
//      * @param string|null $id Cars User id.
//      * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
//      * @throws \Cake\Network\Exception\NotFoundException When record not found.
//      */
//     public function edit($id = null)
//     {
//         $carsUser = $this->CarsUsers->get($id, [
//             'contain' => []
//         ]);
//         if ($this->request->is(['patch', 'post', 'put'])) {
//             $carsUser = $this->CarsUsers->patchEntity($carsUser, $this->request->getData());
//             if ($this->CarsUsers->save($carsUser)) {
//                 $this->Flash->success(__('The cars user has been saved.'));

//                 return $this->redirect(['action' => 'index']);
//             }
//             $this->Flash->error(__('The cars user could not be saved. Please, try again.'));
//         }
//         $cars = $this->CarsUsers->Cars->find('list', ['limit' => 200]);
//         $users = $this->CarsUsers->Users->find('list', ['limit' => 200]);
//         $this->set(compact('carsUser', 'cars', 'users'));
//         $this->set('_serialize', ['carsUser']);
//     }

//     /**
//      * Delete method
//      *
//      * @param string|null $id Cars User id.
//      * @return \Cake\Http\Response|null Redirects to index.
//      * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//      */
//     public function delete($id = null)
//     {
//         $this->request->allowMethod(['post', 'delete']);
//         $carsUser = $this->CarsUsers->get($id);
//         if ($this->CarsUsers->delete($carsUser)) {
//             $this->Flash->success(__('The cars user has been deleted.'));
//         } else {
//             $this->Flash->error(__('The cars user could not be deleted. Please, try again.'));
//         }

//         return $this->redirect(['action' => 'index']);
//     }
// }

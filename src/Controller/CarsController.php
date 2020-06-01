<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

/**
 * Cars Controller
 *
 * @property \App\Model\Table\CarsTable $Cars
 *
 * @method \App\Model\Entity\Car[] paginate($object = null, array $settings = [])
 */
class CarsController extends AppController
{

     public function isAuthorized($user){
        // los de registrado 
        if(isset($user['role']) and $user['role'] === 'user'){
            if(in_array($this->request->action, ['view', 'search', 'filter', 'addContribution', 'howTo']))
            {
                return true;
            }
        
           // if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
           //  // Prior to 3.4.0 $this->request->params('pass.0')
           //      $carId = (int)$this->request->getParam('pass.0');
           //      if ($this->Cars->isOwnedBy($carId, $user['id'])) {
           //          return true;
           //      }
           //  }
        }
            return parent::isAuthorized($user);

        }

    public function beforeFilter(Event $event){//los de no registrado

        $this->Auth->allow(['search', 'view', 'contributions', 'howTo']);
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
         $cars = $this->Cars->find('all');

        $this->paginate($cars);
        $this->set(compact('cars'));
        $this->set('_serialize', ['cars']);
    }

    public function contributions(){

        $this->paginate = [
            'sortWhitelist' => ['polls','car_id','marca','modelo','consumoCiudad','consumoAutopista','combinado','combustible']
        ];

        $cars = $this->Cars->find()->group(['Cars.modelo']);

        foreach ($cars as $car) {
           //debug($car);
         } 
    
        // $connection = ConnectionManager::get('default');
        // $contributions = $connection->execute('SELECT cars.id as car_id, cars.marca as marca, cars.modelo as modelo, AVG(contribution.consumoCiudad) as avgCity, AVG(contribution.consumoAutopista) as avgHighway, AVG(contribution.combinado) as avgCombined, cars.combustible as combustible, count(cars.id) as polls FROM cars_users AS contribution INNER JOIN cars ON cars.id = contribution.car_id GROUP BY cars.modelo, cars.combustible')->fetchAll('assoc');
        

        $this->loadModel('CarsUsers');

        $contributions = $this->paginate($this->CarsUsers->find()->select([
            'id',
            'car_id' => 'cars.id', 
            'marca' => 'cars.marca',
            'modelo' => 'cars.modelo',
            'consumoCiudad' => 'AVG(carsusers.consumoCiudad)',
            'consumoAutopista' => 'AVG(carsusers.consumoAutopista)',
            'combinado' => 'AVG(carsusers.combinado)',
            'combustible' => 'cars.combustible',
            'polls' => 'count(cars.id)'])
        ->innerJoinWith('Cars')
        ->group(['cars.modelo','cars.combustible'])
    );

        $fuelTypes = $this->Cars->find()->select(['Cars.combustible'])->distinct()->toArray();
        $marcas = $this->Cars->find()->select(['Cars.marca'])->distinct()->toArray();

       // $most = $this->Cars->find()->select(['count' => $this->Cars->find()->func()->count('*')])->group(['Cars.modelo']);
        //$brands = $this->Cars->find('all', ['fields'=>['DISTINCT marca']]);

        
        $this->set('marcas', $marcas);
        $this->set('fuelTypes', $fuelTypes);
        $this->set(compact('cars'));
        $this->set('_serialize', ['cars']);
        $this->set(compact('contributions'));
    }

    /**
     * addContribution method
     *
     * @param string| $user user id.
     * @param string| $car Car id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    */
    public function addContribution($user=null, $car=null){
        

        $this->loadModel('CarsUsers');

        $carsUser = $this->CarsUsers->newEntity();
        
        if ($this->request->is('post')) {
            //$cid =  select id from cars where modelo == this.modelo and combustible == this.combustble
            if($this->request->getData()['modelo']!=null){
                $car_id = $this->Cars->find()->select(['id'])->where(['modelo =' => $this->request->getData()['modelo'], 'combustible ='=> $this->request->getData()['combustible']])->first()->get('id'); 
            } else {
                debug("el modelo no existe");
            }
            $data = $this->request->getData();            
            $data['car_id'] = $car_id;

            $carsUser = $this->CarsUsers->patchEntity($carsUser, $data);
            if ($this->CarsUsers->save($carsUser)) {
                $this->Flash->success(__('The contribution has been saved.'));

                return $this->redirect(['controller' => 'Cars', 'action' => 'contributions']);
            }
            
            $this->Flash->error(__('The cars user could not be saved. Please, try again.'));
        }


        $this->Cars->find('all');

        //  $data->tags->_joinData->data_from_join_data);

        //  //$users = $this->Cars->Users->find('list', ['limit' => 200]);

           // $brands = $this->Cars->find('all', ['fields'=>['DISTINCT marca']]);
            // foreach ($result as $res) {
            //     debug($res->marca);
            // }
            
            $brands = $this->Cars->find()->select(['Cars.marca'])->distinct()->toArray();
            $models = $this->Cars->find()->select(['Cars.modelo'])->distinct()->toArray();
            
            $this->set('models', $models);
            $this->set('brands', $brands);
        //  $this->set(compact('car', 'users'));
        //  $this->set('_serialize', ['car']);


        $cars = $this->CarsUsers->Cars->find('list', ['limit' => 200]);
        $users = $this->CarsUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('carsUser', 'cars', 'users'));
        $this->set('_serialize', ['carsUser']);
    }


    /**
     * View method
     *
     * @param string|null $id Car id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null){

        // if($combustible != null && $modelo != null){
           
        //     //se saca ese modelo para el combustible que nos llega, viene del enlace por get
        //     $id = $this->Cars->find()->select(['Cars.id'])->where(['modelo' => $modelo, 'combustible' => $combustible]);
            

        //     // debug($carOtroCombustible->first());
        //     // foreach ($carOtroCombustible as $idOtroCombustuble) {
        //     //     debug($idOtroCombustuble);
        //     // }
        // }

        $car = $this->Cars->get($id, [
            'contain' => ['Users']
        ]);

        switch ($car->combustible) {
            case 'Diesel':
                $idPetrol = $this->Cars->find()->select(['Cars.id'])->where(['modelo' => $car->modelo, 'combustible' => "Petrol"]); 
                $idElectric = $this->Cars->find()->select(['Cars.id'])->where(['modelo' => $car->modelo, 'combustible' => "Electric"]);

            break;

            case 'Petrol':
                $idDiesel = $this->Cars->find()->select(['Cars.id'])->where(['modelo' => $car->modelo, 'combustible' => "Diesel"]); 
                $idElectric = $this->Cars->find()->select(['Cars.id'])->where(['modelo' => $car->modelo, 'combustible' => "Electric"]);
                
            break;

            case 'Electric':
                $idDiesel = $this->Cars->find()->select(['Cars.id'])->where(['modelo' => $car->modelo, 'combustible' => "Diesel"]); 
                $idPetrol = $this->Cars->find()->select(['Cars.id'])->where(['modelo' => $car->modelo, 'combustible' => "Petrol"]);

            break;

            default:
            break;
        }


        $combustibles = $this->Cars->find()->select(['Cars.combustible'])->distinct()->where(['modelo'=>$car->modelo])->toArray();
        
        //obtenemos los datos de la relación
        $this->loadModel('CarsUsers');

        $relatedContributions = $this->CarsUsers->find()->where(['car_id =' => $car->id])->all();

     //   $maxCity = $this->CarsUsers->find()->where(['car_id =' => $car->id, '' => '' ]);
       
        $maxHighway = $relatedContributions->max(function ($max) {
            return $max->consumoAutopista;
        });
        $maxHighway = $maxHighway->consumoAutopista;

        $maxCity = $relatedContributions->max(function ($max) {
            return $max->consumoCiudad;
        });
        $maxCity = $maxCity->consumoCiudad;

        $maxCombined = $relatedContributions->max(function ($max) {
            return $max->combinado;
        });
        $maxCombined = $maxCombined->combinado;

        $minHighway = $relatedContributions->min(function ($min) {
            return $min->consumoAutopista;
        });
        $minHighway = $minHighway->consumoAutopista;

        $minCity = $relatedContributions->min(function ($min) {
            return $min->consumoCiudad;
        });
        $minCity = $minCity->consumoCiudad; 

        $minCombined = $relatedContributions->min(function ($min) {
            return $min->combinado;
        });
        $minCombined = $minCombined->combinado;

        $totalContributions = count($relatedContributions);

        $pollsCity = 0;
        $pollsHighway = 0;
        $pollsCombined = 0;

        $totalCity = 0;
        $totalHighway = 0;
        $totalCombined = 0;

        $medianCity = array();
        $medianHighway = array();
        $medianCombined = array();
    
        foreach ($relatedContributions as $contribution) {
            if($contribution->consumoCiudad != null && $contribution->consumoCiudad != 0){
               $totalCity += $contribution->consumoCiudad;
               array_push($medianCity,$contribution->consumoCiudad);
               $pollsCity++;
            }
            if($contribution->consumoAutopista != null && $contribution->consumoAutopista != 0){
               $totalHighway += $contribution->consumoAutopista;
               array_push($medianHighway,$contribution->consumoAutopista);
               $pollsHighway++;
            }
            if($contribution->combinado != null && $contribution->combinado != 0){
               $totalCombined += $contribution->combinado;
               array_push($medianCombined,$contribution->combinado);
               $pollsCombined++;
            }
        }
        
        //ordenamos los arrays de medianas y tomamos el valor del medio en pares e impares
        sort($medianCity);
        $middlevalCity = floor(($pollsCity-1)/2);
        if($pollsCity % 2) {
            $medianCity = $medianCity[$middlevalCity];
        } else {
            $low = $medianCity[$middlevalCity];
            $high = $medianCity[$middlevalCity+1];
            $medianCity = (($low+$high)/2);
        }

        sort($medianHighway);
        $middlevalHighway = floor(($pollsHighway-1)/2);
        if($pollsHighway % 2) {
            $medianHighway = $medianHighway[$middlevalHighway];
        } else {
            $low = $medianHighway[$middlevalHighway];
            $high = $medianHighway[$middlevalHighway+1];
            $medianHighway = (($low+$high)/2);
        }

        sort($medianCombined);
        $middlevalCombined = floor(($pollsCombined-1)/2);
        if($pollsCombined % 2) {
            $medianCombined = $medianCombined[$middlevalCombined];
        } else {
            $low = $medianCombined[$middlevalCombined];
            $high = $medianCombined[$middlevalCombined+1];
            $medianCombined = (($low+$high)/2);
        }

        $avgCity = $totalCity / $pollsCity;
        $avgHighway = $totalHighway / $pollsHighway;
        $avgCombined = $totalCombined / $pollsCombined;


        $this->set('car', $car);
        $this->set('relatedContributions', $relatedContributions);
        $this->set('combustibles', $combustibles);


        //inicializamos las variables con los ids del mismo coche pero con distinto combustible
        if(isset($idDiesel) && $idDiesel->first() != null){
            $this->set('idDiesel', $idDiesel->first()->id);
        }
        if(isset($idPetrol) && $idPetrol->first() != null){
            $this->set('idPetrol', $idPetrol->first()->id);
        }
        if(isset($idElectric) && $idElectric->first() != null){
            $this->set('idElectric', $idElectric->first()->id);   
        }
// // // hacer un find con todos los vehiculos cuyo modelo counter_reset()ponde con el de $car->modelo y sacar las medias y tal
//         $modelArray = $this->Cars->find()
//         ->where(['modelo LIKE' => '%'.$car->modelo.'%'])->all();

//         $modelArrayDiesel = $this->Cars->find()
//         ->where(['modelo LIKE' => '%'.$car->modelo.'%','combustible' => 'Diesel'])->all();
//         //        ->where(['modelo LIKE' => '%'.$car->modelo.'%', 'combustible' => 'Diesel'])->all();

//         $modelArrayFuel = $this->Cars->find()
//         ->where(['modelo LIKE' => '%'.$car->modelo.'%','combustible' => 'Gasolina'])->all();
        
//         $modelArrayElectric = $this->Cars->find()
//         ->where(['modelo LIKE' => '%'.$car->modelo.'%','combustible' => 'electrico'])->all();

//         $this->set('modelo', $modelArray);

//         //debug($car);
//         $this->loadModel('CarsUsers');

        $this->set('avgCity', $avgCity);
        $this->set('avgHighway', $avgHighway);
        $this->set('avgCombined', $avgCombined);
        
        $this->set('maxCity', $maxCity);
        $this->set('maxHighway', $maxHighway);
        $this->set('maxCombined', $maxCombined);
        
        $this->set('minCity', $minCity);
        $this->set('minHighway', $minHighway);
        $this->set('minCombined', $minCombined);
        
        $this->set('pollsCity', $pollsCity);
        $this->set('pollsHighway', $pollsHighway);
        $this->set('pollsCombined', $pollsCombined);

        $this->set('medianCity', $medianCity);
        $this->set('medianHighway', $medianHighway);
        $this->set('medianCombined', $medianCombined);


        $this->set('car', $car);
        $this->set('_serialize', ['car']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $car = $this->Cars->newEntity();
        if ($this->request->is('post')) {
            $car = $this->Cars->patchEntity($car, $this->request->getData());
            if ($this->Cars->save($car)) {
                $this->Flash->success(__('The car has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The car could not be saved. Please, try again.'));
        }
        $users = $this->Cars->Users->find('list', ['limit' => 200]);
        $this->set(compact('car', 'users'));
        $this->set('_serialize', ['car']);



        //     /**
//      * Add method
//      *
//      * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
//      */
//     public function add()
//     {
//         $this->Cars->find('all')->contain(['Users']
//         debug()
//     $data->tags->_joinData->data_from_join_data);

//         $car = $this->Cars->newEntity();
//         if ($this->request->is('post')) {
//             $car = $this->Cars->patchEntity($car, $this->request->getData(),
//                 ['associated' => [
//                     'Users.__joinData']]
//             );

//             $car->user_id = $this->Auth->user('id'); //el usuario autenticado
            

//             if ($this->Cars->save($car)) {
//                 $this->Flash->success(__('The car has been saved.'));

//                 return $this->redirect(['action' => 'index']);
//             }
//             $this->Flash->error(__('The car could not be saved. Please, try again.'));
//         }

//         //$users = $this->Cars->Users->find('list', ['limit' => 200]);

        // $brand = $brands;
        // $models = $models
        $brands = $this->Cars->find('all', ['fields'=>['DISTINCT marca']]);
        // foreach ($result as $res) {
        //     debug($res->marca);
        // }
        
         $brand = $this->Cars->find()->select(['Cars.marca'])->distinct()->toArray();
         $models = $this->Cars->find()->select(['Cars.modelo'])->distinct()->toArray();
        
//         $this->set('models', $models);
         $this->set('brands', $brand);
//         $this->set(compact('car', 'users'));
//         $this->set('_serialize', ['car']);
//     }

    }

    /**
     * Edit method
     *
     * @param string|null $id Car id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $car = $this->Cars->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $car = $this->Cars->patchEntity($car, $this->request->getData());
            if ($this->Cars->save($car)) {
                $this->Flash->success(__('The car has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The car could not be saved. Please, try again.'));
        }
        $users = $this->Cars->Users->find('list', ['limit' => 200]);
        $this->set(compact('car', 'users'));
        $this->set('_serialize', ['car']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Car id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $car = $this->Cars->get($id);
        if ($this->Cars->delete($car)) {
            $this->Flash->success(__('The car has been deleted.'));
        } else {
            $this->Flash->error(__('The car could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    // mi idea es renderiz el método view pero 
    //con los datos de la búsqueda para no hacer
    // otra página search, aunque también valdría.
    public function search($query=null){

        if(!empty($this->request->query['query'])){

            $query = $this->request->query['query'];
            $query = preg_replace('/[^a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]/', '', $query);
            // debug($query);

            $terms = explode(' ', trim($query));
            $terms = array_diff($terms, array(''));

            foreach ($terms as $term) {
                $conditions[] = array('OR' => ['Cars.marca LIKE' => '%' . $term . '%', 'Cars.modelo LIKE' => '%' . $term . '%']);
            }

            
            $cars = $this->Cars->find('all', array('recursive'=> -1, 'conditions' => $conditions, 'limit' => 20));
            $cars->distinct(['modelo']);
            
        //Terminamos de calcular las medias dividiendo las sumas totales entre el número de elementos de cada una de las apariciones concretas, pero para la búsqueda de momento mostramos simplemente el primero que aparezca 



            if(count($cars) == 1) //lo mando directamente al coche que es
            {
                // debug($cars);
                //return $this->redirect(array('controller' => 'cars', 'action' => 'view', $cars[0]['Car']['id']));
            }
            $this->set(compact('cars'));

        }

        $this->set(compact('query'));
        // return $this->redirect(['action' => 'index']);

        //ahora se evalua una petición AJAX para poder generar uan vista de resultados con él.
        if($this->request->is('ajax'))
        {
            $this->layout = false;
            $this->set('ajax', 1);
        }
        else
        {
            $this->set('ajax', 0);
        }


        /* anterior
        $query = $this->Cars->find();

        return $this->redirect(['action' => 'index']);
            */
//      $this->render(); lo llama automáticamente al final de cada acción
   /*     $query = $this->Cars->get($query, [
            'contain' => ['marca']
        ]);

        $this->set('car', $car);
        $this->set('_serialize', ['car']);
    */}

    public function howTo(){
        $this->render();
    }

    public function getModelByBrand(){
        $model = $this->request->data('model');
        $models = $this->Cars->find('list', [ 'conditions' => [ 'modelo' => $model ]]); 
        echo json_encode($models); 
    }
}






// //////////////<?php
// namespace App\Controller;

// use App\Controller\AppController;
// use Cake\Event\Event;
// use Cake\Datasource\ConnectionManager;

// /**
//  * Cars Controller
//  *
//  * @property \App\Model\Table\CarsTable $Cars
//  *
//  * @method \App\Model\Entity\Car[] paginate($object = null, array $settings = [])
//  */
// class CarsController extends AppController
// {

//     var $name = 'Cars';
//     public $components = ['RequestHandler'];


//     public function isAuthorized($user){
//         // los de registrado 
//         if(isset($user['role']) and $user['role'] === 'user'){
//             if(in_array($this->request->action, ['index', 'view', 'search', 'add', 'filter', 'howTo'])) //acciones que se le permiten a cada user, el this request action devuelve la accion a la que se intentó acceder, y para pdoer acceder tiene q ue estar en la lista
//             {
//                 return true;
//             }
        
//            if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
//             // Prior to 3.4.0 $this->request->params('pass.0')
//             $carId = (int)$this->request->getParam('pass.0');
//             if ($this->Cars->isOwnedBy($carId, $user['id'])) {
//                 return true;
//             }
//         }
//     }
//         return parent::isAuthorized($user);

//     }
//     public function beforeFilter(Event $event)
//     {//los de no registrado
//         $this->Auth->allow(['home', 'search', 'view', 'index', 'howTo']);
//         $this->set('current_user', $this->Auth->user());
//     }

//     /**
//      * Index method
//      *
//      * @return \Cake\Http\Response|void
//      */
//     public function index()
//     {       
//         $cars = $this->paginate($this->Cars, ['maxLimit' => 600]);

//         $this->set(compact('cars'));
//         $this->set('_serialize', ['cars']);

//          $query = $this->Cars->find('all');
//     foreach ($query as $usersandcar) {
//         debug($usersandcar);
//     }

//        // $marcas = $this->Cars->find()->select(['Cars.marca'])->distinct()->toArray();
//         //$fuelTypes = $this->Cars->find()->select(['Cars.combustible'])->distinct()->toArray();

//         // $most = $this->Cars->find()->select(['count' => $this->Cars->find()->func()->count('*')])->group(['Cars.modelo']);
//         // debug($most);

//         // $connection = ConnectionManager::get('default');
//         // $results = $connection->execute(' SELECT modelo FROM cars WHERE (SELECT COUNT(modelo) FROM cars GROUP BY modelo'))->fetchAll('assoc');
//         // debug($results);

// //        $this->set('marcas', $marcas);
//   //      $this->set('fuelType', $fuelTypes);

//     }

//     /**
//      * View method
//      *
//      * @param string|null $id Car id.
//      * @return \Cake\Http\Response|void
//      * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//      */
//     public function view($id=null)
//     {
//         if ($id != null){ //truqui para evitar que se intente acceder sin id por url
//             $car = $this->Cars->get($id/*, el get me devuelve la entidad con ese id
//             ['contain' => ['Users']
//         ]*/);

//             //Todo esto iría al nuevo controlador
//         $pollsCity = 0;
//         $pollsHighway = 0;
//         $pollsCombined = 0;

//         $countCity = 0;
//         $countHighway = 0;
//         $countCombined = 0;

// // hacer un find con todos los vehiculos cuyo modelo corresponde con el de $car->modelo y sacar las medias y tal
//         $modelArray = $this->Cars->find()
//         ->where(['modelo LIKE' => '%'.$car->modelo.'%'])->all();

//         $modelArrayDiesel = $this->Cars->find()
//         ->where(['modelo LIKE' => '%'.$car->modelo.'%','combustible' => 'Diesel'])->all();
//         //        ->where(['modelo LIKE' => '%'.$car->modelo.'%', 'combustible' => 'Diesel'])->all();
        
//         $modelArrayFuel = $this->Cars->find()
//         ->where(['modelo LIKE' => '%'.$car->modelo.'%','combustible' => 'Gasolina'])->all();
        
//         $modelArrayElectric = $this->Cars->find()
//         ->where(['modelo LIKE' => '%'.$car->modelo.'%','combustible' => 'electrico'])->all();

//         $this->set('modelo', $modelArray);

//         if($car != null){
//         $avgCity=0;
//         $avgHighway=0;
//         $avgCombined=0;
//         $maxCity=0;
//         $maxHighway=0;
//         $maxCombined=0;
//         $minCity=100;
//         $minHighway=100;
//         $minCombined=100;
//         foreach ($modelArray as $model) {
//             //Sumamos todos los registros de consumo para calcular la media descartando los ceros y negtivos
//             if($model->consumoCiudad > 0){
//                 $avgCity+=$model->consumoCiudad;
//                 $countCity++;
//                 $pollsCity++; 
//             }
//             if($model->consumoAutopista > 0){
//                 $avgHighway+=$model->consumoAutopista;
//                 $countHighway++;
//                 $pollsHighway++;
//             }
//             if($model->combinado != 0){
//                 $avgCombined+=$model->combinado;
//                 $countCombined++;
//                 $pollsCombined++;
//             }
//             //Aumentamos el contador de número de registros para ese modelo
                
//             //Comprobamos y guardamos los valores máximos
//             if($maxCity < $model->consumoCiudad){
//                 $maxCity = $model->consumoCiudad;
//             }
//             if($maxHighway < $model->consumoAutopista){
//                 $maxHighway = $model->consumoAutopista;
//             }
//             if($maxCombined < $model->combinado){
//                 $maxCombined = $model->combinado;
//             }
//             //Lo mismo con los mínimos
//             if($model->consumoCiudad > 0 && $minCity > $model->consumoCiudad){
//                 $minCity = $model->consumoCiudad;
//             }
//             if($model->consumoAutopista > 0 && $minHighway > $model->consumoAutopista){
//                 $minHighway = $model->consumoAutopista;
//             }
//             if($model->combinado > 0 && $minCombined > $model->combinado){
//                 $minCombined = $model->combinado;
//             }
//         }
//             //Terminamos de calcular las medias dividiendo las sumas totales entre el número de elementos
//             if($countCity > 0 ){
//                 $avgCity /= $countCity;
//             }
//             if($countHighway > 0 ){
//                 $avgHighway /= $countHighway;
//             }
//             if($countCombined > 0){
//                 $avgCombined /= $countCombined;
//             }


//             ////////////////////ahora para diesel
//         $pollsCityD = 0;
//         $pollsHighwayD = 0;
//         $pollsCombinedD = 0;

//         $countCityD = 0;
//         $countHighwayD = 0;
//         $countCombinedD = 0;

//         $avgCityD=0;
//         $avgHighwayD=0;
//         $avgCombinedD=0;
//         $maxCityD=0;
//         $maxHighwayD=0;
//         $maxCombinedD=0;
//         $minCityD=100;
//         $minHighwayD=100;
//         $minCombinedD=100;
//         foreach ($modelArrayDiesel as $model) {
//             //Sumamos todos los registros de consumo para calcular la media descartando los ceros y negtivos
//             if($model->consumoCiudad > 0){
//                 $avgCityD+=$model->consumoCiudad;
//                 $countCityD++;
//                 $pollsCityD++; 
//             }
//             if($model->consumoAutopista > 0){
//                 $avgHighwayD+=$model->consumoAutopista;
//                 $countHighwayD++;
//                 $pollsHighwayD++;
//             }
//             if($model->combinado != 0){
//                 $avgCombinedD+=$model->combinado;
//                 $countCombinedD++;
//                 $pollsCombinedD++;
//             }
//             //Aumentamos el contador de número de registros para ese modelo
                
//             //Comprobamos y guardamos los valores máximos
//             if($maxCityD < $model->consumoCiudad){
//                 $maxCityD = $model->consumoCiudad;
//             }
//             if($maxHighwayD < $model->consumoAutopista){
//                 $maxHighwayD = $model->consumoAutopista;
//             }
//             if($maxCombinedD < $model->combinado){
//                 $maxCombinedD = $model->combinado;
//             }
//             //Lo mismo con los mínimos
//             if($model->consumoCiudad > 0 && $minCity > $model->consumoCiudad){
//                 $minCityD = $model->consumoCiudad;
//             }
//             if($model->consumoAutopista > 0 && $minHighway > $model->consumoAutopista){
//                 $minHighwayD = $model->consumoAutopista;
//             }
//             if($model->combinado > 0 && $minCombined > $model->combinado){
//                 $minCombinedD = $model->combinado;
//             }
//         }
//             //Terminamos de calcular las medias dividiendo las sumas totales entre el número de elementos
//             if($countCityD > 0 ){
//                 $avgCityD /= $countCityD;
//             }
//             if($countHighwayD > 0 ){
//                 $avgHighwayD /= $countHighwayD;
//             }
//             if($countCombinedD > 0){
//                 $avgCombinedD /= $countCombinedD;
//             }


//             ////////////////////// AHORA PARA FUEL
//         $pollsCityF = 0;
//         $pollsHighwayF = 0;
//         $pollsCombinedF = 0;

//         $countCityF = 0;
//         $countHighwayF = 0;
//         $countCombinedF = 0;

//         $avgCityF=0;
//         $avgHighwayF=0;
//         $avgCombinedF=0;
//         $maxCityF=0;
//         $maxHighwayF=0;
//         $maxCombinedF=0;
//         $minCityF=100;
//         $minHighwayF=100;
//         $minCombinedF=100;
//         foreach ($modelArrayFuel as $model) {
//             //Sumamos todos los registros de consumo para calcular la media descartando los ceros y negtivos
//             if($model->consumoCiudad > 0){
//                 $avgCityF+=$model->consumoCiudad;
//                 $countCityF++;
//                 $pollsCityF++; 
//             }
//             if($model->consumoAutopista > 0){
//                 $avgHighwayF+=$model->consumoAutopista;
//                 $countHighwayF++;
//                 $pollsHighwayF++;
//             }
//             if($model->combinado != 0){
//                 $avgCombinedF+=$model->combinado;
//                 $countCombinedF++;
//                 $pollsCombinedF++;
//             }
//             //Aumentamos el contador de número de registros para ese modelo
                
//             //Comprobamos y guardamos los valores máximos
//             if($maxCityF < $model->consumoCiudad){
//                 $maxCityF = $model->consumoCiudad;
//             }
//             if($maxHighwayF < $model->consumoAutopista){
//                 $maxHighwayF = $model->consumoAutopista;
//             }
//             if($maxCombinedF < $model->combinado){
//                 $maxCombinedF = $model->combinado;
//             }
//             //Lo mismo con los mínimos
//             if($model->consumoCiudad > 0 && $minCity > $model->consumoCiudad){
//                 $minCityF = $model->consumoCiudad;
//             }
//             if($model->consumoAutopista > 0 && $minHighway > $model->consumoAutopista){
//                 $minHighwayF = $model->consumoAutopista;
//             }
//             if($model->combinado > 0 && $minCombined > $model->combinado){
//                 $minCombinedF = $model->combinado;
//             }
//         }
//             //Terminamos de calcular las medias dividiendo las sumas totales entre el número de elementos
//             if($countCityF > 0 ){
//                 $avgCityF /= $countCityF;
//             }
//             if($countHighwayF > 0 ){
//                 $avgHighwayF /= $countHighwayF;
//             }
//             if($countCombinedF > 0){
//                 $avgCombinedF /= $countCombinedF;
//             }

//         }else{
//             //no polls for that car
//         }
//         // echo $avgCity." ";
//         // echo $avgCombined." "; 
//         // echo $avgHighway;

//         // aquí hay que usar un queryBuilder para recuperar todos los registros de coche que tengan el mismo tipo de cmbustible y modelo y hacer la media de sus consumos.
//         $this->set('avgCity', $avgCity);
//         $this->set('avgHighway', $avgHighway);
//         $this->set('avgCombined', $avgCombined);
        
//         $this->set('maxCity', $maxCity);
//         $this->set('maxHighway', $maxHighway);
//         $this->set('maxCombined', $maxCombined);
        
//         $this->set('minCity', $minCity);
//         $this->set('minHighway', $minHighway);
//         $this->set('minCombined', $minCombined);
        
//         $this->set('pollsCity', $pollsCity);
//         $this->set('pollsHighway', $pollsHighway);
//         $this->set('pollsCombined', $pollsCombined);

//         $this->set('avgCityD', $avgCityD);
//         $this->set('avgHighwayD', $avgHighwayD);
//         $this->set('avgCombinedD', $avgCombinedD);
        
//         $this->set('maxCityD', $maxCityD);
//         $this->set('maxHighwayD', $maxHighwayD);
//         $this->set('maxCombinedD', $maxCombinedD);
        
//         $this->set('minCityD', $minCityD);
//         $this->set('minHighwayD', $minHighwayD);
//         $this->set('minCombinedD', $minCombinedD);
        
//         $this->set('pollsCityD', $pollsCityD);
//         $this->set('pollsHighwayD', $pollsHighwayD);
//         $this->set('pollsCombinedD', $pollsCombinedD);

//         $this->set('avgCityF', $avgCityF);
//         $this->set('avgHighwayF', $avgHighwayF);
//         $this->set('avgCombinedF', $avgCombinedF);
        
//         $this->set('maxCityF', $maxCityF);
//         $this->set('maxHighwayF', $maxHighwayF);
//         $this->set('maxCombinedF', $maxCombinedF);
        
//         $this->set('minCityF', $minCityF);
//         $this->set('minHighwayF', $minHighwayF);
//         $this->set('minCombinedF', $minCombinedF);
        
//         $this->set('pollsCityF', $pollsCityF);
//         $this->set('pollsHighwayF', $pollsHighwayF);
//         $this->set('pollsCombinedF', $pollsCombinedF);

        
//         $this->set('car', $car);
//         $this->set('_serialize', ['car']);
//     }else{
//         $this->redirect(['action' => 'index']);
//     }
//     }

//     /**
//      * Add method
//      *
//      * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
//      */
//     public function add()
//     {
//         $this->Cars->find('all')->contain(['Users']
//         debug()
//     $data->tags->_joinData->data_from_join_data);

//         $car = $this->Cars->newEntity();
//         if ($this->request->is('post')) {
//             $car = $this->Cars->patchEntity($car, $this->request->getData(),
//                 ['associated' => [
//                     'Users.__joinData']]
//             );

//             $car->user_id = $this->Auth->user('id'); //el usuario autenticado
            

//             if ($this->Cars->save($car)) {
//                 $this->Flash->success(__('The car has been saved.'));

//                 return $this->redirect(['action' => 'index']);
//             }
//             $this->Flash->error(__('The car could not be saved. Please, try again.'));
//         }

//         //$users = $this->Cars->Users->find('list', ['limit' => 200]);

//         //$brand = $brands;
//         //$models = $models
//         // $brands = $this->Cars->find('all', ['fields'=>['DISTINCT marca']]);
//         // foreach ($result as $res) {
//         //     debug($res->marca);
//         // }
        
//         $brand = $this->Cars->find()->select(['Cars.marca'])->distinct()->toArray();
//         $models = $this->Cars->find()->select(['Cars.modelo'])->distinct()->toArray();
        
//         $this->set('models', $models);
//         $this->set('brands', $brand);
//         $this->set(compact('car', 'users'));
//         $this->set('_serialize', ['car']);
//     }

//     /**
//      * Edit method
//      *
//      * @param string|null $id Car id.
//      * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
//      * @throws \Cake\Network\Exception\NotFoundException When record not found.
//      */
//     public function edit($id = null)
//     {
//         $car = $this->Cars->get($id, [
//             'contain' => []
//         ]);

//             //&& ($car->user_id == $this->Auth->user('id'))
//         if ($this->request->is(['patch', 'post', 'put']) ) {
//             $car = $this->Cars->patchEntity($car, $this->request->getData());
//            // $car->user_id = $this->Auth->user('id');

//             if ($this->Cars->save($car)) {
//                 $this->Flash->success(__('The car has been saved.'));

//                 return $this->redirect(['action' => 'index']);
//             }
//             $this->Flash->error(__('The car could not be saved. Please, try again.'));
//         }
//         //$users = $this->Cars->Users->find('list', ['limit' => 200]);
//         $this->set(compact('car'));
//         $this->set('_serialize', ['car']);
//     }

//     /**
//      * Delete method
//      *
//      * @param string|null $id Car id.
//      * @return \Cake\Http\Response|null Redirects to index.
//      * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//      */
//     public function delete($id = null)
//     {
//         $this->request->allowMethod(['post', 'delete']);
//         $car = $this->Cars->get($id);
//         if ($this->Cars->delete($car)) {
//             $this->Flash->success(__('The car has been deleted.'));
//         } else {
//             $this->Flash->error(__('The car could not be deleted. Please, try again.'));
//         }

//         return $this->redirect(['action' => 'index']);
//     }

//     //mi idea es renderizar el método view pero 
//     //con los datos de la búsqueda para no hacer
//     // otra página search, aunque también valdría.
//     public function search($query=null){

//         if(!empty($this->request->query['query'])){

//             $query = $this->request->query['query'];
//             $query = preg_replace('/[^a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]/', '', $query);
//             // debug($query);

//             $terms = explode(' ', trim($query));
//             $terms = array_diff($terms, array(''));

//             foreach ($terms as $term) {
//                 $conditions[] = array('OR' => ['Cars.marca LIKE' => '%' . $term . '%', 'Cars.modelo LIKE' => '%' . $term . '%']);
//             }

            
//             $cars = $this->Cars->find('all', array('recursive'=> -1, 'conditions' => $conditions, 'limit' => 20));
//             $cars->distinct(['modelo']);
            
//         //Terminamos de calcular las medias dividiendo las sumas totales entre el número de elementos de cada una de las apariciones concretas, pero para la búsqueda de momento mostramos simplemente el primero que aparezca 



//             if(count($cars) == 1) //lo mando directamente al coche que es
//             {
//                 // debug($cars);
//                 //return $this->redirect(array('controller' => 'cars', 'action' => 'view', $cars[0]['Car']['id']));
//             }
//             $this->set(compact('cars'));

//         }

//         $this->set(compact('query'));
//         // return $this->redirect(['action' => 'index']);

//         //ahora se evalua una petición AJAX para poder generar uan vista de resultados con él.
//         if($this->request->is('ajax'))
//         {
//             $this->layout = false;
//             $this->set('ajax', 1);
//         }
//         else
//         {
//             $this->set('ajax', 0);
//         }


//         /* anterior
//         $query = $this->Cars->find();

//         return $this->redirect(['action' => 'index']);
//             */
// //      $this->render(); lo llama automáticamente al final de cada acción
//    /*     $query = $this->Cars->get($query, [
//             'contain' => ['marca']
//         ]);

//         $this->set('car', $car);
//         $this->set('_serialize', ['car']);
//     */}
// }

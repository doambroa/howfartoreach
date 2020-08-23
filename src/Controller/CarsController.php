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
            if(in_array($this->request->action, ['view', 'search', 'filter', 'addContribution','getModelByBrand','getFuelByModel', 'howTo']))
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

        $this->Auth->allow(['search', 'view', 'contributions', 'howTo','exportCars','exportContributions','exportAverages','exportCarContributions','exportContributionsByBrand']);
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

        if ($this->request->getQuery('amountC') || $this->request->getQuery('amountH') || $this->request->getQuery('amountCo') || $this->request->getQuery('brands') || $this->request->getQuery('typeOfFuel')){

            if(isset($this->request->getQuery()['typeOfFuel'])){
               $typeOfFuel = $this->request->getQuery()['typeOfFuel'];
            }else{
               $typeOfFuel = ['Diesel', 'Petrol', 'Electric'];
            }
            $city = ($this->request->getQuery()["amountC"]);
            $highway = ($this->request->getQuery()["amountH"]);
            $combined = ($this->request->getQuery()["amountCo"]);

            $city = str_replace('%', '', $city);
            $city = str_replace(' ', '', $city);
            $city = explode("-" , $city);
            $highway = str_replace('%', '', $highway);
            $highway = str_replace(' ', '', $highway);
            $highway = explode("-" , $highway);
            $combined = str_replace('%', '', $combined);
            $combined = str_replace(' ', '', $combined);
            $combined = explode("-" , $combined);

            $minCity = $city[0];
            $minHighway = $highway[0];
            $minCombined = $combined[0];
            $maxCity = $city[1];
            $maxHighway = $highway[1];
            $maxCombined = $combined[1];            

             if(isset($this->request->getQuery()['brands'])) {
                $brands = $this->request->getQuery()['brands'];
             } else{
                $brands = $this->Cars->find()->select([
                    'marca' => 'cars.marca'
                ]);
             }             

            $this->loadModel('CarsUsers');
            // $this->paginate['CarsUsers']['page'] = 1;
            $contributions = $this->paginate($this->CarsUsers->find()->select([
                'id',
                'car_id' => 'cars.id', 
                'marca' => 'cars.marca',
                'modelo' => 'cars.modelo',
                'consumoCiudad' => 'AVG(carsusers.consumoCiudad)',
                'consumoAutopista' => 'AVG(carsusers.consumoAutopista)',
                'combinado' => 'AVG(carsusers.combinado)',
                'combustible' => 'cars.combustible',
                'polls' => 'count(cars.id)',
                'page' => 1])
                ->where(['marca IN' => $brands, 'combustible IN' => $typeOfFuel, 'consumoCiudad >=' => $minCity, 'consumoCiudad <=' => $maxCity, 'consumoAutopista >=' => $minHighway, 'consumoAutopista <=' => $maxHighway, 'combinado >=' => $minCombined, 'combinado <=' => $maxCombined])
                ->innerJoinWith('Cars')
                ->group(['cars.modelo','cars.combustible'])
            );

            // debug($this->passedArgs);
            // debug($this->request->getData());
         
         } else {
            // $connection = ConnectionManager::get('default');
            // $contributions = $connection->execute('SELECT cars.id as car_id, cars.marca as marca, cars.modelo as modelo, AVG(contribution.consumoCiudad) as avgCity, AVG(contribution.consumoAutopista) as avgHighway, AVG(contribution.combinado) as avgCombined, cars.combustible as combustible, count(cars.id) as polls FROM cars_users AS contribution INNER JOIN cars ON cars.id = contribution.car_id GROUP BY cars.modelo, cars.combustible')->fetchAll('assoc');

            $minCity = 4;
            $minHighway = 3;
            $minCombined = 3.5;
            $maxCity = 6.5;
            $maxHighway = 11;
            $maxCombined = 8;
            $typeOfFuel = [];

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
                ->group(['cars.modelo','cars.combustible']));

        }
            $cars = $this->Cars->find()->group(['Cars.modelo']);
            $fuelTypes = $this->Cars->find()->select(['Cars.combustible'])->distinct()->toArray();
            $marcas = $this->Cars->find()->select(['Cars.marca'])->distinct()->toArray();

           // $most = $this->Cars->find()->select(['count' => $this->Cars->find()->func()->count('*')])->group(['Cars.modelo']);
            //$brands = $this->Cars->find('all', ['fields'=>['DISTINCT marca']]);   
            

            $this->set('minCity', $minCity);
            $this->set('minHighway', $minHighway);
            $this->set('minCombined', $minCombined);
            $this->set('maxCity', $maxCity);
            $this->set('maxHighway', $maxHighway);
            $this->set('maxCombined', $maxCombined);
            $this->set('typeOfFuel', $typeOfFuel);

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
            if($this->request->getData()['modelo'] != null){
                $car_id = $this->Cars->find()->select(['id'])->where(['modelo =' => $this->request->getData()['modelo'], 'combustible ='=> $this->request->getData()['combustible']])->first()->get('id'); 
            }
            $data = $this->request->getData();
            $data['car_id'] = $car_id;

            $carsUser = $this->CarsUsers->patchEntity($carsUser, $data);
            if ($this->CarsUsers->save($carsUser)) {
                $this->Flash->success(__('The contribution has been saved.'));

                return $this->redirect(['controller' => 'Cars', 'action' => 'contributions']);
            }                       
            $this->Flash->error(__('The contribution could not be saved. Please, try again.'));
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
        $queryModelos = $this->Cars->find()->select(['Cars.modelo'])->distinct()->where(['marca'=>$car->marca, 'combustible'=>$car->combustible])->toArray();
        
        $modelos = array();

        foreach ($queryModelos as $objetoModelo) {

            array_push($modelos, $objetoModelo->modelo);
        }
        
        //obtenemos los datos de la relación
        $this->loadModel('CarsUsers');

       $chartAverages = $this->CarsUsers->find()->select([
            'modelo' => 'Cars.modelo',
            'combustible' => 'cars.combustible',
            'consumoCiudad' => 'AVG(carsusers.consumoCiudad)',
            'pollsCity' => 'count(carsusers.consumoCiudad)',
            'consumoAutopista' => 'AVG(carsusers.consumoAutopista)',
            'pollsHighway' => 'count(carsusers.consumoAutopista)',
            'combinado' => 'AVG(carsusers.combinado)',
            'pollsCombined' => 'count(carsusers.combinado)'])
        ->where(['cars.marca' => $car->marca, 'cars.combustible' => $car->combustible])
        ->innerJoinWith('Cars')
        ->group(['cars.marca','cars.modelo','cars.combustible']);

        $chartAverages->enableHydration(false); // esto hace que devuelva un array en lugar de un objeto

        $averagesByYear = $this->CarsUsers->find()->select([
                'marca' => 'Cars.marca',
                'modelo' => 'Cars.modelo',
                'car_ano' => 'Cars.ano',
                'combustible' => 'cars.combustible',
                'consumoCiudad' => 'AVG(carsusers.consumoCiudad)',
                'pollsCity' => 'count(carsusers.consumoCiudad)',
                'consumoAutopista' => 'AVG(carsusers.consumoAutopista)',
                'pollsHighway' => 'count(carsusers.consumoAutopista)',
                'combinado' => 'AVG(carsusers.combinado)',
                'pollsCombined' => 'count(carsusers.combinado)',
                'mediaGlobal' => '(AVG(carsusers.consumoCiudad)+AVG(carsusers.consumoAutopista)+AVG(carsusers.combinado))/3'
            ])
            ->where(['cars.marca' => $car->marca, 'cars.combustible' => $car->combustible])
            ->innerJoinWith('Cars')
            ->group(['cars.marca', 'cars.ano'])
            ->order('cars.ano');
        
        $averagesByYear->enableHydration(false);

          $averagesByBrand = $this->CarsUsers->find()->select([
                'marca' => 'Cars.marca',
                'combustible' => 'cars.combustible',
                'consumoCiudad' => 'AVG(carsusers.consumoCiudad)',
                'pollsCity' => 'count(carsusers.consumoCiudad)',
                'consumoAutopista' => 'AVG(carsusers.consumoAutopista)',
                'pollsHighway' => 'count(carsusers.consumoAutopista)',
                'combinado' => 'AVG(carsusers.combinado)',
                'pollsCombined' => 'count(carsusers.combinado)'])
            ->where(['cars.marca' => $car->marca, 'cars.combustible' => $car->combustible])
            ->innerJoinWith('Cars')
            ->group(['cars.marca','cars.combustible']);

            $averagesByBrand->enableHydration(false);
        // $chartModels = array();

        //me lo puedo crear y parsearlo en JS
        // foreach ($chartAverages as $chart) {

        //     array_push($chartModels, $chart->modelo.",".$chart->combustible );
        // }
        // debug($chartModels);


        // debug($modelsChart->toArray());

        $relatedContributions = $this->CarsUsers->find()->where(['car_id =' => $car->id])->all();

        $maxHighway = $relatedContributions->max(function ($max) {
            return $max->consumoAutopista;
        });
        if($maxHighway->consumoAutopista !=null){
            $maxHighway = $maxHighway->consumoAutopista;
        }else{
            $maxHighway = 0;
        }

        $maxCity = $relatedContributions->max(function ($max) {
            return $max->consumoCiudad;
        });
        if($maxCity->consumoCiudad != null){
            $maxCity = $maxCity->consumoCiudad;
        }else{
            $maxCity = 0;
        }

        $maxCombined = $relatedContributions->max(function ($max) {
            return $max->combinado;
        });
        if($maxCombined->combinado != null){
            $maxCombined = $maxCombined->combinado;
        }else{
            $maxCombined = 0;
        }

        //esto se trae los nulls
        // $minCity = $relatedContributions->min(function ($min) {
        //     return $min->consumoCiudad;
        // });
        // $minCity = $minCity->consumoCiudad; 

        $minCity = $this->CarsUsers->find()->select([
            "consumoCiudad" => "min(consumoCiudad)"
        ])->where(['car_id =' => $car->id, 'consumoCiudad IS NOT' => null])->first()->consumoCiudad;

        // $minHighway = $relatedContributions->min(function ($min) {
        //     return $min->consumoAutopista;
        // });
        // $minHighway = $minHighway->consumoAutopista;

        $minHighway = $this->CarsUsers->find()->select([
            "consumoAutopista" => "min(consumoAutopista)"
        ])->where(['car_id =' => $car->id, 'consumoAutopista IS NOT' => null])->first()->consumoAutopista;

        // $minCombined = $relatedContributions->min(function ($min) {
        //     return $min->combinado;
        // });
        // $minCombined = $minCombined->combinado;

        $minCombined = $this->CarsUsers->find()->select([
            "combinado" => "min(combinado)"
        ])->where(['car_id =' => $car->id, 'combinado IS NOT' => null])->first()->combinado;

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

        $middlevalCity = 0;
        $middlevalHighway = 0;
        $middlevalCombined = 0;

        $avgCity = 0;
        $avgHighway = 0;
        $avgCombined = 0;
    
        $loginArr = array();

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
            $login = $this->CarsUsers->Users->find()->select([
                'login'
            ])->where(['id' => $contribution->user_id])->first();


           array_push($loginArr, $login);

        }
        
        //ordenamos los arrays de medianas y tomamos el valor del medio en pares e impares
        if(!empty($medianCity)){
            sort($medianCity);
        }else{
            $medianCity = 0;
        }
        $middlevalCity = floor(($pollsCity-1)/2);
        if($pollsCity % 2) {
            $medianCity = $medianCity[$middlevalCity];
        } else {
            $low = $medianCity[$middlevalCity];
            $high = $medianCity[$middlevalCity+1];
            $medianCity = (($low+$high)/2);
        }

        if(!empty($medianHighway)){
            sort($medianHighway);
        }else{
            $medianHighway = 0;
        }
        $middlevalHighway = floor(($pollsHighway-1)/2);
        
        if($middlevalHighway > -1){
            if($pollsHighway % 2) {
                $medianHighway = $medianHighway[$middlevalHighway];
            } else {
                $low = $medianHighway[$middlevalHighway];
                $high = $medianHighway[$middlevalHighway+1];
                $medianHighway = (($low+$high)/2);
            }
        }

        if(!empty($medianCombined)){
            sort($medianCombined);
        }else{
            $medianCombined = 0;
        }
        $middlevalCombined = floor(($pollsCombined-1)/2);
        if($middlevalCombined > -1){
            if($pollsCombined % 2) {
                $medianCombined = $medianCombined[$middlevalCombined];
            } else {
                $low = $medianCombined[$middlevalCombined];
                $high = $medianCombined[$middlevalCombined+1];
                $medianCombined = (($low+$high)/2);
            }
        }
        if($pollsCity > 0){
            $avgCity = $totalCity / $pollsCity;
        }
        if($pollsHighway > 0){
            $avgHighway = $totalHighway / $pollsHighway;
        }
        if($pollsCombined > 0){
            $avgCombined = $totalCombined / $pollsCombined;
        }               


        $this->set('relatedContributions', $relatedContributions);

        $this->set('combustibles', $combustibles);
        
        $this->set('modelos', $modelos);
        $this->set('chartAverages', $chartAverages);
        $this->set('averagesByYear', $averagesByYear);
        $this->set('loginArr', $loginArr);
        $this->set('averagesByBrand', $averagesByBrand);


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
     * @return \Cake\Http\Response|null Redirects on successful add, renders View otherwise.
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

            
           $cars = $this->Cars->find('all', array('recursive'=> -1, 'conditions' => $conditions));
           $cars->distinct(['modelo']);
            
            $this->loadModel('CarsUsers');

            $contributions = $this->CarsUsers->find()->select([
                    'id',
                    'car_id',
                    'car_marca' => 'Cars.marca',
                    'car_modelo' => 'Cars.modelo',
                    'consumoCiudad' => 'AVG(carsusers.consumoCiudad)',
                    'consumoAutopista' => 'AVG(carsusers.consumoAutopista)',
                    'combinado' => 'AVG(carsusers.combinado)',
                    'combustible' => 'cars.combustible',
                    'polls' => 'count(cars.id)',
                    'pollsCity' => 'count(carsusers.consumoCiudad)',
                    'pollsHighway' => 'count(carsusers.consumoAutopista)',
                    'pollsCombined' => 'count(carsusers.combinado)'])
                    ->where([$conditions])
                    ->innerJoinWith('Cars')
                    ->group(['cars.modelo','cars.combustible']) // el añadir aqui el cars. combustible saca casquetones, aunque saca la info bien.
            ;
            $this->set(compact('contributions'));

            // foreach ($contributions as $contribution) {
            //     # code
            //  //    debug($contribution->pollsCiudad);
            // }

            // foreach ($cars as $car) {
                

            //   //  $measures = $this->CarsUsers->find()->select(['carsusers.tipoConduccion','carsusers.consumoCiudad','carsusers.consumoAutopista','carsusers.combinado','Cars.ano'])->where(['carsusers.car_id=' => $car->id]);
            // }

            // //Terminamos de calcular las medias dividiendol as sumas totales entre el número de elementos de cada una de las apariciones concretas, pero para la búsqueda de momento mostramos simplemente el primero que aparezca 

            // if(count($cars) == 1) //lo mando directamente al coche que es
            // {
            //     // debug($cars);
            //     //return $this->redirect(array('controller' => 'cars', 'action' => 'view', $cars[0]['Car']['id']));
            // }
            $this->set(compact('cars'));

        }

        $this->set('measures');



        $this->set(compact('query'));
        // return $this->redirect(['action' => 'index']);

        //ahora se evalua una petición AJAX para poder generar una vista de resultados con él.
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

    //todos los cars
    public function exportCars()
    {
            $cars = $this->Cars->find()->select(['Cars.marca','Cars.modelo','Cars.combustible','Cars.ano']);
            $_serialize = 'cars';
            $_header = ['Brand', 'Model','Fuel','Year'];
                

            $this->response = $this->response->withDownload('cars.csv');
            $this->viewBuilder()->setClassName('CsvView.Csv');
            $this->set(compact('cars', '_header', '_serialize'));
    }

    //todas las contribuciones
    public function exportContributions()
    {
        $this->loadModel('CarsUsers');
              
           $carsUsers = $this->CarsUsers->find()->select([
                'car_marca' => 'Cars.marca',
                'car_modelo' => 'Cars.modelo',
                'car_ano' => 'Cars.ano',
                'car_driving' => 'carsusers.tipoConduccion',
                'consumoCiudad' => 'carsusers.consumoCiudad',
                'consumoAutopista' => 'carsusers.consumoAutopista',
                'combinado' => 'carsusers.combinado',
                'combustible' => 'cars.combustible',
                'created' => 'carsusers.creado'])
                ->innerJoinWith('Cars');

            $_serialize = 'carsUsers';
            $_header = ['Brand', 'Model','Year','Driving','City','Highway','Combined','Fuel','Created'];

            $this->response = $this->response->withDownload('contributions.csv');
            $this->viewBuilder()->setClassName('CsvView.Csv');
            $this->set(compact('carsUsers', '_header', '_serialize'));
    }

    //medias de consumo por modelo y tipo de combustible
    public function exportAverages()
    {
             $this->loadModel('CarsUsers');

        $averagesByModel = $this->CarsUsers->find()->select([
                'marca' => 'Cars.marca',
                'modelo' => 'Cars.modelo',
                'car_ano' => 'Cars.ano',
                'combustible' => 'cars.combustible',
                'consumoCiudad' => 'AVG(carsusers.consumoCiudad)',
                'pollsCity' => 'count(carsusers.consumoCiudad)',
                'consumoAutopista' => 'AVG(carsusers.consumoAutopista)',
                'pollsHighway' => 'count(carsusers.consumoAutopista)',
                'combinado' => 'AVG(carsusers.combinado)',
                'pollsCombined' => 'count(carsusers.combinado)'])
            ->innerJoinWith('Cars')
            ->group(['cars.modelo','cars.combustible']);
        $_serialize = 'averagesByModel';
       
        $_header = ['Brand', 'Model','Year','Fuel','City','pollsCity','Highway','pollsHighway','Combined','pollsCombined'];
                

        $this->response = $this->response->withDownload('averagesByModel.csv');
        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('averagesByModel', '_header', '_serialize'));
    }

    
    //exportAveragesCar
    public function exportCarContributions($carId=null)
    {
             $this->loadModel('CarsUsers');

       $averagesByThis = $this->CarsUsers->find()->select([
                'car_marca' => 'Cars.marca',
                'car_modelo' => 'Cars.modelo',
                'car_ano' => 'Cars.ano',
                'car_driving' => 'carsusers.tipoConduccion',
                'combustible' => 'cars.combustible',
                'consumoCiudad' => 'carsusers.consumoCiudad',
                'consumoAutopista' => 'carsusers.consumoAutopista',
                'combinado' => 'carsusers.combinado',
                'created' => 'carsusers.creado'])
                ->innerJoinWith('Cars')
                ->where(['Cars.id' =>  $carId]);

        $_serialize = 'averagesByThis';
       
        $brand = $this->Cars->find()->select(['marca'])->where(['id =' => $carId])->first()->marca;
        $model = $this->Cars->find()->select(['modelo'])->where(['id =' => $carId])->first()->modelo;

        $_header = ['Brand', 'Model','Year','Driving','Fuel','City','Highway','Combined'];

        $this->response = $this->response->withDownload($brand.' '.$model.'.csv');
        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('averagesByThis', '_header', '_serialize'));
    }


    //consumos por marca 
    //SELECT Cars.marca AS `marca`, cars.combustible AS `combustible`, AVG(carsusers.consumoCiudad) AS `consumoCiudad`, count(carsusers.consumoCiudad) AS `pollsCity`, AVG(carsusers.consumoAutopista) AS `consumoAutopista`, count(carsusers.consumoAutopista) AS `pollsHighway`, AVG(carsusers.combinado) AS `combinado`, count(carsusers.combinado) AS `pollsCombined` FROM cars_users CarsUsers INNER JOIN cars Cars ON Cars.id = (CarsUsers.car_id) GROUP BY cars.marca, cars.combustible
    public function exportContributionsByBrand()
    {
             $this->loadModel('CarsUsers');

       $averagesByBrand = $this->CarsUsers->find()->select([
                'marca' => 'Cars.marca',
                'combustible' => 'cars.combustible',
                'consumoCiudad' => 'AVG(carsusers.consumoCiudad)',
                'pollsCity' => 'count(carsusers.consumoCiudad)',
                'consumoAutopista' => 'AVG(carsusers.consumoAutopista)',
                'pollsHighway' => 'count(carsusers.consumoAutopista)',
                'combinado' => 'AVG(carsusers.combinado)',
                'pollsCombined' => 'count(carsusers.combinado)'])
            ->innerJoinWith('Cars')
            ->group(['cars.marca','cars.combustible']);

        $_serialize = 'averagesByBrand';

        $_header = ['Brand','Fuel','City','pollsCity','Highway','pollsHighway','Combined','pollsCombined'];

        $this->response = $this->response->withDownload('ContributionsByBrand.csv');
        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('averagesByBrand', '_header', '_serialize'));
    }

    //medias de consumo por año de matriculación 
    // public function exportByYear()
    // {
    //     $this->loadModel('CarsUsers');

    //     $averagesByYear = $this->CarsUsers->find()->select([
    //             'marca' => 'Cars.marca',
    //             'modelo' => 'Cars.modelo',
    //             'car_ano' => 'Cars.ano',
    //             'combustible' => 'cars.combustible',
    //             'consumoCiudad' => 'AVG(carsusers.consumoCiudad)',
    //             'consumoAutopista' => 'AVG(carsusers.consumoAutopista)',
    //             'combinado' => 'AVG(carsusers.combinado)'])
    //         ->innerJoinWith('Cars')
    //         ->group(['cars.modelo','cars.combustible','cars.ano']);
    //     $_serialize = 'averagesByModel';
       
    //     $_header = ['Brand', 'Model','Year','Fuel','City','pollsCity','Highway','pollsHighway','Combined','pollsCombined'];

    //     $this->response = $this->response->withDownload('averagesByYear .csv');
    //     $this->viewBuilder()->setClassName('CsvView.Csv');
    //     $this->set(compact('averagesByModel', '_header', '_serialize'));
    // }

    public function howTo(){
        $this->render();
    }

    public function getModelByBrand(){
         if ($this->request->is(['ajax', 'post'])) {
            $results = $this->Cars->find()->select(['modelo'])->where(['marca =' => $this->request->getData()['marca']])->group('modelo')->toList();
            $this->response->getBody()->write(json_encode($results));
            return $this->response;
         }
    }

    public function getFuelByModel(){
        if ($this->request->is(['ajax', 'post'])) {
            $results = $this->Cars->find()->select(['combustible'])->where(['modelo =' => $this->request->getData()['modelo']])->group('combustible')->toList();
            $this->response->getBody()->write(json_encode($results));
            return $this->response;
        }
    }

}
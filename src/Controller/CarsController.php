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

    var $name = 'Cars';
    public $components = ['RequestHandler'];


    public function isAuthorized($user){
        // los de registrado 
        if(isset($user['role']) and $user['role'] === 'user'){
            if(in_array($this->request->action, ['index', 'view', 'search', 'add', 'filter', 'howTo'])) //acciones que se le permiten a cada user, el this request action devuelve la accion a la que se intentó acceder, y para pdoer acceder tiene q ue estar en la lista
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
        $cars = $this->paginate($this->Cars, ['maxLimit' => 600]);

        $this->set(compact('cars'));
        $this->set('_serialize', ['cars']);

        $marcas = $this->Cars->find()->select(['Cars.marca'])->distinct()->toArray();
        $fuelTypes = $this->Cars->find()->select(['Cars.combustible'])->distinct()->toArray();

        // $most = $this->Cars->find()->select(['count' => $this->Cars->find()->func()->count('*')])->group(['Cars.modelo']);
        // debug($most);

        // $connection = ConnectionManager::get('default');
        // $results = $connection->execute(' SELECT modelo FROM cars WHERE (SELECT COUNT(modelo) FROM cars GROUP BY modelo'))->fetchAll('assoc');
        // debug($results);

        $this->set('marcas', $marcas);
        $this->set('fuelType', $fuelTypes);

    }

    /**
     * View method
     *
     * @param string|null $id Car id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id=null)
    {
        if ($id != null){ //truqui para evitar que se intente acceder sin id por url
            $car = $this->Cars->get($id/*, el get me devuelve la entidad con ese id
            ['contain' => ['Users']
        ]*/);

            //Todo esto iría al nuevo controlador
        $pollsCity = 0;
        $pollsHighway = 0;
        $pollsCombined = 0;

        $countCity = 0;
        $countHighway = 0;
        $countCombined = 0;

// hacer un find con todos los vehiculos cuyo modelo corresponde con el de $car->modelo y sacar las medias y tal
        $modelArray = $this->Cars->find()
        ->where(['modelo LIKE' => '%'.$car->modelo.'%'])->all();

        $modelArrayDiesel = $this->Cars->find()
        ->where(['modelo LIKE' => '%'.$car->modelo.'%','combustible' => 'Diesel'])->all();
        //        ->where(['modelo LIKE' => '%'.$car->modelo.'%', 'combustible' => 'Diesel'])->all();
        
        $modelArrayFuel = $this->Cars->find()
        ->where(['modelo LIKE' => '%'.$car->modelo.'%','combustible' => 'Gasolina'])->all();
        
        $modelArrayElectric = $this->Cars->find()
        ->where(['modelo LIKE' => '%'.$car->modelo.'%','combustible' => 'electrico'])->all();

        $this->set('modelo', $modelArray);

        if($car != null){
        $avgCity=0;
        $avgHighway=0;
        $avgCombined=0;
        $maxCity=0;
        $maxHighway=0;
        $maxCombined=0;
        $minCity=100;
        $minHighway=100;
        $minCombined=100;
        foreach ($modelArray as $model) {
            //Sumamos todos los registros de consumo para calcular la media descartando los ceros y negtivos
            if($model->consumoCiudad > 0){
                $avgCity+=$model->consumoCiudad;
                $countCity++;
                $pollsCity++; 
            }
            if($model->consumoAutopista > 0){
                $avgHighway+=$model->consumoAutopista;
                $countHighway++;
                $pollsHighway++;
            }
            if($model->combinado != 0){
                $avgCombined+=$model->combinado;
                $countCombined++;
                $pollsCombined++;
            }
            //Aumentamos el contador de número de registros para ese modelo
                
            //Comprobamos y guardamos los valores máximos
            if($maxCity < $model->consumoCiudad){
                $maxCity = $model->consumoCiudad;
            }
            if($maxHighway < $model->consumoAutopista){
                $maxHighway = $model->consumoAutopista;
            }
            if($maxCombined < $model->combinado){
                $maxCombined = $model->combinado;
            }
            //Lo mismo con los mínimos
            if($model->consumoCiudad > 0 && $minCity > $model->consumoCiudad){
                $minCity = $model->consumoCiudad;
            }
            if($model->consumoAutopista > 0 && $minHighway > $model->consumoAutopista){
                $minHighway = $model->consumoAutopista;
            }
            if($model->combinado > 0 && $minCombined > $model->combinado){
                $minCombined = $model->combinado;
            }
        }
            //Terminamos de calcular las medias dividiendo las sumas totales entre el número de elementos
            if($countCity > 0 ){
                $avgCity /= $countCity;
            }
            if($countHighway > 0 ){
                $avgHighway /= $countHighway;
            }
            if($countCombined > 0){
                $avgCombined /= $countCombined;
            }


            ////////////////////ahora para diesel
        $pollsCityD = 0;
        $pollsHighwayD = 0;
        $pollsCombinedD = 0;

        $countCityD = 0;
        $countHighwayD = 0;
        $countCombinedD = 0;

        $avgCityD=0;
        $avgHighwayD=0;
        $avgCombinedD=0;
        $maxCityD=0;
        $maxHighwayD=0;
        $maxCombinedD=0;
        $minCityD=100;
        $minHighwayD=100;
        $minCombinedD=100;
        foreach ($modelArrayDiesel as $model) {
            //Sumamos todos los registros de consumo para calcular la media descartando los ceros y negtivos
            if($model->consumoCiudad > 0){
                $avgCityD+=$model->consumoCiudad;
                $countCityD++;
                $pollsCityD++; 
            }
            if($model->consumoAutopista > 0){
                $avgHighwayD+=$model->consumoAutopista;
                $countHighwayD++;
                $pollsHighwayD++;
            }
            if($model->combinado != 0){
                $avgCombinedD+=$model->combinado;
                $countCombinedD++;
                $pollsCombinedD++;
            }
            //Aumentamos el contador de número de registros para ese modelo
                
            //Comprobamos y guardamos los valores máximos
            if($maxCityD < $model->consumoCiudad){
                $maxCityD = $model->consumoCiudad;
            }
            if($maxHighwayD < $model->consumoAutopista){
                $maxHighwayD = $model->consumoAutopista;
            }
            if($maxCombinedD < $model->combinado){
                $maxCombinedD = $model->combinado;
            }
            //Lo mismo con los mínimos
            if($model->consumoCiudad > 0 && $minCity > $model->consumoCiudad){
                $minCityD = $model->consumoCiudad;
            }
            if($model->consumoAutopista > 0 && $minHighway > $model->consumoAutopista){
                $minHighwayD = $model->consumoAutopista;
            }
            if($model->combinado > 0 && $minCombined > $model->combinado){
                $minCombinedD = $model->combinado;
            }
        }
            //Terminamos de calcular las medias dividiendo las sumas totales entre el número de elementos
            if($countCityD > 0 ){
                $avgCityD /= $countCityD;
            }
            if($countHighwayD > 0 ){
                $avgHighwayD /= $countHighwayD;
            }
            if($countCombinedD > 0){
                $avgCombinedD /= $countCombinedD;
            }


            ////////////////////// AHORA PARA FUEL
        $pollsCityF = 0;
        $pollsHighwayF = 0;
        $pollsCombinedF = 0;

        $countCityF = 0;
        $countHighwayF = 0;
        $countCombinedF = 0;

        $avgCityF=0;
        $avgHighwayF=0;
        $avgCombinedF=0;
        $maxCityF=0;
        $maxHighwayF=0;
        $maxCombinedF=0;
        $minCityF=100;
        $minHighwayF=100;
        $minCombinedF=100;
        foreach ($modelArrayFuel as $model) {
            //Sumamos todos los registros de consumo para calcular la media descartando los ceros y negtivos
            if($model->consumoCiudad > 0){
                $avgCityF+=$model->consumoCiudad;
                $countCityF++;
                $pollsCityF++; 
            }
            if($model->consumoAutopista > 0){
                $avgHighwayF+=$model->consumoAutopista;
                $countHighwayF++;
                $pollsHighwayF++;
            }
            if($model->combinado != 0){
                $avgCombinedF+=$model->combinado;
                $countCombinedF++;
                $pollsCombinedF++;
            }
            //Aumentamos el contador de número de registros para ese modelo
                
            //Comprobamos y guardamos los valores máximos
            if($maxCityF < $model->consumoCiudad){
                $maxCityF = $model->consumoCiudad;
            }
            if($maxHighwayF < $model->consumoAutopista){
                $maxHighwayF = $model->consumoAutopista;
            }
            if($maxCombinedF < $model->combinado){
                $maxCombinedF = $model->combinado;
            }
            //Lo mismo con los mínimos
            if($model->consumoCiudad > 0 && $minCity > $model->consumoCiudad){
                $minCityF = $model->consumoCiudad;
            }
            if($model->consumoAutopista > 0 && $minHighway > $model->consumoAutopista){
                $minHighwayF = $model->consumoAutopista;
            }
            if($model->combinado > 0 && $minCombined > $model->combinado){
                $minCombinedF = $model->combinado;
            }
        }
            //Terminamos de calcular las medias dividiendo las sumas totales entre el número de elementos
            if($countCityF > 0 ){
                $avgCityF /= $countCityF;
            }
            if($countHighwayF > 0 ){
                $avgHighwayF /= $countHighwayF;
            }
            if($countCombinedF > 0){
                $avgCombinedF /= $countCombinedF;
            }

        }else{
            //no polls for that car
        }
        // echo $avgCity." ";
        // echo $avgCombined." "; 
        // echo $avgHighway;

        // aquí hay que usar un queryBuilder para recuperar todos los registros de coche que tengan el mismo tipo de cmbustible y modelo y hacer la media de sus consumos.
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

        $this->set('avgCityD', $avgCityD);
        $this->set('avgHighwayD', $avgHighwayD);
        $this->set('avgCombinedD', $avgCombinedD);
        
        $this->set('maxCityD', $maxCityD);
        $this->set('maxHighwayD', $maxHighwayD);
        $this->set('maxCombinedD', $maxCombinedD);
        
        $this->set('minCityD', $minCityD);
        $this->set('minHighwayD', $minHighwayD);
        $this->set('minCombinedD', $minCombinedD);
        
        $this->set('pollsCityD', $pollsCityD);
        $this->set('pollsHighwayD', $pollsHighwayD);
        $this->set('pollsCombinedD', $pollsCombinedD);

        $this->set('avgCityF', $avgCityF);
        $this->set('avgHighwayF', $avgHighwayF);
        $this->set('avgCombinedF', $avgCombinedF);
        
        $this->set('maxCityF', $maxCityF);
        $this->set('maxHighwayF', $maxHighwayF);
        $this->set('maxCombinedF', $maxCombinedF);
        
        $this->set('minCityF', $minCityF);
        $this->set('minHighwayF', $minHighwayF);
        $this->set('minCombinedF', $minCombinedF);
        
        $this->set('pollsCityF', $pollsCityF);
        $this->set('pollsHighwayF', $pollsHighwayF);
        $this->set('pollsCombinedF', $pollsCombinedF);

        
        $this->set('car', $car);
        $this->set('_serialize', ['car']);
    }else{
        $this->redirect(['action' => 'index']);
    }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cars = $this->Cars;
        $query = $cars->find('all');
        foreach ($query as $car) {
            echo $car;
        }

/*
        $car = $this->Cars->newEntity();
        if ($this->request->is('post')) {
            $car = $this->Cars->patchEntity($car, $this->request->getData());

            $car->user_id = $this->Auth->user('id'); //el usuario autenticado

            if ($this->Cars->save($car)) {
                $this->Flash->success(__('The car has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The car could not be saved. Please, try again.'));
        }*/

        //$users = $this->Cars->Users->find('list', ['limit' => 200]);

        //$brand = $brands;
        //$models = $models
        // $brands = $this->Cars->find('all', ['fields'=>['DISTINCT marca']]);
        // foreach ($result as $res) {
        //     debug($res->marca);
        // }
        
        $brand = $this->Cars->find()->select(['Cars.marca'])->distinct()->toArray();
        $models = $this->Cars->find()->select(['Cars.modelo'])->distinct()->toArray();
        
        $this->set('models', $models);
        $this->set('brands', $brand);
        $this->set(compact('car', 'users'));
        $this->set('_serialize', ['car']);
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
            'contain' => []
        ]);

            //&& ($car->user_id == $this->Auth->user('id'))
        if ($this->request->is(['patch', 'post', 'put']) ) {
            $car = $this->Cars->patchEntity($car, $this->request->getData());
           // $car->user_id = $this->Auth->user('id');

            if ($this->Cars->save($car)) {
                $this->Flash->success(__('The car has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The car could not be saved. Please, try again.'));
        }
        //$users = $this->Cars->Users->find('list', ['limit' => 200]);
        $this->set(compact('car'));
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

    //mi idea es renderizar el método view pero 
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

     public function addNew()
     {
        $car = $this->Cars->newEntity();
        if ($this->request->is('post')) {
            $car = $this->Cars->patchEntity($car, $this->request->getData());

            //$car->user_id = $this->Auth->user('id'); //el usuario autenticado d
            //Debería poner el modelo + combustible como UNIQUE

            if ($this->Cars->save($car)) {
                $this->Flash->success(__('The car has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The car could not be saved. Please, try again.'));
        }
        $this->set(compact('car'));
        $this->set('_serialize', ['car']);
    }

    public function howTo(){
        $this->render();
    }

    public function getModelByBrand(){
        $model = $this->request->data('model');
        $models = $this->Cars->find('list', [ 'conditions' => [ 'modelo' => $model ]]); 
        echo json_encode($models); 
    }
}

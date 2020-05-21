
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car[]|\Cake\Collection\CollectionInterface $cars
 */
// $this->Paginator->options(array(
//     'update' => '#carsContainer',
//     'before' => $this->Html->get('#procesando')->effect('fadeIn', array('buffer' => false)),
//     'complete' => $this->Html->get('#procesando')->effect('fadeOut', array('buffer' => false))
// ));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
<!--     <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Car'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul> -->
</nav>
<div class="" style="text-align: center; margin-top: 40px;">

    <?= $this->Html->image('cars.png', ['alt' => 'Car image', 'style' => 'width:25%;height:25%;']); ?>



<!--     <?php 
	foreach ($cars as $car ) {
		if($car->users){
			foreach ($car->users as $carsusers ){
    			debug($carsusers->_joinData);
			}
		}
    }?> -->

<div class="container-fluid">
    <div class="row">
    <div class="col-xs-6 col-sm-3">
      <div id="accordion" class="panel panel-primary behclick-panel">
        <div class="panel-heading">
          <h3 class="panel-title">Filter Cars</h3>
        </div>
        <div class="panel-body" >
        <!--   <div class="panel-heading " >
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse0">
                <i class="indicator fa fa-caret-down" aria-hidden="true"></i> Price
              </a>
            </h4>
          </div> -->
            <div class="panel-heading " >
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse0">
                <i class="indicator fa fa-caret-down" aria-hidden="true"></i> Mileage measure
              </a>
            </h4>
          </div>    
          <div id="collapse0" class="panel-collapse collapse in" >
            <ul class="list-group">
              <li class="list-group-item">
                <p><!-- Filtro -->
                  <label for="amountC">Mileage range in City:</label>
                  <input type="text" id="amountC" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p> <div id="slider-rangeC"></div>
              </li>
               <li class="list-group-item">
                <p><!-- Filtro -->
                  <label for="amountH">Mileage range in Highway:</label>
                  <input type="text" id="amountH" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p> <div id="slider-rangeH"></div>
              </li>
               <li class="list-group-item">
                <p><!-- Filtro -->
                  <label for="amountCo">Mileage range Combined:</label>
                  <input type="text" id="amountCo" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p> <div id="slider-rangeCo"></div>
              </li>
            </ul>
          </div>

          <div class="panel-heading" >
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse3"><i class="indicator fa fa-caret-down" aria-hidden="true"></i> Type of fuel</a>
            </h4>
          </div>
          <div id="collapse3" class="panel-collapse collapse in">
            <ul class="list-group">
             <?php foreach ($fuelType as $fuel ) {?>
                  <li class="list-group-item">
                    <div class="checkbox" >
                      <label>
                            <?php if ($fuel->combustible == 'Diesel') {
                            ?><input type="checkbox" class="fuelCheckBoxD" value="<?php echo $fuel->combustible;?>" onchange="checkFuel()"><?php
                                echo $fuel->combustible;
                            } ?>
                            <?php if ($fuel->combustible == 'Gasolina') {
                            ?><input type="checkbox" class="fuelCheckBoxP" value="<?php echo $fuel->combustible;?>" onchange="checkFuel()"><?php
                                echo "Petrol";
                            } ?>
                            <?php if ($fuel->combustible == 'electrico') {
                                ?><input type="checkbox" class="fuelCheckBoxE" value="<?php echo $fuel->combustible;?>" onchange="checkFuel()"><?php
                                echo "Electric";
                            } ?>
                      </label>
                    </div>
                  </li>
              <?php  } ?>
            </ul>
          </div>
          <div class="panel-heading " >
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse1">
                <i class="indicator fa fa-caret-down" aria-hidden="true"></i> Brand
              </a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse in" >
            <ul class="list-group">
            <?php foreach ($marcas as $marca) {?>
              <li class="list-group-item">
                <div class="checkbox" style="text-align: center">
                  <label>
                    <input type="checkbox" class="marca" name="brand" value="<?php echo $marca->marca?>" id="<?php echo $marca->marca?>" onchange="checkBrand()">
                      <?=$marca->marca?>
                  </label>
                </div>
              </li>
            <?php } ?>
            </ul>
          </div>
           <div class="panel-heading" >
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapseColor"><i class="indicator fa fa-caret-down" aria-hidden="true"></i>Other</a>
            </h4>
          </div>
          <div id="collapseColor" class="panel-collapse collapse in">
            <ul class="list-group">
              <li class="list-group-item">
                <div class="checkbox">
                  <label>
                    <a href="/howfartoreach">
                    Most contributed cars
                    </a>
                  </label>
                </div>
              </li>
              <li class="list-group-item">
                <div class="checkbox"  >
                  <label>
                    <a href="/howfartoreach" style="visibility: hidden; ">
                    Less contributed cars
                    </a>
                  </label>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

 <div class="col-md-9 col-sm-6">
     <h3><?= __('Cars') ?></h3>

     <div id="carsContainer">
        <div class="progress oculto" id="procesando">
            <div class="progress-bar progress-bar-stripped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100", style="width: 100%">
                <span class="sr-only"> 100% complete</span>
            </div>
        </div>

    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('marca', ['label' => 'Brand'])//en un array se mete el nombre que se queire que aparezca, habría que echarle un ojo a la internacionalización para ver como se hace ?></th>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('modelo', ['label' => 'Model']) ?></th>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('consumoCiudad', ['label' => 'City']) ?></th>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('consumoAutopista', ['label' => 'Highway']) ?></th>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('combinado', ['label' => 'Combined']) ?></th>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('combustible', ['label' => 'Fuel type']) ?></th>
                <!-- <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('user_id') ?></th> -->
                <th style="text-align: center;" scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($cars as $car):

            	if($car->users){

            		foreach ($car->users as $carsusers ){?> <!-- En realidad aqui voy a tener que sacar las medias de todo para pintar la lista y que seleccionen los filtros -->
			
			            <tr style="display: "";"  class="carBrands" id="car_<?=$i?>">
			                <td><a href=""><?= $this->Number->format($car->id) ?></a></td>
			                <td class="marca"><?= h($car->marca) ?></td>
			                <td class="modelo"><?= h($car->modelo) ?></td>
			             
			                <td class="consumoCiudad"><?= $this->Number->format($carsusers->_joinData->consumoCiudad)?></td>      <!-- aquí habra que meter las medias de la table de carsusers -->
			                <td class="consumoAutopista"><?= $this->Number->format($carsusers->_joinData->consumoAutopista) ?></td>
			                <td class="consumoCombinado"><?= $this->Number->format($carsusers->_joinData->combinado) ?></td>
			                <td class="combustible"><?= h($car->combustible) ?></td>
			                <!-- <td><?= $car->has('user') ? $this->Html->link($car->user->login, ['controller' => 'Users', 'action' => 'view', $car->user->id]) : '' ?></td>-->
			                
			                <td class="actions">
			                    <?= $this->Html->link(__('View'), ['action' => 'view', $car->id], ['class' => 'btn btn-sm btn-info']) ?>
                          <?php// debug($carsusers); ?>
			                    <?php if($current_user['role'] == 'admin'): ?>
			                    <?= $this->Html->link(__('Edit'), ['controller' => 'CarsUsers', 'action' => 'edit', $carsusers->_joinData->id, $carsusers->_joinData->car_id, $carsusers->_joinData->user_id], ['class' => 'btn btn-sm btn-warning'] ) ?>
			                    <?= $this->Form->postLink('Delete', ['controller' => 'CarsUsers', 'action' => 'delete', $carsusers->_joinData->id, $carsusers->_joinData->car_id, $carsusers->_joinData->user_id], ['confirm' => 'Are you sure you want to delete register number ' . $carsusers->_joinData->id . '?', 'class' => 'btn btn-sm btn-danger']) ?>
			                    
			                    <?php endif ?>
			                </td>
			                <?php $i++?>
			            </tr>
            	<?php }
            }

        	endforeach; ?>
        </tbody>
    </table>
</div> <!-- container cars -->
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
</div>

  </div>
</div>



<!-- 

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car[]|\Cake\Collection\CollectionInterface $cars
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Car'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cars index large-9 medium-8 columns content">
    <h3><?= __('Cars') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('marca') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modelo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('combustible') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cars as $car): ?>
            <tr>
                <td><?= $this->Number->format($car->id) ?></td>
                <td><?= h($car->marca) ?></td>
                <td><?= h($car->modelo) ?></td>
                <td><?= h($car->combustible) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $car->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $car->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $car->id], ['confirm' => __('Are you sure you want to delete # {0}?', $car->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
 -->
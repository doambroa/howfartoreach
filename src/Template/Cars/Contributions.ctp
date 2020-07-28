
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

$parameters=1234;
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
<!--     <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Car'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul> -->
</nav>
<div style=" margin-top: 40px;background-image: url(../img/tires3.png);">
<div class="" style="text-align: center; margin-top: 40px;">

    <?= $this->Html->image('cars.png', ['alt' => 'Car image', 'style' => 'width:25%;height:25%;']); ?>
<div class="container-fluid">
    <div class="row">
      <div class="col-xs-6 col-sm-3">
        <?=$this->Form->create('',['id' => 'filtersForm'])?>
        <div id="accordion" class="panel panel-primary behclick-panel">
          <div class="panel-heading">
            <h3 class="panel-title">Filter Cars</h3>
          </div>
          <input type="submit" value="Apply filters" class="btn btn-primary btn-block">Apply filters
          <!-- <?=$this->Html->link('Apply filters', ['controller' => 'Cars', 'action' => 'Contributions', $parameters])?> -->

          <div class="panel-body">
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
                    <input type="text" id="amountC" name="amountC" data-min="4" data-max="6.5" value="4" readonly style="border:0; color:#f6931f; font-weight:bold;">
                  </p> <div id="slider-rangeC"></div>
                </li>
                 <li class="list-group-item">
                  <p><!-- Filtro -->
                    <label for="amountH">Mileage range in Highway:</label>
                    <input type="text" id="amountH" name="amountH" data-min="3" data-max="11" readonly style="border:0; color:#f6931f; font-weight:bold;">
                  </p> <div id="slider-rangeH"></div>
                </li>
                 <li class="list-group-item">
                  <p><!-- Filtro -->
                    <label for="amountCo">Mileage range Combined:</label>
                    <input type="text" id="amountCo" name="amountCo"data-min="3.5" data-max="8" readonly style="border:0; color:#f6931f; font-weight:bold;">
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
              
              <?php foreach ($fuelTypes as $fuel ) {?>
                    <li class="list-group-item">
                      <div class="checkbox" >
                              <?php if ($fuel->combustible == 'Diesel') {
                                  ?><input id="fuelD" type="checkbox" class="fuelCheckBoxD" name="typeOfFuel[]" value="<?php echo $fuel->combustible;?>" onchange="">
                                  <label for="fuelD"><?=$fuel->combustible;?></label><?php
                              } ?>
                              <?php if ($fuel->combustible == 'Petrol') {
                              
                                ?><input id="fuelP" type="checkbox" class="fuelCheckBoxP"  name="typeOfFuel[]" value="<?php echo $fuel->combustible;?>" onchange="">
                                <label for="fuelP"><?=$fuel->combustible;?></label><?php
                              } ?>
                              </label>
                              <?php if ($fuel->combustible == 'Electric') {
                                  ?>
                                  <input id="fuelE" type="checkbox" class="fuelCheckBoxE"  name="typeOfFuel[]" value="<?php echo $fuel->combustible;?>" onchange="">
                                  <label for="fuelE"><?=$fuel->combustible;?></label>
                                  <?php
                              } ?>
                        </label>
                      </div>
                    </li>
                <?php  
              }?>

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
                        <input type="checkbox" class="marca" name="brands[]" value="<?php echo $marca->marca?>" id="<?php echo $marca->marca?>">
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
        <?= $this->Form->end() ?>
      </div>

     <div class="col-md-9 col-sm-6">
         <h3><?= __('All time averages') ?></h3>

         <div id="carsContainer">
            <div class="progress oculto" id="procesando">
                <div class="progress-bar progress-bar-stripped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100", style="width: 100%">
                    <span class="sr-only"> 100% complete</span>
                </div>
            </div>

        <table class="table table-striped" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('polls', ['label' => 'Polls']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('marca', ['label' => 'Brand'])//en un array se mete el nombre que se queire que aparezca, habría que echarle un ojo a la internacionalización para ver como se hace ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('modelo', ['label' => 'Model']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('consumoCiudad', ['label' => 'City']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('consumoAutopista', ['label' => 'Highway']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('combinado', ['label' => 'Combined']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('combustible', ['label' => 'Fuel type']) ?></th>
                    <?php //  <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('user_id') </th>?>

                    <th style="text-align: center;" scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php


                foreach ($contributions as $contribution): ?>  
    			            <tr style="display: "";"  class="carBrands" id="car_<?=$contribution->id?>">
    			                <!-- <td><a href=""><?= $this->Number->format($contribution->id) ?></a></td> -->
                           <td class="polls"><?= h($contribution->polls) ?></td>
    			                <td class="marca"><?= h($contribution->marca) ?></td>
    			                <td class="modelo"><?= h($contribution->modelo) ?></td>
    			             
    			                <td class="consumoCiudad"><?= $this->Number->format($contribution->consumoCiudad)?></td>
    			                <td class="consumoAutopista"><?= $this->Number->format($contribution->consumoAutopista) ?></td>
    			                <td class="consumoCombinado"><?= $this->Number->format($contribution->combinado) ?></td>
    			                <td class="combustible"><?= h($contribution->combustible) ?></td>

    			                
    			                <td class="actions">
    			                    <?= $this->Html->link(__('View'), ['action' => 'view', $contribution->car_id], ['class' => 'btn btn-sm btn-info']) ?>
                              <?php// debug($carsusers); ?>
    			                    <?php /*if($current_user['role'] == 'admin'): ?>
    			                    <?= $this->Html->link(__('Edit'), ['controller' => 'CarsUsers', 'action' => 'edit', $contribution->id, $contribution->car_id, $contribution->user_id], ['class' => 'btn btn-sm btn-warning'] ) ?>
    			                    <?= $this->Form->postLink('Delete', ['controller' => 'CarsUsers', 'action' => 'delete', $contribution->id, $contribution->car_id, $contribution->user_id], ['confirm' => 'Are you sure you want to delete register number ' . $contribution->id . '?', 'class' => 'btn btn-sm btn-danger']) ?>
    			                    
    			                    <?php endif */?>
    			                </td>
                      </tr>			                
                	<?php 
                endforeach ?>
            </tbody>
        </table>
    </div>
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
</div>










<!-- API REST CONSUMES JSON_PRETTY_PRINT



<?php
    $curl = curl_init();
        $where = urlencode('{
            "Year": {
                "$gt": 2000
            }
        }');
    curl_setopt($curl, CURLOPT_URL, 'https://parseapi.back4app.com/classes/Carmodels_Car_Model_List?limit=500&order=-Make&excludeKeys=Category&where=' . $where);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'X-Parse-Application-Id: 53bkR77dFmhMUomS7Gn8Z7THdxyRpuV7cbum7FNK', // This is your app's application id
        'X-Parse-REST-API-Key: AzxmRXt3RKLZBa6YZf4Y1m2Pt4rBATLKiuajYnof' // This is your app's REST API key
    ));
    $data = json_decode(curl_exec($curl)); // Here you have the data that you need
    print_r(json_encode($data, JSON_PRETTY_PRINT));
    curl_close($curl);
?> -->
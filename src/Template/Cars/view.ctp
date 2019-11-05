<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car $car
 */
?>
<!-- ESTO SERÍA COMO MUCHO PARA EL ADMINISTRADOR
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Car'), ['action' => 'edit', $car->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Car'), ['action' => 'delete', $car->id], ['confirm' => __('Are you sure you want to delete # {0}?', $car->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cars'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Car'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
FIN ADMIN -->

<div class="container-fluid" style="text-align: center;">
    <div class="col-md-6" style="padding-bottom: 20px">
        <h1> <?= $car->marca . ' ' . $car->modelo ?></h1> <!-- aqui tiene que ir marca y modelo del coche traído de la BD así -->
    </div>
    <div class="col-md-6">
        <span class="col-md-4"><h1>Diesel</h1></span> 
<!--         <span class="col-md-4"><a><h1>Gasoline</h1></a></span>
        <span class="col-md-4"><a><h1>Electric</h1></a></span>
    </div> -->

        <!-- poner en gris los otros dos a ambos lados seleccionables FUEL y ELECTRIC y que se peuda cambmiar entre ellos-->
    </div>
</div>

<div class="container-fluid">
<div class = col-md-6 style="margin: 0 auto;">
    <?php echo $this->Html->image('../img/cars/' . $car->modelo . '.png', ['alt' => $car->marca . ' ' . $car->modelo, 'class' => 'img-responsive', 'style' => 'margin:auto;'])?>
</div>
<div id="diesel">
    <div class = col-md-6>
            <span class="col-md-2">
                <b>City</b>
            </span>
             <div class="progress col-md-10">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?=$car->consumoCiudad*7?>%">
                  <span>
                    <?php if ($car->consumoCiudad != 0) {   // aquí estou mostrando lso registros del coche al que accede, no del total, debería cambiarlo
                       echo $car->consumoCiudad . '%'; 
                    }else{
                        echo 'No polls';
                    }?>
                    </span>
                </div>
            </div>
    </div>

    <div class = col-md-6>
            <span class="col-md-2">
                <b>Highway</b>
            </span>
            <div class="progress col-md-10">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?=$car->consumoAutopista*7?>%">
                    <span>
                    <?php if ($car->consumoAutopista != 0) {
                       echo $car->consumoAutopista . '%'; 
                    }else{
                        echo 'No polls';
                    }
                ?>
                    </span>
                </div>
            </div>
    </div>

    <div class = col-md-6>
        <span class="col-md-2">
            <b>Combined</b>
        </span>
        <div class="progress col-md-10">
            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?=$car->combinado*7?>%">
                <span>
                    <?php if ($car->combinado != 0) {
                       echo $car->combinado . '%'; 
                    }else{
                        echo 'No polls';
                    }?>
                </span>
            </div>
        </div>
    </div>

</div>

<?php////////////// REPETIMOS /////////////////////?>
<!-- <div id="gasolina" style="visibility: hidden;">
    <div class = col-md-6>
            <span class="col-md-2">
                <b>City</b>
            </span>
             <div class="progress col-md-10">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?=$avgCityF*7?>%">
                  <span>
                    <?php if ($avgCityF != 0) {   // aquí estou mostrando lso registros del coche al que accede, no del total, debería cambiarlo
                       echo $avgCityF. '%'; 
                    }else{
                        echo 'No polls';
                    }?>
                    </span>
                </div>
            </div>
    </div>

    <div class = col-md-6>

            <span class="col-md-2">
                <b>Highway</b>
            </span>
            <div class="progress col-md-10">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?=$avgHighwayF*7?>%">
                    <span>
                    <?php if ($avgHighwayF != 0) {
                       echo $avgHighwayF . '%'; 
                    }else{
                        echo 'No polls';
                    }
                ?>
                    </span>
                </div>
            </div>
    </div>

    <div class = col-md-6>

            <span class="col-md-2">
                <b>Combined</b>
            </span>
             <div class="progress col-md-10">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?=$avgCombinedF*7?>%">
              <span>
                    <?php if ($avgCombinedF != 0) {
                       echo $avgCombinedF . '%'; 
                    }else{
                        echo 'No polls';
                    }?>
                    </span>
                </div>
      </div>
    </div>
</div>

<script type="text/javascript">
    
    
    
</script>

<?php /////////////////////// REPETIMOS, darle un id y pintar sólo el active //////////////////////////////////////////?>
<div id="electrico" style="visibility: hidden;">
    <div class = col-md-6>
            <span class="col-md-2">
                <b>City</b>
            </span>
             <div class="progress col-md-10">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?=$avgCityD*7?>%">
                  <span>
                    <?php if ($avgCityD != 0) {   // aquí estou mostrando lso registros del coche al que accede, no del total, debería cambiarlo
                       echo $avgCityD . '%'; 
                    }else{
                        echo 'No polls';
                    }?>
                    </span>
                </div>
            </div>
    </div>

    <div class = col-md-6>

            <span class="col-md-2">
                <b>Highway</b>
            </span>
            <div class="progress col-md-10">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?=$avgHighwayD*7?>%">
                    <span>
                    <?php if ($avgHighwayD != 0) {
                       echo $avgHighwayD . '%'; 
                    }else{
                        echo 'No polls';
                    }
                ?>
                    </span>
                </div>
            </div>
    </div>

    <div class = col-md-6>

            <span class="col-md-2">
                <b>Combined</b>
            </span>
             <div class="progress col-md-10">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?=$avgCombinedD*7?>%">
              <span>
                    <?php if ($avgCombinedD != 0) {
                       echo $avgCombinedD . '%'; 
                    }else{
                        echo 'No polls';
                    }?>
                    </span>
                </div>
      </div>
    </div>
</div> -->
<?php //////////////////////////////// REPETIMO fin ////////////////////////////////////////////////////?>

  <div class = "col-md-6" style=" visibility: hidden;">
    <center style="opacity:0.3; margin-top:10px; cursor: not-allowed;">
        <span title="NOT IMPLEMENTED">
            
                    <input type="checkbox"> <?= $this->Html->image('../img/sportive.png', ['width'=>'10%', 'height'=>'10%', 'style'=>'cursor: not-allowed;' ]) ?> <b> Sportive driving  </b>
                <!-- aquí podríamos poner un redio button que sea thrifty/saving, normal y sportive -->
                
                </span>
                </center>
  </div>
</div>

<div class="container" style="padding-top: 20px;">
    <table class="table">
    <thead>
      <tr>
        <th>Way</th>
        <th>Polled</th>
        <th>Average</th>
        <th>Mode</th>
        <th>Lowest</th>
        <th>Highest</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>City</td>
        <td><?= $pollsCity ?></td> 
        <td><?= $avgCity ?> %</td>
        <td>5.65</td>
        <td><?= $minCity  ?> %</td>
        <td><?= $maxCity ?> %</td>
      </tr>
      <tr>
        <td>Highway</td>
        <td><?= $pollsHighway ?></td>
        <td><?= $avgHighway ?> %</td>
        <td>6</td>
        <td><?= $minHighway ?> %</td>
        <td><?= $maxHighway ?> %</td>
      </tr>
      <tr>
        <td>Combined</td>
        <td><?= $pollsCombined ?></td>
        <td><?= $avgCombined ?> %</td>
        <td>5.5</td>
        <td><?= $minCombined ?> %</td>
        <td><?= $maxCombined ?> %</td>
      </tr>
    </tbody>
  </table>
</div>



<div class="container" style="padding-top: 20px">

       <button data-toggle="collapse" data-target="#allRegisters" type="button" class="btn btn-primary btn-block">See all registers for this car</button>
       <!-- quizá aquí desplegar una lista con cada uno de los registros de coche  en ultimo caso hacerle un redirect a cars-->
<div id="allRegisters" class="collapse"> 
        <table class="table table-striped" cellpadding="0" cellspacing="0" style="text-align: center;">
            <thead>
                <tr>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('marca', ['label' => 'Brand'])//en un array se mete el nombre que se queire que aparezca, habría que echarle un ojo a la internacionalización para ver como se hace ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('modelo', ['label' => 'Model']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('consumoCiudad', ['label' => 'City']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('consumoAutopista', ['label' => 'Highway']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('combinado', ['label' => 'Combined']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('combustible', ['label' => 'Fuel type']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                </tr>
            </thead>

            <tbody>
           <?php foreach ($modelo as $car): ?>
                <tr>
                    <td><a href=""><?= $this->Number->format($car->id) ?></a></td>
                    <td><?= h($car->marca) ?></td>
                    <td><?= h($car->modelo) ?></td>
                    <td><?= $this->Number->format($car->consumoCiudad) ?></td>
                    <td><?= $this->Number->format($car->consumoAutopista) ?></td>
                    <td><?= $this->Number->format($car->combinado) ?></td>
                    <td><?= h($car->combustible) ?></td>
                    <td><?= $this->Html->link($car->user_id, ['controller' => 'Users', 'action' => 'view', $car->user_id]) ?></td>
                </tr> 
            <?php  endforeach ?>
            </tbody>
        </table>


</div>
</div>

<div class="container" style="padding-top: 60px;">
    <a href="/howfartoreach/cars/add">Add your own measure</a>
</div>
<!-- 
<div class="cars view large-9 medium-8 columns content">
    <h3><?= h($car->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Marca') ?></th>
            <td><?= h($car->marca) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modelo') ?></th>
            <td><?= h($car->modelo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Combustible') ?></th>
            <td><?= h($car->combustible) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $car->has('user') ? $this->Html->link($car->user->id, ['controller' => 'Users', 'action' => 'view', $car->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($car->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ConsumoCiudad') ?></th>
            <td><?= $this->Number->format($car->consumoCiudad) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ConsumoAutopista') ?></th>
            <td><?= $this->Number->format($car->consumoAutopista) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Combinado') ?></th>
            <td><?= $this->Number->format($car->combinado) ?></td>
        </tr>
    </table>
</div>
 -->
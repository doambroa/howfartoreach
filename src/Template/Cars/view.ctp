
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car $car
 */
?>

    <div class="container" style="text-align: center;">
    <div class="col-md-6" style="padding-bottom: 20px">
        <h1> <?= $car->marca . ' ' . $car->modelo ?></h1> <!-- aqui tiene que ir marca y modelo del coche traído de la BD así -->
    </div>
    <div class="col-md-6"><?php
        switch ($car->combustible) {
            case 'Diesel':
                ?><span class="col-md-4"><h1><u>Diesel</u></h1></span><?php 
                if (isset($idPetrol)){
                    ?><span class="col-md-4"><h1><?= $this->Form->postLink('Petrol', ['action' => 'view',  $idPetrol],['style' => 'color: lightgrey;']) ?></h1></span><?php
                }
                if (isset($idElectric)){
                    ?><span class="col-md-4"><h1><?= $this->Form->postLink('Electric', ['action' => 'view',  $idElectric],['style' => 'color: lightgrey;']) ?></h1></span><?php
                }
                break;
            case 'Petrol':
                ?><span class="col-md-4"><h1><u>Petrol</u></h1></span><?php
                if (isset($idDiesel)){
                    ?><span class="col-md-4"><h1><?= $this->Html->link('Diesel', ['action' => 'view',  $idDiesel],['style' => 'color: lightgrey;']) ?></h1></span><?php
                }
                if (isset($idElectric)){
                    ?><span class="col-md-4"><h1><?= $this->Form->postLink('Electric', ['action' => 'view',  $idElectric],['style' => 'color: lightgrey;']) ?></h1></span><?php
                }
                break;

            case 'Electric':
                ?><span class="col-md-4"><h1><u>Electric</u></h1></span><?php 
                if (isset($idPetrol)){
                    ?><span class="col-md-4"><h1><?= $this->Form->postLink('Petrol', ['action' => 'view',  $idPetrol],['style' => 'color: lightgrey;']) ?></h1></span><?php
                }
                if (isset($idPetrol)){
                    ?><span class="col-md-4"><h1><?= $this->Html->link('Diesel', ['action' => 'view', $idDiesel],['style' => 'color: lightgrey;']) ?></h1></span><?php
                }
                break;                    
            default:
                break;
        }?> 
  </div>

        <!-- poner en gris los otros dos a ambos lados seleccionables FUEL y ELECTRIC y que se peuda cambmiar entre ellos-->
    </div>
</div>

<div class="container">
    <div class = col-md-6 style="margin: 0 auto;">
        <?php echo $this->Html->image('../img/cars/' . $car->modelo . '.png', ['alt' => $car->marca . ' ' . $car->modelo, 'class' => 'img-responsive', 'style' => 'margin:auto;'])?>
    </div>
<div id="diesel">
    <div class = col-md-6>
            <span class="col-md-2">
                <b>City</b>
            </span>
             <div class="progress col-md-10">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?=$avgCity*7?>%">
                  <span>
                    <?php if ($avgCity != 0) {
                       echo round($avgCity,3) . '%'; 
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
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?=$avgHighway*7?>%">
                    <span>
                    <?php if ($avgHighway != 0) {
                       echo round($avgHighway,3) . '%'; 
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
            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?=$avgCombined*7?>%">
                <span>
                    <?php if ($avgCombined != 0) {
                       echo round($avgCombined,3) . '%'; 
                    }else{
                        echo 'No polls';
                    }?>
                </span>
            </div>
        </div>
    </div>


METER PRECIO POR KM 
<li><?=$avgCombined/100?> L/Km </li>
<li><?=($avgCombined/100)*1.20?> €/km OBTENER PRECIO CARBURANTE EN TIEMPO REAL, la media de lso ultimos 10 años es la misma</li>
METER PRECIO LLENAR DEPOSITO APROX
Meter emisiones de CO2 si sobra tiempo


</div>  

  <div class = "col-md-2" style=" visibility: ;">
    <center style="opacity:0.3; margin-top:10px; cursor: not-allowed;">
        <span title="NOT IMPLEMENTED">
            
                    <input type="checkbox"> <?= $this->Html->image('../img/eco.png', ['width'=>'10%', 'height'=>'10%', 'style'=>'cursor: not-allowed;' ]) ?> <b> Eco driving  </b>
                
                </span>
                </center>
  </div>
   <div class = "col-md-2" style=" visibility: ;">
    <center style="opacity:0.3; margin-top:10px; cursor: not-allowed;">
        <span title="NOT IMPLEMENTED">
            
                    <input type="checkbox"> <?= $this->Html->image('../img/normal.png', ['width'=>'10%', 'height'=>'10%', 'style'=>'cursor: not-allowed;' ]) ?> <b> Normal driving  </b>
                
                </span>
                </center>
  </div>
   <div class = "col-md-2" style=" visibility: ;">
    <center style="opacity:0.3; margin-top:10px; cursor: not-allowed;">
        <span title="NOT IMPLEMENTED">
            
                    <input type="checkbox"> <?= $this->Html->image('../img/sportive.png', ['width'=>'10%', 'height'=>'10%', 'style'=>'cursor: not-allowed;' ]) ?> <b> Sport driving  </b>
                
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
        <th>Median</th>
        <th>Lowest</th>
        <th>Highest</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>City</td>
        <td><?= $pollsCity ?></td> 
        <td><?= round($avgCity,3) ?> %</td>
        <td><?=$medianCity?> %</td>
        <td><?= $minCity  ?> %</td>
        <td><?= $maxCity ?> %</td>
      </tr>
      <tr>
        <td>Highway</td>
        <td><?= $pollsHighway ?></td>
        <td><?= round($avgHighway,3) ?> %</td>
        <td><?=$medianHighway?> %</td>
        <td><?= $minHighway ?> %</td>
        <td><?= $maxHighway ?> %</td>
      </tr>
      <tr>
        <td>Combined</td>
        <td><?= $pollsCombined ?></td>
        <td><?= round($avgCombined,3) ?> %</td>
        <td><?=$medianCombined?></td>
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
                    <!-- <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('id') ?></th> -->
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
           <?php foreach ($relatedContributions as $contribution): ?>
                <tr>
                    <!-- <td><a href=""><?= $this->Number->format($car->id) ?></a></td> -->
                    <td><?= h($car->marca) ?></td>
                    <td><?= h($car->modelo) ?></td>
                    <td><?= $this->Number->format(round($contribution->consumoCiudad, 3)) ?></td>
                    <td><?= $this->Number->format(round($contribution->consumoAutopista, 3)) ?></td>
                    <td><?= $this->Number->format(round($contribution->combinado, 3))?></td>
                    <td><?= h($car->combustible) ?></td>
                    <?php
                      if($contribution->user_id == $current_user['id']){
                        ?><td><?=$this->Html->link('Edit', ['controller' => 'CarsUsers',
                                                            'action' => 'edit',$contribution->id, $contribution->car_id, $contribution->user_id
                                                            
                                                         ])?>
                                                         </td><?php
                    }else{
                        ?><td><?= $this->Html->link($contribution->user_id, ['controller' => 'Users', 'action' => 'view', $contribution->user_id]) ?></td><?php
                    }
                    ?>
                </tr> 
            <?php  endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div class="container" style="padding-top: 20px">
    <div class="row">
        <div class="col-md-4">
            <?= $this->Html->link('Add your own measure', ['controller' => 'Cars', 'action' => 'addContribution', $contribution->car_id]) ?> <!-- Pasamos el id del coche para que en un fguturo el formulario se autorellene con esa info-->
        </div>
        <div class="col-md-4 col-md-offset-4 text-right">
            <?= $this->Html->link('Download Data for this car', ['controller' => 'Cars', 'action' => 'exportCarContributions', $contribution->car_id]) ?>
        </div>
    </div>
     <div class="row">
        <div class="col-md-4 col-md-offset-8 text-right">
            <?= $this->Html->link('Averages by brand', ['controller' => 'Cars', 'action' => 'exportContributionsByBrand']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-8 text-right">
            <?= $this->Html->link('All time averages', ['controller' => 'Cars', 'action' => 'exportAverages']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-8 text-right">
            <?= $this->Html->link('All contributions', ['controller' => 'Cars', 'action' => 'exportContributions']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-8 text-right">
            <?= $this->Html->link('All cars', ['controller' => 'Cars', 'action' => 'exportContributions']) ?>
        </div>
    </div>
</div>

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
<div class = "col-md-12 text-center" style="margin-top: 10px;margin-bottom: 10px; visibility: ;">
  <?php if(isset($current_user) && $current_user['role'] == 'admin'):?>
                <?= $this->Html->link('Edit this car', ['controller' => 'Cars', 'action' => 'Edit', $car->id],['class' => 'btn btn-sm btn-warning']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $car->id], ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $car->id)]) ?>
  <?php endif?> 
</div>
<div class="container text-center">
    <div class="col-md-6" style="margin: 0 auto;">
        <?php echo $this->Html->image('../img/cars/' . $car->modelo . '.png', ['alt' => $car->marca . ' ' . $car->modelo, 'class' => 'img-responsive', 'style' => 'margin:auto;', 'id' => 'carImg', 'onerror' => 'this.src="../../img/cars/cars.png"'])?>
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

    <div class = col-md-3>
         <div class = col-md-2>
            <img height="35" src="../../img/gasicon.png"/>
        </div>
        <div class = col-md-4>
            <?=round($avgCombined/100,5)?> L/Km
        </div>
    </div>
    
    <div class = col-md-3>
         <div class = col-md-2>
            <img height="35" src="../../img/eurico.png"/>
        </div>
        <div class = col-md-4 title="(Based on 10 last year price average in Spain)">
            <?=round(($avgCombined/100)*1.20,5)?> €/km
        </div>
    </div>
     <!--OBTENER PRECIO CARBURANTE EN TIEMPO REAL, la media de lso ultimos 10 años es la misma<-->




</div>  

  <div class = "col-md-2" style="margin-top: 10px; visibility: ;">
    <center style="opacity:0.3; margin-top:10px; cursor: not-allowed;">
        <span title="NOT IMPLEMENTED">
            
                    <input type="radio"> <?= $this->Html->image('../img/eco.png', ['width'=>'10%', 'height'=>'10%', 'style'=>'cursor: not-allowed;' ]) ?> <b> Eco driving  </b>
                
                </span>
                </center>
  </div>
   <div class = "col-md-2" style="margin-top: 10px; visibility: ;">
    <center style="opacity:0.3; margin-top:10px; cursor: not-allowed;">
        <span title="NOT IMPLEMENTED">
            
                    <input type="radio"> <?= $this->Html->image('../img/velocimetro.png', ['width'=>'10%', 'height'=>'10%', 'style'=>'cursor: not-allowed;' ]) ?> <b> Normal driving  </b>
                
                </span>
                </center>
  </div>
   <div class = "col-md-2" style="margin-top: 10px; visibility: ;">
    <center style="opacity:0.3; margin-top:10px; cursor: not-allowed;">
        <span title="NOT IMPLEMENTED">
            
                    <input type="radio"> <?= $this->Html->image('../img/sportive.png', ['width'=>'10%', 'height'=>'10%', 'style'=>'cursor: not-allowed;' ]) ?> <b> Sport driving  </b>
                
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
        <td><?= round($minCity,3)  ?> %</td>
        <td><?= $maxCity ?> %</td>
      </tr>
      <tr>
        <td>Highway</td>
        <td><?= $pollsHighway ?></td>
        <td><?= round($avgHighway,3) ?> %</td>
        <td><?= $medianHighway?> %</td>
        <td><?= round($minHighway,3) ?> %</td>
        <td><?= $maxHighway ?> %</td>
      </tr>
      <tr>
        <td>Combined</td>
        <td><?= $pollsCombined ?></td>
        <td><?= round($avgCombined,3) ?> %</td>
        <td><?=$medianCombined?></td>
        <td><?= round($minCombined,3) ?> %</td>
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
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('marca', ['label' => 'Brand'])?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('modelo', ['label' => 'Model']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('consumoCiudad', ['label' => 'City']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('consumoAutopista', ['label' => 'Highway']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('combinado', ['label' => 'Combined']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('combustible', ['label' => 'Fuel type']) ?></th>
                    <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                </tr>
            </thead>

            <tbody>

           <?php $cont = 0;
            foreach ($relatedContributions as $contribution): ?>
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
                                                         ], ['class' => 'btn btn-sm btn-warning'])?>
                        <?=$this->Form->postLink('Delete', ['controller' => 'CarsUsers',
                                                            'action' => 'Delete',$contribution->id, $contribution->car_id, $contribution->user_id
                                                            
                                                         ], ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $car->id)])?>
                                                         </td><?php
                    }else{
                        ?> <!-- <td><?= $this->Html->link($contribution->user_id, ['controller' => 'Users', 'action' => 'view', $contribution->user_id]) ?></td>--><?php
                        ?><td><?= $this->Html->link($loginArr[$cont]{"login"}, ['controller' => 'Users', 'action' => 'view', $contribution->user_id]) ?></td><?php
                    }
                    ?>
                </tr> 
            <?php  ++$cont;
        endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div class="container" style="padding-top: 20px">
    <div class="row">
        <div class="col-md-4">
            <?= $this->Html->link('Add your own measure', ['controller' => 'Cars', 'action' => 'addContribution', $contribution->car_id]) ?>
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



<!-- <div class="container" style="padding-top: 20px">
    <div class="col-md-6">
        <img src="https://docs.moodle.org/dev/images_dev/c/c5/bar_chart.png">
    </div>
    <div class="col-md-6">
        <img src="https://docs.moodle.org/dev/images_dev/a/a9/doughnut_pie_chart.png">
    </div>
</div> -->

<?php /* debug($averagesByYear->toArray()); ?>
<!--     <?php debug($modelos)?>-->
    <?php // debug($chartAverages->toArray())?>  */?>

<div class="container" style="padding-top: 20px">
    <div class="col-md-12 text-center">   
        <h2> This brand averages by model</h2>
        <div id="chartByModel" style="margin-left: -100px"></div>
    </div>
</div>
<div class="container"  style="padding-top: 20px">
     <div class="col-md-6 text-center">   
        <h2>Brand global average for all models</h2>
        <div id="chartByBrand">
        </div>
    </div>
    <div class="col-md-6 text-center">   
        <h2>Contributions to this model</h2>
        <div id="PieChart">
        </div>
    </div>
</div>
<div class="container">
     
</div>
<div class="container">
    <div class="col-md-12 text-center">
        <h2> This brand average measures over the years</h2>
        <div id="averageByYearBrand" style="margin-left: -100px">
        </div>
    </div>
</div>

<script type="text/javascript">
// Load google charts

//console.log( " <?php echo $car->modeldelo;?> ");

var chartAverages = <?=json_encode($chartAverages);?>;
var averagesByYear = <?=json_encode($averagesByYear)?>;
var averagesByBrand = <?=json_encode($averagesByBrand)?>;

google.charts.load('current', {'packages':['corechart']});
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawbyBrandChart);
google.charts.setOnLoadCallback(drawPieChart);
google.charts.setOnLoadCallback(averageByYearBrandChart);

var arrayData = [];
arrayData.push(['Model', 'City', 'Highway', 'Combined']); //pusheamos los títulos en el primer índice

for(var i in chartAverages){
    arrayData.push([chartAverages[i].modelo, chartAverages[i].consumoCiudad, chartAverages[i].consumoAutopista, chartAverages[i].combinado]);
};

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable(arrayData);

  // Optional; add a title and set the width and height of the chart
  var options = {
                 'width':1280,
                 'height':480};


  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.ColumnChart(document.getElementById('chartByModel'));
  chart.draw(data, options);  
}

var arrayData2 = [];
arrayData2.push(['Year', 'City', 'Highway', 'Combined']); //pusheamos los títulos en el primer índice

var arrayDataAverageBrand = [];
arrayDataAverageBrand.push(['Brand', 'City', 'Highway', 'Combined', { role: 'annotation' }]);

var arrayDataLine = [];
arrayDataLine.push(['Year', 'City', 'Highway', 'Combined','Global Average']);

var arrayPie = [];
arrayPie.push(['Year', 'City', 'Highway', 'Combined','Global Average']);

for(var i in averagesByYear){
    
    arrayData2.push([averagesByYear[i].car_ano, averagesByYear[i].consumoCiudad, averagesByYear[i].consumoAutopista, averagesByYear[i].combinado]);
    
    arrayDataLine.push([averagesByYear[i].car_ano, averagesByYear[i].consumoCiudad, averagesByYear[i].consumoAutopista, averagesByYear[i].combinado, parseFloat(averagesByYear[i].mediaGlobal)]);

    arrayPie.push([averagesByYear[i].modelo, averagesByYear[i].pollsCity]);
    arrayPie.push([averagesByYear[i].modelo, averagesByYear[i].pollsHighway]);
    arrayPie.push([averagesByYear[i].modelo, averagesByYear[i].pollsCombined]);
};

for(var i in averagesByBrand){
    arrayDataAverageBrand.push([averagesByBrand[i].marca, averagesByBrand[i].consumoCiudad, averagesByBrand[i].consumoAutopista, averagesByBrand[i].combinado,averagesByBrand[i].pollsCombined]);
    console.log(arrayDataAverageBrand);
};

for(var i in averagesByYear){
    arrayPie.push([averagesByYear[i].modelo, averagesByYear[i].pollsCity]);
    arrayPie.push([averagesByYear[i].modelo, averagesByYear[i].pollsHighway]);
    arrayPie.push([averagesByYear[i].modelo, averagesByYear[i].pollsCombined]);
};

function drawbyBrandChart() {
    var data = google.visualization.arrayToDataTable(arrayDataAverageBrand);

  // Optional; add a title and set the width and height of the chart
  var options = {
                 bars: 'horizontal',
                 'width':700,
                 'height':250};


  // Display the chart inside the <div> element with id="piechart"
          var chart = new google.charts.Bar(document.getElementById('chartByBrand'));

  chart.draw(data, google.charts.Bar.convertOptions(options));
}

//numero de registros por modelo
function drawPieChart() {

        // Create the data table for Sarah's pizza.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['City refuels', <?=$pollsCity?>],
          ['Highway refuels', <?=$pollsHighway?>],
          ['Combined refuels', <?=$pollsCombined?>]
        ]);

        // Set options for Pie's pie chart.
        var options = {
                       width:600,
                       height:300,
                       pieHole: 0.4};

        // Instantiate and draw the chart for Sarah's pizza.
        var chart = new google.visualization.PieChart(document.getElementById('PieChart'));
        chart.draw(data, options);
      };


 function averageByYearBrandChart() {
         var data = google.visualization.arrayToDataTable(arrayDataLine);

        var options = {
          curveType: 'none',
          legend: { position: 'right' },
          seriesType: 'bars',
          series: {3: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('averageByYearBrand'));
        chart.draw(data, options);

};


</script>
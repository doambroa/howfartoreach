
<?php if($ajax != 1): ?>
<div class="col-md-12 text-center" style="background-image: url(../img/tires3.png);">
<h1>Results</h1>
<!-- <?php debug($cars)?> -->
<?php if(empty($query)): ?>
<h3>Please, fill any search criteria.</h3>
</div>
<?php endif; ?>
  <?php if(!empty($cars)): ?>
    <div class="row">
        <?php foreach($cars as $car): ?>
            <div class="col-md-6">
                <figure class="car">
                    
                
  <div id="card"><!-- $this->Flash->success(__('The car has been saved.')) -->

    <div> <!--div for car image -->
    <img src="<?php echo '../img/miniaturas/' . $car->modelo . '.png'; ?>" style="float: left; padding-top: 20px; max-height: 180px; max-width: 190px;">
  </div> <!-- end div for car image-->
  <h3 id="H3_2">
    <a title="title" href="" id="A_3"><?php echo $this->Html->link($car['marca'].' '.$car['modelo'], array('action' => 'view', $car['id'])); ?></a>
  </h3>
 
    <div id="cardData">
      <div id="cardText">
        City
      </div>
      <div id="cardNumber">
        <?php echo $car->consumoCiudad; ?> %
      </div>
      <div id="cardText">
        Highway
      </div>
      <div id="cardNumber">
        <?php echo $car->consumoAutopista ?> %
      </div>
      <div id="cardText">
        Combined
      </div>
      <div id="cardNumber">
        <?php echo $car->combinado ?> %
      </div>
    </div>

    </div>
   </figure>
                <br>
                <?php // echo $this->Html->link($car['marca'], array('action' => 'view', $car['id'])); ?>
                <br>
                <br><br>
            </div>
        <?php endforeach; ?>
    </div>
    <br><br><br>
    
    <?php else: ?> <!--  if(!empty($cars)) ?>
 -->

    <?php endif; ?>


<?php endif; ?>
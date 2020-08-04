<?php if($ajax != 1): ?>
  <div class="col-md-12 text-center" style="background-image: url(../img/tires3.png);">
  <h1>Results</h1>
  <?php if(empty($query)): ?>
  <h3>Please, fill any search criteria.</h3>
  </div>
  <?php endif; ?>
    <?php if(!empty($contributions)): ?>
      <div class="row">
        <?php foreach($contributions as $contribution): ?>
            <div class="col-md-6">
                <figure class="car">                     
                  <div id="card">
                    <div> <!--div for car image -->
                      <img src="<?php echo '../img/miniaturas/'.$contribution['car_modelo'].'.png'; ?>" style="float: left; padding-top: 20px; max-height: 180px; max-width: 190px;" onerror='this.src="../img/cars/cars.png"'>
                    </div> <!-- end div for car image-->
                    <h3 id="H3_2">
                      <a title="title" href="" id="A_3"><?php echo $this->Html->link($contribution['car_marca'].' '.$contribution['car_modelo'].' '.$contribution['combustible'][0], array('action' => 'view', $contribution['car_id'])); ?></a>

                     <?php
                     
                      if($contribution->pollsCity < 5){
                              $colorCity = "red";
                            }else if($contribution->pollsCity < 10){
                              $colorCity = "orange";
                            }else if($contribution->pollsCity >= 10){
                              $colorCity = "";
                            }

                            if($contribution->pollsHighway < 5){
                              $colorHighway = "red";
                            }else if($contribution->pollsHighway < 10){
                              $colorHighway = "orange";
                            }else if($contribution->pollsHighway >= 10){
                              $colorHighway = "";
                            }

                            if($contribution->pollsCombined < 5){
                              $colorCombined = "red";
                            }else if($contribution->pollsCombined< 10){
                              $colorCombined = "orange";
                            }else if($contribution->pollsCombined >= 10){
                              $colorCombined = "";
                            }
                    ?>

                    </h3> 
                    <div id="cardData">
                      <div id="cardText">
                        City
                      </div>
                      <div id="cardNumber" style="background:<?=$colorCity?>">
                        <?php echo round($contribution->consumoCiudad,3); ?> %
                      </div>
                      <div id="cardText">
                        Highway
                      </div>
                      <div id="cardNumber" style="background:<?=$colorHighway?>">
                        <?php echo round($contribution->consumoAutopista,3) ?> %
                      </div>
                      <div id="cardText">
                        Combined
                      </div>
                      <div id="cardNumber" style="background:<?=$colorCombined?>"> 
                        <?php echo round($contribution->combinado,3) ?> %
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


    <?php endif; ?>


<?php endif;


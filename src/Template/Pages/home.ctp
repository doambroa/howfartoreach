
<div class="container-fluid main-image">
<!--  <?php
 echo $this->Html->image('main.png', ['alt' => 'Main image', 'style' => 'style="width:128px;height:128px;']);
 ?>
 -->
<img class="img-responsive" src="img/main3.jpg" alt="main image">
<div class="titf">
         <h1 class="titu"> How far can your car go? </strong></h1>

  <div class="" >
    <?php echo $numModels;?> different models along <?= $numBrands;?> car brands </br>
        <?php echo $numCarRegisters; ?> total measure contributions
        from <?php echo $numUsers;?> users
  </div>
</div>

</div>
<div class="container" style="text-align: center; font-family: lato; padding-top: 64px; padding-bottom: 64px;">
  <h1>Welcome to howfartoreach</h1>
  <p style="font-size: 20px;">Time to know how much gas your car REALLY consumes.</p>      
  <p>Car mileage real data from the real final drivers</p>      
</div>
<section>
  <div class="container">
  <div class="row">  
    <div class="col-md-6 double-col-text">
      <h2>From users like you</h2>
      <p>HowFarToReach is a community website that provides data retrieved from final car users to bring you the most reliable information about fuel consumption </p>
    </div>

    <div class="col-md-6 double-col-img">
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 double-col-img" style="background-image:url('img/reliable.jpg');background-position: bottom; ">
</div>

    <div class="col-md-6 double-col-text">
      <h2>Reliable and trusty</h2>
      <p>Due to everybody's effort, HowFarToReach is as reliable as the own user data got from its own experiences, it's also very simple to use. </p>
    </div>
  </div>

  <div class="row">

    <div class="col-md-6 double-col-text">
      <h2>Forget manufacturers</h2>
      <p>We all know that manufacturer's data is always thinking about what they call the "best scenario" and they are not always realistic... HowFarToReach is the opposite from this, real data from real people </p>
    </div>
  
    <div class="col-md-6 double-col-img" style="background-image:url('img/manufacturers.jpg'); background-position:top;">
    </div>

  </div>

</div>
</section>

<div class="container-fluid">
 <div class="row" style="text-align: center">
   
  <div class="col-md-12">
    <h1>How does it work?</h1>
    <h3>simple</h3>
  </div>
 </div>

<div class="row">


  <div class="col-md-6" style="display: flex; justify-content: center; align-items: center;">
    <?php echo $this->Html->image('sample.png', ['alt' => 'Sample image', 'class' => 'img-responsive', 'style' => 'padding-top: 10px;']); ?>

<!--     <div id="cardData">
      <div id="cardText">
        City
      </div>
      <div id="cardNumber">
        11%
      </div>
      <div id="cardText">
        Highway
      </div>
      <div id="cardNumber">
        10%
      </div>
      <div id="cardText">
        Combined
      </div>
      <div id="cardNumber">
        11,5%
      </div>
    </div> -->

    </div>

  <div id="sampleTable" class="col-md-6 col-sm-12" style="text-align: center; font-family: lato;">
    <center><h4><b> </b></h4></center> <br>
      <ul class="list-group table">
        <li class="list-group-item"><b>Car brand and model: </b> Volkswagen Golf</li>
        <li class="list-group-item"><b>Mileage in city roads: </b>6.5L every 100 Km</li>
        <li class="list-group-item"><b>Mileage in highway roads: </b>5.8L every 100 Km</li>
        <li class="list-group-item"><b>Mileage combining them with a single tank: </b>6L every 100 Km</li>
      </ul>
     </div>
   </div>
</div> <!--row-->

<section>
<div class="overlay"> <!--contribute -->
<?php if(!isset($current_user)){ ?>
  <div class="container" style="margin-top: 60px">
    <div class="row" style="height: 240px">
      <div class="col-xl-9 mx-auto">
       <center>
       <h1> Ready to contribute? Sign up now!</h1>
        <?= $this->Html->link(__('Sign up'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'btn btn-lg btn-recolor-blue btn-default ']) ?>
        </center>
      </div>
    </div>
  </div>
<?php }else{ ?>
   <div class="container" style="margin-top: 60px">
    <div class="row" style="height: 240px">
      <div class="col-xl-9 mx-auto">
       <center>
       <h1> Ready to contribute? Share your measure!</h1>
        <?= $this->Html->link(__('Submit'), ['controller' => 'Cars', 'action' => 'addContribution'], ['class' => 'btn btn-lg btn-recolor-blue btn-default ']) ?>
        </center>
      </div>
    </div>
  </div>
<?php }?>
</div> <!--contribute> -->
</section>

<section>
  <div class="" >
    <?php echo $numModels;?> different models along <?= $numBrands;?> car brands </br>
        <?php echo $numCarRegisters; ?> total measure contributions
        Total users: <?php echo $numUsers;?>
  </div>
</section>
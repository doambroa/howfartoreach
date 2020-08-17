    <nav class="navbar navbar-inverse" /*style="height: 60px"*/>
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

          </button>
        <!--   <span><?= $this->Html->image('h-logo-negativo.png', [
            'alt' => 'HowFarToReach',
            'url' => ['controller' => 'Pages', 'action' => 'index'],
            'class' => 'navbar-brand nav-logo'
            // 'style' => 'width: 900px;'
            ]); ?></span> -->
        <!-- <a class="navbar-brand" href=""><?= $this->fetch('title') ?></a>  -->
        <a class= "navbar-brand nav-logo" href="/howfartoreach/"></a>

        </div>

        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
           <li class="active"><a href="/howfartoreach">Home</a></li>
<!--             <li class="active">
              <?php echo $this->Html->link('Home', ['controller' => 'users', 'action' => 'index'])?>
            </li>  -->
            <li><?php echo $this->Html->link('Measures', ['controller' => 'cars', 'action' => 'contributions'])?></li>

            <?php if(isset($current_user) && $current_user['role'] == 'admin'): ?>
              <li><?php echo $this->Html->link('Users', ['controller' => 'users', 'action' => 'index'])?></li>
            <?php endif ?>
          </ul>

            <?php echo $this->Form->create('Car', array('type' => 'GET', 'class' => 'navbar-form navbar-left', 'url' => array('controller'=>'Cars', 'action' => 'search')));?>

        <div class="input-group">
            <?php echo $this->Form->input('query', array('label' => false, 'div' => false, 'id'=>'s', 'class'=> 'form-control s', 'autocomplete' => 'off', 'placeholder'=>'Search for a car...'));?>

            <?php echo $this->Form->button('<div class="glyphicon glyphicon-search"></div>', array('class' => 'btn btn-default','role'=>'button', 'type'=>'submit', 'escape'=>false));/* si pongo un i en lugar de un div no tiene sentido, me pinta muchas lupas porque crea un montón de <i> aleatorios https://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_form_input_group_btn&stacked=h */?>
            <?php echo $this->Form->end();?>
        </div>

            <ul class="nav navbar-nav"><li><?php echo $this->Html->link('Submit', ['controller' => 'cars', 'action' => 'addContribution'])?></li></ul>



          <?php if(isset($current_user) && $current_user['role'] == 'admin'): ?>
            <ul class="nav navbar-nav"><li><?php echo $this->Html->link('NEW CAR', ['controller' => 'cars', 'action' => 'add'])?></li></ul>

            <ul class="nav navbar-nav"><li><?php echo $this->Html->link('LIST CARS', ['controller' => 'cars', 'action' => 'index'])?></li></ul>

            <ul class="nav navbar-nav"><li><?php echo $this->Html->link('LIST CONTRIBUTIONS', ['controller' => 'CarsUsers', 'action' => 'index'])?></li></ul>

          <?php endif ?>


        <ul class = "nav navbar-nav navbar-right" >
          <?php if(!isset($current_user)): ?>
          <li class=""> <a href="/howfartoreach/users/login">Log in</a></li>
          <li><?php echo $this->Html->link('Sign Up', ['controller' => 'users', 'action' => 'add'])?></a></li>
        <?php endif ?>
          <?php if(isset($current_user)): ?>
             <li><?php //echo $current_user['login']; 
                  echo $this->Html->link('Profile', ['controller' => 'users', 'action' => 'view', $current_user['id']])?></a></li>
          <li><?php //echo $current_user['login']; 
                  echo $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout'])?></a></li>
          <?php endif ?>
        </ul>

        </div><!--/.nav-collapse -->
      </div>
    </nav>


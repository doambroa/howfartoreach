
  <?= $this->Flash->render('auth'); ?>
<div class="container" style="padding-top: 60px">
  <div class="row">

        <div class="col-lg-3 col-md-3"> 
        </div>

        <div class="col-lg-6 col-md-6">



  <div class="imgAvatar">
    <img src="../img/h-logo.png" alt="Avatar" class="avatar">
  </div>

  <?= $this->Form->create() ?>
  <div class="signupForm">
    <!-- <label><b>Username</b></label> -->
    <!-- <input class="inp" type="text" placeholder="Enter Username" name="uname" required> -->

    <?= $this->Form->input('login', ['class' => 'inp form-control', 'placeholder' => 'Enter username', 'label' => 'Username', 'required']) ?>

    <!-- <label><b>Password</b></label> -->
<!--     <input class="inp" type="password" placeholder="Enter Password" name="psw" required>
 -->
    <?= $this->Form->input('password', ['class' => 'inp form-control', 'placeholder' => 'Enter password', 'label' => 'Password', 'required']) ?>

<!--     <button class="butn" type="submit">Login</button> -->
    <?= $this->Form->button('Login', ['class' => 'butn']) ?>
    <!-- <?php echo debug($this)?> -->
<!--  //echo $this->Html->link('Sign Up', ['controller' => 'Users', 'action' => 'add'], ['class' => 'butn'])
 -->    <!-- <input type="checkbox" checked="checked"> Remember me -->
  </div>
<!-- 
  <div class="signupForm" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn butn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div> -->
<?= $this->Form->end(); ?>

</div>
<div class="col-lg-3"></div>
	</div>

</div>




<!-- <div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->input('login') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div> -->
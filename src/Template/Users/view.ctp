<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
    <div class="" style=" margin-top: 40px;background-image: url(../../img/tires3.png);">

<div class="container" style="margin-top: 40px;">
    <div class="col-md-6" style="padding-top:20px;">
        <h3><?= h($user->login) ?></h3>
        <table class="table">

            <tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($user->id) ?></td>
            </tr>
                <th scope="row"><?= __('Login') ?></th>
                <td><?= h($user->login) ?></td>
            </tr>
            <?php
            if($current_user['role'] == 'admin' || $current_user['id'] == $user->id){ ?>
                <tr>
                    <th scope="row"><?= __('Mail') ?></th>
                    <td><?= h($user->mail) ?></td>
                </tr><?php
            }?>

            <tr>
                <th scope="row"><?= __('Role') ?></th>
                <td><?= h($user->role) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Sex') ?></th>
                <td><?= h($user->sex) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Country') ?></th>
                <td><?= h($user->country) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Age') ?></th>
                <td><?= $this->Number->format($user->age) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Signed up on') ?></th>
                <td><?= h($user->creado) ?></td>
            </tr>
        </table>
    </div>

    <div class="container col-md-6 usrimg">

            <!-- <img style="width: 50%; height: auto;" src="../../img/Profile.png" alt="Profile photo" width="35%"> -->

            <!-- <img alt="User Pic" src="../../img/Profile.png" id="profile-image1" class="img-circle img-responsive" width="60%"> -->
            <?php
                if($current_user['sex']=='male'){
                  ?><img alt="User Pic" src="../../img/Profile.png" id="profile-image1" class="img-circle img-responsive" width="60%"><?php
                } else if($current_user['sex']=='female'){
                  ?><img alt="User Pic" src="../../img/profile-female.jpg" id="profile-image1" class="img-circle img-responsive" width="60%"><?php
                } else{
                  ?><img alt="User Pic" src="../../img/profile-undefined.png" id="profile-image1" class="img-circle img-responsive" width="60%"><?php 
                }
                ?>
              <div class="overlay"></div>

            <?php if($current_user['role'] == 'admin' || $current_user['id'] == $user->id){ ?>
                <?= $this->Html->link(__('Edit my profile'), ['action' => 'edit', $user->id], ['class' => 'btn btn-lg btn-warning', 'style' => 'position: absolute;top: 50%;left: 31%;transform: translate(-50%,-50%);text-align: center;']) ?>
            <?php 
            }
            ?>
            <?php if($current_user['role'] == 'admin' || $current_user['id'] == $user->id){ ?>
                <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->login)]) ?> </li>
            <?php } ?>
                    
     </div>
   

<?php //debug($user->cars[0]->_joinData->consumoCiudad); ?>

    <div class="col-md-10" style="padding-top:40px;">
        <h4><?= __('Related Contributions') ?></h4>          
        <?php if (!empty($user->cars)): ?>
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Brand' ) ?></th>
                <th scope="col"><?= __('Model') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('Highway') ?></th>
                <th scope="col"><?= __('Combined') ?></th>
                <th scope="col"><?= __('Type of fuel') ?></th>
                <th scope="col"><?= __('Style') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->cars as $cars): ?>
            <tr>
                <td><?= h($cars->marca) ?></td>
                <td><?= h($cars->modelo) ?></td>
                <td><?= h($cars->_joinData->consumoCiudad) ?></td>
                <td><?= h($cars->_joinData->consumoAutopista) ?></td>
                <td><?= h($cars->_joinData->combinado) ?></td>
                <td><?= h($cars->combustible) ?></td>
                <td><?= h($cars->_joinData->tipoConduccion) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Cars', 'action' => 'view', $cars->id], ['class' => 'btn btn-sm btn-info']) ?>
                      <?php if($current_user['id'] == $user->id){ ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'CarsUsers', 'action' => 'edit', $cars->_joinData->id,$cars->id,$user->id], ['class' => 'btn btn-sm btn-warning']) ?>
                      <?php } ?>
                      <?php if($current_user['role'] == 'admin' || $current_user['id'] == $user->id){ ?>
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'CarsUsers', 'action' => 'delete', $cars->_joinData->id,$cars->id,$user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cars->_joinData->id), 'class'=>'btn btn-sm btn-danger']) ?>
                      <?php } ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else:?>
        <span>You have no contributions yet. You can add your own measure <?= $this->Html->link(__('here'), ['controller' => 'Cars', 'action' => 'add_contribution'], ['class' => '']) ?>
</span>
        <?php endif; ?>
    </div>
</div>

</div>
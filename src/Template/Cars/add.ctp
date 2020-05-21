<?php
use Cake\Routing\Router;
?>

<div class="container">
    <div class="" style=" margin-top: 40px;background-image: url(../img/tires3.png);">
        <?= $this->Form->create($car,['type' => 'file', 'class' => 'ajax_page']) ?>
        <fieldset>
            <legend><?= __('Add new car in the market') ?><div class="ajax_loading_image"></div></legend>
                <div class="form-group select">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span><?php echo $this->Form->control('marca',['label'=>'Brand','required']);?></span>
                    </div>
                </div>
                <div class="form-group select">
                    <span style="font-weight: bold;"></span>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span><?php echo $this->Form->control('modelo',['label'=>'Model','required'=>true]);?></span>
                    </div>
                </div>
                <div class="form-group select" style="padding-top: 20px; padding-bottom: 10px;">
                    <span style="font-weight: bold;">Type of fuel</span>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tint"></span></span>
                        <?php echo $this->Form->control('combustible', ['label' => false, 'options' => ['Diesel' => 'Diesel', 'Gasolina' => 'Petrol', 'electrico' => 'Electric']]);?>
                    </div>
                </div>    
            </div>
        </fieldset>
        <?= $this->Form->button(__('Create')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

<!-- <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car $car
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cars'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cars form large-9 medium-8 columns content">
    <?= $this->Form->create($car) ?>
    <fieldset>
        <legend><?= __('Add Car') ?></legend>
        <?php
            echo $this->Form->control('marca');
            echo $this->Form->control('modelo');
            echo $this->Form->control('combustible');
            echo $this->Form->control('users._ids', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
 -->
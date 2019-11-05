<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car $car
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $car->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $car->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cars'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav> -->
<div class="col-md-6 col-md-offset-3" style="padding-top: 40px;">
    <?= $this->Form->create($car) ?>
    <fieldset>
        <legend><?= __('Edit Car') ?></legend>
        <?php
            echo $this->Form->control('marca',['disabled']);
            echo $this->Form->control('modelo',['disabled']);
            echo $this->Form->control('consumoCiudad');
            echo $this->Form->control('consumoAutopista');
            echo $this->Form->control('combinado');
            echo $this->Form->control('combustible', ['label' => 'Fuel', 'options' => ['Diesel' => 'Diesel', 'Gasolina' => 'Petrol', 'electrico' => 'Electric']]);
            // echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Confirm changes'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->button('Reset', ['type' => 'reset', 'class'=>'btn btn-warning']) ?>

    <?= $this->Form->end() ?>
</div>

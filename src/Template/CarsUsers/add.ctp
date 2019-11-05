<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CarsUser $carsUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cars Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cars'), ['controller' => 'Cars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Car'), ['controller' => 'Cars', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="carsUsers form large-9 medium-8 columns content">
    <?= $this->Form->create($carsUser) ?>
    <fieldset>
        <legend><?= __('Add Cars User') ?></legend>
        <?php
            echo $this->Form->control('consumoCiudad');
            echo $this->Form->control('consumoAutopista');
            echo $this->Form->control('combinado');
            echo $this->Form->control('tipoConduccion');
            echo $this->Form->control('creado');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

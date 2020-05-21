<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Carsuser $carsuser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $carsUser->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $carsUser->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Carsusers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cars'), ['controller' => 'Cars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Car'), ['controller' => 'Cars', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="carsusers form large-9 medium-8 columns content">
    <?= $this->Form->create($carsUser) ?>
    <fieldset>
        <legend><?= __('Edit Carsuser') ?></legend>
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

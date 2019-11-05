<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CarsUser $carsUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cars User'), ['action' => 'edit', $carsUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cars User'), ['action' => 'delete', $carsUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $carsUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cars Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cars User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cars'), ['controller' => 'Cars', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Car'), ['controller' => 'Cars', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="carsUsers view large-9 medium-8 columns content">
    <h3><?= h($carsUser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Car') ?></th>
            <td><?= $carsUser->has('car') ? $this->Html->link($carsUser->car->id, ['controller' => 'Cars', 'action' => 'view', $carsUser->car->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $carsUser->has('user') ? $this->Html->link($carsUser->user->id, ['controller' => 'Users', 'action' => 'view', $carsUser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TipoConduccion') ?></th>
            <td><?= h($carsUser->tipoConduccion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($carsUser->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ConsumoCiudad') ?></th>
            <td><?= $this->Number->format($carsUser->consumoCiudad) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ConsumoAutopista') ?></th>
            <td><?= $this->Number->format($carsUser->consumoAutopista) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Combinado') ?></th>
            <td><?= $this->Number->format($carsUser->combinado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Creado') ?></th>
            <td><?= h($carsUser->creado) ?></td>
        </tr>
    </table>
</div>

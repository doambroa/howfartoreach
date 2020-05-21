<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Carsuser $carsuser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>

<?php debug($carsuser);?>

        <li><?= $this->Html->link(__('Edit Carsuser'), ['action' => 'edit', ,$carsuser->id, $carsuser->car->id, $carsuser->user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Carsuser'), ['action' => 'delete', $carsuser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $carsuser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Carsusers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Carsuser'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cars'), ['controller' => 'Cars', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Car'), ['controller' => 'Cars', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="carsusers view large-9 medium-8 columns content">
    <h3><?= h($carsuser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Car') ?></th>
            <td><?= $carsuser->has('car') ? $this->Html->link($carsuser->car->id, ['controller' => 'Cars', 'action' => 'view', $carsuser->car->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $carsuser->has('user') ? $this->Html->link($carsuser->user->id, ['controller' => 'Users', 'action' => 'view', $carsuser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TipoConduccion') ?></th>
            <td><?= h($carsuser->tipoConduccion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($carsuser->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ConsumoCiudad') ?></th>
            <td><?= $this->Number->format($carsuser->consumoCiudad) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ConsumoAutopista') ?></th>
            <td><?= $this->Number->format($carsuser->consumoAutopista) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Combinado') ?></th>
            <td><?= $this->Number->format($carsuser->combinado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Creado') ?></th>
            <td><?= h($carsuser->creado) ?></td>
        </tr>
    </table>
</div>

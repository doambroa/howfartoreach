<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CarsUser[]|\Cake\Collection\CollectionInterface $carsUsers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cars User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cars'), ['controller' => 'Cars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Car'), ['controller' => 'Cars', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="carsUsers index large-9 medium-8 columns content">
    <h3><?= __('Cars Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('car_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('consumoCiudad') ?></th>
                <th scope="col"><?= $this->Paginator->sort('consumoAutopista') ?></th>
                <th scope="col"><?= $this->Paginator->sort('combinado') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipoConduccion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('creado') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carsUsers as $carsUser): ?>
            <tr>
                <td><?= $this->Number->format($carsUser->id) ?></td>
                <td><?= $carsUser->has('car') ? $this->Html->link($carsUser->car->id, ['controller' => 'Cars', 'action' => 'view', $carsUser->car->id]) : '' ?></td>
                <td><?= $carsUser->has('user') ? $this->Html->link($carsUser->user->id, ['controller' => 'Users', 'action' => 'view', $carsUser->user->id]) : '' ?></td>
                <td><?= $this->Number->format($carsUser->consumoCiudad) ?></td>
                <td><?= $this->Number->format($carsUser->consumoAutopista) ?></td>
                <td><?= $this->Number->format($carsUser->combinado) ?></td>
                <td><?= h($carsUser->tipoConduccion) ?></td>
                <td><?= h($carsUser->creado) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $carsUser->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $carsUser->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $carsUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $carsUser->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

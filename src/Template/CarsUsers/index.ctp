<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Carsuser[]|\Cake\Collection\CollectionInterface $carsusers
 */
?>

<div class="container" style="text-align: center; margin-top: 40px;">
     <?= $this->Html->image('velocimetro.png', ['alt' => 'contributions icon', 'style' => 'width:15%;height:15%;']); ?>

    <h3><?=__('All contributions')?></h3>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('car_id') ?></th>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('consumoCiudad') ?></th>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('consumoAutopista') ?></th>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('combinado') ?></th>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('Driving style') ?></th>
                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('Created') ?></th>
                <th style="text-align: center;" scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carsUsers as $carsuser): ?>
            <tr>
                <td><?= $this->Number->format($carsuser->id) ?></td>
                <td><?= $carsuser->has('car') ? $this->Html->link($carsuser->car->id, ['controller' => 'Cars', 'action' => 'view', $carsuser->car->id]) : '' ?></td>
                <td><?= $carsuser->has('user') ? $this->Html->link($carsuser->user->id, ['controller' => 'Users', 'action' => 'view', $carsuser->user->id]) : '' ?></td>
                <td><?= $this->Number->format($carsuser->consumoCiudad) ?></td>
                <td><?= $this->Number->format($carsuser->consumoAutopista) ?></td>
                <td><?= $this->Number->format($carsuser->combinado) ?></td>
                <td><?= h($carsuser->tipoConduccion) ?></td>
                <td><?= h($carsuser->creado) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $carsuser->car_id],['class' => 'btn btn-sm btn-info']) ?>
                    <?php 
                    if( ($current_user['role'] == 'admin') || ($current_user['id'] == $carsuser->user_id) ): ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'CarsUsers', 'action' => 'edit', $carsuser->id, $carsuser->car_id, $carsuser->user_id], ['class' => 'btn btn-sm btn-warning'] ) ?>
                            <?= $this->Form->postLink('Delete', ['controller' => 'CarsUsers', 'action' => 'delete', $carsuser->id, $carsuser->car_id, $carsuser->user_id], ['confirm' => 'Are you sure you want to delete register number ' . $carsuser->id . '?', 'class' => 'btn btn-sm btn-danger']) ?> 
                    <?php endif?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
</div>
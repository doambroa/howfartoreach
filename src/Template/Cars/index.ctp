<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car[]|\Cake\Collection\CollectionInterface $cars
 */
?>
<div class="container">
    <div class="col-md-12"  style="text-align: center; margin-top: 40px;">
        <h3><?= __('Cars') ?></h3>
        <table class="table table-striped cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('Brand') ?></th>
                    <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('Model') ?></th>
                    <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('Fuel') ?></th>
                    <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('Year') ?></th>
                    <th scope="col" style="text-align: center;" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cars as $car): ?>
                <tr>

                    <td><?= $this->Number->format($car->id) ?></td>
                    <td><?= h($car->marca) ?></td>
                    <td><?= h($car->modelo) ?></td>
                    <td><?= h($car->combustible) ?></td>
                    <td><?= h($car->ano) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $car->id], ['class' => 'btn btn-sm btn-info']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $car->id], ['class' => 'btn btn-sm btn-warning']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $car->id], ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $car->id)]) ?>
                        <!-- <script>
                            $.get("http://localhost/howfartoreach/img/miniaturas/<?=$car->modelo?>.png")
                            .done(function() { 
                                $('#carimg').attr('src', "http://localhost/howfartoreach/img/miniaturas/<?=$car->modelo?>.png");


                            }).fail(function() { 
                                

                            });
                        </script>
                        <img id="carimg" src="#"></img>
                         -->
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers(['before' => '', 'after' => '']   ) ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
</div>


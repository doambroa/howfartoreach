    <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<div class="col-md-12" style="text-align: center; margin-top: 40px;">

    <?= $this->Html->image('user.png', ['alt' => 'users image', 'style' => 'width:8%;height:8%;']); ?>

    <h3><?= __('Users') ?></h3>
    <table class="table table-striped cellpadding=" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th  style="text-align: center;" scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th  style="text-align: center;" scope="col"><?= $this->Paginator->sort('login') ?></th>
                <!--<th scope="col"><?= $this->Paginator->sort('password') ?></th>-->
                <th  style="text-align: center;" scope="col"><?= $this->Paginator->sort('mail') ?></th>
                <th  style="text-align: center;" scope="col"><?= $this->Paginator->sort('age') ?></th>
<!--                 <th scope="col"><?= $this->Paginator->sort('role') ?></th> -->
                <th  style="text-align: center;" scope="col"><?= $this->Paginator->sort('sex') ?></th>
                <th  style="text-align: center;" scope="col"><?= $this->Paginator->sort('country') ?></th>
                <!--<th scope="col"><?= $this->Paginator->sort('creado') ?></th>-->
                <th scope="col" class="actions" style="text-align: center;"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td>    <?= h($user->login) ?></td>
             <!--    <td><?= h($user->password) ?></td> -->
                <td><?= h($user->mail) ?></td>
                <td><?= $this->Number->format($user->age) ?></td>
                <!--<td><?= h($user->role) ?></td>-->
                <td><?= h($user->sex) ?></td>
                <td>
                    <?php if($user->country == 'ES'){ ?>
                            <?php echo 'España' ?>
                        <?php }else{ ?>
                        <?= h($user->country) ?>
                        <?php } ?>
                    </td>
                <!--<td><?= h($user->creado) ?></td>-->
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id], ['class' => 'btn btn-sm btn-info']) ?>
                    <?php if($current_user['role'] == 'admin' || $current_user['id'] == $user->id): ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-sm btn-warning']) ?>
                    <?php if($user->role != 'admin'): ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => 'Are you sure you want to delete user ' . $user->id . ' with login ' .  $user->login . '?', 'class' => 'btn btn-sm btn-danger']) ?>
                    <?php endif ?>
                    <?php endif ?>
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

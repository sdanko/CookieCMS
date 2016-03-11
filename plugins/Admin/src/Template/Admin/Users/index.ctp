
<div class="actions">
    <div class="btn-group">
        <?= $this->Html->link(__d('admin','New User'), ['prefix' => 'admin', 'action' => 'add'], ['class'=> 'btn btn-success']) ?>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-stripped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('active', __d('admin', 'Active')) ?></th>
            <th><?= $this->Paginator->sort('first_name', __d('admin', 'First name')) ?></th>
            <th><?= $this->Paginator->sort('middle_name', __d('admin', 'Middle name')) ?></th>
            <th><?= $this->Paginator->sort('last_name', __d('admin', 'Last name')) ?></th>
            <th><?= $this->Paginator->sort('email', __d('admin', 'Email')) ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $this->Number->format($user->id) ?></td>
            <td><?= h($user->active ?  __d('admin','Yes') : __d('admin','No')) ?></td>
            <td><?= h($user->first_name) ?></td>
            <td><?= h($user->middle_name) ?></td>
            <td><?= h($user->last_name) ?></td>
            <td><?= h($user->email) ?></td>
            <td class="actions">
              <!--   <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?> -->
              
              <?= $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', ['action' => 'edit', $user->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Edit')]) ?>
              <?= $this->Form->postLink(__('<i class="fa fa-trash fa-lg"></i>'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Delete')]) ?>
              <?= $this->Html->link('<i class="fa fa-users fa-lg"></i>', ['controller' => 'RolesUsers', 'action' => 'index', "userId" => $user->id],
                        ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','User roles')]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>

</div>

  <div class="col-md-12 text-center">
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __d('admin','previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__d('admin','next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>

<div class="actions">
    <div class="btn-group">
        <?= $this->Html->link(__d('admin','New Role'), ['prefix' => 'admin', 'action' => 'add'], ['class'=> 'btn btn-success']) ?>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-stripped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name', __d('admin', 'Name')) ?></th>
            <th><?= $this->Paginator->sort('alias', __d('admin', 'Alias')) ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($roles as $role): ?>
        <tr>
            <td><?= $this->Number->format($role->id) ?></td>
            <td><?= h($role->name) ?></td>
            <td><?= h($role->alias) ?></td>
            <td class="actions">
                <?= $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', ['action' => 'edit', $role->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Edit')]) ?>
                <?= $this->Form->postLink(__('<i class="fa fa-trash fa-lg"></i>'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id), 'escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Delete')]) ?>
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

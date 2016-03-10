
<div class="table-responsive">
    <table class="table table-stripped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('name', __d('admin', 'Name')) ?></th>
            <th><?= $this->Paginator->sort('alias', __d('admin', 'Alias')) ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($roles as $role): ?>
        <tr>
            <td><?= h($role->name) ?></td>
            <td><?= h($role->alias) ?></td>
            <td class="actions">
                <?= $role->active ?
                        $this->Form->postLink(__('<i class="fa fa-check-square fa-lg"></i>'), ['action' => 'deactivate', $role->id, $userId], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Deactivate')])
                        :
                        $this->Form->postLink(__('<i class="fa fa-check-square-o fa-lg"></i>'), ['action' => 'activate', $role->id, $userId], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Activate')])
                ?>
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

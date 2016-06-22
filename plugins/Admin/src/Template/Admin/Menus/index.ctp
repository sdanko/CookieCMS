<div class="actions">
    <div class="btn-group">
        <?= $this->Html->link(__d('admin','New Menu'), ['action' => 'add'], ['class'=> 'btn btn-success']) ?>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-stripped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('title', __d('admin', 'Title')) ?></th>
            <th><?= $this->Paginator->sort('alias', __d('admin', 'Alias')) ?></th>
            <th><?= $this->Paginator->sort('class', __d('admin', 'Class')) ?></th>
            <th><?= $this->Paginator->sort('active', __d('admin', 'Active')) ?></th>
            <th class="actions"><?= __d('admin','Actions')  ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($menus as $menu): ?>
        <tr>
            <td><?= h($menu->title) ?></td>
            <td><?= h($menu->alias) ?></td>
            <td><?= h($menu->class) ?></td>
            <td><?= $this->element('checkbox_column', ["checked" => $menu->active]); ?></td>
            <td class="actions">
                <?= $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', ['action' => 'edit', $menu->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Edit')]) ?>
                <?= $this->Form->postLink(__('<i class="fa fa-trash fa-lg"></i>'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id), 'escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Delete')]) ?>
                <?= $this->Html->link('<i class="fa fa-link fa-lg"></i>', ['controller' => 'Links', 'action' => 'index', "menuId" => $menu->id],
                        ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Links')]) ?>
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


<div class="actions">
    <div class="btn-group">
         <?= $this->Html->link(__d('admin','New Link'), ['action' => 'add', $menuId], ['class'=> 'btn btn-success']) ?>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-stripped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('link', __d('admin', 'Link')) ?></th>
            <th><?= $this->Paginator->sort('title', __d('admin', 'Title')) ?></th>
            <th><?= $this->Paginator->sort('parent_id', __d('admin', 'Parent')) ?></th>
            <th><?= $this->Paginator->sort('menu_id', __d('admin', 'Menu')) ?></th>
            <th class="actions"><?= __d('admin','Order') ?></th>
            <th class="actions"><?= __d('admin','Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($links as $key=>$link): ?>
        <tr>
            <td><?= $this->Number->format($link->id) ?></td>
            <td><?= h($link->link) ?></td>
            <td><?= h($link->title) ?></td>
            <td>
                <?= $link->has('parent_link') ? $this->Html->link($link->parent_link->id, ['controller' => 'Links', 'action' => 'view', $link->parent_link->id]) : '' ?>
            </td>
            <td>
                <?= $link->has('menu') ? $this->Html->link($link->menu->title, ['controller' => 'Menus', 'action' => 'view', $link->menu->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $key!=0 ? $this->Form->postLink(__('<i class="fa fa-angle-up fa-lg"></i>'), ['action' => 'moveUp', $link->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Move up')]) : '' ?>
                <?= $key!=count($links)-1 ? $this->Form->postLink(__('<i class="fa fa-angle-down fa-lg"></i>'), ['action' => 'moveDown', $link->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Move down')]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', ['action' => 'edit', $link->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Edit')]) ?>
                <?= $this->Form->postLink(__('<i class="fa fa-trash fa-lg"></i>'), ['action' => 'delete', $link->id], ['confirm' => __('Are you sure you want to delete # {0}?', $link->id), 'escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Delete')]) ?>
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

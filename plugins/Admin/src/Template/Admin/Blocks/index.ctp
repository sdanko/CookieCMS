<div class="actions">
    <div class="btn-group">
        <?= $this->Html->link(__d('admin','New Block'), ['action' => 'add', $regionId], ['class'=> 'btn btn-success']) ?>
    </div>
</div>
<h3><?=  $title_for_layout ?></h3>
<div class="table-responsive">
    <table class="table table-stripped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('title', __d('admin', 'Title')) ?></th>
            <th><?= $this->Paginator->sort('alias', __d('admin', 'Alias')) ?></th>
            <th><?= $this->Paginator->sort('class', __d('admin', 'Class')) ?></th>
            <th><?= $this->Paginator->sort('element', __d('admin', 'Element')) ?></th>
            <th><?= $this->Paginator->sort('region_id', __d('admin', 'Region')) ?></th>
            <th><?= $this->Paginator->sort('show_title', __d('admin', 'Show title')) ?></th>
            <th><?= $this->Paginator->sort('active', __d('admin', 'Active')) ?></th>
            <th class="actions"><?= __d('admin','Order') ?></th>
            <th class="actions"><?= __d('admin','Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($blocks as $key=>$block): ?>
        <tr>
            <td><?= h($block->title) ?></td>
            <td><?= h($block->alias) ?></td>
            <td><?= h($block->class) ?></td>
            <td><?= h($block->element) ?></td>
            <td>
                <?= $block->has('region') ? $this->Html->link($block->region->title, ['controller' => 'Regions', 'action' => 'view', $block->region->id]) : '' ?>
            </td>
            <td><?= $this->element('checkbox_column', ["checked" => $block->show_title]); ?></td>
            <td><?= $this->element('checkbox_column', ["checked" => $block->active]); ?></td>
            <td class="actions">
                <?= $key!=0 ? $this->Form->postLink(__('<i class="fa fa-angle-up fa-lg"></i>'), ['action' => 'moveUp', $block->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Move up')]) : '' ?>
                <?= $key!=count($blocks)-1 ? $this->Form->postLink(__('<i class="fa fa-angle-down fa-lg"></i>'), ['action' => 'moveDown', $block->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Move down')]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', ['action' => 'edit', $block->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Edit')]) ?>
                <?= $this->Form->postLink(__('<i class="fa fa-trash fa-lg"></i>'), ['action' => 'delete', $block->id], ['confirm' => __('Are you sure you want to delete # {0}?', $block->id), 'escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Delete')]) ?>
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


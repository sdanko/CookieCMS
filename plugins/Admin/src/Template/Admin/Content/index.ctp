<div class="actions">
    <div class="btn-group">
        <?= $this->Html->link(__d('admin','New Content'), ['prefix' => 'admin', 'action' => 'add'], ['class'=> 'btn btn-success']) ?>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-stripped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('title',  __d('admin', 'Title')) ?></th>
            <th><?= $this->Paginator->sort('content_type_id',  __d('admin', 'Content type')) ?></th>
            <th><?= $this->Paginator->sort('active',  __d('admin', 'Active')) ?></th>
            <th><?= $this->Paginator->sort('create_date',  __d('admin', 'Create date')) ?></th>
            <th><?= $this->Paginator->sort('modified_date',  __d('admin', 'Modified date')) ?></th>
            <th><?= $this->Paginator->sort('slug', __d('admin', 'Slug')) ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($content as $content): ?>
        <tr>
            <td><?= $this->Number->format($content->id) ?></td>
            <td><?= h($content->title) ?></td>
            <td>
                <?= $content->has('content_type') ? $this->Html->link($content->content_type->title, ['controller' => 'ContentTypes', 'action' => 'view', $content->content_type->id]) : '' ?>
            </td>
            <td><?= h($content->active) ?></td>
            <td><?= h($content->create_date) ?></td>
            <td><?= h($content->modified_date) ?></td>
            <td><?= h($content->slug) ?></td>
            <td class="actions">
                <!-- <?= $this->Html->link(__('View'), ['action' => 'view', $content->id]) ?>-->
                 <?= $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', ['action' => 'edit', $content->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Edit')]) ?>
                <?= $this->Form->postLink(__('<i class="fa fa-trash fa-lg"></i>'), ['action' => 'delete', $content->id], ['confirm' => __('Are you sure you want to delete # {0}?', $content->id), 'escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Delete')]) ?>
               
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
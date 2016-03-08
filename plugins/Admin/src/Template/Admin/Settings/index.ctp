<div class="actions">
    <div class="btn-group">
        <?= $this->Html->link(__d('admin','New Setting'), ['action' => 'add'], ['class'=> 'btn btn-success']) ?>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-stripped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('key', __d('admin', 'Key'))?></th>
            <th><?= $this->Paginator->sort('title', __d('admin', 'Title')) ?></th>
            <th><?= $this->Paginator->sort('description', __d('admin', 'Description'))?></th>
            <th class="actions"><?= __d('admin','Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($settings as $setting): ?>
        <tr>
            <td><?= $this->Number->format($setting->id) ?></td>
            <td><?= h($setting->key) ?></td>
            <td><?= h($setting->title) ?></td>
            <td><?= h($setting->description) ?></td>
            <td class="actions">
                <?= $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', ['action' => 'edit', $setting->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Edit')]) ?>
                <?= $this->Form->postLink(__('<i class="fa fa-trash fa-lg"></i>'), ['action' => 'delete', $setting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $setting->id), 'escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Delete')]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
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

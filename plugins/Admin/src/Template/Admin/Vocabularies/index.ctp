<div class="actions">
    <div class="btn-group">
        <?= $this->Html->link(__d('admin','New Vocabulary'), ['action' => 'add'], ['class'=> 'btn btn-success']) ?>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('title', __d('admin', 'Title')) ?></th>
                <th><?= $this->Paginator->sort('alias', __d('admin', 'Alias')) ?></th>
                <th><?= $this->Paginator->sort('required', __d('admin', 'Required')) ?></th>
                <th><?= $this->Paginator->sort('multiple', __d('admin', 'Multiple')) ?></th>
                <th><?= $this->Paginator->sort('tags', __d('admin', 'Tags')) ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vocabularies as $vocabulary): ?>
            <tr>
                <td><?= $this->Number->format($vocabulary->id) ?></td>
                <td><?= h($vocabulary->title) ?></td>
                <td><?= h($vocabulary->alias) ?></td>
                <td><?= h($vocabulary->required ?  __d('admin','Yes') : __d('admin','No'))  ?></td>
                <td><?= h($vocabulary->multiple ?  __d('admin','Yes') : __d('admin','No')) ?></td>
                <td><?= h($vocabulary->tags ?  __d('admin','Yes') : __d('admin','No')) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', ['action' => 'edit', $vocabulary->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Edit')]) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-trash fa-lg"></i>'), ['action' => 'delete', $vocabulary->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vocabulary->id), 'escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Delete')]) ?>
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
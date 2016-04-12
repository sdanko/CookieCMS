<div class="actions">
    <div class="btn-group">
         <?= $this->Html->link(__d('admin','New Term'), ['action' => 'add', $vocabularyId], ['class'=> 'btn btn-success']) ?>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('title', __d('admin','Title')) ?></th>
                <th><?= $this->Paginator->sort('slug', __d('admin','Slug')) ?></th>
                <th class="actions"><?= __d('admin','Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($terms as $term): ?>
            <tr>
                <td><?= $this->Number->format($term->id) ?></td>
                <td><?= h($term->title) ?></td>
                <td><?= h($term->slug) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', ['action' => 'edit', $term->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Edit')]) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-trash fa-lg"></i>'), ['action' => 'delete', $term->id], ['confirm' => __('Are you sure you want to delete # {0}?', $term->id), 'escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Delete')]) ?>
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
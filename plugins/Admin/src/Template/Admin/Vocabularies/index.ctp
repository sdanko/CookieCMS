<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Vocabulary'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taxonomies'), ['controller' => 'Taxonomies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxonomy'), ['controller' => 'Taxonomies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Content Types'), ['controller' => 'ContentTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Content Type'), ['controller' => 'ContentTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vocabularies index large-9 medium-8 columns content">
    <h3><?= __('Vocabularies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('alias') ?></th>
                <th><?= $this->Paginator->sort('required') ?></th>
                <th><?= $this->Paginator->sort('multiple') ?></th>
                <th><?= $this->Paginator->sort('tags') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vocabularies as $vocabulary): ?>
            <tr>
                <td><?= $this->Number->format($vocabulary->id) ?></td>
                <td><?= h($vocabulary->title) ?></td>
                <td><?= h($vocabulary->alias) ?></td>
                <td><?= h($vocabulary->required) ?></td>
                <td><?= h($vocabulary->multiple) ?></td>
                <td><?= h($vocabulary->tags) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $vocabulary->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vocabulary->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vocabulary->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vocabulary->id)]) ?>
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

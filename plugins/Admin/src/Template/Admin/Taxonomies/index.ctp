<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Taxonomy'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Terms'), ['controller' => 'Terms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Terms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vocabularies'), ['controller' => 'Vocabularies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vocabulary'), ['controller' => 'Vocabularies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="taxonomies index large-9 medium-8 columns content">
    <h3><?= __('Taxonomies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('parent_id') ?></th>
                <th><?= $this->Paginator->sort('term_id') ?></th>
                <th><?= $this->Paginator->sort('vocabulary_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($taxonomies as $taxonomy): ?>
            <tr>
                <td><?= $this->Number->format($taxonomy->id) ?></td>
                <td><?= $taxonomy->has('parent_taxonomy') ? $this->Html->link($taxonomy->parent_taxonomy->id, ['controller' => 'Taxonomies', 'action' => 'view', $taxonomy->parent_taxonomy->id]) : '' ?></td>
                <td><?= $taxonomy->has('term') ? $this->Html->link($taxonomy->term->title, ['controller' => 'Terms', 'action' => 'view', $taxonomy->term->id]) : '' ?></td>
                <td><?= $taxonomy->has('vocabulary') ? $this->Html->link($taxonomy->vocabulary->title, ['controller' => 'Vocabularies', 'action' => 'view', $taxonomy->vocabulary->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $taxonomy->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $taxonomy->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $taxonomy->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxonomy->id)]) ?>
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

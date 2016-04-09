<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Term'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taxonomies'), ['controller' => 'Taxonomies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxonomy'), ['controller' => 'Taxonomies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="terms index large-9 medium-8 columns content">
    <h3><?= __('Terms') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('slug') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($terms as $term): ?>
            <tr>
                <td><?= $this->Number->format($term->id) ?></td>
                <td><?= h($term->title) ?></td>
                <td><?= h($term->slug) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $term->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $term->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $term->id], ['confirm' => __('Are you sure you want to delete # {0}?', $term->id)]) ?>
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

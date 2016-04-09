<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Term'), ['action' => 'edit', $term->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Term'), ['action' => 'delete', $term->id], ['confirm' => __('Are you sure you want to delete # {0}?', $term->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Terms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Taxonomies'), ['controller' => 'Taxonomies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxonomy'), ['controller' => 'Taxonomies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="terms view large-9 medium-8 columns content">
    <h3><?= h($term->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($term->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Slug') ?></th>
            <td><?= h($term->slug) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($term->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($term->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Taxonomies') ?></h4>
        <?php if (!empty($term->taxonomies)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Parent Id') ?></th>
                <th><?= __('Term Id') ?></th>
                <th><?= __('Vocabulary Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($term->taxonomies as $taxonomies): ?>
            <tr>
                <td><?= h($taxonomies->id) ?></td>
                <td><?= h($taxonomies->parent_id) ?></td>
                <td><?= h($taxonomies->term_id) ?></td>
                <td><?= h($taxonomies->vocabulary_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Taxonomies', 'action' => 'view', $taxonomies->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Taxonomies', 'action' => 'edit', $taxonomies->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Taxonomies', 'action' => 'delete', $taxonomies->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxonomies->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

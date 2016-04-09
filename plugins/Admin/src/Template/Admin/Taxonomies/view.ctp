<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Taxonomy'), ['action' => 'edit', $taxonomy->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Taxonomy'), ['action' => 'delete', $taxonomy->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxonomy->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Taxonomies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxonomy'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Taxonomies'), ['controller' => 'Taxonomies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Taxonomy'), ['controller' => 'Taxonomies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Terms'), ['controller' => 'Terms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Terms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vocabularies'), ['controller' => 'Vocabularies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vocabulary'), ['controller' => 'Vocabularies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="taxonomies view large-9 medium-8 columns content">
    <h3><?= h($taxonomy->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Parent Taxonomy') ?></th>
            <td><?= $taxonomy->has('parent_taxonomy') ? $this->Html->link($taxonomy->parent_taxonomy->id, ['controller' => 'Taxonomies', 'action' => 'view', $taxonomy->parent_taxonomy->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Term') ?></th>
            <td><?= $taxonomy->has('term') ? $this->Html->link($taxonomy->term->title, ['controller' => 'Terms', 'action' => 'view', $taxonomy->term->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Vocabulary') ?></th>
            <td><?= $taxonomy->has('vocabulary') ? $this->Html->link($taxonomy->vocabulary->title, ['controller' => 'Vocabularies', 'action' => 'view', $taxonomy->vocabulary->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($taxonomy->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Taxonomies') ?></h4>
        <?php if (!empty($taxonomy->child_taxonomies)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Parent Id') ?></th>
                <th><?= __('Term Id') ?></th>
                <th><?= __('Vocabulary Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($taxonomy->child_taxonomies as $childTaxonomies): ?>
            <tr>
                <td><?= h($childTaxonomies->id) ?></td>
                <td><?= h($childTaxonomies->parent_id) ?></td>
                <td><?= h($childTaxonomies->term_id) ?></td>
                <td><?= h($childTaxonomies->vocabulary_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Taxonomies', 'action' => 'view', $childTaxonomies->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Taxonomies', 'action' => 'edit', $childTaxonomies->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Taxonomies', 'action' => 'delete', $childTaxonomies->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childTaxonomies->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

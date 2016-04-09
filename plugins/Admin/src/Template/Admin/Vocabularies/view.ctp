<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vocabulary'), ['action' => 'edit', $vocabulary->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vocabulary'), ['action' => 'delete', $vocabulary->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vocabulary->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vocabularies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vocabulary'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Taxonomies'), ['controller' => 'Taxonomies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxonomy'), ['controller' => 'Taxonomies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Content Types'), ['controller' => 'ContentTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Content Type'), ['controller' => 'ContentTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vocabularies view large-9 medium-8 columns content">
    <h3><?= h($vocabulary->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($vocabulary->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Alias') ?></th>
            <td><?= h($vocabulary->alias) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($vocabulary->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Required') ?></th>
            <td><?= $vocabulary->required ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Multiple') ?></th>
            <td><?= $vocabulary->multiple ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Tags') ?></th>
            <td><?= $vocabulary->tags ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($vocabulary->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Taxonomies') ?></h4>
        <?php if (!empty($vocabulary->taxonomies)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Parent Id') ?></th>
                <th><?= __('Term Id') ?></th>
                <th><?= __('Vocabulary Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vocabulary->taxonomies as $taxonomies): ?>
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
    <div class="related">
        <h4><?= __('Related Content Types') ?></h4>
        <?php if (!empty($vocabulary->content_types)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Alias') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vocabulary->content_types as $contentTypes): ?>
            <tr>
                <td><?= h($contentTypes->id) ?></td>
                <td><?= h($contentTypes->title) ?></td>
                <td><?= h($contentTypes->description) ?></td>
                <td><?= h($contentTypes->alias) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ContentTypes', 'action' => 'view', $contentTypes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ContentTypes', 'action' => 'edit', $contentTypes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ContentTypes', 'action' => 'delete', $contentTypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentTypes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

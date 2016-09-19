<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Workflow'), ['action' => 'edit', $workflow->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Workflow'), ['action' => 'delete', $workflow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workflow->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Workflows'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workflow'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Content Types'), ['controller' => 'ContentTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Content Type'), ['controller' => 'ContentTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Nodes'), ['controller' => 'Nodes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Node'), ['controller' => 'Nodes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="workflows view large-9 medium-8 columns content">
    <h3><?= h($workflow->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($workflow->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($workflow->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Xml') ?></h4>
        <?= $this->Text->autoParagraph(h($workflow->xml)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Content Types') ?></h4>
        <?php if (!empty($workflow->content_types)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Alias') ?></th>
                <th><?= __('Format Show Author') ?></th>
                <th><?= __('Format Show Date') ?></th>
                <th><?= __('Workflow Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($workflow->content_types as $contentTypes): ?>
            <tr>
                <td><?= h($contentTypes->id) ?></td>
                <td><?= h($contentTypes->title) ?></td>
                <td><?= h($contentTypes->description) ?></td>
                <td><?= h($contentTypes->alias) ?></td>
                <td><?= h($contentTypes->format_show_author) ?></td>
                <td><?= h($contentTypes->format_show_date) ?></td>
                <td><?= h($contentTypes->workflow_id) ?></td>
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
    <div class="related">
        <h4><?= __('Related Nodes') ?></h4>
        <?php if (!empty($workflow->nodes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Content Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Label') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Workflow Id') ?></th>
                <th><?= __('Node Type Id') ?></th>
                <th><?= __('Node Status Id') ?></th>
                <th><?= __('First') ?></th>
                <th><?= __('Last') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($workflow->nodes as $nodes): ?>
            <tr>
                <td><?= h($nodes->id) ?></td>
                <td><?= h($nodes->content_id) ?></td>
                <td><?= h($nodes->title) ?></td>
                <td><?= h($nodes->label) ?></td>
                <td><?= h($nodes->description) ?></td>
                <td><?= h($nodes->workflow_id) ?></td>
                <td><?= h($nodes->node_type_id) ?></td>
                <td><?= h($nodes->node_status_id) ?></td>
                <td><?= h($nodes->first) ?></td>
                <td><?= h($nodes->last) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Nodes', 'action' => 'view', $nodes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Nodes', 'action' => 'edit', $nodes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Nodes', 'action' => 'delete', $nodes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nodes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Node Type'), ['action' => 'edit', $nodeType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Node Type'), ['action' => 'delete', $nodeType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nodeType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Node Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Node Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Nodes'), ['controller' => 'Nodes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Node'), ['controller' => 'Nodes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="nodeTypes view large-9 medium-8 columns content">
    <h3><?= h($nodeType->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($nodeType->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Config') ?></th>
            <td><?= h($nodeType->config) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($nodeType->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Nodes') ?></h4>
        <?php if (!empty($nodeType->nodes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Content Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Label') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Workflow Id') ?></th>
                <th><?= __('Node Type Id') ?></th>
                <th><?= __('First') ?></th>
                <th><?= __('Last') ?></th>
                <th><?= __('Level') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($nodeType->nodes as $nodes): ?>
            <tr>
                <td><?= h($nodes->id) ?></td>
                <td><?= h($nodes->content_id) ?></td>
                <td><?= h($nodes->title) ?></td>
                <td><?= h($nodes->label) ?></td>
                <td><?= h($nodes->description) ?></td>
                <td><?= h($nodes->workflow_id) ?></td>
                <td><?= h($nodes->node_type_id) ?></td>
                <td><?= h($nodes->first) ?></td>
                <td><?= h($nodes->last) ?></td>
                <td><?= h($nodes->level) ?></td>
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

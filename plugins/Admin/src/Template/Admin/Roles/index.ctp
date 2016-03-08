<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Role'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Roles Users'), ['controller' => 'RolesUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Roles User'), ['controller' => 'RolesUsers', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="roles index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('alias') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('created_by') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th><?= $this->Paginator->sort('modified_by') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($roles as $role): ?>
        <tr>
            <td><?= $this->Number->format($role->id) ?></td>
            <td><?= h($role->name) ?></td>
            <td><?= h($role->alias) ?></td>
            <td><?= h($role->created) ?></td>
            <td><?= $this->Number->format($role->created_by) ?></td>
            <td><?= h($role->modified) ?></td>
            <td><?= $this->Number->format($role->modified_by) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $role->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $role->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?>
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

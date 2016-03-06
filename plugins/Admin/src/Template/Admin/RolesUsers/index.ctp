<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Roles User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="rolesUsers index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('role_id') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($rolesUsers as $rolesUser): ?>
        <tr>
            <td>
                <?= $rolesUser->has('role') ? $this->Html->link($rolesUser->role->title, ['controller' => 'Roles', 'action' => 'view', $rolesUser->role->id]) : '' ?>
            </td>
            <td>
                <?= $rolesUser->has('user') ? $this->Html->link($rolesUser->user->id, ['controller' => 'Users', 'action' => 'view', $rolesUser->user->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $rolesUser->role_id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rolesUser->role_id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rolesUser->role_id], ['confirm' => __('Are you sure you want to delete # {0}?', $rolesUser->role_id)]) ?>
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

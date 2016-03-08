<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Roles User'), ['action' => 'edit', $rolesUser->role_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Roles User'), ['action' => 'delete', $rolesUser->role_id], ['confirm' => __('Are you sure you want to delete # {0}?', $rolesUser->role_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Roles Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Roles User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="rolesUsers view large-10 medium-9 columns">
    <h2><?= h($rolesUser->role_id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Role') ?></h6>
            <p><?= $rolesUser->has('role') ? $this->Html->link($rolesUser->role->title, ['controller' => 'Roles', 'action' => 'view', $rolesUser->role->id]) : '' ?></p>
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $rolesUser->has('user') ? $this->Html->link($rolesUser->user->id, ['controller' => 'Users', 'action' => 'view', $rolesUser->user->id]) : '' ?></p>
        </div>
    </div>
</div>

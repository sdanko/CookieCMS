<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles Users'), ['controller' => 'RolesUsers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Roles User'), ['controller' => 'RolesUsers', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="roles view large-10 medium-9 columns">
    <h2><?= h($role->title) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($role->name) ?></p>
            <h6 class="subheader"><?= __('Alias') ?></h6>
            <p><?= h($role->alias) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($role->id) ?></p>
            <h6 class="subheader"><?= __('Created By') ?></h6>
            <p><?= $this->Number->format($role->created_by) ?></p>
            <h6 class="subheader"><?= __('Modified By') ?></h6>
            <p><?= $this->Number->format($role->modified_by) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($role->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($role->modified) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Users') ?></h4>
    <?php if (!empty($role->users)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Active') ?></th>
            <th><?= __('First Name') ?></th>
            <th><?= __('Middle Name') ?></th>
            <th><?= __('Last Name') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('Password') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Created By') ?></th>
            <th><?= __('Modified') ?></th>
            <th><?= __('Modified By') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($role->users as $users): ?>
        <tr>
            <td><?= h($users->id) ?></td>
            <td><?= h($users->active) ?></td>
            <td><?= h($users->first_name) ?></td>
            <td><?= h($users->middle_name) ?></td>
            <td><?= h($users->last_name) ?></td>
            <td><?= h($users->email) ?></td>
            <td><?= h($users->password) ?></td>
            <td><?= h($users->created) ?></td>
            <td><?= h($users->created_by) ?></td>
            <td><?= h($users->modified) ?></td>
            <td><?= h($users->modified_by) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Roles Users') ?></h4>
    <?php if (!empty($role->roles_users)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Role Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($role->roles_users as $rolesUsers): ?>
        <tr>
            <td><?= h($rolesUsers->role_id) ?></td>
            <td><?= h($rolesUsers->user_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'RolesUsers', 'action' => 'view', $rolesUsers->role_id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'RolesUsers', 'action' => 'edit', $rolesUsers->role_id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'RolesUsers', 'action' => 'delete', $rolesUsers->role_id], ['confirm' => __('Are you sure you want to delete # {0}?', $rolesUsers->role_id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>

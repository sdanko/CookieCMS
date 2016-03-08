<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Menu'), ['action' => 'edit', $menu->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Menu'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Links'), ['controller' => 'Links', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Link'), ['controller' => 'Links', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="menus view large-10 medium-9 columns">
    <h2><?= h($menu->title) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Title') ?></h6>
            <p><?= h($menu->title) ?></p>
            <h6 class="subheader"><?= __('Alias') ?></h6>
            <p><?= h($menu->alias) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($menu->id) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Active') ?></h6>
            <p><?= $menu->active ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Links') ?></h4>
    <?php if (!empty($menu->links)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Parent Id') ?></th>
            <th><?= __('Menu Id') ?></th>
            <th><?= __('Link') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($menu->links as $links): ?>
        <tr>
            <td><?= h($links->id) ?></td>
            <td><?= h($links->parent_id) ?></td>
            <td><?= h($links->menu_id) ?></td>
            <td><?= h($links->link) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Links', 'action' => 'view', $links->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Links', 'action' => 'edit', $links->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Links', 'action' => 'delete', $links->id], ['confirm' => __('Are you sure you want to delete # {0}?', $links->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>

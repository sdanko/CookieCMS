<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Link'), ['action' => 'edit', $link->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Link'), ['action' => 'delete', $link->id], ['confirm' => __('Are you sure you want to delete # {0}?', $link->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Links'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Link'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Links'), ['controller' => 'Links', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Link'), ['controller' => 'Links', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="links view large-10 medium-9 columns">
    <h2><?= h($link->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Parent Link') ?></h6>
            <p><?= $link->has('parent_link') ? $this->Html->link($link->parent_link->id, ['controller' => 'Links', 'action' => 'view', $link->parent_link->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Menu') ?></h6>
            <p><?= $link->has('menu') ? $this->Html->link($link->menu->title, ['controller' => 'Menus', 'action' => 'view', $link->menu->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Link') ?></h6>
            <p><?= h($link->link) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($link->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Links') ?></h4>
    <?php if (!empty($link->child_links)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Parent Id') ?></th>
            <th><?= __('Menu Id') ?></th>
            <th><?= __('Link') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($link->child_links as $childLinks): ?>
        <tr>
            <td><?= h($childLinks->id) ?></td>
            <td><?= h($childLinks->parent_id) ?></td>
            <td><?= h($childLinks->menu_id) ?></td>
            <td><?= h($childLinks->link) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Links', 'action' => 'view', $childLinks->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Links', 'action' => 'edit', $childLinks->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Links', 'action' => 'delete', $childLinks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childLinks->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>

<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Region'), ['action' => 'edit', $region->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Region'), ['action' => 'delete', $region->id], ['confirm' => __('Are you sure you want to delete # {0}?', $region->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Regions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Region'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Blocks'), ['controller' => 'Blocks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Block'), ['controller' => 'Blocks', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="regions view large-10 medium-9 columns">
    <h2><?= h($region->title) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Title') ?></h6>
            <p><?= h($region->title) ?></p>
            <h6 class="subheader"><?= __('Alias') ?></h6>
            <p><?= h($region->alias) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($region->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Blocks') ?></h4>
    <?php if (!empty($region->blocks)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Title') ?></th>
            <th><?= __('Alias') ?></th>
            <th><?= __('Body') ?></th>
            <th><?= __('Show Title') ?></th>
            <th><?= __('Class') ?></th>
            <th><?= __('Region Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($region->blocks as $blocks): ?>
        <tr>
            <td><?= h($blocks->id) ?></td>
            <td><?= h($blocks->title) ?></td>
            <td><?= h($blocks->alias) ?></td>
            <td><?= h($blocks->body) ?></td>
            <td><?= h($blocks->show_title) ?></td>
            <td><?= h($blocks->class) ?></td>
            <td><?= h($blocks->region_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Blocks', 'action' => 'view', $blocks->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Blocks', 'action' => 'edit', $blocks->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Blocks', 'action' => 'delete', $blocks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blocks->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>

<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Block'), ['action' => 'edit', $block->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Block'), ['action' => 'delete', $block->id], ['confirm' => __('Are you sure you want to delete # {0}?', $block->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Blocks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Block'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="blocks view large-10 medium-9 columns">
    <h2><?= h($block->title) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Title') ?></h6>
            <p><?= h($block->title) ?></p>
            <h6 class="subheader"><?= __('Alias') ?></h6>
            <p><?= h($block->alias) ?></p>
            <h6 class="subheader"><?= __('Class') ?></h6>
            <p><?= h($block->class) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($block->id) ?></p>
            <h6 class="subheader"><?= __('Region Id') ?></h6>
            <p><?= $this->Number->format($block->region_id) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Show Title') ?></h6>
            <p><?= $block->show_title ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Body') ?></h6>
            <?= $this->Text->autoParagraph(h($block->body)) ?>
        </div>
    </div>
</div>

<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Setting'), ['action' => 'edit', $setting->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Setting'), ['action' => 'delete', $setting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $setting->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Settings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Setting'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="settings view large-10 medium-9 columns">
    <h2><?= h($setting->title) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Key') ?></h6>
            <p><?= h($setting->key) ?></p>
            <h6 class="subheader"><?= __('Title') ?></h6>
            <p><?= h($setting->title) ?></p>
            <h6 class="subheader"><?= __('Description') ?></h6>
            <p><?= h($setting->description) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($setting->id) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Value') ?></h6>
            <?= $this->Text->autoParagraph(h($setting->value)) ?>
        </div>
    </div>
</div>

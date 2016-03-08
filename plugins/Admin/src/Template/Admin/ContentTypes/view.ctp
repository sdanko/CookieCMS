<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Content Type'), ['action' => 'edit', $contentType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Content Type'), ['action' => 'delete', $contentType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Content Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Content Type'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="contentTypes view large-10 medium-9 columns">
    <h2><?= h($contentType->title) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Title') ?></h6>
            <p><?= h($contentType->title) ?></p>
            <h6 class="subheader"><?= __('Description') ?></h6>
            <p><?= h($contentType->description) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($contentType->id) ?></p>
        </div>
    </div>
</div>

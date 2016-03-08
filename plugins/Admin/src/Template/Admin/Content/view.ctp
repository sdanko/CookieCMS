<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Content'), ['action' => 'edit', $content->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Content'), ['action' => 'delete', $content->id], ['confirm' => __('Are you sure you want to delete # {0}?', $content->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Content'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Content'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="content view large-10 medium-9 columns">
    <h2><?= h($content->title) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Title') ?></h6>
            <p><?= h($content->title) ?></p>
            <h6 class="subheader"><?= __('Slug') ?></h6>
            <p><?= h($content->slug) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($content->id) ?></p>
            <h6 class="subheader"><?= __('Content Type Id') ?></h6>
            <p><?= $this->Number->format($content->content_type_id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Create Date') ?></h6>
            <p><?= h($content->create_date) ?></p>
            <h6 class="subheader"><?= __('Modified Date') ?></h6>
            <p><?= h($content->modified_date) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Active') ?></h6>
            <p><?= $content->active ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Body') ?></h6>
            <?= $this->Text->autoParagraph(h($content->body)) ?>
        </div>
    </div>
</div>

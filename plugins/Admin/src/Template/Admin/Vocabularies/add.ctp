<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Vocabularies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Taxonomies'), ['controller' => 'Taxonomies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxonomy'), ['controller' => 'Taxonomies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Content Types'), ['controller' => 'ContentTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Content Type'), ['controller' => 'ContentTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vocabularies form large-9 medium-8 columns content">
    <?= $this->Form->create($vocabulary) ?>
    <fieldset>
        <legend><?= __('Add Vocabulary') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('alias');
            echo $this->Form->input('description');
            echo $this->Form->input('required');
            echo $this->Form->input('multiple');
            echo $this->Form->input('tags');
            echo $this->Form->input('content_types._ids', ['options' => $contentTypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

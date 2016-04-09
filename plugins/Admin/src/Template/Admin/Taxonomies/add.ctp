<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Taxonomies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parent Taxonomies'), ['controller' => 'Taxonomies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Taxonomy'), ['controller' => 'Taxonomies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Terms'), ['controller' => 'Terms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Terms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vocabularies'), ['controller' => 'Vocabularies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vocabulary'), ['controller' => 'Vocabularies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="taxonomies form large-9 medium-8 columns content">
    <?= $this->Form->create($taxonomy) ?>
    <fieldset>
        <legend><?= __('Add Taxonomy') ?></legend>
        <?php
            echo $this->Form->input('parent_id', ['options' => $parentTaxonomies, 'empty' => true]);
            echo $this->Form->input('term_id', ['options' => $terms, 'empty' => true]);
            echo $this->Form->input('vocabulary_id', ['options' => $vocabularies, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

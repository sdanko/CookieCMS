    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($contentType) ?>
    <fieldset>
        <legend><?=  __d('admin','Add Content Type') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('description', ['type' => 'textarea']);
            echo $this->Form->input('alias');
            echo $this->Form->input('vocabularies._ids', ['options' => $vocabularies]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

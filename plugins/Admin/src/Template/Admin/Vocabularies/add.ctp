
    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($vocabulary) ?>
    <fieldset>
        <legend><?= __d('admin','Add Vocabulary') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('alias');
            echo $this->Form->input('description');
            echo $this->Form->input('required');
            echo $this->Form->input('multiple');
            echo $this->Form->input('tags');
            //echo $this->Form->input('content_types._ids', ['options' => $contentTypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


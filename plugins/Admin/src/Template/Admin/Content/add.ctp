   <?php
        echo $this->Html->script('tinymce/tinymce.min', ['block' => true]);
         echo $this->Html->script('tinymce.init', ['block' => true]);
    ?>
<?php $this->Form->templates($form_templates['default']); ?>
<?= $this->Form->create($content) ?>
<fieldset>
    <legend><?= __d('admin','Add Content') ?></legend>
    <?php
    echo $this->Form->input('title');
    echo $this->Form->input('content_type_id');
    echo $this->Form->input('active');
    echo $this->Form->input('slug');
    echo $this->Form->input('body');
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>



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
    echo $this->Form->input('create_date',  array(
        'class'=>'form-control datefield',
        'type'=>'text'
     ));
    echo $this->Form->input('modified_date',  array(
        'class'=>'form-control datefield',
        'type'=>'text'
     ));
    echo $this->Form->input('slug');
    echo $this->Form->input('body');
    echo $this->Form->input('promote');
    echo $this->Form->input('publish_start',  array(
        'class'=>'form-control datefield',
        'type'=>'text'
     ));
    echo $this->Form->input('publish_end',  array(
        'class'=>'form-control datefield',
        'type'=>'text'
     ));
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>



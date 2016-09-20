    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($contentType) ?>
    <fieldset>
        <legend><?= __d('admin','Edit Content Type') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('description');
            echo $this->Form->input('alias');
            echo $this->Form->input('workflow_id', ['options' => $workflows, 'empty' => true]);
            echo $this->Form->input('vocabularies._ids', ['class'=>'form-control','options' => $vocabularies]);
            echo $this->Form->input('format_show_author', ['label'=>__d('admin','Show author')]);
            echo $this->Form->input('format_show_date', ['label'=>__d('admin','Show date')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


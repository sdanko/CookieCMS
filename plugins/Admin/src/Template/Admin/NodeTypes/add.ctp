
    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($nodeType) ?>
    <fieldset>
        <legend><?=  __d('admin','Add Node Type') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('config');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


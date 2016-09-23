
    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($node) ?>
    <fieldset>
        <legend><?= __d('admin','Edit Node') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('label');
            echo $this->Form->input('description');
            echo $this->Form->input('level');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


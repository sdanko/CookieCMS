
    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($region) ?>
    <fieldset>
        <legend><?= __d('admin','Edit Region') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('alias');
            echo $this->Form->input('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


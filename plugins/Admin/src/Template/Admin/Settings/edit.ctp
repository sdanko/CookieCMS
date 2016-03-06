
    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($setting) ?>
    <fieldset>
        <legend><?= __d('admin','Edit Setting')?></legend>
        <?php
            echo $this->Form->input('key');
            echo $this->Form->input('value');
            echo $this->Form->input('title');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


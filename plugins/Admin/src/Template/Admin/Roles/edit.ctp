
    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($role) ?>
    <fieldset>
        <legend><?= __d('admin', 'Edit Role') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('alias');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('active');
            echo $this->Form->input('first_name');
            echo $this->Form->input('middle_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('created_by');
            echo $this->Form->input('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


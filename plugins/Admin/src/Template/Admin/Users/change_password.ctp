 <?php $this->Form->templates($form_templates['default']); ?>
<?= $this->Form->create($user) ?>
<fieldset>
    <legend><?= __d('admin', 'Change password') ?></legend>
    <?= $this->Form->input('old_password',['type' => 'password' , 'label'=>__d('admin', 'Old password')])?>
    <?= $this->Form->input('password1',['type'=>'password' ,'label'=>__d('admin', 'Password')]) ?>
    <?= $this->Form->input('password2',['type' => 'password' , 'label'=>__d('admin', 'Repeat password')])?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
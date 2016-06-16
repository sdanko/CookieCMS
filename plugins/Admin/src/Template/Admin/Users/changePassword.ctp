<div class="users form large-9 medium-9 columns">
<?= $this->Form->create() ?>
<fieldset>
    <legend><?= __('Change password') ?></legend>
    <?= $this->Form->input('old_password',['type' => 'password' , 'label'=>'Old password'])?>
    <?= $this->Form->input('password1',['type'=>'password' ,'label'=>'Password']) ?>
    <?= $this->Form->input('password2',['type' => 'password' , 'label'=>'Repeat password'])?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
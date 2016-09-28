    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($workflow,  ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __d('admin', 'Edit Workflow') ?></legend>
         <div class="form-group">
            <label class="control-label"><?= __d('admin', 'Select GraphML file') ?></label>
            <input name="file" type="file" class="file" data-show-upload="false" data-show-preview="false" data-show-caption="true">
        </div>
        <?php
            echo $this->Form->input('title');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


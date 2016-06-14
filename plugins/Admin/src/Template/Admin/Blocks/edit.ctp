
    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($block) ?>
    <fieldset>
        <legend><?= __d('admin','Edit Block') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('alias');
            echo $this->Form->input('body');
            echo $this->Form->input('class');
            echo $this->Form->input('element');
            echo $this->Form->input('region_id', array('type' => 'hidden'));
            echo $this->Form->input('show_title');
            echo $this->Form->input('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

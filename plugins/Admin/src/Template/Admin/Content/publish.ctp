
    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($content) ?>
    <fieldset>
        <legend><?=  __d('admin','Publish content')?></legend>
        <?php
            echo $this->Form->input('publish');
            echo $this->Form->input('publish_start',  array(
                'class'=>'form-control datefield',
                'type'=>'text'
             ));
            echo $this->Form->input('publish_end',  array(
                'class'=>'form-control datefield',
                'type'=>'text'
             ));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
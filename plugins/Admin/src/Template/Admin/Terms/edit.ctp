    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($term) ?>
    <fieldset>
        <legend><?= __d('admin','Edit Term') ?></legend>
        <?php
            echo $this->Form->input('parent_id', array(
                'options' => $parentTree,
                'empty' => true,
                //'label' => __d('croogo', 'Parent')
            ));
            echo $this->Form->input('title');
            echo $this->Form->input('slug');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


    <?php $this->Form->templates($form_templates['default']); ?>

    <?= $this->Form->create($link) ?>
    <fieldset>
        <legend><?= __('Add Link') ?></legend>
        <?php
            echo $this->Form->input('parent_id', ['options' => $parentLinks, 'empty' => true]);
            //echo $this->Form->input('menu_id', ['options' => $menus, 'empty' => true]);
            echo $this->Form->input('menu_id', array('type' => 'hidden', 'value' => $menuId));
            echo $this->Form->input('link');
            echo $this->Form->input('title');
        ?>
        
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


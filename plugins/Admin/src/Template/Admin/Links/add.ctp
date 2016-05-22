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
        <div class="form-group">
      <div class="col-sm-3"><label>First name</label><input class="form-control" placeholder="First" type="text"></div>
      <div class="col-sm-3"><label>Last name</label><input class="form-control" placeholder="Last" type="text"></div>
    </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


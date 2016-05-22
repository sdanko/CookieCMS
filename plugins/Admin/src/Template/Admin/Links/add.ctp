<?php
    echo $this->Html->script('link-filter', ['block' => true]);
    $this->assign('script', "<script>$(document).ready(function(){ link-filter('link-type', 'term') });</script>");
?>    
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
            <div class="row">
                <div class="col-sm-3"><label>Link</label><input class="form-control" type="text"></div>
                <div class="col-sm-3">
                    <label>Type</label>
                    <select name="link_type" id="link-type" class="form-control"></select>
                </div>
                <div class="col-sm-3"><label>Search</label><input class="form-control" name="term" id="term" type="text"></div>
            </div>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


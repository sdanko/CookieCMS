<?php
    use Cake\Routing\Router;
    
    $url = Router::url(array('controller'=>'Links','action'=>'searchLinks'));
    
    echo $this->Html->script('link-filter', ['block' => true]);
    $this->append("script","<script>$(document).ready(function(){ filterLinks('link-type', 'term', '" . $url .  "') });</script>");
?>  

<?php $this->Form->templates($form_templates['default']); ?>

    <?= $this->Form->create($link) ?>
    <fieldset>
        <legend><?= __d('admin', 'Edit Link') ?></legend>
        <?php
            echo $this->Form->input('parent_id', ['options' => $parentLinks, 'empty' => true]);
            echo $this->Form->input('menu_id', array('type' => 'hidden'));
            //echo $this->Form->input('link');
            echo $this->Form->input('title');
        ?>
         <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <label><?= __d('admin','Link') ?></label>
                    <input  name="link" id="link" class="form-control" type="text" value="<?= $link->link; ?>" required>
                </div>
                <div class="col-sm-3">
                    <label><?= __d('admin','Type') ?></label>
                    <select name="link_type" id="link-type" class="form-control"></select>
                </div>
                <div class="col-sm-3"><label><?= __d('admin','Search') ?></label><input class="form-control" name="term" id="term" type="text"></div>
            </div>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


<?php
    use Cake\Routing\Router;
    
    $url = Router::url(array('controller' => 'Users','action' => 'searchUsers'));
    
    echo $this->Html->script('user-filter', ['block' => true]);
    $this->append("script","<script>$(document).ready(function(){ filterUsers('term', '" . $url .  "') });</script>");
?>   

    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($node) ?>
    <fieldset>
        <legend><?= __d('admin','Edit Node') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('label');
            echo $this->Form->input('description');
            echo $this->Form->input('level');
            echo $this->Form->input('term', ['type' => 'text', 'value' => $user, 'label' => 'User']);
        ?>
        <input id="user_id" name="user_id" type="hidden">
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


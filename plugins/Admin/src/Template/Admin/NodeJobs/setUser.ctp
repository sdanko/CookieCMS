<?php
    use Cake\Routing\Router;
    
    $url = Router::url(array('controller'=>'Users','action'=>'searchUsers'));
    
    echo $this->Html->script('user-filter', ['block' => true]);
    $this->append("script","<script>$(document).ready(function(){ filterLinks('link-type', 'term', '" . $url .  "') });</script>");
?>    
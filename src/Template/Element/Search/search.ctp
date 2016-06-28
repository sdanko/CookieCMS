<?php
 use Cake\Routing\Router;
?>
<form  method="post" role="search" action="<?php echo Router::url(array('controller' => 'content','action'=>'search')) ?>">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="<?=  $options['placeholder']; ?>" name="q">
        <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
        </div>
    </div>
</form>
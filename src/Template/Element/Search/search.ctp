<?php
 use Cake\Routing\Router;
?>
<form class="navbar-form navbar-left" method="post" role="search" action="<?php echo Router::url(array('controller' => 'content','action'=>'search')) ?>">
        <div class="form-group">
                <input type="text" name="q" class="form-control" placeholder="<?=  __d('admin','Search Content') ?>">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
</form>
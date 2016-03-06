<?php

require_once(ROOT .DS. "Vendor" . DS . "cookie" . DS . "CookieNav.php");
 
?>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
                <button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
                MENU
                </button>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                </button>
                <a href="<?= $this->Url->build('/admin') ?>" class="pull-left"><?= $this->Html->image('logo.png') ?></a>
                <a class="navbar-brand" href="<?= $this->Url->build('/admin') ?>">CookieCMS</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
                <form class="navbar-form navbar-left" method="GET" role="search">
                        <div class="form-group">
                                <input type="text" name="q" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                          <?php
                    echo $this->Cookie->adminMenus(CookieNav::items('top-right'), array(
                            'type' => 'dropdown',
                            'htmlAttributes' => array(
                                    'id' => 'test-menu',
                                    'class' => 'nav',
                            ),
                    ));
            ?>
                        </ul>
                </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
</nav> 

 
  
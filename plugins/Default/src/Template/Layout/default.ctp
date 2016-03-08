<?php
    use Cake\Core\Configure;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="Danko Simunovic">

        <title><?php echo $title_for_layout; ?> &raquo;<?php echo Configure::read('Site.title'); ?></title>

        <?php
        //echo $this->Html->script('jquery/jquery');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');

        //Bootstrap core CSS 
        echo $this->Html->css(array('bootstrap', 'blog', 'font-awesome', 'featherlight'));
        ?>



    </head>

    <body>
        <?php echo $this->element('header'); ?>

        <div class="container">

            <div class="blog-header">
                <h1 class="blog-title"><?php echo Configure::read('Site.title'); ?></h1>
                <p class="lead blog-description"><?php echo Configure::read('Site.tagline'); ?></p>
            </div>

            <div class="row">
                <div class="col-sm-8 blog-main">
                    <p><?= $this->Flash->render() ?></p> 
                    <?php echo $this->fetch('content'); ?>
                </div><!-- /.blog-main -->
                
                <?php echo $this->element('navigation'); ?>  

            </div><!-- /.row -->

        </div><!-- /.container -->

        <?php echo $this->element('footer'); ?>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <?php
        echo $this->Html->script('jquery/jquery');
        echo $this->Html->script('bootstrap/bootstrap');
        echo $this->Html->script('featherlight');
        echo $this->element('initializers');
        ?>
    </body>

</html>




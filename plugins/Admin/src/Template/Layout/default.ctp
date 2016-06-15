

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="Danko Simunovic">

        <title><?php echo $title_for_layout; ?></title>

        <?php
        //echo $this->Html->script('jquery/jquery');

        echo $this->fetch('meta');

        //Bootstrap core CSS 
        echo $this->Html->css(array('bootstrap', 'cookie', 'font-awesome', 'featherlight', 'flag-icon'));
        echo $this->Html->css('/jquery-ui-1.11.4.custom/jquery-ui');
        echo $this->fetch('css');
        ?>

        <!-- Custom styles for this template 
        <link href="dashboard.css" rel="stylesheet">-->


    </head>

    <body>
        <?php echo $this->element('header'); ?>

        <div class="container-fluid main-container">
            <div class="col-md-2 sidebar">
                <div class="row">
                    <!-- uncomment code for absolute positioning tweek see top comment in css -->
                    <div class="absolute-wrapper"> </div>
                    <!-- Menu -->
                    <?php echo $this->element('navigation'); ?>  
                </div>  		
            </div>
            <div class="col-md-10 content">
                <?php echo $this->element('breadcrumb'); ?>
                <?= $this->Flash->render() ?>
                <?php echo $this->fetch('content'); ?>
            </div>
            <?php echo $this->element('footer'); ?>  	
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <?php
        echo $this->Html->script('jquery/jquery');
        echo $this->Html->script('bootstrap/bootstrap');
        echo $this->Html->script('featherlight');
        echo $this->Html->script('/jquery-ui-1.11.4.custom/jquery-ui');
        echo $this->fetch('script');
        echo $this->element('initializers');
        ?>
    </body>

</html>




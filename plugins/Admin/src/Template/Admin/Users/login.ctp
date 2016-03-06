
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title>Admin Login - Cookie</title>
		
	
                <?php

                    //Bootstrap core CSS 
                    echo $this->Html->css(array('bootstrap', 'cookie', 'font-awesome'));
                ?>
	</head>
	<body>
            
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
                </div><!-- /.container-fluid -->
            </nav> 

           <div id="push"></div>
           <div class="container">
               <div class="row">
                   <div class="col-sm-6 col-md-4 col-md-offset-4">
                       <h2><?= $this->Flash->render() ?></h2>
                       <div class="account-wall">
                           <?= $this->Html->image('icons/key.png', ['class' => 'profile-img']) ?>
                           <?php $this->Form->templates($form_templates['login']); ?>
                           <?= $this->Form->create(null, array( 'class' => 'form-signin')) ?>
                            <fieldset>
                                <?= $this->Form->input('email', [
                                    'label' => false, 'placeholder'=>__d('admin','Email')
                                ]) ?>
                                <?= $this->Form->input('password' , [
                                    'label' => false, 'placeholder'=>__d('admin','Password'), 'class' => 'form-control', 'type' => 'password'
                                ]) ?>
                            </fieldset>
                           <?= $this->Form->button(__d('admin','Login')); ?>
                           <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                           <?= $this->Form->end() ?>
<!--                           <form class="form-signin">
                           <input type="text" class="form-control" placeholder="Email" required autofocus>
                           <input type="password" class="form-control" placeholder="Password" required>
                           <button class="btn btn-lg btn-primary btn-block" type="submit">
                               Sign in</button>

                           <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                           </form>-->
                       </div>
                       <a href="#" class="text-center new-account">Create an account </a>
                   </div>
               </div>
           </div>

            
            <?php
                echo $this->Html->script('jquery/jquery');
                echo $this->Html->script('bootstrap/bootstrap');
            ?>
        </body>
</html>
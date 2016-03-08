
<div class="side-menu">
    <nav class="navbar navbar-default" role="navigation">
            <!-- Main Menu -->
            <div class="side-menu-container">
                
                <?php
                        echo $this->Cookie->adminMenus(CookieNav::items(), array(
                                'htmlAttributes' => array(
                                        'id' => 'test-sidebar'
                                )
                        ));
                ?>
                
            </div><!-- /.navbar-collapse -->
    </nav>

</div>




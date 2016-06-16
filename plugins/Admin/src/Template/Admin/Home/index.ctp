 
        <div class="panel panel-default">
                <div class="panel-heading">
                    <?=   __d('admin','Content') . ' & ' . __d('admin','Layout') ?>
                </div>
                <div class="panel-body">
                    <div class="row text-center">
                        <div class="col-xs-6 col-sm-3">
                           <?=  $this->Html->image('icons/content.png', ['url' => ['controller' => 'Content', 'action' => 'types']]) ?>
                          <h4><?= __d('admin','Content') ?></h4>
            <!--              <span class="text-muted">Something else</span>-->
                        </div>
                        <div class="col-xs-6 col-sm-3">
                          <?=  $this->Html->image('icons/folders.png', ['url' => ['controller' => 'ContentTypes', 'action' => 'index']]) ?>
                          <h4><?= __d('admin','Content Types') ?></h4>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                          <?=  $this->Html->image('icons/compass.png', ['url' => ['controller' => 'Menus', 'action' => 'index']]) ?>
                          <h4><?= __d('admin','Menus') ?></h4>
                        </div>
                    </div>
                </div>
        </div>
          
         <div class="panel panel-default">
                <div class="panel-heading">
                    <?= __d('admin','Settings') . ' & ' . __d('admin','Users') ?>
                </div>
                <div class="panel-body">
                    <div class="row text-center">
                        <div class="col-xs-6 col-sm-3">
                          <?=  $this->Html->image('icons/settings.png', ['url' => ['controller' => 'Settings', 'action' => 'index']]) ?>
                          <h4><?= __d('admin','Settings') ?></h4>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                          <?=  $this->Html->image('icons/users.png', ['url' => ['controller' => 'Users', 'action' => 'index']]) ?>
                          <h4><?= __d('admin','Users') ?></h4>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                          <?=  $this->Html->image('icons/key.png', ['url' => ['controller' => 'Roles', 'action' => 'index']]) ?>
                          <h4><?= __d('admin','User roles') ?></h4>
                        </div>
                    </div>
                </div>
        </div>
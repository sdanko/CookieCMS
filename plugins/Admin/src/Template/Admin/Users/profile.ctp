   

    <h4><?= __d('admin', 'Profile') ?></h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            <?= __d('admin', 'Name') ?>
        </dt>

        <dd>
            <?= $fullname; ?>
        </dd>
            
    </dl>
       
     <div class="form-actions no-color">
             <?= $this->Html->link(__d('admin','Change password'), ['controller' => 'users', 'action' => 'changePassword'], ['class'=> 'btn btn-danger']) ?>
    </div>

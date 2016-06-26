   

    <h4><?= __d('admin', 'Profile') ?></h4>
    <div class="actions">
        <div class="btn-group">
            <?= $this->Html->link(__d('admin','Change password'), ['controller' => 'users', 'action' => 'changePassword'], ['class'=> 'btn btn-danger']) ?>
        </div>
    </div>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            <?= __d('admin', 'Name') ?>
        </dt>

        <dd>
            <?= $user['first_name'] . " " . $user['last_name']; ?>
        </dd>
        
        <dt>
            <?= __d('admin', 'Email') ?>
        </dt>

        <dd>
            <?= $user['email']; ?>
        </dd>
            
    </dl>
       

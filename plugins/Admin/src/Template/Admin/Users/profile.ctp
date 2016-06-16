   
   <div>
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

       <?= $this->Html->link(__d('admin','Change Password'), ['controller' => 'users', 'action' => 'changePassword'], ['class'=> 'btn btn-danger']) ?>
</div>
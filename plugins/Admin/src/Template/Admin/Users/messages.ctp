<h2><?= __d('admin', 'Workflow items'); ?></h2>

<div class="table-responsive">
    <table class="table table-hover">
    <thead>
        <tr>
            <th><?= __d('admin', 'Title') ?></th>
            <th class="actions"><?= __d('admin', 'Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($jobs as $id=>$job): ?>
        <tr>
            <td><?= h($job['title']) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['controller' => 'Workflows' ,'action' => 'workflowJob', $id]) ?>              
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>

</div>

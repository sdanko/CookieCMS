<h2><?= __d('admin', 'Workflow items'); ?></h2>

<div class="table-responsive">
    <table class="table table-hover table-bordered ">
    <thead>
        <tr>
            <th><?= __d('admin', 'Title') ?></th>
            <th><?= __d('admin', 'Content') ?></th>
            <th class="actions"><?= __d('admin', 'Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($jobs as $id=>$job): ?>
        <tr>
            <td><?= h($job['title']) ?></td>
            <td><?= h($job['content_title']) ?></td>
            <td class="actions">
              <?= $this->Html->link(__d('admin', 'View'), ['controller' => 'Workflows' ,'action' => 'workflowJob', $id]) ?>              
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>

</div>

    <?php
    if (count($nodes) == 0) {
    ?>
        <div class="actions">
            <div class="btn-group">
                <p> <?= __d('admin','Wokflow has not been started') ?></p>
                <?= $this->Html->link(__d('admin','Start Workflow'), ['action' => 'startWorkflow', $content->id], ['class'=> 'btn btn-success']) ?>
            </div>
        </div>
    <?php
    }else {
    ?>

        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('title', __d('admin', 'Title')) ?></th>
                        <th><?= $this->Paginator->sort('label', __d('admin', 'Label')) ?></th>
                        <th><?= $this->Paginator->sort('node_type.title', __d('admin', 'Type')) ?></th>
                        <th class="actions"><?= __d('admin','Actions')  ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($nodes as $node): ?>
                    <tr class="node-<?= $node->status; ?>">
                        <td><?= h($node->title) ?></td>
                        <td><?= h($node->label) ?></td>
                        <td><?= h($node->node_type->title) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', ['controller' => 'Nodes', 'action' => 'edit', $node->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Edit')]) ?>
                            <?= $node->status==='active' ? 
                                    $this->Html->link('<i class="fa fa-user fa-lg"></i>', ['controller' => 'NodeJobs', 'action' => 'setUser', $node->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Assign User')]) : '' 
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 text-center">
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ' . __d('admin','previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__d('admin','next') . ' >') ?>
                </ul>
                <p><?= $this->Paginator->counter() ?></p>
            </div>
        </div>
    <?php
    }
    ?>
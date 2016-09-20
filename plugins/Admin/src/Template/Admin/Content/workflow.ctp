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
                        <th class="actions"><?= __d('admin','Actions')  ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($nodes as $node): ?>
                    <tr>
                        <td><?= h($node->title) ?></td>
                        <td><?= h($node->label) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', ['action' => 'edit', $node->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Edit')]) ?>
                            <?= $this->Form->postLink(__('<i class="fa fa-trash fa-lg"></i>'), ['action' => 'delete', $node->id], ['confirm' => __('Are you sure you want to delete # {0}?', $node->id), 'escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Delete')]) ?>
                            <?= $this->Html->link('<i class="fa fa-map fa-lg"></i>', ['action' => 'diagram', $node->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Show Diagram')]) ?>
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
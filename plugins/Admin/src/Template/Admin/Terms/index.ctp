<div class="actions">
    <div class="btn-group">
         <?= $this->Html->link(__d('admin','New Term'), ['action' => 'add', $vocabularyId], ['class'=> 'btn btn-success']) ?>
    </div>
</div>
<h3><?=  $title_for_layout ?></h3>
<div class="table-responsive">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th><?=  __d('admin','Title') ?></th>
                <th><?=  __d('admin','Slug') ?></th>
                <th class="actions"><?= __d('admin','Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($terms as $term): 
                $titleCol = $term->title;
                if (!empty($term->indent)):
			$titleCol = str_repeat('&emsp;', $term->indent) . $term->title;
		endif; 
            ?>
            <tr>
                <td><?= $titleCol ?></td>
                <td><?= h($term->slug) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', ['action' => 'edit', $term->id, $vocabularyId], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Edit')]) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-trash fa-lg"></i>'), ['action' => 'delete', $term->id, $vocabularyId], ['confirm' => __('Are you sure you want to delete # {0}?', $term->id), 'escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Delete')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
    use Cake\Routing\Router;
    
    echo $this->Html->css('search-panel', ['block' => true]);
    echo $this->Html->script('collapsible-panel', ['block' => true]);
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?=  __d('admin','Search') ?></h3>
        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
    </div>
    <div class="panel-body">       
        <?php  echo $this->Form->create(null, ['class' => 'form-horizontal']); ?>
        <div class="form-group">
            <div class="col-xs-10 col-sm-8 col-md-3">
                   <?php echo $this->Form->input('q', ['class' => 'form-control', 'placeholder' =>  __d('admin', 'Search Content'), 'label' => false]); ?>
            </div>
        </div>
         
        <div class="form-group">               

            <div class="button-group col-xs-10 col-xs-offset-0 col-sm-8 col-sm-offset-2 col-md-3 col-md-offset-0">
                 <input type="submit" class="btn btn-primary" value="<?=  __d('admin','Search') ?>" />
                  <input type="button" class="btn btn-default" value="<?=  __d('admin','Reset') ?>" onclick="window.location.href='<?php echo Router::url(array('action'=>'lookup')) ?>'" />
            </div>
        </div>
        <?php  echo $this->Form->end(); ?>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-stripped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('title',  __d('admin', 'Title')) ?></th>
            <th><?= $this->Paginator->sort('created',  __d('admin', 'Create date')) ?></th>
            <th><?= $this->Paginator->sort('modified',  __d('admin', 'Modified date')) ?></th>
            <th><?= $this->Paginator->sort('slug', __d('admin', 'Slug')) ?></th>
            <th><?= $this->Paginator->sort('active',  __d('admin', 'Active')) ?></th>
            <th class="actions"><?= __d('admin','Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($content as $content): ?>
        <tr>
            <td><?= h($content->title) ?></td>
            <td><?= h($content->created) ?></td>
            <td><?= h($content->modified) ?></td>
            <td><?= h($content->slug) ?></td>
            <td><?=  $this->element('checkbox_column', ["checked" => $content->active]); ?></td>
            <td class="actions">
                <!-- <?= $this->Html->link(__('View'), ['action' => 'view', $content->id]) ?>-->
                 <?= $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', ['action' => 'edit', $content->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Edit')]) ?>
                 <?= $this->Html->link('<i class="fa fa-thumbs-up  fa-lg"></i>', ['action' => 'publish', $content->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Publish')]) ?>
                <?= $content->promote ?
                        $this->Form->postLink(__('<i class="fa fa-lock fa-lg"></i>'), ['action' => 'unpromote', $content->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Unpromote')])
                        :
                        $this->Form->postLink(__('<i class="fa fa-unlock fa-lg"></i>'), ['action' => 'promote', $content->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Promote')])
   
                ?>
                <?= $this->Html->link('<i class="fa fa-sitemap fa-lg"></i>', ['action' => 'nodes', $content->id], ['escape'=>false, 'data-toggle'=>'tooltip', 'title'=>__d('admin','Workflow')]) ?>
               
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
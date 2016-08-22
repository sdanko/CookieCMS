 <?php
    use Cake\Utility\Hash;
    use Cake\Routing\Router;
    if (count($taxonomy) > 0):
        $taxonomyIds = Hash::extract($content, 'taxonomies.{n}.id');
    endif;
    
    $urlGet = Router::url(array('controller'=>'Content','action'=>'getComments'));
    $urlSubmit = Router::url(array('controller'=>'Content','action'=>'submitComment'));
    
    echo $this->Html->script('tinymce/tinymce.min', ['block' => true]);
    echo $this->Html->script('tinymce.init', ['block' => true]);
    echo $this->Html->script('knockout-3.3.0', ['block' => true]);
    $this->append("script","<script>var urlGet='" . $urlGet .  "';</script>");
    $this->append("script","<script>var urlSubmit='" . $urlSubmit .  "';</script>");
    echo $this->Html->script('ContentComments', ['block' => true]);
  ?>

    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($content) ?>
    <fieldset>
        <legend><?=  __d('admin','Edit Content')?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('content_type_id');
            echo $this->Form->input('slug');
            echo $this->Form->input('excerpt', array(
                'class'=>'editor',
             ));
            echo $this->Form->input('body', array(
                'class'=>'editor',
             ));
            echo $this->Form->input('publish_start',  array(
                'class'=>'form-control datefield',
                'disabled'=>'disabled',
                'type'=>'text'
             ));
            echo $this->Form->input('publish_end',  array(
                'class'=>'form-control datefield',
                'disabled'=>'disabled',
                'type'=>'text'
             ));

            if (count($taxonomy) > 0):

                foreach ($taxonomy as $vocabularyId => $taxonomyTree):           
                    $hasEmpty = !$vocabularies[$vocabularyId]['multiple'];
                    echo $this->Form->input('TaxonomyData.' . $vocabularyId, array(
                        'label' => $vocabularies[$vocabularyId]['title'],
                        'type' => 'select',
                        'class'=>'form-control',
                        'multiple' => $vocabularies[$vocabularyId]['multiple'],
                        'options' => $taxonomyTree,
                        'empty' => $hasEmpty,
                        'value' => $taxonomyIds,
                    ));
                endforeach;
            endif;
            echo $this->Form->input('active');
            echo $this->Form->input('promote', ['disabled'=>'disabled']);
        ?>
    </fieldset>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

    <?php
            echo $this->element('Content/comments', [
                "content" => $content
            ]);
    ?>


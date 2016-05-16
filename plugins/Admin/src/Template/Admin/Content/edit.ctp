 <?php
    use Cake\Utility\Hash;
    if (count($taxonomy) > 0):
        $taxonomyIds = Hash::extract($content, 'taxonomies.{n}.id');
    endif;
    
    echo $this->Html->script('tinymce/tinymce.min', ['block' => true]);
    echo $this->Html->script('tinymce.init', ['block' => true]);
  ?>

    <?php $this->Form->templates($form_templates['default']); ?>
    <?= $this->Form->create($content) ?>
    <fieldset>
        <legend><?=  __d('admin','Edit Content')?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('content_type_id');
            echo $this->Form->input('active');
            echo $this->Form->input('slug');
            echo $this->Form->input('body');
            echo $this->Form->input('promote', ['disabled'=>'disabled']);
            echo $this->Form->input('publish', ['disabled'=>'disabled']);
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
        ?>
        <?php
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
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


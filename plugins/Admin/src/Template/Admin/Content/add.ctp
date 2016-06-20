<?php
use Cake\Utility\Hash;

echo $this->Html->script('tinymce/tinymce.min', ['block' => true]);
echo $this->Html->script('tinymce.init', ['block' => true]);
?>
<?php $this->Form->templates($form_templates['default']); ?>
<?= $this->Form->create($content) ?>
<fieldset>
    <legend><?= __d('admin', 'Add Content') . ' - ' . __d('admin', $type->title) ?></legend>
    <?php
    echo $this->Form->input('title');
    //echo $this->Form->input('content_type_id');
    echo $this->Form->input('menu_id', array('type' => 'hidden', 'value' => $type->id));
    echo $this->Form->input('slug');
    echo $this->Form->input('excerpt', array(
        'class'=>'editor',
     ));
    echo $this->Form->input('body', array(
        'class'=>'editor',
     ));
    echo $this->Form->input('active');
    ?>
    <?php
    if(isset($taxonomy)):
        if (count($taxonomy) > 0):

            foreach ($taxonomy as $vocabularyId => $taxonomyTree):           
                $hasEmpty = !$vocabularies[$vocabularyId]['multiple'];
                echo $this->Form->input('TaxonomyData.' . $vocabularyId, array(
                    'label' => $vocabularies[$vocabularyId]['title'],
                    'type' => 'select',
                    'class'=>'form-control',
                    'multiple' => $vocabularies[$vocabularyId]['multiple'],
                    'options' => $taxonomyTree,
                    'empty' => $hasEmpty
                ));
            endforeach;
        endif;
    endif;
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>



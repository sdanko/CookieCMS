<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Utility\Hash;
use Cake\Core\Exception\Exception;
/**
 * CakePHP TaxonomiesComponent
 * @author DANKO
 */
class TaxonomiesComponent extends Component {

    public function prepareCommonData($type, $options = array()) {
        $options = Hash::merge(array(
                    'modelClass' => $this->controller->modelClass,
                        ), $options);
        $modelClass = $options['modelClass'];
        debug($this->controller);
        if (isset($this->controller->{$modelClass})) {
            $Model = $this->controller->{$modelClass};
        } else {
            throw new Exception(sprintf(
                    'Model %s not found in controller %s', $Model, $this->controller->name
            ));
        }
        debug($type);die;
        $vocabularies = Hash::combine($type['Vocabulary'], '{n}.id', '{n}');
        $taxonomy = array();
        foreach ($type['Vocabulary'] as $vocabulary) {
            $vocabularyId = $vocabulary['id'];
            $taxonomy[$vocabularyId] = $Model->Taxonomy->getTree(
                    $vocabulary['alias'], array('taxonomyId' => true)
            );
        }
        $this->controller->set(compact(
                        'type', 'taxonomy', 'vocabularies'
        ));
    }

}

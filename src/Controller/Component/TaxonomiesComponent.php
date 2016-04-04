<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Cake\Controller\Component;

/**
 * CakePHP TaxonomiesComponent
 * @author DANKO
 */
class TaxonomiesComponent extends Component {
    public function prepareCommonData($type, $options = array()) {
		$options = Hash::merge(array(
			'modelClass' => $this->controller->modelClass,
		), $options);
		$typeAlias = $type['Type']['alias'];
		$modelClass = $options['modelClass'];

		if (isset($this->controller->{$modelClass})) {
			$Model = $this->controller->{$modelClass};
		} else {
			throw new UnexpectedException(sprintf(
				'Model %s not found in controller %s',
				$model, $this->controller->name
			));
		}
		$Model->type = $typeAlias;
		$vocabularies = Hash::combine($type['Vocabulary'], '{n}.id', '{n}');
		$taxonomy = array();
		foreach ($type['Vocabulary'] as $vocabulary) {
			$vocabularyId = $vocabulary['id'];
			$taxonomy[$vocabularyId] = $Model->Taxonomy->getTree(
				$vocabulary['alias'],
				array('taxonomyId' => true)
			);
		}
		$this->controller->set(compact(
			'type', 'typeAlias', 'taxonomy', 'vocabularies'
		));
	}
}

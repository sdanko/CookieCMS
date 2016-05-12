<?php

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\Event\EventManager;
use Cake\ORM\Table;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP Behavior
 * @author Danko
 */
class TaxonomizableBehavior extends Behavior {

   public function initialize(array $config)
    {
        $this->_setupEvents();
    }
    
    protected function _setupEvents()
    {
        $callback = array($this, 'onBeforeSaveNode');
        EventManager::instance()->on("Model.Node.beforeSaveNode", $callback);
    }
    
 /**
 * Handle Model.Node.beforeSaveNode event
 *
 * @param CakeEvent $event Event containing `data` and `typeAlias`
 */
    public function onBeforeSaveNode($event)
    {
        $data = $event->data['data'];
        $typeAlias = $event->data['typeAlias'];
        $this->formatTaxonomyData($event->subject, $data, $typeAlias);
        $event->data['data'] = $data;
    }
        
    /**
     * Transform TaxonomyData array to a format that can be used for save operation
     *
     * @param array $data Array containing relevant Taxonomy data
     * @param string $typeAlias string Node type alias
     * @return array Formatted data
     * @throws InvalidArgumentException
     */
    public function formatTaxonomyData(Table $table, &$data, $typeAlias) 
    {
        $type = $table->ContentTypes->find('byAlias',['alias' => $typeAlias])->first();
        
        if (empty($type)) {
            throw new InvalidArgumentException(__d('croogo', 'Invalid Content Type'));
        }
        debug($data);die;
        if (empty($data[$model->alias]['type'])) {
            $data[$model->alias]['type'] = $typeAlias;
        }
        $model->type = $type['Type']['alias'];

        if (array_key_exists('TaxonomyData', $data)) {
            $foreignKey = $model->id;
            if (isset($data[$model->alias][$model->primaryKey])) {
                $foreignKey = $data[$model->alias][$model->primaryKey];
            }
            $data['Taxonomy'] = array();
            foreach ($data['TaxonomyData'] as $vocabularyId => $taxonomyIds) {
                if (empty($taxonomyIds)) {
                    continue;
                }
                foreach ((array) $taxonomyIds as $taxonomyId) {
                    $join = array(
                        'model' => $model->alias,
                        'foreign_key' => $foreignKey,
                        'taxonomy_id' => $taxonomyId,
                    );
                    $data['Taxonomy'][] = $join;
                }
            }
            unset($data['TaxonomyData']);
        }

        $this->cacheTerms($model, $data);
    }

}

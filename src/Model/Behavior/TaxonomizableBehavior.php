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

        if (empty($data['content_type_id'])) {
            $data['content_type_id'] = $type->id;
        }

        if (array_key_exists('TaxonomyData', $data)) {

            $data['Taxonomy'] = array();
            foreach ($data['TaxonomyData'] as $vocabularyId => $taxonomyIds) {
                if (empty($taxonomyIds)) {
                    continue;
                }
                foreach ((array) $taxonomyIds as $taxonomyId) {
                    $data['Taxonomy'][] = taxonomyId;
                }
            }
            unset($data['TaxonomyData']);die;
        }

        $this->cacheTerms($table, $data);
    }
    
     /**
     * Caches Term in `terms` field
     *
     * @param Table $table
     * @param array $data
     * @return void
     */
    public function cacheTerms(Table $table, &$data = null) 
    {	
        $taxonomies = $model->Taxonomy->find('all', array(
                'conditions' => array(
                        'Taxonomies.id IN ' => $data['Taxonomy'],
                ),
        ));
        $terms = Hash::combine($taxonomies, '{n}.Terms.id', '{n}.Terms.slug');
        $data['terms'] = $model->encodeData($terms, array(
                'trim' => false,
                'json' => true,
        ));
    }

}

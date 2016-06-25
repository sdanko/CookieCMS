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
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * CakePHP TaxonomiesComponent
 * @author DANKO
 */
class TaxonomiesDataComponent extends Component {

    public $components = ['CookieData'];
    /**
     * Types for layout
     *
     * @var string
     * @access public
     */
    public $typesForLayout = array();

    /**
     * Vocabularies for layout
     *
     * @var string
     * @access public
     */
    public $vocabulariesForLayout = array();
    
    /**
     * initialize
     *
     */
    public function initialize(array $config)
    {
        $this->controller = $this->_registry->getController();
        if (isset($this->controller->Taxonomies)) {
            $this->Taxonomies = $this->controller->Taxonomies;
        } else {
            $this->Taxonomies = TableRegistry::get('Taxonomies');
        }
    }

    public function startup(Event $event)
    {       
        if (isset($this->request->params['prefix'])) {
            if ($this->request->params['prefix'] == 'admin') {
                return;
            }
        }
        $this->types();
        $this->vocabularies();
    }

    public function beforeRender(Event $event)
    {
        $this->controller = $this->_registry->getController();
        $this->controller->set('types_for_layout', $this->typesForLayout);
        $this->controller->set('vocabularies_for_layout', $this->vocabulariesForLayout);
    }
    
    public function types() 
    {
        $types = $this->Taxonomies->Vocabularies->ContentTypes->find('all')->cache('types', 'layoutData')->toArray();
        foreach ($types as $type) {
                $alias = $type['alias'];
                $this->typesForLayout[$alias] = $type;
        }
    }
    
    public function vocabularies()
    {
        $vocabularies = array();
        $themeData = $this->CookieData->getThemeData(Configure::read('Site.theme'));
        if (isset($themeData['vocabularies']) && is_array($themeData['vocabularies'])) {
            $vocabularies = Hash::merge($vocabularies, $themeData['vocabularies']);
        }
        $vocabularies = Hash::merge($vocabularies, array_keys($this->controller->BlocksData->blocksData['vocabularies']));

        $vocabularies = array_unique($vocabularies);
        foreach ($vocabularies as $vocabularyAlias) {
            $vocabulary = $this->Taxonomies->Vocabularies->find('all', [
                  'conditions' => ['Vocabularies.alias' => $vocabularyAlias]
              ])->cache($vocabularyAlias . '_vocabularies', 'layoutData')->first();

            if (isset($vocabulary['id'])) {
                $this->vocabulariesForLayout[$vocabularyAlias] = $vocabulary;
                $findOptions = array(
                        'conditions' => array(
                                'vocabulary_id' => $vocabulary['id']
                        )
                );
                $taxonomies = $this->Taxonomies->find('threaded', $findOptions)->contain(['Terms'])
                        ->cache($vocabularyAlias . '_taxonomies', 'layoutData')->toArray();
                $this->vocabulariesForLayout[$vocabularyAlias]['threaded'] = $taxonomies;
            }
        }
    }

    public function prepareCommonData($type, $options = array())
    {
        $options = Hash::merge(array(
            'modelClass' => $this->controller->modelClass,
        ), $options);
        $modelClass = $options['modelClass'];
        if (isset($this->controller->{$modelClass})) {
            $Model = $this->controller->{$modelClass};
        } else {
            throw new Exception(sprintf(
                    'Model %s not found in controller %s', $Model, $this->controller->name
            ));
        }
        
        if(!$type->vocabularies)
            return;
        
        $vocabularies = Hash::combine($type->vocabularies, '{n}.id', '{n}');
        $taxonomy = array();
        foreach ($type->vocabularies as $vocabulary) {
            $vocabularyId = $vocabulary['id'];
            $taxonomy[$vocabularyId] = $Model->ContentTypes->ContentTypesVocabularies->Vocabularies->Taxonomies->getTreeList(
                    $vocabularyId, array('taxonomyId' => true)
            );
        }
        
        $this->controller->set(compact('taxonomy', 'vocabularies'));
    }

}

<?php
namespace App\Model\Table;

use App\Model\Entity\Taxonomy;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Taxonomies Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentTaxonomies
 * @property \Cake\ORM\Association\BelongsTo $Terms
 * @property \Cake\ORM\Association\BelongsTo $Vocabularies
 * @property \Cake\ORM\Association\HasMany $ChildTaxonomies
 */
class TaxonomiesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('cms.taxonomies');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('ParentTaxonomies', [
            'className' => 'Taxonomies',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Terms', [
            'foreignKey' => 'term_id'
        ]);
        $this->belongsTo('Vocabularies', [
            'foreignKey' => 'vocabulary_id'
        ]);
        $this->hasMany('ChildTaxonomies', [
            'className' => 'Taxonomies',
            'foreignKey' => 'parent_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('lft')
            ->allowEmpty('lft');

        $validator
            ->integer('rght')
            ->allowEmpty('rght');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['parent_id'], 'ParentTaxonomies'));
        $rules->add($rules->existsIn(['term_id'], 'Terms'));
        $rules->add($rules->existsIn(['vocabulary_id'], 'Vocabularies'));
        return $rules;
    }
    
    public function findByVocabulary(Query $query, array $options)
    {
        $vocabularyId = isset($options["vocabularyId"]) ? $options["vocabularyId"] : null;
        
        if (empty($vocabularyId)) {
                trigger_error(__d('admin', '"vocabulary_id" key not found'));
        }
                
        $query->find('treeList',
        [
            'keyPath' => 'term_id',
            'valuePath' => 'id',
            'spacer' => '_'
        ])->where(['vocabulary_id' => $vocabularyId ]);
        
        return $query;
    }
    
    public function getTreeList($vocabularyId, $options = array()) {
        $_options = array(
            'key' => 'slug', // Term.slug
            'value' => 'title', // Term.title
            'taxonomyId' => false,
            'cache' => false,
        );
        $options = array_merge($_options, $options);
        
        $tree = $this->find('byVocabulary', array(
                'vocabularyId' => $vocabularyId
        ))->toArray();

        if(empty($tree))
        {
           return []; 
        }
                 
        $termsIds = array_keys($tree);

        $termsList = $this->Terms->find('list', array(
            'conditions' => array(
                    'Terms.id IN' => $termsIds
            ),
            'fields' => array(
                 'id',
                 'slug'
 
            )
        ))->toArray();

        $termsTree = array();
        foreach ($tree as $termId => $tvId) {
            if (isset($termsList[$termId])) {
                $key = $termId;
                $value = $termsList[$key];
                if (strstr($tvId, '_')) {
                    $tvIdN = str_replace('_', '', $tvId);
                    $tvIdE = explode($tvIdN, $tvId);
                    $value = $tvIdE['0'] . $value;
                }

                if (!$options['taxonomyId']) {
                    $termsTree[$key] = $value;
                } else {
                    $termsTree[str_replace('_', '', $tvId)] = $value;
                }
            }
        }

        return $termsTree;
    }
}

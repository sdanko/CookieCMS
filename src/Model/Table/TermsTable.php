<?php
namespace App\Model\Table;

use App\Model\Entity\Term;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Terms Model
 *
 * @property \Cake\ORM\Association\HasMany $Taxonomies
 */
class TermsTable extends Table
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

        $this->table('cms.terms');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->hasMany('Taxonomies', [
            'foreignKey' => 'term_id'
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
            ->allowEmpty('title');

        $validator
            ->allowEmpty('slug');

        $validator
            ->allowEmpty('description');

        return $validator;
    }
    
    public function add($data, $vocabularyId)
    {
        return $this->_save($data, $vocabularyId);
    }
    
    protected function _save($data, $vocabularyId, $taxonomyId = null)
    {
        $added = false;
        
        $termId = $this->saveAndGetId($data);
        if (!$this->isInVocabulary($termId, $vocabularyId, $taxonomyId)) {
                $dataToPersist = array(
                        'parent_id' => $data['Taxonomy']['parent_id'],
                        'term_id' => $termId,
                        'vocabulary_id' => $vocabularyId,
                );
                if (!is_null($taxonomyId)) {
                        $dataToPersist['id'] = $taxonomyId;
                }
                $added = $this->Vocabulary->Taxonomy->save($dataToPersist);
        }
        return $added;
    }
    
    public function isInVocabulary($id, $vocabularyId, $taxonomyId = null)
    {
        $conditions = array('term_id' => $id, 'vocabulary_id' => $vocabularyId);
        if (!is_null($taxonomyId)) {
                $conditions['Taxonomy.id !='] = $taxonomyId;
        }
        return $this->Vocabulary->Taxonomy->hasAny($conditions);
    }
    
    public function saveAndGetId($data)
    {
        $this->id = false;
        
        if ($this->save($data)) {
                return $this->id;
        }

        return false;
    }
}

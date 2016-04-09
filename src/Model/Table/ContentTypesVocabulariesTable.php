<?php
namespace App\Model\Table;

use App\Model\Entity\ContentTypesVocabulary;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContentTypesVocabularies Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ContentTypes
 * @property \Cake\ORM\Association\BelongsTo $Vocabularies
 */
class ContentTypesVocabulariesTable extends Table
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

        $this->table('cms.content_types_vocabularies');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('ContentTypes', [
            'foreignKey' => 'content_type_id'
        ]);
        $this->belongsTo('Vocabularies', [
            'foreignKey' => 'vocabulary_id'
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
        $rules->add($rules->existsIn(['content_type_id'], 'ContentTypes'));
        $rules->add($rules->existsIn(['vocabulary_id'], 'Vocabularies'));
        return $rules;
    }
}

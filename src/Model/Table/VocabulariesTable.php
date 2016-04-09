<?php
namespace App\Model\Table;

use App\Model\Entity\Vocabulary;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vocabularies Model
 *
 * @property \Cake\ORM\Association\HasMany $Taxonomies
 * @property \Cake\ORM\Association\BelongsToMany $ContentTypes
 */
class VocabulariesTable extends Table
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

        $this->table('cms.vocabularies');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->hasMany('Taxonomies', [
            'foreignKey' => 'vocabulary_id'
        ]);
        $this->belongsToMany('ContentTypes', [
            'foreignKey' => 'vocabulary_id',
            'targetForeignKey' => 'content_type_id',
            'joinTable' => 'content_types_vocabularies'
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
            ->allowEmpty('alias');

        $validator
            ->allowEmpty('description');

        $validator
            ->boolean('required')
            ->allowEmpty('required');

        $validator
            ->boolean('multiple')
            ->allowEmpty('multiple');

        $validator
            ->boolean('tags')
            ->allowEmpty('tags');

        return $validator;
    }
}

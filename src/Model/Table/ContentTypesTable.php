<?php
namespace App\Model\Table;

use App\Model\Entity\ContentType;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContentTypes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Workflows
 * @property \Cake\ORM\Association\HasMany $Content
 * @property \Cake\ORM\Association\BelongsToMany $Vocabularies
 */
class ContentTypesTable extends Table
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

        $this->table('cms.content_types');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Workflows', [
            'foreignKey' => 'workflow_id'
        ]);
        $this->hasMany('Content', [
            'foreignKey' => 'content_type_id'
        ]);
//        $this->belongsToMany('Vocabularies', [
//            'foreignKey' => 'content_type_id',
//            'targetForeignKey' => 'vocabulary_id',
//            'joinTable' => 'content_types_vocabularies'
//        ]);
         $this->belongsToMany('Vocabularies', [
            'foreignKey' => 'content_type_id',
            'targetForeignKey' => 'vocabulary_id',
            'joinTable' => 'content_types_vocabularies',
            'through' => 'ContentTypesVocabularies'
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
            ->notEmpty('title');

        $validator
            ->allowEmpty('description');

        $validator
            ->notEmpty('alias');

        $validator
            ->boolean('format_show_author')
            ->allowEmpty('format_show_author');

        $validator
            ->boolean('format_show_date')
            ->allowEmpty('format_show_date');

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
        $rules->add($rules->existsIn(['workflow_id'], 'Workflows'));
        return $rules;
    }
    
    public function findByAlias(Query $query, array $options)
    {
        $alias = isset($options["alias"]) ? $options["alias"] : null;

        $query->contain(['Vocabularies'])->where([
            'alias' => $alias
        ]);
        
        return $query;
    }
}

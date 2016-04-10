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

        $this->hasMany('Content', [
            'foreignKey' => 'content_type_id'
        ]);
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
            ->allowEmpty('title');

        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('alias');

        return $validator;
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

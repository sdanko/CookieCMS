<?php
namespace App\Model\Table;

use App\Model\Entity\Content;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Content Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ContentTypes
 */
class ContentTable extends Table
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

        $this->table('cms.content');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Ceeram/Blame.Blame');

        $this->belongsTo('ContentTypes', [
            'foreignKey' => 'content_type_id'
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
            ->boolean('active')
            ->allowEmpty('active');

        $validator
            ->allowEmpty('slug');

        $validator
            ->allowEmpty('body');

        $validator
            ->boolean('promote')
            ->allowEmpty('promote');

        $validator
            ->dateTime('publish_start')
            ->allowEmpty('publish_start');

        $validator
            ->dateTime('publish_end')
            ->allowEmpty('publish_end');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

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
        return $rules;
    }
    
    public function findByType(Query $query, array $options)
    {
        $type = isset($options["type"]) ? $options["type"] : null;

        $query->contain(['ContentTypes'])->where([
            'ContentTypes.alias' => $type
        ]);
        
        $query->formatResults(function (\Cake\Datasource\ResultSetInterface $results) {
               return $results->map(function ($row) {
                   $row['url'] = array(
                       'controller' => 'content',
                       'action' => 'view',
                       'slug' => $row['slug'],
                       'type' => $row['content_type']['alias']
                   );
                   return $row;
               });
           });
        
        return $query;
    }
    
    public function findBySlug(Query $query, array $options)
    {
        $type = isset($options["type"]) ? $options["type"] : null;
        $slug = isset($options["slug"]) ? $options["slug"] : null;

        $query->contain(['ContentTypes'])->where([
            'slug' => $slug,
            'ContentTypes.alias' => $type
        ]);
        
        return $query;
    }
}

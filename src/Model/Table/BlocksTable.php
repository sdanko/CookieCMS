<?php
namespace App\Model\Table;

use App\Model\Entity\Block;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Blocks Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Regions
 */
class BlocksTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('cms.blocks');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->belongsTo('Regions', [
            'foreignKey' => 'region_id'
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->allowEmpty('title');
            
        $validator
            ->requirePresence('alias', 'create')
            ->notEmpty('alias');
            
        $validator
            ->allowEmpty('body');
            
        $validator
            ->add('show_title', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('show_title');
            
        $validator
            ->add('active', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('active');
            
        $validator
            ->allowEmpty('element');

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
        $rules->add($rules->existsIn(['region_id'], 'Regions'));
        return $rules;
    }
    
    public function findActive(Query $query, array $options)
    {
        $regionId = isset($options["regionId"]) ? $options["regionId"] : null;
        
        $query->where([
            'active' => true,
            'region_id' => $regionId
        ])->hydrate(false);
        
        return $query;
    }
}

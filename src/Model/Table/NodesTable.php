<?php
namespace App\Model\Table;

use App\Model\Entity\Node;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Nodes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Contents
 * @property \Cake\ORM\Association\BelongsTo $Workflows
 * @property \Cake\ORM\Association\BelongsTo $NodeTypes
 * @property \Cake\ORM\Association\BelongsTo $NodeStatuses
 * @property \Cake\ORM\Association\HasMany $NodeJobs
 */
class NodesTable extends Table
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

        $this->table('cms.nodes');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Content', [
            'foreignKey' => 'content_id'
        ]);
        $this->belongsTo('Workflows', [
            'foreignKey' => 'workflow_id'
        ]);
        $this->belongsTo('NodeTypes', [
            'foreignKey' => 'node_type_id'
        ]);
        $this->hasMany('NodeJobs', [
            'foreignKey' => 'node_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->allowEmpty('label');

        $validator
            ->allowEmpty('description');

        $validator
            ->boolean('first')
            ->allowEmpty('first');

        $validator
            ->boolean('last')
            ->allowEmpty('last');

        $validator
            ->integer('level')
            ->allowEmpty('level');

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
        $rules->add($rules->existsIn(['content_id'], 'Content'));
        $rules->add($rules->existsIn(['workflow_id'], 'Workflows'));
        $rules->add($rules->existsIn(['node_type_id'], 'NodeTypes'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
    
    public function findByContent(Query $query, array $options)
    {
        $content_id = isset($options["content_id"]) ? $options["content_id"] : null;
        
        if($content_id!=null) {
            $query->contain(['NodeTypes'])->where([
                'content_id' => $content_id
            ]);
        }
        
        $query->formatResults(function (\Cake\Datasource\ResultSetInterface $results) {
               return $results->map(function ($row) {
                   $nodeJob = $this->NodeJobs->findByNodeId($row['id'])->first();
                   
                   if(isset($nodeJob)) {
                       if($nodeJob->finished) {
                           $row['status'] = 'finished';
                       } else {
                           $row['status'] = 'active';
                       }                     
                   } else {
                       $row['status'] = 'waiting';
                   }
                   
                   return $row;
               });
           });
        
        return $query;
    }  
}

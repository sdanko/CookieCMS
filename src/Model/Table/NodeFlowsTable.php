<?php
namespace App\Model\Table;

use App\Model\Entity\NodeFlow;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NodeFlows Model
 *
 * @property \Cake\ORM\Association\BelongsTo $NodeEdges
 * @property \Cake\ORM\Association\BelongsTo $NodeJobs
 */
class NodeFlowsTable extends Table
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

        $this->table('cms.node_flows');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('NodeEdges', [
            'foreignKey' => 'node_edge_id'
        ]);
        $this->belongsTo('NodeJobs', [
            'foreignKey' => 'node_job_id'
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
        $rules->add($rules->existsIn(['node_edge_id'], 'NodeEdges'));
        $rules->add($rules->existsIn(['node_job_id'], 'NodeJobs'));
        return $rules;
    }
}

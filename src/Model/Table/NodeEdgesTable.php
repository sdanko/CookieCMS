<?php
namespace App\Model\Table;

use App\Model\Entity\NodeEdge;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NodeEdges Model
 *
 * @property \Cake\ORM\Association\HasMany $NodeFlows
 */
class NodeEdgesTable extends Table
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

        $this->table('cms.node_edges');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('NodeFlows', [
            'foreignKey' => 'node_edge_id'
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
            ->integer('source')
            ->allowEmpty('source');

        $validator
            ->integer('target')
            ->allowEmpty('target');

        $validator
            ->allowEmpty('label');

        return $validator;
    }
}

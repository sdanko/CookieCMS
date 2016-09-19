<?php
namespace App\Model\Table;

use App\Model\Entity\Workflow;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Workflows Model
 *
 * @property \Cake\ORM\Association\HasMany $ContentTypes
 * @property \Cake\ORM\Association\HasMany $Nodes
 */
class WorkflowsTable extends Table
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

        $this->table('cms.workflows');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->hasMany('ContentTypes', [
            'foreignKey' => 'workflow_id'
        ]);
        $this->hasMany('Nodes', [
            'foreignKey' => 'workflow_id'
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
            ->allowEmpty('path');

        $validator
            ->notEmpty('title');

        return $validator;
    }
}

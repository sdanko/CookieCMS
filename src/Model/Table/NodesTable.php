<?php
namespace App\Model\Table;

use App\Model\Entity\Node;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

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

        $this->belongsTo('Contents', [
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
        $rules->add($rules->existsIn(['content_id'], 'Contents'));
        $rules->add($rules->existsIn(['workflow_id'], 'Workflows'));
        $rules->add($rules->existsIn(['node_type_id'], 'NodeTypes'));
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
        
        return $query;
    }
    
    public function startWorkflow($id, $workflow_id, $xmlNodes)
    {
         $nodes = $xmlNodes->graph;
         foreach ($nodes->node as $node) {
             $i=0;
             
             do{
                $children = $node->data[$i]->children(Configure::read('Workflow.GraphMLNamespace'));
                $i++;
             }while(empty($children));
  
            $newNode = $this->newEntity();
            $newNode->content_id = $id;
            $newNode->title = (string)$node->attributes()->id;
            $newNode->label = (string)$children->GenericNode->NodeLabel;
            $newNode->workflow_id = $workflow_id;
       
            $nodeType = $this->NodeTypes->findByConfig((string)$children->GenericNode->attributes()->configuration)->first();
            
            if(!empty($nodeType)) {
                $newNode->node_type_id = $nodeType->id;
                
                if($nodeType->config===Configure::read('Workflow.startNode')) {
                    $newNode->first = true;
                }
                 if($nodeType->config===Configure::read('Workflow.endNode')) {
                    $newNode->last = true;
                }
            }  
            //$this->save($newNode);
         }
         
         foreach ($nodes->edge as $edge) {
              $i=0;
             
             do{
                $children = $edge->data[$i]->children(Configure::read('Workflow.GraphMLNamespace'));
                $i++;
             }while(empty($children));
             
             $newEdge = $this->NodeEdges->newEntity();
             
             $source = $this->findByTitle((string)$edge->attributes()->source);
             if(!empty($source)) {
                 $newEdge->source = $source->id;
            }
            
            $target = $this->findByTitle((string)$edge->attributes()->target);
             if(!empty($target)) {
                 $newEdge->target = $target->id;
            }
            
            if(!empty($children->PolyLineEdge->EdgeLabel)) {
                $newEdge->label = (string)$children->PolyLineEdge->EdgeLabel;
            }
            
            $this->NodeEdges->save($newEdge);
        }
             
    }
}

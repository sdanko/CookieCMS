<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class WorkflowJobForm extends Form
{
    protected function _buildSchema(Schema $schema) {
        return $schema->addField('next_node', ['type' => 'integer'])
            ->addField('node_job_id', ['type' => 'integer']);
    }
       
    protected function _execute(array $data)
    {
        $nodeJobs = TableRegistry::get('NodeJobs');

        $nodeJob = $nodeJobs->get($data['node_job_id'], [
            'contain' => ['Nodes' => ['NodeTypes']]
        ]);
        
        try {
            if($nodeJob->node->node_type->config == Configure::read('Workflow.decisionNode')) {               
                $edge = $nodeJobs->NodeFlows->NodeEdges->find()->where(['source' => $nodeJob->node_id, 'target' => $data['next_node']])->first();
            } else { 
                $edge = $nodeJobs->NodeFlows->NodeEdges->find()->where(['source' => $nodeJob->node_id])->first();              
            }
            
            $nodeJob->finished=true;
            $nodeJobs->save($nodeJob);

            $nodeFlow = $nodeJobs->NodeFlows->newEntity();
            $nodeFlow->node_job_id = $nodeJob->id;
            $nodeFlow->node_edge_id = $edge->id;
            $nodeJobs->NodeFlows->save($nodeFlow);

            $nextNode = $nodeJobs->Nodes->get($edge->target);
            
            if($nextNode->last) {
                $nextNodeJob = $nodeJobs->newEntity();
                $nextNodeJob->node_id = $nextNode->id;
                $nextNodeJob->title = $nextNode->label;
                $nextNodeJob->finished = true;
                $nodeJobs->save($nextNodeJob);
            } else {
                $nextNodeJob = $nodeJobs->newEntity();
                $nextNodeJob->node_id = $nextNode->id;
                $nextNodeJob->title = $nextNode->label;
                $nodeJobs->save($nextNodeJob);
            }
            
            return true;
            
        } catch (Exception $ex) {
            return false;
        }
    }
}




<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Utility\Hash;
use Cake\Cache\Cache;

/**
 * Blocks Component
 */
class WorkflowDataComponent extends Component {

    public $components = ['Auth', 'Tools.AuthUser'];
     
    public $workflowJobs = array();

    public function initialize(array $config)
    {
        $this->controller = $this->_registry->getController();
        if (isset($this->controller->NodeJobs)) {
            $this->NodeJobs = $this->controller->NodeJobs;
        } else {
            $this->NodeJobs = TableRegistry::get('NodeJobs');
        }
    }

    /**
     * Startup
     *
     * @return void
     */
    public function startup(Event $event)
    {
        if ((isset($this->request->params['prefix']) && ( $this->request->params['prefix'] == 'admin'))) {
             $this->workflowJobs();
        }
    }

    public function beforeRender(Event $event)
    {
        $controller = $this->_registry->getController();
        $controller->set('workflow_jobs', $this->workflowJobs);
    }

    /**
     * Blocks
     *
     * Blocks will be available in this variable in views: $blocks_for_layout
     *
     * @return void
     */
    public function workflowJobs()
    {
        $user = $this->Auth->user();
        $jobs = $this->NodeJobs->find()->where(['Nodes.user_id' => $user['id'], 'OR' => [['finished' => false], ['finished IS' => null]]])->contain(['Nodes' => ['NodeTypes', 'Content']])->toList();
       
        foreach ($jobs as $job) {
            $this->workflowJobs[$job->id] = array();
           
            $this->workflowJobs[$job->id]['text'] = $job->text;
            $this->workflowJobs[$job->id]['title'] = $job->title;
            $this->workflowJobs[$job->id]['type'] = $job->node->node_type->title;
            $this->workflowJobs[$job->id]['node_id'] = $job->node->id;
            $this->workflowJobs[$job->id]['content_id'] = $job->node->content_id;
            $this->workflowJobs[$job->id]['content_title'] = $job->node->content->title;
            
            $targets = $this->NodeJobs->NodeFlows->NodeEdges->find()->where(['source' => $job->node->id])->combine('target', 'label')->toArray();
            $this->workflowJobs[$job->id]['targets'] = $targets;
        }
    }

}



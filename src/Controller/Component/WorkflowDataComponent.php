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
        if (isset($this->controller->WorkflowJobs)) {
            $this->WorkflowJobs = $this->controller->WorkflowJobs;
        } else {
            $this->WorkflowJobs = TableRegistry::get('WorkflowJobs');
        }
    }

    /**
     * Startup
     *
     * @return void
     */
    public function startup(Event $event)
    {
        if (isset($this->request->params['prefix'])) {
            if ($this->request->params['prefix'] == 'admin') {
                $this->workflowJobs();
            }
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
        $regions = $this->Block->Regions->find('active')->cache('regions', 'layoutData')->combine('id', 'alias')->toArray();
       
        foreach ($regions as $regionId => $regionAlias) {
            $this->blocksForLayout[$regionAlias] = array();

            $blocks = Cache::read('blocks_' . $regionAlias, 'layoutData');
            if ($blocks === false) {
                $blocks = $this->Block->find('active', array(
                    'regionId' => $regionId
                ))->toArray();
                Cache::write('blocks_' . $regionAlias, $blocks, 'layoutData');
            }
            $this->processBlocksData($blocks);
            $this->blocksForLayout[$regionAlias] = $blocks;
        }
    }

}



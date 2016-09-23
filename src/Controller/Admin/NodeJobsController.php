<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Nodes Controller
 *
 * @property \App\Model\Table\NodesTable $Nodes
 */
class NodeJobsController extends AppController
{   
    public function setUser($id = null)
    {
        $nodeJob = $this->NodesJobs->findByNodeId($id)->first();
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $nodeJob = $this->NodeJobs->patchEntity($nodeJob, $this->request->data);
            if ($this->NodeJobs->save($nodeJob)) {
                $this->Flash->success(__('The user has been assigned.'));
                return $this->redirect(['controller' => 'Content', 'action' => 'workflow', $nodeJob->node_id]);
            } else {
                $this->Flash->error(__('The user could not be assigned. Please, try again.'));
            }
        }
        $this->set(compact('nodeJob'));
        $this->set('_serialize', ['nodeJob']);
    }

}

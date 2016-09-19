<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Network\Exception\InternalErrorException;
use Cake\Routing\Router;

/**
 * Workflows Controller
 *
 * @property \App\Model\Table\WorkflowsTable $Workflows
 */
class WorkflowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $workflows = $this->paginate($this->Workflows);

        $this->set(compact('workflows'));
        $this->set('_serialize', ['workflows']);
    }

    /**
     * View method
     *
     * @param string|null $id Workflow id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $workflow = $this->Workflows->get($id, [
            'contain' => ['ContentTypes', 'Nodes']
        ]);

        $this->set('workflow', $workflow);
        $this->set('_serialize', ['workflow']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $workflow = $this->Workflows->newEntity();
        if ($this->request->is('post')) {
            $workflow = $this->Workflows->patchEntity($workflow, $this->request->data);
            if(!empty($this->request->data['file']['name'])){
                $allowed = ['graphml'];
                if(!in_array(substr(strchr($this->request->data['file']['name'], '.'), 1), $allowed)) {
                    throw new InternalErrorException("Error Processing Request. File type not allowed.", 1);
                }
                $fileName = $this->request->data['file']['name'];
                $uploadPath = 'GraphMLViewer/graphs/';
                $uploadFile = $uploadPath . $fileName;
                
                 if(move_uploaded_file($this->request->data['file']['tmp_name'], $uploadFile)){
                    $workflow->path = $uploadFile;
                }
            }        
            if ($this->Workflows->save($workflow)) {
                $this->Flash->success(__('The workflow has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The workflow could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('workflow'));
        $this->set('_serialize', ['workflow']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Workflow id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $workflow = $this->Workflows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workflow = $this->Workflows->patchEntity($workflow, $this->request->data);
            if(!empty($this->request->data['file']['name'])){
                $allowed = ['graphml'];
                if(!in_array(substr(strchr($this->request->data['file']['name'], '.'), 1), $allowed)) {
                    throw new InternalErrorException("Error Processing Request. File type not allowed.", 1);
                }
                $fileName = $this->request->data['file']['name'];
                $uploadPath = 'uploads/files/';
                $uploadFile = $uploadPath . $fileName;
                
                 if(move_uploaded_file($this->request->data['file']['tmp_name'], $uploadFile)){
                    $workflow->path = $uploadFile;
                }
            }  
            if ($this->Workflows->save($workflow)) {
                $this->Flash->success(__('The workflow has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The workflow could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('workflow'));
        $this->set('_serialize', ['workflow']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Workflow id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $workflow = $this->Workflows->get($id);
        if ($this->Workflows->delete($workflow)) {
            $this->Flash->success(__('The workflow has been deleted.'));
        } else {
            $this->Flash->error(__('The workflow could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function diagram($id = null)
    {
        $workflow = $this->Workflows->get($id);
        $this->set('path', Router::url('/', true) . $workflow->path);
    }
}

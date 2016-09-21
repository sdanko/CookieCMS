<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * NodeTypes Controller
 *
 * @property \App\Model\Table\NodeTypesTable $NodeTypes
 */
class NodeTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $nodeTypes = $this->paginate($this->NodeTypes);

        $this->set(compact('nodeTypes'));
        $this->set('_serialize', ['nodeTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Node Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $nodeType = $this->NodeTypes->get($id, [
            'contain' => ['Nodes']
        ]);

        $this->set('nodeType', $nodeType);
        $this->set('_serialize', ['nodeType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $nodeType = $this->NodeTypes->newEntity();
        if ($this->request->is('post')) {
            $nodeType = $this->NodeTypes->patchEntity($nodeType, $this->request->data);
            if ($this->NodeTypes->save($nodeType)) {
                $this->Flash->success(__('The node type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The node type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('nodeType'));
        $this->set('_serialize', ['nodeType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Node Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $nodeType = $this->NodeTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $nodeType = $this->NodeTypes->patchEntity($nodeType, $this->request->data);
            if ($this->NodeTypes->save($nodeType)) {
                $this->Flash->success(__('The node type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The node type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('nodeType'));
        $this->set('_serialize', ['nodeType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Node Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $nodeType = $this->NodeTypes->get($id);
        if ($this->NodeTypes->delete($nodeType)) {
            $this->Flash->success(__('The node type has been deleted.'));
        } else {
            $this->Flash->error(__('The node type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

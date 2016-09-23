<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Nodes Controller
 *
 * @property \App\Model\Table\NodesTable $Nodes
 */
class NodesController extends AppController
{

    /**
     * Edit method
     *
     * @param string|null $id Node id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $node = $this->Nodes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $node = $this->Nodes->patchEntity($node, $this->request->data);
            if ($this->Nodes->save($node)) {
                $this->Flash->success(__('The node has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The node could not be saved. Please, try again.'));
            }
        }
        $content = $this->Nodes->Content->find('list', ['limit' => 200]);
        $workflows = $this->Nodes->Workflows->find('list', ['limit' => 200]);
        $nodeTypes = $this->Nodes->NodeTypes->find('list', ['limit' => 200]);
        $this->set(compact('node', 'content', 'workflows', 'nodeTypes'));
        $this->set('_serialize', ['node']);
    }

}

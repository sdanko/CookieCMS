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
            'contain' => ['Users']
        ]);
        
        $user = '';
        if(!empty($node->user)) {
            $user = $node->user->first_name . ' ' . $node->user->last_name;
        } 
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $node = $this->Nodes->patchEntity($node, $this->request->data);
            if ($this->Nodes->save($node)) {
                $this->Flash->success(__('The node has been saved.'));
                return $this->redirect([ 'controller' => 'Content' ,'action' => 'workflow', $node->content_id]);
            } else {
                $this->Flash->error(__('The node could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('node', 'user'));
        $this->set('_serialize', ['node']);
    }

}

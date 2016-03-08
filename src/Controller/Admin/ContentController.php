<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Content Controller
 *
 * @property \App\Model\Table\ContentTable $Content
 */
class ContentController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ContentTypes']
        ];
        $this->set('content', $this->paginate($this->Content));
        $this->set('_serialize', ['content']);
    }

    /**
     * View method
     *
     * @param string|null $id Content id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $content = $this->Content->get($id, [
            'contain' => ['ContentTypes']
        ]);
        $this->set('content', $content);
        $this->set('_serialize', ['content']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $content = $this->Content->newEntity();
        if ($this->request->is('post')) {
            $content = $this->Content->patchEntity($content, $this->request->data);
            if ($this->Content->save($content)) {
                $this->Flash->success(__('The content has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The content could not be saved. Please, try again.'));
            }
        }
        $contentTypes = $this->Content->ContentTypes->find('list', ['limit' => 200]);
        $this->set(compact('content', 'contentTypes'));
        $this->set('_serialize', ['content']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Content id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $content = $this->Content->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $content = $this->Content->patchEntity($content, $this->request->data);
            if ($this->Content->save($content)) {
                $this->Flash->success(__('The content has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The content could not be saved. Please, try again.'));
            }
        }
        $contentTypes = $this->Content->ContentTypes->find('list', ['limit' => 200]);
        $this->set(compact('content', 'contentTypes'));
        $this->set('_serialize', ['content']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Content id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $content = $this->Content->get($id);
        if ($this->Content->delete($content)) {
            $this->Flash->success(__('The content has been deleted.'));
        } else {
            $this->Flash->error(__('The content could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

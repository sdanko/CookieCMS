<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\I18n;

/**
 * ContentTypes Controller
 *
 * @property \App\Model\Table\ContentTypesTable $ContentTypes
 */
class ContentTypesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('contentTypes', $this->paginate($this->ContentTypes));
        $this->set('_serialize', ['contentTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Content Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contentType = $this->ContentTypes->get($id, [
            'contain' => []
        ]);
        $this->set('contentType', $contentType);
        $this->set('_serialize', ['contentType']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contentType = $this->ContentTypes->newEntity();
        if ($this->request->is('post')) {
            $contentType = $this->ContentTypes->patchEntity($contentType, $this->request->data);
            if ($this->ContentTypes->save($contentType)) {
                $this->Flash->success(__('The content type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The content type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('contentType'));
        $this->set('_serialize', ['contentType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Content Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contentType = $this->ContentTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contentType = $this->ContentTypes->patchEntity($contentType, $this->request->data);
            if ($this->ContentTypes->save($contentType)) {
                $this->Flash->success(__('The content type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The content type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('contentType'));
        $this->set('_serialize', ['contentType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Content Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contentType = $this->ContentTypes->get($id);
        if ($this->ContentTypes->delete($contentType)) {
            $this->Flash->success(__('The content type has been deleted.'));
        } else {
            $this->Flash->error(__('The content type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

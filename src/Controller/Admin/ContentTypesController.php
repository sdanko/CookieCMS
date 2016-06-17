<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

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
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contentTypes = $this->paginate($this->ContentTypes);

        $this->set(compact('contentTypes'));
        $this->set('_serialize', ['contentTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Content Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contentType = $this->ContentTypes->get($id, [
            'contain' => ['Vocabularies', 'Content']
        ]);

        $this->set('contentType', $contentType);
        $this->set('_serialize', ['contentType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
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
        $vocabularies = $this->ContentTypes->Vocabularies->find('list', ['limit' => 200]);
        $this->set(compact('contentType', 'vocabularies'));
        $this->set('_serialize', ['contentType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Content Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contentType = $this->ContentTypes->get($id, [
            'contain' => ['Vocabularies']
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
        $vocabularies = $this->ContentTypes->Vocabularies->find('list', ['limit' => 200]);
        $this->set(compact('contentType', 'vocabularies'));
        $this->set('_serialize', ['contentType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Content Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        if($this->ContentTypes->Content->findByContentTypeId($id)->count()!=0) {
             $this->Flash->error(__('There is content related to this type.'));
             return $this->redirect(['action' => 'index']);
        }
        if ($this->ContentTypes->delete($contentType)) {
            $this->Flash->success(__('The content type has been deleted.'));
        } else {
            $this->Flash->error(__('The content type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

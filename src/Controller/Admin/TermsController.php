<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Terms Controller
 *
 * @property \App\Model\Table\TermsTable $Terms
 */
class TermsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($vocabularyId = null)
    {
        $terms = $this->paginate($this->Terms);

        $this->set(compact('terms'));
        $this->set('_serialize', ['terms']);
    }

    /**
     * View method
     *
     * @param string|null $id Term id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $term = $this->Terms->get($id, [
            'contain' => ['Taxonomies']
        ]);

        $this->set('term', $term);
        $this->set('_serialize', ['term']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $term = $this->Terms->newEntity();
        if ($this->request->is('post')) {
            $term = $this->Terms->patchEntity($term, $this->request->data);
            if ($this->Terms->save($term)) {
                $this->Flash->success(__('The term has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The term could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('term'));
        $this->set('_serialize', ['term']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Term id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $term = $this->Terms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $term = $this->Terms->patchEntity($term, $this->request->data);
            if ($this->Terms->save($term)) {
                $this->Flash->success(__('The term has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The term could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('term'));
        $this->set('_serialize', ['term']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Term id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $term = $this->Terms->get($id);
        if ($this->Terms->delete($term)) {
            $this->Flash->success(__('The term has been deleted.'));
        } else {
            $this->Flash->error(__('The term could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

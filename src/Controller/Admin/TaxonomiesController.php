<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Taxonomies Controller
 *
 * @property \App\Model\Table\TaxonomiesTable $Taxonomies
 */
class TaxonomiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ParentTaxonomies', 'Terms', 'Vocabularies']
        ];
        $taxonomies = $this->paginate($this->Taxonomies);

        $this->set(compact('taxonomies'));
        $this->set('_serialize', ['taxonomies']);
    }

    /**
     * View method
     *
     * @param string|null $id Taxonomy id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $taxonomy = $this->Taxonomies->get($id, [
            'contain' => ['ParentTaxonomies', 'Terms', 'Vocabularies', 'ChildTaxonomies']
        ]);

        $this->set('taxonomy', $taxonomy);
        $this->set('_serialize', ['taxonomy']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $taxonomy = $this->Taxonomies->newEntity();
        if ($this->request->is('post')) {
            $taxonomy = $this->Taxonomies->patchEntity($taxonomy, $this->request->data);
            if ($this->Taxonomies->save($taxonomy)) {
                $this->Flash->success(__('The taxonomy has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The taxonomy could not be saved. Please, try again.'));
            }
        }
        $parentTaxonomies = $this->Taxonomies->ParentTaxonomies->find('list', ['limit' => 200]);
        $terms = $this->Taxonomies->Terms->find('list', ['limit' => 200]);
        $vocabularies = $this->Taxonomies->Vocabularies->find('list', ['limit' => 200]);
        $this->set(compact('taxonomy', 'parentTaxonomies', 'terms', 'vocabularies'));
        $this->set('_serialize', ['taxonomy']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Taxonomy id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $taxonomy = $this->Taxonomies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $taxonomy = $this->Taxonomies->patchEntity($taxonomy, $this->request->data);
            if ($this->Taxonomies->save($taxonomy)) {
                $this->Flash->success(__('The taxonomy has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The taxonomy could not be saved. Please, try again.'));
            }
        }
        $parentTaxonomies = $this->Taxonomies->ParentTaxonomies->find('list', ['limit' => 200]);
        $terms = $this->Taxonomies->Terms->find('list', ['limit' => 200]);
        $vocabularies = $this->Taxonomies->Vocabularies->find('list', ['limit' => 200]);
        $this->set(compact('taxonomy', 'parentTaxonomies', 'terms', 'vocabularies'));
        $this->set('_serialize', ['taxonomy']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Taxonomy id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $taxonomy = $this->Taxonomies->get($id);
        if ($this->Taxonomies->delete($taxonomy)) {
            $this->Flash->success(__('The taxonomy has been deleted.'));
        } else {
            $this->Flash->error(__('The taxonomy could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

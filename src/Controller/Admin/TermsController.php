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
    protected $_redirectUrl = array(
        'controller' => 'Vocabularies',
        'action' => 'index'
    );

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($vocabularyId = null)
    {
        $this->__ensureVocabularyIdExists($vocabularyId);
        
        $vocabulary = $this->Terms->Taxonomies->Vocabularies->findById($vocabularyId)->first();
        $this->set('title_for_layout', __d('admin', 'Vocabulary: {0}', $vocabulary->title));
        
        $terms = array();
        
        $termsTree = $this->Terms->Taxonomies->getTreeList($vocabularyId);

        if(!empty($termsTree))
        {   
            $termsById = $this->Terms->find('all', array(
                'conditions' => array(
                        'Terms.id IN' => array_keys($termsTree)
                )
            ))->toArray();

            $ordered = array_keys($termsTree);
            foreach ($termsById as $tempTerm) {
                    $term = $tempTerm;
                    $id = $term['id'];
                    $term['indent'] = substr_count($termsTree[$id], '_');
                    $position = array_search($id, $ordered);
                    $terms[$position] = $term;
            }
            ksort($terms); 
        }

            
        $this->set('vocabularyId', $vocabularyId );
        $this->set('terms', $terms);
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
    public function add($vocabularyId = null)
    {
        $this->__ensureVocabularyIdExists($vocabularyId);
        
        $vocabulary = $this->Terms->Taxonomies->Vocabularies->findById($vocabularyId)->first();
        $this->set('title_for_layout', __d('admin', '{0} : Add Term', $vocabulary->title));
        
        $term = $this->Terms->newEntity();
        if ($this->request->is('post')) {
            //$term = $this->Terms->patchEntity($term, $this->request->data);
            if ($this->Terms->add($this->request->data, $vocabularyId)) {
                $this->Flash->success(__('The term has been saved.'));
                return $this->redirect(['action' => 'index', "vocabularyId" => $vocabularyId]);
            } else {
                $this->Flash->error(__('The term could not be saved. Please, try again.'));
            }
        }
        
        $parentTree = $this->Terms->Taxonomies->getTreeList($vocabularyId, array('taxonomyId' => true));
             
        $this->set(compact('term', 'vocabularyId', 'parentTree'));
        $this->set('_serialize', ['term']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Term id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $vocabularyId = null)
    {
        $this->__ensureVocabularyIdExists($vocabularyId);
        
        $vocabulary = $this->Terms->Taxonomies->Vocabularies->findById($vocabularyId)->first();
        $this->set('title_for_layout', __d('admin', '{0} : Edit Term', $vocabulary->title));
        
        $term = $this->Terms->get($id, [
            'contain' => []
        ]);
        
        $taxonomy = $this->Terms->Taxonomies->find('all', array(
            'conditions' => array(
                    'Taxonomies.term_id' => $id,
                    'Taxonomies.vocabulary_id' => $vocabularyId,
            )
        ))->first();
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            //$term = $this->Terms->patchEntity($term, $this->request->data);
            if ($this->Terms->edit($this->request->data, $vocabularyId)) {
                $this->Flash->success(__('The term has been saved.'));
                return $this->redirect(['action' => 'index', "vocabularyId" => $vocabularyId]);
            } else {
                $this->Flash->error(__('The term could not be saved. Please, try again.'));
            }
        }
        
        $parentTree = $this->Terms->Taxonomies->getTreeList($vocabularyId, array('taxonomyId' => true));
        $taxonomyId = $taxonomy ? $taxonomy->id : null;
        
        $this->set(compact('term', 'vocabularyId', 'parentTree', 'taxonomyId'));
        $this->set('_serialize', ['term']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Term id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $vocabularyId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        //$term = $this->Terms->get($id);
        if ($this->Terms->remove($id, $vocabularyId)) {
            $this->Flash->success(__('The term has been deleted.'));
        } else {
            $this->Flash->error(__('The term could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index', "vocabularyId" => $vocabularyId]);
    }
    
        /**
     * Checks that Vocabulary exists or flash redirect to $url when it is not found
     *
     * @param integer $vocabularyId Vocabulary Id
     * @param string $url Redirect Url
     * @return bool True if Term exists
     */
    private function __ensureVocabularyIdExists($vocabularyId, $url = null) {
        $redirectUrl = is_null($url) ? $this->_redirectUrl : $url;
        if (!$vocabularyId) {
                return $this->redirect($redirectUrl);
        }
        
        if (!$this->Terms->Taxonomies->Vocabularies->exists(['id' => $vocabularyId])) {
            $this->Flash->error(__d('cookie', 'Invalid Vocabulary ID.'));
            return $this->redirect($redirectUrl);
        }
    }
}

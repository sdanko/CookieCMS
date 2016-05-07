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
        $this->__ensureVocabularyIdExists($vocabularyId);
        
        $vocabulary = $this->Terms->Taxonomies->Vocabularies->findById($vocabularyId)->first();
        $this->set('title_for_layout', __d('admin', 'Vocabulary: {0}', $vocabulary->title));
        
        $terms = $this->getTreeList($vocabularyId, array('taxonomyId' => true));
        
            
        $terms = $this->paginate($query);
        $this->set('vocabularyId', $vocabularyId );
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
    public function add($vocabularyId = null)
    {
        $this->__ensureVocabularyIdExists($vocabularyId);
        
        $vocabulary = $this->Terms->Taxonomies->Vocabularies->findById($vocabularyId)->first();
        $this->set('title_for_layout', __d('admin', '{0} : Add Term', $vocabulary->title));
        
        $term = $this->Terms->newEntity();
        if ($this->request->is('post')) {
            $term = $this->Terms->patchEntity($term, $this->request->data);
            if ($this->Terms->add($term, $vocabularyId)) {
                $this->Flash->success(__('The term has been saved.'));
                return $this->redirect(['action' => 'index', "vocabularyId" => $vocabularyId]);
            } else {
                $this->Flash->error(__('The term could not be saved. Please, try again.'));
            }
        }
        
        $parentTree = $this->Terms->Taxonomies->find('byVocabulary', array(
                'vocabularyId' => $vocabularyId
        ))->toList();
             
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $term = $this->Terms->patchEntity($term, $this->request->data);
            if ($this->Terms->save($term)) {
                $this->Flash->success(__('The term has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The term could not be saved. Please, try again.'));
            }
        }
        
        $parentTree = $this->Terms->Taxonomies->find('byVocabulary', array(
                'vocabularyId' => $vocabularyId
        ))->toList();
        $this->set(compact('term', 'vocabularyId', 'parentTree'));
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
    
    private function getTreeList($vocabularyId, $options = array()) {
        $_options = array(
            'key' => 'slug', // Term.slug
            'value' => 'title', // Term.title
            'taxonomyId' => false,
            'cache' => false,
        );
        $options = array_merge($_options, $options);
        
        $tree = $this->Terms->Taxonomies->find('byVocabulary', array(
                'vocabularyId' => $vocabularyId
        ))->toArray();
        
        $termsIds = array_keys($tree);
        
        $terms = $this->Terms->find('list', array(
            'conditions' => array(
                    'Term.id' => $termsIds,
            ),
            'fields' => array(
                    $options['key'],
                    $options['value'],
                    'id',
            ),
        ))->toArray();
        
        debug($terms);die;
        $termsTree = array();
        foreach ($tree as $termId => $tvId) {
            if (isset($terms[$termId])) {
                $term = $terms[$termId];
                $key = array_keys($term);
                $key = $key['0'];
                $value = $term[$key];
                if (strstr($tvId, '_')) {
                    $tvIdN = str_replace('_', '', $tvId);
                    $tvIdE = explode($tvIdN, $tvId);
                    $value = $tvIdE['0'] . $value;
                }

                if (!$options['taxonomyId']) {
                    $termsTree[$key] = $value;
                } else {
                    $termsTree[str_replace('_', '', $tvId)] = $value;
                }
            }
        }
    }
}

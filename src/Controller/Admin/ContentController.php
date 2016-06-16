<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;


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
        $typeAlias = $this->request->query('typeAlias');
        $query = $this->Content->find('byType', array(
            'type' => $typeAlias
        ));
        
        $type = $this->Content->ContentTypes->find('byAlias',array(
            'alias' => $typeAlias
        ))->first();

        $this->paginate = [
            'contain' => ['ContentTypes']
        ];
        
        $content = $this->paginate($query);
        $this->set(compact('type', 'content'));
        //$this->set('content', $this->paginate($this->Content));
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
    public function add($typeAlias = null)
    {
        $type = $this->Content->ContentTypes->find('byAlias',array(
            'alias' => $typeAlias
        ))->first();

        $content = $this->Content->newEntity();
        if ($this->request->is('post')) {
            //$content = $this->Content->patchEntity($content, $this->request->data);
            //if ($this->Content->save($content)) {
            if ($this->Content->addContent($content, $this->request->data, $typeAlias)) {
                $this->Flash->success(__('The content has been saved.'));
                return $this->redirect(['action' => 'index', "typeAlias" => $typeAlias]);
            } else {
                $this->Flash->error(__('The content could not be saved. Please, try again.'));
            }
        }
        $contentTypes = $this->Content->ContentTypes->find('list', ['limit' => 200]);
        $this->set(compact('content', 'contentTypes', 'type'));
        $this->set('_serialize', ['content']);
        
        if (isset($this->TaxonomiesData)) {
            $this->TaxonomiesData->prepareCommonData($type);
        }
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
            'contain' => ['Taxonomies']
        ]);

        $type = $this->Content->ContentTypes->get($content->content_type_id, [
            'contain' => ['Vocabularies']
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            //$content = $this->Content->patchEntity($content, $this->request->data);
            if ($this->Content->editContent($content, $this->request->data, $type->alias)) {
                $this->Flash->success(__('The content has been saved.'));
                return $this->redirect(['action' => 'index',  "typeAlias" => $type->alias]);
            } else {
                $this->Flash->error(__('The content could not be saved. Please, try again.'));
            }
        }
        $contentTypes = $this->Content->ContentTypes->find('list', ['limit' => 200]);
        $this->set(compact('content', 'contentTypes', 'type'));
        $this->set('_serialize', ['content']);
        
        if (isset($this->TaxonomiesData)) {
            $this->TaxonomiesData->prepareCommonData($type);
        }
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
    
     public function publish($id = null)
    {
        $content = $this->Content->get($id, [
            'contain' => []
        ]);
        
        $type = $this->Content->ContentTypes->get($content->content_type_id);
        
        if (empty($type)) {
            throw new Exception(__d('admin', 'Invalid Content Type'));
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $content = $this->Content->patchEntity($content, $this->request->data);
            if ($this->Content->save($content)) {
                $this->Flash->success(__('The content has been published.'));
                return $this->redirect(['action' => 'index', "typeAlias" => $type->alias]);
            } else {
                $this->Flash->error(__('The content could not be published. Please, try again.'));
            }
        }
        $this->set(compact('content'));
        $this->set('_serialize', ['content']);
    }
    
    public function promote($id = null)
    {
        $this->request->allowMethod(['post', 'promote']);
        $content = $this->Content->get($id);
        
        $type = $this->Content->ContentTypes->get($content->content_type_id);
        
        if (empty($type)) {
            throw new Exception(__d('admin', 'Invalid Content Type'));
        }
        
        $content->promote = true;
        
        if ($this->Content->save($content)) {
            $this->Flash->success(__('Content has been promoted.'));
            return $this->redirect(['action' => 'index', "typeAlias" => $type->alias]);
        } else {
            $this->Flash->error(__('Content not be promoted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function unpromote($id = null)
    {
        $this->request->allowMethod(['post', 'unpromote']);
        $content = $this->Content->get($id);
        
        $type = $this->Content->ContentTypes->get($content->content_type_id);
        
        if (empty($type)) {
            throw new Exception(__d('admin', 'Invalid Content Type'));
        }
        
        $content->promote = false;
        
        if ($this->Content->save($content)) {
            $this->Flash->success(__('Content has been unpromoted.'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('Content not be unpromoted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function types() 
    {
        $this->set('title_for_layout', __d('admin', 'Choose content type'));

        $types = $this->Content->ContentTypes->find();
              
        $this->set(compact('types'));
    }
    
    public function nodes($id = null)
    {
        
    }
    
    public function getComments()
    {
        if( $this->request->is('ajax') ) {
             $content_id = $this->request->query('contentId');

             $content = $this->Content->get($content_id, [
                  'contain' => ['Comments', 'Comments.Creator']
              ])->toArray();

              $this->set('data', $content['comments']);
              $this->set('_serialize', ['data']);
        }
    }
    
    public function submitComment()
    {        
        if( $this->request->is('ajax') ) {
            $request_data = json_decode($this->request->input()); 
            $this->Content->addComment((array)$request_data,  ['Auth' => $this->Auth]);

            $this->set('_serialize', []);
        }
    }
}

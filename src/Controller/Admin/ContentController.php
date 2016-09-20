<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\I18n\Time;
use Cake\Core\Configure;

/**
 * Content Controller
 *
 * @property \App\Model\Table\ContentTable $Content
 */
class ContentController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            'actions' => ['lookup']
        ]);
    }

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
        $query->order(['created' => 'DESC']);
        
        $type = $this->Content->ContentTypes->find('byAlias',array(
            'alias' => $typeAlias
        ))->first();

        $this->paginate = [
             'limit' => 10,
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
        } else {
            $this->Flash->error(__('Content not be promoted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index', "typeAlias" => $type->alias]);
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
        } else {
            $this->Flash->error(__('Content not be unpromoted. Please, try again.'));
        }
          return $this->redirect(['action' => 'index', "typeAlias" => $type->alias]);
    }
    
    public function types() 
    {
        $this->set('title_for_layout', __d('admin', 'Choose content type'));

        $types = $this->Content->ContentTypes->find();
              
        $this->set(compact('types'));
    }
    
    public function lookup()
    {
        $query = $this->Content
            ->find('search', ['search' => $this->request->query]);

        $this->set('content', $this->paginate($query));
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
    
    public function workflow($id = null)
    {
        $content = $this->Content->get($id);
        
        if (empty($content)) {
            throw new Exception(__d('admin', 'Invalid Content'));
        }
        
        $nodes_table = TableRegistry::get('Nodes');
        $query = $nodes_table->find('byContent', array(
            'content_id' => $id
        ));
        $query->order(['level' => 'ASC']);
        
        $this->paginate = [
            'limit' => 10,
            'contain' => ['NodeTypes']
        ];
        
        $nodes = $this->paginate($query);
        $this->set(compact('nodes', 'content'));
        $this->set('_serialize', ['nodes']);
    }
    
    public function startWorkflow($id = null)
    {
        $content = $this->Content->get($id, [
            'contain' => ['ContentTypes']
        ]);
              
        if (empty($content)) {
            throw new Exception(__d('admin', 'Invalid Content'));
        }
        
         $nodes_table = TableRegistry::get('Nodes');
         $workflow = $nodes_table->Workflows->get($content->content_type->workflow_id);
         $xml_nodes = $this->CookieData->getWorkflowXmlNodes($workflow);debug($xml_nodes);die;
         $nodes_table->startWorkflow($id);
         
         return $this->redirect(['action' => 'workflow', "id" => $id]);
    }
    
    public function nodes($id = null)
    {
        
    }
    
    public function getNodes()
    {
        if( $this->request->is('ajax') ) {
            $id = $this->request->query('id');

            $content = $this->Content->get($id, [
                  'contain' => ['Creator', 'Publisher']
              ]);
             
            
            
            $data['created'] = ['title' => __d('admin', 'Created'),'date' => $content->created->i18nFormat(Configure::read('Writing.date_time_format')),
                'creator' => $content->creator];
             
            $published = false;
            $date = Time::now();
            $startDate = $content->publish_start;
            $endDate = empty($content->publish_end) ?  $date : $content->publish_end;

            if(!empty($startDate)) {
                if( ( $date >= $startDate ) && ( $date <= $endDate ) ) {
                    $published = true;
                }
            }

            if ($published) {
                $data['published'] = ['title' => __d('admin', 'Published'), 'date' => $content->publish_start->i18nFormat(Configure::read('Writing.date_time_format')),
                    'publisher' => $content->publisher];
            }
        
             
            $this->set('data', $data);
            $this->set('_serialize', ['data']);
        }
    }
}

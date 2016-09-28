<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\I18n\Time;
use Cake\Core\Configure;
use Cake\Utility\Xml;
use Cake\Utility\Exception\XmlException;

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
        
        $nodesTable = TableRegistry::get('Nodes');
        $query = $nodesTable->find('byContent', array(
            'content_id' => $id
        ));
        $query->order(['level' => 'ASC']);
        
        $this->paginate = [
            'limit' => 10,
            'contain' => ['NodeTypes', 'Users']
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
        
         $nodesTable = TableRegistry::get('Nodes');
         $workflow = $nodesTable->Workflows->get($content->content_type->workflow_id);
         
         if (empty($content)) {
            throw new Exception(__d('admin', 'Invalid Workflow'));
        }
        
         $xmlNodes = $this->_getWorkflowXmlNodes($workflow);
       
        $this->_createWorkflowElements($id, $workflow->id, $xmlNodes);
        $this->_setWorkflowLevels($id);
        $this->_createFirstJob($id);
         
        return $this->redirect(['action' => 'workflow', $id]);
    }
    
    protected function _getWorkflowXmlNodes($workflow) 
    {
        try {
            $xml = Xml::build($workflow->path); 
        } catch (\Cake\Utility\Exception\XmlException $e) {
            throw new InternalErrorException("Invalid GraphML file", 1);
        }   
        
        return $xml; 
    }
    
    protected function _createWorkflowElements($id, $workflow_id, $xmlNodes)
    {
        $nodesTable = TableRegistry::get('Nodes');

        $nodes = $xmlNodes->graph;
        foreach ($nodes->node as $node) {
            $i=0;

            do{
               $children = $node->data[$i]->children(Configure::read('Workflow.GraphMLNamespace'));
               $i++;
            }while(empty($children));

           $newNode = $nodesTable->newEntity();
           $newNode->content_id = $id;
           $newNode->title = (string)$node->attributes()->id;
           $newNode->label = (string)$children->GenericNode->NodeLabel;
           $newNode->workflow_id = $workflow_id;

           $nodeType = $nodesTable->NodeTypes->findByConfig((string)$children->GenericNode->attributes()->configuration)->first();

           if(!empty($nodeType)) {
               $newNode->node_type_id = $nodeType->id;

               if($nodeType->config===Configure::read('Workflow.startNode')) {
                   $newNode->first = true;
               }
                if($nodeType->config===Configure::read('Workflow.endNode')) {
                   $newNode->last = true;
               }
           } 
           $nodesTable->save($newNode);
        }

        foreach ($nodes->edge as $edge) {
           $i=0;

           do{
               $children = $edge->data[$i]->children(Configure::read('Workflow.GraphMLNamespace'));
               $i++;
            }while(empty($children));

           $newEdge = $nodesTable->NodeJobs->NodeFlows->NodeEdges->newEntity();
           
           //$source = $nodesTable->findByTitleAndContent(['title' => (string)$edge->attributes()->source, 'content_id' => $id])->first();
           $source = $nodesTable->find('byTitleAndContent', array(
                'title' => (string)$edge->attributes()->source,
                'content_id' => $id
            ))->first();
           if(!empty($source)) {
                $newEdge->source = $source->id;
           }
           
           $target = $nodesTable->find('byTitleAndContent', array(
                'title' => (string)$edge->attributes()->target,
                'content_id' => $id
            ))->first();
           if(!empty($target)) {
                $newEdge->target = $target->id;
           }

           if(!empty($children->PolyLineEdge->EdgeLabel)) {
               $newEdge->label = (string)$children->PolyLineEdge->EdgeLabel;
           }
           $nodesTable->NodeJobs->NodeFlows->NodeEdges->save($newEdge);
       }
             
    }
    
    protected function _setWorkflowLevels($id)
    {
        $nodesTable = TableRegistry::get('Nodes');
        $startNode = $nodesTable->find()->where(['content_id' => $id, 'first' => true])->first();
        
        if(!empty($startNode)) {
            $startNode->level = 1;
            $nodesTable->save($startNode);
            $this->_setNextNodeLevel($startNode);
        }
    }
    
    protected function _setNextNodeLevel($node)
    {
        if($node->last) {
            return;
        }
        
        $nodesTable = TableRegistry::get('Nodes');

        $nodeEdges = $nodesTable->NodeJobs->NodeFlows->NodeEdges->find()->where(['source' => $node->id])->toList();

        foreach ($nodeEdges as $nodeEdge) {
            $nextNode = $nodesTable->get($nodeEdge->target);
            if(!empty($nextNode)) {
                    if($nextNode->level < $node->level) {
                        $nextNode->level = $node->level+1;
                        $nodesTable->save($nextNode);
                        $this->_setNextNodeLevel($nextNode); 
                    }                                  
            }
        }
    }
    
    protected function _createFirstJob($id)
    {
        $nodesTable = TableRegistry::get('Nodes');
        
        $startNode = $nodesTable->find()->where(['content_id' => $id, 'first' => true])->first();
        
        if(!empty($startNode)) {
            $nodeJob = $nodesTable->NodeJobs->newEntity();
            $nodeJob->node_id = $startNode->id;
            $nodeJob->title = $startNode->label;
            $nodeJob->finished = true;
            $nodesTable->NodeJobs->save($nodeJob);
            
            $edge = $nodesTable->NodeJobs->NodeFlows->NodeEdges->find()->where(['source' => $startNode->id])->first();
            
            if(!empty($edge)) {
                $nextNode = $nodesTable->get($edge->target);
                
                $nodeFlow = $nodesTable->NodeJobs->NodeFlows->newEntity();
                $nodeFlow->node_job_id = $nodeJob->id;
                $nodeFlow->node_edge_id = $edge->id;
                $nodesTable->NodeJobs->NodeFlows->save($nodeFlow);
            }           
        }
        
        if(!empty($nextNode)) {
            $nodeJob = $nodesTable->NodeJobs->newEntity();
            $nodeJob->node_id = $nextNode->id;
            $nodeJob->title = $nextNode->label;
            $nodesTable->NodeJobs->save($nodeJob);
        }
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

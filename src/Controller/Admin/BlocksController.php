<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Blocks Controller
 *
 * @property \App\Model\Table\BlocksTable $Blocks
 */
class BlocksController extends AppController
{
    protected $_redirectUrl = array(
        'controller' => 'Regions',
        'action' => 'index'
    );

    /**
     * Index method
     *
     * @return void
     */
    public function index($regionId = null)
    {
        $this->__ensureRegionIdExists($regionId);
        
        $region = $this->Blocks->Regions->findById($regionId)->first();
        $this->set('title_for_layout', __d('admin', 'Region: {0}', $region->title));
        
        $query = $this->Blocks->find()->where(['Blocks.region_id' => $regionId]);
        
        $this->paginate = [
            'contain' => ['Regions']
        ];
        
        $this->set('regionId', $regionId);
        
        $this->set('blocks', $this->paginate($query));
        $this->set('_serialize', ['blocks']);
    }

    /**
     * View method
     *
     * @param string|null $id Block id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $block = $this->Blocks->get($id, [
            'contain' => []
        ]);
        $this->set('block', $block);
        $this->set('_serialize', ['block']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($regionId = null)
    {
        $this->__ensureRegionIdExists($regionId);
        
        $block = $this->Blocks->newEntity();
        if ($this->request->is('post')) {
            $block = $this->Blocks->patchEntity($block, $this->request->data);
            if ($this->Blocks->save($block)) {
                $this->Flash->success(__('The block has been saved.'));
                return $this->redirect(['action' => 'index', "regionId" => $regionId]);
            } else {
                $this->Flash->error(__('The block could not be saved. Please, try again.'));
            }
        }
        $this->set('regionId', $regionId);
        //$regions = $this->Blocks->Regions->find('list', ['limit' => 200]);
        $this->set(compact('block', 'regions'));
        $this->set('_serialize', ['block']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Block id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $block = $this->Blocks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $block = $this->Blocks->patchEntity($block, $this->request->data);
            if ($this->Blocks->save($block)) {
                $this->Flash->success(__('The block has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The block could not be saved. Please, try again.'));
            }
        }
        $regions = $this->Blocks->Regions->find('list', ['limit' => 200]);
        $this->set(compact('block', 'regions'));
        $this->set('_serialize', ['block']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Block id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $block = $this->Blocks->get($id);
        if ($this->Blocks->delete($block)) {
            $this->Flash->success(__('The block has been deleted.'));
        } else {
            $this->Flash->error(__('The block could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function moveUp($id = null)
    {
        $block = $this->Blocks->get($id, [
            'contain' => []
        ]);
        $block->position--;
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->Blocks->save($block)) {
                $this->Flash->success(__('The block has been moved.'));
            } else {
                $this->Flash->error(__('The block could not be moved. Please, try again.'));
            }
        }
        
        return $this->redirect(['action' => 'index', "regionId" => $block->region_id]);
    }
    
    public function moveDown($id = null)
    {
        $block = $this->Blocks->get($id, [
            'contain' => []
        ]);
        $block->position++;
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->Blocks->save($block)) {
                $this->Flash->success(__('The blocks has been moved.'));
            } else {
                $this->Flash->error(__('The block could not be moved. Please, try again.'));
            }
        }
        
        return $this->redirect(['action' => 'index', "regionId" => $block->region_id]);
    }
    
    private function __ensureRegionIdExists($regionId, $url = null) 
    {
        $redirectUrl = is_null($url) ? $this->_redirectUrl : $url;
        if (!$regionId) {
                return $this->redirect($redirectUrl);
        }
        
        if (!$this->Blocks->Regions->exists(['id' => $regionId])) {
            $this->Flash->error(__d('admin', 'Invalid Region ID.'));
            return $this->redirect($redirectUrl);
        }
    }
}

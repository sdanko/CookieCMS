<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Links Controller
 *
 * @property \App\Model\Table\LinksTable $Links
 */
class LinksController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index($menuId = null)
    {
        $query = $this->Links->find()->where(['Links.menu_id' => $menuId]);
        
        $this->paginate = [
            'contain' => ['ParentLinks', 'Menus']
        ];
        
        $this->set('menuId', $menuId);
        
        $this->set('links', $this->paginate($query));
        $this->set('_serialize', ['links']);
    }

    /**
     * View method
     *
     * @param string|null $id Link id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $link = $this->Links->get($id, [
            'contain' => ['ParentLinks', 'Menus', 'ChildLinks']
        ]);
        $this->set('link', $link);
        $this->set('_serialize', ['link']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($menuId = null)
    {
        $link = $this->Links->newEntity();
        if ($this->request->is('post')) {
            $link = $this->Links->patchEntity($link, $this->request->data);
            if ($this->Links->save($link)) {
                $this->Flash->success(__('The link has been saved.'));
                return $this->redirect(['action' => 'index', "menuId" => $menuId]);
            } else {
                $this->Flash->error(__('The link could not be saved. Please, try again.'));
            }
        }
        $this->set('menuId', $menuId);
         
        $parentLinks = $this->Links->ParentLinks->find('list', ['limit' => 200,  'conditions' => array(
                                    'menu_id' => $menuId
                            )]);
        //$menus = $this->Links->Menus->find('list', ['limit' => 200]);
        $this->set(compact('link', 'parentLinks', 'menus'));
        $this->set('_serialize', ['link']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Link id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $link = $this->Links->get($id, [
            'contain' => []
        ]);
        $menuId = $link->menu_id;
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $link = $this->Links->patchEntity($link, $this->request->data);
            if ($this->Links->save($link)) {
                $this->Flash->success(__('The link has been saved.'));
                return $this->redirect(['action' => 'index', "menuId" => $link->menu_id]);
            } else {
                $this->Flash->error(__('The link could not be saved. Please, try again.'));
            }
        }
        $this->set('menuId', $menuId);
        $parentLinks = $this->Links->ParentLinks->find('list', ['limit' => 200,  'conditions' => array(
                                  'menu_id' => $menuId
                          )]);
        //$menus = $this->Links->Menus->find('list', ['limit' => 200]);
        $this->set(compact('link', 'parentLinks', 'menus'));
        $this->set('_serialize', ['link']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Link id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $link = $this->Links->get($id);
        if ($this->Links->delete($link)) {
            $this->Flash->success(__('The link has been deleted.'));
        } else {
            $this->Flash->error(__('The link could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index', "menuId" => $link->menu_id]);
    }
    
    public function searchLinks()
    {
         if( $this->request->is('ajax') ) {
            $this->set('text', $this->request->query('type'));
            $this->set('_serialize', ['text']);
        }
        
    }
}

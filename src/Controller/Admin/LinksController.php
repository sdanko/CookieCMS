<?php
namespace App\Controller\Admin;

require_once(ROOT . DS . "Vendor" . DS . "cookie" . DS . "StringConverter.php");

use StringConverter;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

/**
 * Links Controller
 *
 * @property \App\Model\Table\LinksTable $Links
 */
class LinksController extends AppController
{
    protected $_redirectUrl = array(
        'controller' => 'Menus',
        'action' => 'index'
    );
    
    /**
     * Index method
     *
     * @return void
     */
    public function index($menuId = null)
    {
        $this->__ensureMenuIdExists($menuId);
        
        $menu = $this->Links->Menus->findById($menuId)->first();
        $this->set('title_for_layout', __d('admin', 'Menu: {0}', $menu->title));
        
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
        $this->__ensureMenuIdExists($menuId);
         
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
        //$menuId = $link->menu_id;
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $link = $this->Links->patchEntity($link, $this->request->data);
            if ($this->Links->save($link)) {
                $this->Flash->success(__('The link has been saved.'));
                return $this->redirect(['action' => 'index', "menuId" => $link->menu_id]);
            } else {
                $this->Flash->error(__('The link could not be saved. Please, try again.'));
            }
        }
        //$this->set('menuId', $menuId);
        $parentLinks = $this->Links->ParentLinks->find('list', ['limit' => 200,  'conditions' => array(
                                  'menu_id' => $menuId
                          )]);

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
            $type = $this->request->query('type');
            $term = $this->request->query('term');
            
            if($type=="term") {
                $terms = TableRegistry::get('Terms');
                $data = $terms->find('all', ['limit' => 5, 'conditions' => array(
                        'OR' => array(
                            'Terms.slug LIKE ' => "%" . $term . "%",
                            'Terms.title LIKE' => "%" . $term . "%"
                        )
                )]);
                
                $data->formatResults(function (\Cake\Datasource\ResultSetInterface $results) {
                   return $results->map(function ($row) {                     
                       $row['url'] = $this->_urlToLinkString([
                            'controller' => 'content',
                            'action' => 'term',
                            'slug' => $row['slug']
                        ]);
                       return $row;
                   });
               });
                
            } else {
                $content = TableRegistry::get('Content');
                $data = $content->find('all', ['limit' => 5,  'conditions' => array(
                        'OR' => array(
                            'Content.slug LIKE ' => "%" . $term . "%",
                            'Content.title LIKE ' => "%" . $term . "%",
                        )
                )])->contain(['ContentTypes']);
                
                $data->formatResults(function (\Cake\Datasource\ResultSetInterface $results) {
                   return $results->map(function ($row) {                     
                       $row['url'] = $this->_urlToLinkString([
                            'controller' => 'content',
                            'action' => 'view',
                            'slug' => $row['slug'],
                            'type' => $row['content_type']['alias']
                        ]);
                       return $row;
                   });
               });
            }
            
            $this->set('data', $data);
            $this->set('_serialize', ['data']);
        }
        
    }
    
    public function moveUp($id = null)
    {
        $link = $this->Links->get($id, [
            'contain' => []
        ]);
        $link->position--;
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->Links->save($link)) {
                $this->Flash->success(__('The link has been moved.'));
            } else {
                $this->Flash->error(__('The link could not be moved. Please, try again.'));
            }
        }
        
        return $this->redirect(['action' => 'index', "menuId" => $link->menu_id]);
    }
    
    public function moveDown($id = null)
    {
        $link = $this->Links->get($id, [
            'contain' => []
        ]);
        $link->position++;
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->Links->save($link)) {
                $this->Flash->success(__('The link has been moved.'));
            } else {
                $this->Flash->error(__('The link could not be moved. Please, try again.'));
            }
        }
        
        return $this->redirect(['action' => 'index', "menuId" => $link->menu_id]);
    }
     /**
     * Converts array into string controller:abc/action:xyz/value1/value2
     *
     * @param array $url link
     * @return array
     * @see StringConverter::urlToLinkString()
     */
    protected function _urlToLinkString($url)
    {
        $this->converter = new StringConverter();
        
        return $this->converter->urlToLinkString($url);
    }
    
    private function __ensureMenuIdExists($menuId, $url = null) 
    {
        $redirectUrl = is_null($url) ? $this->_redirectUrl : $url;
        if (!$menuId) {
                return $this->redirect($redirectUrl);
        }
        
        if (!$this->Links->Menus->exists(['id' => $menuId])) {
            $this->Flash->error(__d('cookie', 'Invalid Menu ID.'));
            return $this->redirect($redirectUrl);
        }
    }
    
}

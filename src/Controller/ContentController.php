<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Routing\Router;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP ContentController
 * @author DANKO
 */
class ContentController extends AppController {

    public function view($id = null) {
        if ($this->request->query('type')!=null && $this->request->query('slug')!=null) {
            $content = $this->Content->find('bySlug', array(
                    'type' => $this->request->query('type'),
                    'slug' => $this->request->query('slug')
            ))->first();
        } elseif ($id == null) {
             $this->Flash->error(__d('croogo', 'Invalid content'));
            return $this->redirect('/');
        } else {
//             $content = $this->Content->find('byId', array(
//                    'id' => $id,
//            ))->first();
               $content = $this->Content->findById($id)->contain(['ContentTypes'])->first();
        }

        if (!isset($content->id)) {
            $this->Flash->error(__d('croogo', 'Invalid content'));
            return $this->redirect('/');
        }

        $this->set('title_for_layout', $content->title);
        $this->set(compact('content'));
    }

    public function promoted($type = null) {
        //$Content = $this->{$this->modelClass};
        $this->set('title_for_layout', __d('cookie', 'Home'));

        $limit = Configure::read('Reading.items_per_page');
        
        if ($type!=null) {
            $type = $this->Content->ContentTypes->find('byAlias', array(
                    'alias' => $type
            ))->first();
            
            if (!isset($type->id)) {
                $this->Flash->error(__d('cookie', 'Invalid content type.'));
                return $this->redirect('/');
            }
            
                
            $this->set('title_for_layout', $type->title);
            
            $query = $this->Content->find('byType', array(
                    'type' => $type
            ));
            
             $this->paginate = [
                'limit' => $limit,
                'contain' => ['ContentTypes']
            ];
             
            $content = $this->paginate($query);
            $this->set(compact('type', 'content'));
        }
        else {
            
           $this->paginate = [
                'limit' => $limit,
                'contain' => ['ContentTypes']
            ];
            
            $query = $this->Content->find();
            $query->formatResults(function (\Cake\Datasource\ResultSetInterface $results) {
                return $results->map(function ($row) {
                    $row['url'] = array(
                        'controller' => 'content',
                        'action' => 'view',
                        'slug' => $row['slug'],
                       'type' => $row['content_type']['alias']
                        
                    );
                    return $row;
                });
            });
            $content = $this->paginate($query);

            $this->set(compact('content'));  
        }
        
    }

}

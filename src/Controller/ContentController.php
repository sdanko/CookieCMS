<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\I18n\Time;

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

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            'actions' => ['search']
        ]);
    }
    
    public function view($type = null, $slug=null)
    {
        if ($type != null && $slug != null) {
            $content = $this->Content->find('bySlug', array(
                        'type' => $type,
                        'slug' => $slug
                    ))->applyOptions(['published' => true, 'active' => true])->first();
        } else {
            $this->Flash->error(__d('cookie', 'Invalid content'));
            return $this->redirect('/');
        } //else {
//            $content = $this->Content->findById($id)->contain(['ContentTypes', 'Taxonomies' => ['Terms']])->first();
//        }
        
        if (!isset($content->id)) {
            $this->Flash->error(__d('cookie', 'Invalid content'));
            return $this->redirect('/');
        }

        $this->set('title_for_layout', $content->title);
        $this->set(compact('content'));
    }

    public function promoted($type = null)
    {
        //$Content = $this->{$this->modelClass};
        $this->set('title_for_layout', __d('cookie', 'Home'));

        $limit = Configure::read('Reading.items_per_page');

        $type = $this->Content->ContentTypes->find('byAlias', array(
                    'alias' => $type
                ))->first();

        $query = $this->Content->find('byType', array(
                    'type' => $type
                ))->where([
            'promote' => true
        ]);
        $query->applyOptions(['published' => true, 'active' => true]);
        $query->cache('promoted');

        $this->paginate = [
            'limit' => $limit,
            'contain' => ['ContentTypes', 'Taxonomies' => ['Terms']]
        ];

        $content = $this->paginate($query);

        if ($type != null) {
            if (!isset($type->id)) {
                $this->Flash->error(__d('cookie', 'Invalid content type.'));
                return $this->redirect('/');
            }

            $this->set('title_for_layout', $type->title);

            $this->set(compact('type', 'content'));
        } else {
            $this->set(compact('content'));
        }
    }

    public function term() 
    {
        $limit = Configure::read('Reading.items_per_page');

        $term = $this->Content->Taxonomies->Terms->find('all', array(
                    'conditions' => array(
                        'Terms.slug' => $this->request->query('slug')
                    )
                ))->first();

        if (!isset($term->id)) {
            $this->Flash->error(__d('cookie', 'Invalid Term.'));
            return $this->redirect('/');
        }

        $this->set('title_for_layout', $term->title);

        $this->paginate = [
            'limit' => $limit,
            'contain' => ['ContentTypes', 'Taxonomies' => ['Terms']]
        ];
        
        $query = $this->Content->find('byTypeAndTerm', array(
            'type' => $this->request->query('type'),
            'term' => $this->request->query('slug')
        ));
        $query->applyOptions(['published' => true, 'active' => true]);
        
        $content = $this->paginate($query);
        $this->set(compact('term', 'content'));
    }
    
    public function search()
    {
        $query = $this->Content
            ->find('search', ['search' => $this->request->query]);

        $this->set('content', $this->paginate($query));
    }

}

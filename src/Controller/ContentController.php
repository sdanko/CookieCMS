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
        if ($this->request->query('type') != null && $this->request->query('slug') != null) {
            $content = $this->Content->find('bySlug', array(
                        'type' => $this->request->query('type'),
                        'slug' => $this->request->query('slug')
                    ))->first();
        } elseif ($id == null) {
            $this->Flash->error(__d('cookie', 'Invalid content'));
            return $this->redirect('/');
        } else {
//             $content = $this->Content->find('byId', array(
//                    'id' => $id,
//            ))->first();
            $content = $this->Content->findById($id)->contain(['ContentTypes'])->first();
        }

        if (!isset($content->id)) {
            $this->Flash->error(__d('cookie', 'Invalid content'));
            return $this->redirect('/');
        }

        if (empty($content->publish)) {
            $this->Flash->error(__d('cookie', 'Invalid content'));
            return $this->redirect('/');
        }

        $this->set('title_for_layout', $content->title);
        $this->set(compact('content'));
    }

    public function promoted($type = null) {
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
        $query->applyOptions(['published' => true]);

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

    public function term() {
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
        $query->applyOptions(['published' => true]);
        
        $content = $this->paginate($query);
        $this->set(compact('term', 'content'));
    }

}

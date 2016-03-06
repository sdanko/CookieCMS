<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP ThemesController
 * @author DANKO
 */

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Hash;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

class ThemesController extends AppController {
    public function getThemes() {
         $themes = array(
             array(
                'name' => 'Default',
                'screenshot' => '/img/screenshot.png'
                )
        );
         
        $this->folder = new Folder(ROOT . DS . "config");

        //$expected = array('name' => '', 'description' => '');

        $configFolderContent = $this->folder->read();

        if (in_array('themes.json', $configFolderContent['1'])) {
            $path=$this->folder->path;
            $themesJson = $path . DS . 'themes.json';

            $contents = file_get_contents($themesJson);
            $json = json_decode($contents, true);
            if ($json === null) {
                    $this->log('Invalid themes manifest:' . $themesJson);
                    $json = array();
            }
            else {
                $themes = Hash::merge($themes, $json);
            }

//            foreach ($json as $item) {
//                $intersect = array_intersect_key($expected, $item);
//                if ($json !== null && $intersect == $expected) {
//                        $themes[] = $item['name'];
//                }
//            }             
        }

        return $themes;
    }
    
    public function index() {
        $this->set('title_for_layout', __d('admin', 'Themes'));

        $themes = $this->getThemes();
        
        $currentTheme = Configure::read('Site.theme');
        
        $this->set(compact('themes', 'currentTheme'));
    }
    
    public function activate($alias = null) {
        $Setting = TableRegistry::get('Settings');
        if ($Setting->write('Site.theme', $alias)) {
            $this->Flash->success(__d('admin', 'Theme activated.'));
        } else {
            $this->Flash->error(__d('admin', 'Theme activation failed.'));
        }

        return $this->redirect(array('action' => 'index'));
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CakePHP HomeController
 * @author DANKO
 */
class HomeController extends AppController {

    public function index() 
    {

    }
    
    public function setLocale($locale = 'en_US') 
    {
        $Setting = TableRegistry::get('Settings');
        $Setting->write('Site.language', $locale);

        return $this->redirect($this->request->referer());
    }

}

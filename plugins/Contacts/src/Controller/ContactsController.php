<?php

namespace Contacts\Controller;

use Contacts\Form\ContactsForm;

class ContactsController extends AppController
{
    public function index()
    {
        $this->set('title_for_layout', __d('cookie', 'Contact'));
        
        $contact = new ContactsForm();
        if ($this->request->is('post')) {
            if ($contact->execute($this->request->data)) {                  
                $this->Flash->success(__d('cookie', 'We will get back to you soon.'));
            } else {
                $this->Flash->error(__d('cookie', 'There was a problem submitting your form.'));
            }
        }
        $this->set('contact', $contact);
    }
}


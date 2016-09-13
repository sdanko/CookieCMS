<?php

namespace Contacts\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Tools\Mailer\Email;
use Cake\Core\Configure;

class ContactsForm extends Form
{
    protected function _buildSchema(Schema $schema) {
        return $schema->addField('name', ['type' => 'string', 'length' => 40])
                ->addField('email', ['type' => 'string', 'length' => 50])
                ->addField('subject', ['type' => 'string', 'length' => 60])
                ->addField('body', ['type' => 'text']);
    }

    protected function _buildValidator(Validator $validator) {
        return $validator
                ->requirePresence('name')
                ->notEmpty('name', __('This field cannot be left empty'))
                ->requirePresence('email')
                ->add('email', 'format', [
                                'rule' => 'email',
                                'message' => __('A valid email address is required'),
                ])
                ->requirePresence('subject')
                ->notEmpty('subject', __('This field cannot be left empty'))
                ->requirePresence('body')
                ->notEmpty('body', __('This field cannot be left empty'));
    }
        
    protected function _execute(array $data)
    {
        $email = new Email();

        $email->to(Configure::read('Config.adminEmail'));
        $email->subject('Contact');
        $email->message($data['body']);
        $email->replyTo($data['email'], $data['name']);

        // Send it
        if ($email->send()) {
            return true;
        }
    }
}


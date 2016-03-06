<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity.
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'active' => true,
        'first_name' => true,
        'middle_name' => true,
        'last_name' => true,
        'email' => true,
        'password' => true,
        'created_by' => true,
        'modified_by' => true,
        'role' => true,
        'user_roles' => true,
    ];
    
     protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
}

<?php
namespace App\Model\Table;

use App\Model\Entity\Setting;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;
use Cake\Core\Configure;
use Cake\Utility\Hash;


/**
 * Settings Model
 *
 */
class SettingsTable extends Table
{
    public $settingsPath = '';

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('cms.settings');
        $this->displayField('title');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
           ->notEmpty('key');
        
       $validator->add(
            'key', 
            ['unique' => [
                'rule' => 'validateUnique', 
               'provider' => 'table', 
               'message' => 'Not unique']
            ]
        );
            
        $validator
            ->allowEmpty('value');
            
        $validator
            ->allowEmpty('title');
            
        $validator
            ->allowEmpty('description');

        return $validator;
    }
    
    public function afterSave() {
        $this->updateJson();
        $this->writeConfiguration();
    }

    public function afterDelete() {
        $this->updateJson();
        $this->writeConfiguration();
    }
    
    public function writeConfiguration() {
        Configure::load('settings', 'settings');
    }

    public function updateJson() {
        $settings = $this
            ->find('all')
            ->select(['id', 'key', 'value'])
            ->order(['Settings__key' => 'ASC'])
            ->combine('key', 'value')
            ->toArray();

        Configure::write($settings);
        foreach ($settings as $key => $setting) {
            list($key, $ignore) = explode('.', $key, 2);
            $keys[] = $key;
        }
        $keys = array_unique($keys);
        Configure::dump('settings', 'settings', $keys);
    }
    
    public function deleteKey($key) {
        $setting = $this->findByKey($key);
        if (isset($setting->id) &&
                $this->delete($setting->id)) {
            return true;
        }
        return false;
    }
    
    public function write($key, $value, $options = array()) {
        $options = array_merge(array(
                'title' => '',
                'description' => '',
        ), $options);
        $setting = $this->findByKey($key)->first();
        
        if (isset($setting->id)) {
            $setting->value = $value;
            $setting->title = $options['title'];
            $setting->description = $options['description'];
        } else {
            $setting = $this->newEntity();
            $setting->key = $key;
            $setting->value = $value;
            $setting->title = $options['title'];
            $setting->description = $options['description'];
        }

        $this->id = false;
        
        if ($this->save($setting)) {
            Configure::write($key, $value);
            return true;
        } else {
            return false;
        }
    }

}

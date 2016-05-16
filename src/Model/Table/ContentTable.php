<?php
namespace App\Model\Table;

use App\Model\Entity\Content;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Core\Configure;
use Cake\ORM\Entity;
use ArrayObject;
use Cake\Event\EventManager;

/**
 * Content Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ContentTypes
 */
class ContentTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('cms.content');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Ceeram/Blame.Blame');
        $this->addBehavior('Taxonomizable');
        $this->addBehavior('Encoder');

        $this->belongsTo('ContentTypes', [
            'foreignKey' => 'content_type_id'
        ]);
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('title');

        $validator
            ->boolean('active')
            ->allowEmpty('active');

        $validator
            ->allowEmpty('slug');

        $validator
            ->allowEmpty('body');

        $validator
            ->boolean('promote')
            ->allowEmpty('promote');

        $validator
            ->date('publish_start', Configure::read('Writing.validation_date_time_format'))
            ->allowEmpty('publish_start');

        $validator
            ->date('publish_end', Configure::read('Writing.validation_date_time_format'))
            ->allowEmpty('publish_end');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

        $validator
            ->boolean('publish')
            ->allowEmpty('publish');

        $validator
            ->integer('published_by')
            ->allowEmpty('published_by');

        $validator
            ->integer('promoted_by')
            ->allowEmpty('promoted_by');

        $validator
            ->allowEmpty('terms');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['content_type_id'], 'ContentTypes'));
        return $rules;
    }
    
    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
    {
        foreach (['publish_start', 'publish_end'] as $key) {
            if (isset($data[$key]) && is_string($data[$key])) {
                $data[$key] = Time::parseDateTime($data[$key], Configure::read('Writing.date_time_format'));
            }
        }
    }
    
    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if (empty($options['loggedInUser'])) {
                return;
        }
        
        if(!empty($entity->publish)) {
            if($entity->publish==true) {
                $entity->set('published_by', $options['loggedInUser']);
            }
        }
        
        if(!empty($entity->promote)) {
            if($entity->promote==true) {
                $entity->set('promoted_by', $options['loggedInUser']);
            }
        }
    }
    
    public function findByType(Query $query, array $options)
    {
        $type = isset($options["type"]) ? $options["type"] : null;

        $query->contain(['ContentTypes'])->where([
            'ContentTypes.alias' => $type
        ]);
        
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
        
        return $query;
    }
    
    public function findBySlug(Query $query, array $options)
    {
        $type = isset($options["type"]) ? $options["type"] : null;
        $slug = isset($options["slug"]) ? $options["slug"] : null;

        $query->contain(['ContentTypes'])->where([
            'slug' => $slug,
            'ContentTypes.alias' => $type
        ]);
        
        return $query;
    }
    
    public function findPublished(Query $query, array $options)
    {
        $date = Time::now();

        $query->contain(['ContentTypes'])->where([
            'publish' => true,
            'publish_start <= ' => $date,
            'publish_end >= ' => $date,
        ]);
        
        return $query;
    }
    
    public function saveContent($data, $typeAlias = self::DEFAULT_TYPE)
    {
        $result = false;

        $event = new Event('Model.Node.beforeSaveNode', $this, compact('data', 'typeAlias'));
        EventManager::instance()->dispatch($event);

        $content = $this->newEntity();
        $content = $this->patchEntity($content, $event->data['data'], ['associated' => ['Taxonomies']]);
        $result = $this->save($content);

        return $result;
    }
}

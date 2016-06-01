<?php
namespace App\Model\Table;

use App\Model\Entity\Comment;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Ceeram\Blame\Event\LoggedInUserListener;

/**
 * Comments Model
 *
 */
class CommentsTable extends Table
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

        $this->table('cms.comments');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Ceeram/Blame.Blame');
        
        $this->belongsTo('Creator', [
            'className' => 'Users',
            'foreignKey' => 'created_by'
        ]);
        
        $this->belongsTo('Modifier', [
            'className' => 'Users',
            'foreignKey' => 'modified_by'
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
            ->allowEmpty('model');

        $validator
            ->integer('foreign_key')
            ->allowEmpty('foreign_key');

        $validator
            ->allowEmpty('title');

        $validator
            ->allowEmpty('body');

        $validator
            ->boolean('status')
            ->allowEmpty('status');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

        return $validator;
    }
    
    public function add($data, $model, $options = array())
    {
        $listener = new LoggedInUserListener($options['Auth']);
        $this->eventManager()->attach($listener);
        
        $comment = $this->newEntity();
        $comment = $this->patchEntity($comment, $data);
        $comment->model=$model;
        $comment->status = 1;
        
        return $this->save($comment);
    }
}

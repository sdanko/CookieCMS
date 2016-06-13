<?php
namespace App\Model\Table;

use App\Model\Entity\Link;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Links Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentLinks
 * @property \Cake\ORM\Association\BelongsTo $Menus
 * @property \Cake\ORM\Association\HasMany $ChildLinks
 */
class LinksTable extends Table
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

        $this->table('cms.links');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('ParentLinks', [
            'className' => 'Links',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Menus', [
            'foreignKey' => 'menu_id'
        ]);
        $this->hasMany('ChildLinks', [
            'className' => 'Links',
            'foreignKey' => 'parent_id'
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
            ->allowEmpty('link');

        $validator
            ->allowEmpty('title');

        $validator
            ->integer('position')
            ->allowEmpty('position');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentLinks'));
        $rules->add($rules->existsIn(['menu_id'], 'Menus'));
        return $rules;
    }
}

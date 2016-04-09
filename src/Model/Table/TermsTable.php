<?php
namespace App\Model\Table;

use App\Model\Entity\Term;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Terms Model
 *
 * @property \Cake\ORM\Association\HasMany $Taxonomies
 */
class TermsTable extends Table
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

        $this->table('cms.terms');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->hasMany('Taxonomies', [
            'foreignKey' => 'term_id'
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
            ->allowEmpty('slug');

        $validator
            ->allowEmpty('description');

        return $validator;
    }
}

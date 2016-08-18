<?php
namespace App\Model\Table;

use App\Model\Entity\Term;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\Entity;
use ArrayObject;
use Cake\Event\Event;


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
            ->notEmpty('title');

        $validator
            ->notEmpty('slug');

        $validator
            ->allowEmpty('description');

        return $validator;
    }
    
    public function beforeDelete(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        $count = $this->Taxonomies->find('all', array(
            'conditions' => array(
                    'term_id' => $entity->id,
            ),
        ))->count();
        return $count === 0;
    }
    
    public function add($data, $vocabularyId)
    {
        return $this->_save($data, $vocabularyId);
    }
    
    public function edit($data, $vocabularyId)
    {
        $id = $data['id'];
        $slug = $data['slug'];

        if ($this->hasSlugChanged($id, $slug) && $this->slugExists($slug)) {
            $edited = false;
        } else {
            $taxonomyId = !empty($data['Taxonomy']['id']) ? $data['Taxonomy']['id'] : null;        
            $edited = $this->_save($data, $vocabularyId, $taxonomyId);
        }
        return $edited;
    }
    
    public function hasSlugChanged($id, $slug)
    {
        if (!is_numeric($id) || !$this->exists(['id' => $id])) {
                throw new NotFoundException(__d('admin', 'Invalid Term Id'));
        }
        
        $term = $this->findById($id)->first();
        return $term->slug != $slug;
    }
    
    public function slugExists($slug)
    {
        return $this->exists(['slug' => $slug]);
    }
    
    protected function _save($data, $vocabularyId, $taxonomyId = null)
    {
        $added = false;

        $termId = $this->saveAndGetId($data);
        if (!$this->isInVocabulary($termId, $vocabularyId, $taxonomyId)) {
                $dataToPersist = array(
                        'parent_id' => $data['Taxonomy']['parent_id'],
                        'term_id' => $termId,
                        'vocabulary_id' => $vocabularyId,
                );
                if (!is_null($taxonomyId)) {
                    $taxonomy = $this->Taxonomies->findById($taxonomyId)->first();
                }
                else {
                    $taxonomy = $this->Taxonomies->newEntity();
                }
              
                $taxonomy = $this->Taxonomies->patchEntity($taxonomy, $dataToPersist);
                $added = $this->Taxonomies->save($taxonomy);
        }
        return $added;
    }
    
    public function isInVocabulary($id, $vocabularyId, $taxonomyId = null)
    {
        $conditions = array('term_id' => $id, 'vocabulary_id' => $vocabularyId);
        if (!is_null($taxonomyId)) {
                $conditions['Taxonomies.id !='] = $taxonomyId;
        }
        return $this->Taxonomies->exists($conditions);
    }
    
    public function saveAndGetId($data)
    {
        $dataToPersist = array(
            'title' => $data['title'],
            'slug' => $data['slug'],
            'description' => $data['description'],
        );
        
        $term = $this->findBySlug($data['slug'])->first();
        
        if(!$term) {
            $term = $this->newEntity();
        }
        
        $term = $this->patchEntity($term, $dataToPersist);
        
        if ($this->save($term)) {
                return $term->id;
        }
        
        return false;
    }
    
    public function remove($id, $vocabularyId)
    {
        $taxonomy = $this->Taxonomies->find('all', array(
              'conditions' => array(
                    'Taxonomies.term_id' => $id,
                    'Taxonomies.vocabulary_id' => $vocabularyId,
            )
        ))->first();
  
        return $this->Taxonomies->delete($taxonomy) && $this->delete($this->get($id));
    }
}

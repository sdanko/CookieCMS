<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContentTypesVocabulariesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContentTypesVocabulariesTable Test Case
 */
class ContentTypesVocabulariesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContentTypesVocabulariesTable
     */
    public $ContentTypesVocabularies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.content_types_vocabularies',
        'app.content_types',
        'app.content',
        'app.vocabularies',
        'app.taxonomies',
        'app.terms'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ContentTypesVocabularies') ? [] : ['className' => 'App\Model\Table\ContentTypesVocabulariesTable'];
        $this->ContentTypesVocabularies = TableRegistry::get('ContentTypesVocabularies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContentTypesVocabularies);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

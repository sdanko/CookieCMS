<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VocabulariesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VocabulariesTable Test Case
 */
class VocabulariesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VocabulariesTable
     */
    public $Vocabularies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vocabularies',
        'app.taxonomies',
        'app.terms',
        'app.content_types',
        'app.content',
        'app.content_types_vocabularies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Vocabularies') ? [] : ['className' => 'App\Model\Table\VocabulariesTable'];
        $this->Vocabularies = TableRegistry::get('Vocabularies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Vocabularies);

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
}

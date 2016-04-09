<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaxonomiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaxonomiesTable Test Case
 */
class TaxonomiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TaxonomiesTable
     */
    public $Taxonomies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.taxonomies',
        'app.terms',
        'app.vocabularies',
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
        $config = TableRegistry::exists('Taxonomies') ? [] : ['className' => 'App\Model\Table\TaxonomiesTable'];
        $this->Taxonomies = TableRegistry::get('Taxonomies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Taxonomies);

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

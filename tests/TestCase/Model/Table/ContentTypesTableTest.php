<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContentTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContentTypesTable Test Case
 */
class ContentTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContentTypesTable
     */
    public $ContentTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.content_types',
        'app.content'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ContentTypes') ? [] : ['className' => 'App\Model\Table\ContentTypesTable'];
        $this->ContentTypes = TableRegistry::get('ContentTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContentTypes);

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
     * Test findByAlias method
     *
     * @return void
     */
    public function testFindByAlias()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkflowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkflowsTable Test Case
 */
class WorkflowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkflowsTable
     */
    public $Workflows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.workflows',
        'app.content_types',
        'app.content',
        'app.taxonomies',
        'app.terms',
        'app.vocabularies',
        'app.content_types_vocabularies',
        'app.model_taxonomies',
        'app.comments',
        'app.creator',
        'app.roles',
        'app.users',
        'app.roles_users',
        'app.modifier',
        'app.publisher',
        'app.nodes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Workflows') ? [] : ['className' => 'App\Model\Table\WorkflowsTable'];
        $this->Workflows = TableRegistry::get('Workflows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Workflows);

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

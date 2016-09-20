<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NodesTable Test Case
 */
class NodesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NodesTable
     */
    public $Nodes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.nodes',
        'app.contents',
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
        'app.node_types',
        'app.node_statuses',
        'app.node_jobs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Nodes') ? [] : ['className' => 'App\Model\Table\NodesTable'];
        $this->Nodes = TableRegistry::get('Nodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Nodes);

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

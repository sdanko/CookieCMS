<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NodeFlowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NodeFlowsTable Test Case
 */
class NodeFlowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NodeFlowsTable
     */
    public $NodeFlows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.node_flows',
        'app.node_edges',
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
        $config = TableRegistry::exists('NodeFlows') ? [] : ['className' => 'App\Model\Table\NodeFlowsTable'];
        $this->NodeFlows = TableRegistry::get('NodeFlows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NodeFlows);

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

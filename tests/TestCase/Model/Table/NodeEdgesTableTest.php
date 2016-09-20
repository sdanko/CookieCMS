<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NodeEdgesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NodeEdgesTable Test Case
 */
class NodeEdgesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NodeEdgesTable
     */
    public $NodeEdges;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.node_edges',
        'app.node_flows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('NodeEdges') ? [] : ['className' => 'App\Model\Table\NodeEdgesTable'];
        $this->NodeEdges = TableRegistry::get('NodeEdges', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NodeEdges);

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

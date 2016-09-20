<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NodeTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NodeTypesTable Test Case
 */
class NodeTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NodeTypesTable
     */
    public $NodeTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.node_types',
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
        'app.node_statuses',
        'app.node_jobs',
        'app.node_job_types',
        'app.node_flows',
        'app.node_edges'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('NodeTypes') ? [] : ['className' => 'App\Model\Table\NodeTypesTable'];
        $this->NodeTypes = TableRegistry::get('NodeTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NodeTypes);

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

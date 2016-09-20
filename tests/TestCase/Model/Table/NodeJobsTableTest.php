<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NodeJobsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NodeJobsTable Test Case
 */
class NodeJobsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NodeJobsTable
     */
    public $NodeJobs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.node_jobs',
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
        $config = TableRegistry::exists('NodeJobs') ? [] : ['className' => 'App\Model\Table\NodeJobsTable'];
        $this->NodeJobs = TableRegistry::get('NodeJobs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NodeJobs);

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

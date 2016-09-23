<?php
namespace App\Test\TestCase\Controller;

use App\Controller\NodesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\NodesController Test Case
 */
class NodesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.nodes',
        'app.content',
        'app.taxonomies',
        'app.terms',
        'app.vocabularies',
        'app.content_types',
        'app.workflows',
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
        'app.node_jobs',
        'app.node_flows',
        'app.node_edges',
        'app.source_edge',
        'app.target_edge'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

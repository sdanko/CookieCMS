<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BlocksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BlocksTable Test Case
 */
class BlocksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BlocksTable
     */
    public $Blocks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.blocks',
        'app.regions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Blocks') ? [] : ['className' => 'App\Model\Table\BlocksTable'];
        $this->Blocks = TableRegistry::get('Blocks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Blocks);

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

    /**
     * Test findActive method
     *
     * @return void
     */
    public function testFindActive()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

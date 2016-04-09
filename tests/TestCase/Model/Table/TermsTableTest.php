<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TermsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TermsTable Test Case
 */
class TermsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TermsTable
     */
    public $Terms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.terms',
        'app.taxonomies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Terms') ? [] : ['className' => 'App\Model\Table\TermsTable'];
        $this->Terms = TableRegistry::get('Terms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Terms);

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

<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContentToDocumentTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContentToDocumentTable Test Case
 */
class ContentToDocumentTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContentToDocumentTable
     */
    public $ContentToDocument;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.content_to_document'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ContentToDocument') ? [] : ['className' => 'App\Model\Table\ContentToDocumentTable'];
        $this->ContentToDocument = TableRegistry::get('ContentToDocument', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContentToDocument);

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

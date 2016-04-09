<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContentTypesFixture
 *
 */
class ContentTypesFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'cms.content_types';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => '10', 'autoIncrement' => true, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null],
        'title' => ['type' => 'string', 'length' => '100', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        'description' => ['type' => 'string', 'length' => '510', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        'alias' => ['type' => 'string', 'length' => '510', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'title' => 'Lorem ipsum dolor sit amet',
            'description' => 'Lorem ipsum dolor sit amet',
            'alias' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}

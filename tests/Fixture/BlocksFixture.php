<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BlocksFixture
 *
 */
class BlocksFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'cms.blocks';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => '10', 'autoIncrement' => true, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null],
        'title' => ['type' => 'string', 'length' => '200', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        'alias' => ['type' => 'string', 'length' => '200', 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        'body' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'precision' => null, 'comment' => null],
        'show_title' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => 0, 'precision' => null, 'comment' => null],
        'region_id' => ['type' => 'integer', 'length' => '10', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => 0, 'precision' => null, 'comment' => null],
        'element' => ['type' => 'string', 'length' => '255', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        'class' => ['type' => 'string', 'length' => '255', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        'position' => ['type' => 'integer', 'length' => '10', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
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
            'alias' => 'Lorem ipsum dolor sit amet',
            'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'show_title' => 1,
            'region_id' => 1,
            'active' => 1,
            'element' => 'Lorem ipsum dolor sit amet',
            'class' => 'Lorem ipsum dolor sit amet',
            'position' => 1
        ],
    ];
}

<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VocabulariesFixture
 *
 */
class VocabulariesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => '10', 'autoIncrement' => true, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null],
        'title' => ['type' => 'string', 'length' => '255', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        'alias' => ['type' => 'string', 'length' => '255', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        'description' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'precision' => null, 'comment' => null],
        'required' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => 0, 'precision' => null, 'comment' => null],
        'multiple' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => 0, 'precision' => null, 'comment' => null],
        'tags' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => 0, 'precision' => null, 'comment' => null],
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
            'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'required' => 1,
            'multiple' => 1,
            'tags' => 1
        ],
    ];
}

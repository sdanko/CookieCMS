<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'cms.users';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => '10', 'autoIncrement' => true, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => 0, 'precision' => null, 'comment' => null],
        'first_name' => ['type' => 'string', 'length' => '510', 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        'middle_name' => ['type' => 'string', 'length' => '510', 'null' => true, 'default' => 'NULL', 'precision' => null, 'comment' => null, 'fixed' => null],
        'last_name' => ['type' => 'string', 'length' => '510', 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => '510', 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'length' => '510', 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null],
        'created_by' => ['type' => 'integer', 'length' => '10', 'null' => true, 'default' => 'NULL', 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null],
        'modified_by' => ['type' => 'integer', 'length' => '10', 'null' => true, 'default' => 'NULL', 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_indexes' => [
            'users_first_name' => ['type' => 'index', 'columns' => ['first_name'], 'length' => []],
            'users_middle_name' => ['type' => 'index', 'columns' => ['middle_name'], 'length' => []],
            'users_last_name' => ['type' => 'index', 'columns' => ['last_name'], 'length' => []],
            'users_email' => ['type' => 'index', 'columns' => ['email'], 'length' => []],
            'users_created_by' => ['type' => 'index', 'columns' => ['created_by'], 'length' => []],
            'users_modified_by' => ['type' => 'index', 'columns' => ['modified_by'], 'length' => []],
        ],
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
            'active' => 1,
            'first_name' => 'Lorem ipsum dolor sit amet',
            'middle_name' => 'Lorem ipsum dolor sit amet',
            'last_name' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'password' => 'Lorem ipsum dolor sit amet',
            'created' => 1457392626,
            'created_by' => 1,
            'modified' => 1457392626,
            'modified_by' => 1
        ],
    ];
}

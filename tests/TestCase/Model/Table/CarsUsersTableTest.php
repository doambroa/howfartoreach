<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CarsUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CarsUsersTable Test Case
 */
class CarsUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CarsUsersTable
     */
    public $CarsUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cars_users',
        'app.cars',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CarsUsers') ? [] : ['className' => CarsUsersTable::class];
        $this->CarsUsers = TableRegistry::get('CarsUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CarsUsers);

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

<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CarsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CarsTable Test Case
 */
class CarsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CarsTable
     */
    public $Cars;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cars',
        'app.users',
        'app.cars_users',
        'app.cars_cars_users',
        'app.cars_users_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Cars') ? [] : ['className' => CarsTable::class];
        $this->Cars = TableRegistry::get('Cars', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cars);

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

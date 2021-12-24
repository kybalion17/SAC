<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClienteRelationshipTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClienteRelationshipTable Test Case
 */
class ClienteRelationshipTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClienteRelationshipTable
     */
    public $ClienteRelationship;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ClienteRelationship',
        'app.Clientes',
        'app.Colas',
        'app.Status',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ClienteRelationship') ? [] : ['className' => ClienteRelationshipTable::class];
        $this->ClienteRelationship = TableRegistry::getTableLocator()->get('ClienteRelationship', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClienteRelationship);

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

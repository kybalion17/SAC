<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ColasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ColasTable Test Case
 */
class ColasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ColasTable
     */
    public $Colas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Colas',
        'app.ClienteRelationship',
        'app.VwDetalle',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Colas') ? [] : ['className' => ColasTable::class];
        $this->Colas = TableRegistry::getTableLocator()->get('Colas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Colas);

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

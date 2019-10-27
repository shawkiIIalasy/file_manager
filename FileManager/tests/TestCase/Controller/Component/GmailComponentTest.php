<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\GmailComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\GmailComponent Test Case
 */
class GmailComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\GmailComponent
     */
    public $Gmail;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Gmail = new GmailComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Gmail);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

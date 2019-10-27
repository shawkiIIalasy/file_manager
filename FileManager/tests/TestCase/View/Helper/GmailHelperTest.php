<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\GmailHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\GmailHelper Test Case
 */
class GmailHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\GmailHelper
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
        $view = new View();
        $this->Gmail = new GmailHelper($view);
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

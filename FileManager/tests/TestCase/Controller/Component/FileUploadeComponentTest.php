<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\FileUploadComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\FileUploadComponent Test Case
 */
class FileUploadeComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\FileUploadComponent
     */
    public $FileUploade;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->FileUploade = new FileUploadComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FileUploade);

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

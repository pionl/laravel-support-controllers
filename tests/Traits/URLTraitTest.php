<?php
namespace Tests\Traits;

use Illuminate\Support\Facades\Route;
use Tests\Mock\URLController;
use Tests\TestCase;
use Pion\Support\Controllers\Traits\URLTrait;

class URLTraitTest extends TestCase
{

    /**
     * @var URLController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();
        $this->controller = new URLController();
    }

    public function testControllerName()
    {
        $name = $this->invokeMethod($this->controller, "getControllerName");
        $this->assertEquals("URLController", $name);
    }

    public function testControllersRootNamespace() {
        $name = $this->invokeMethod($this->controller, "getControllersRootNamespace");
        $this->assertEquals("Tests\\Mock\\", $name, "The mock must return the testing namespace with the end slash");
    }

    public function testControllersRootNamespaceTrait() {
        $mock = $this->getObjectForTrait(URLTrait::class);
        $name = $this->invokeMethod($mock, "getControllersRootNamespace");
        $this->assertEquals("App\\Http\\Controllers\\", $name, "the trait should return the basic controllers folder
        with end slash");
    }

    public function testCurrentActionForName()
    {
        $return = $this->invokeMethod($this->controller, "getCurrentActionForName", [
            "test"
        ]);
        $this->assertEquals("URLController@test", $return);
    }

    public function testCurrentActionURL()
    {
        $return = $this->invokeMethod($this->controller, "getCurrentActionURL", [
            "test"
        ]);
        // in normal usage it will return standart URL
        $this->assertEquals("test:test", $return);
    }

    public function testCurrentFullURL()
    {
        $mock = $this->getMockForTrait(URLTrait::class, [],"", true, true, true, [
            "getRouter"
        ]);


        $routerMock = $this->getMock(Route::class, ["getCurrentRequest", "fullUrl"]);
        $routerMock->expects($this->once())->method("getCurrentRequest")->willReturn($routerMock);
        $routerMock->expects($this->once())->method("fullUrl")->willReturn($this->returnValue("test"));

        $mock->expects($this->once())->method("getRouter")->willReturn($routerMock);
        $this->invokeMethod($mock, "getCurrentFullURL");
    }
}

<?php
namespace Tests\Traits\Navigation;

use Pion\Support\Controllers\Traits\Navigation\AbstractNavigationTrait;
use Tests\Mock\Model;
use Tests\Mock\NavigationController;
use Tests\TestCase;

class AbstractNavigationTraitTest extends TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $mock;

    protected function setUp()
    {
        parent::setUp();
        $this->mock = $this->getMockForTrait(AbstractNavigationTrait::class);
    }

    public function setUpNavigationMock()
    {
        // the controller supprots the show method
        $this->mock = $this->getMock(NavigationController::class, [
            "addNavigation", "addCurrentNavigation", "getCurrentFullURL"
        ]);
    }

    public function testWithoutTitleAndListTitle()
    {
        $this->mock->expects($this->never())->method("addCurrentNavigation");
        $this->invokeMethod($this->mock, "createNavigation");
    }

    public function testWithTitleAndWithoutListTitle()
    {
        // e expect to call only the current navigaiton with provided title
        $this->mock->expects($this->once())->method("addCurrentNavigation")
            ->with($this->matches("test"));

        $this->mock->expects($this->never())->method("addCrumbNavigationToList");

        // call the protected method
        $this->invokeMethod($this->mock, "createNavigation", ["test"]);
    }

    public function testWithoutTitleAndWithListTitle()
    {
        $this->setProperty("listTitle", "List", $this->mock);

        // e expect to call only the current navigaiton with provided title
        $this->mock->expects($this->once())->method("addCurrentNavigation")
            ->with($this->matches("List"));

        $this->mock->expects($this->never())->method("addCrumbNavigationToList");

        // call the protected method
        $this->invokeMethod($this->mock, "createNavigation");
    }

    public function testWithTitleAndListTitleListURL()
    {
        $this->setProperty("listTitle", "List2", $this->mock);


        // test that addCrumbNavigation uses the current action url and that it
        // uses the listModelAction
        $this->mock->expects($this->once())->method("addNavigation")
            ->with($this->matches("test:index"));


        $this->mock->expects($this->once())->method("addCurrentNavigation")
            ->with($this->matches("test"));

        // call the protected method
        $this->invokeMethod($this->mock, "createNavigation", ["test"]);
    }

    public function testWithObjectWithoutListAndTitle()
    {
        $this->setUpNavigationMock();

        $this->mock->expects($this->never())->method("addCurrentNavigation");
        $this->mock->expects($this->never())->method("addCrumbNavigationToList");
        $this->mock->expects($this->once())->method("addNavigation")->with($this->matches("test:show:1"), $this->matches("test"));

        $this->invokeMethod($this->mock, "createNavigation", [
            new Model("test")
        ]);
    }

    public function testWithObjectWithoutListAndWithTitle()
    {
        // the controller supprots the show method
        $this->setUpNavigationMock();

        $this->mock->expects($this->once())->method("addCurrentNavigation")->with($this->matches("test"));
        $this->mock->expects($this->never())->method("addCrumbNavigationToList");
        $this->mock->expects($this->once())->method("addNavigation")->with(
            $this->matches("test:show:1"),
            $this->matches("test")
        );

        $this->invokeMethod($this->mock, "createNavigation", [
            "test",
            new Model("test")
        ]);
    }

    public function testWithObjectAndSameURL()
    {
        $this->setUpNavigationMock();

        $this->mock->expects($this->once())->method("getCurrentFullURL")->willReturn("test:show:1");
        $this->mock->expects($this->never())->method("addCurrentNavigation");

        $this->invokeMethod($this->mock, "createNavigation", [
            "Testuji",
            new Model("test")
        ]);
    }
}
<?php
namespace Pion\Support\Controllers\Traits;

use Illuminate\Support\Arr;

/**
 * Trait URLTrait
 *
 * Adds an easy way to get current controller name, current controller URL with action name
 *
 * @package Pion\Support\Controllers
 */
trait URLTrait {

    /**
     * Returns the current controller
     * @return string
     */
    protected function getControllerName()
    {
        // get controller from current static class
        $class = static::class;

        // explode to the controller and method name
        // and remove the base namespace
        return str_replace($this->getControllersRootNamespace(), "", Arr::get(explode("@", $class), 0));
    }

    /**
     * Builds the current route controller with given action name and parameters
     * @param string $action
     * @param array $parameters
     * @return string
     */
    protected function getCurrentActionURL($action, $parameters = [])
    {
        // build the controller name with the action
        $url = $this->getCurrentActionForName($action);

        // return the action url with given parameters
        return \URL::action($url, $parameters);
    }

    /**
     * Gets the current controller and adds the action
     * @param string $action
     * @return string
     */
    protected function getCurrentActionForName($action)
    {
        return $this->getControllerName()."@".$action;
    }

    /**
     * Returns the base namespace for controllers.
     * @return string
     */
    protected function getControllersRootNamespace()
    {
        return "App\\Http\\Controllers\\";
    }

    /**
     * Returns the full URL from current request
     * @return mixed
     */
    protected function getCurrentFullURL()
    {
        return $this->getRouter()->getCurrentRequest()->fullUrl();
    }
}
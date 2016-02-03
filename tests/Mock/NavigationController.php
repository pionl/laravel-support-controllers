<?php
namespace Tests\Mock;

use Pion\Support\Controllers\Traits\Navigation\AbstractNavigationTrait;

class NavigationController
{
    use AbstractNavigationTrait;

    /**
     * @param string $url
     * @param string $title
     * @return mixed
     */
    protected function addNavigation($url, $title)
    {
        return $this;
    }

    /**
     * @param string $title
     * @return mixed
     */
    protected function addCurrentNavigation($title)
    {
        return $this;
    }

    /**
     * Implement the detail object
     */
    public function show($id)
    {
        
    }

    public function getCurrentFullURL()
    {
        return "test";
    }
}
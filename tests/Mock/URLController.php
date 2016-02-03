<?php
namespace Tests\Mock;

use Pion\Support\Controllers\Traits\URLTrait;

class URLController
{
    use URLTrait;

    /**
     * Need to fix the get controller name which uses current class
     * @return string
     */
    protected function getControllersRootNamespace()
    {
        return __NAMESPACE__."\\";
    }

    public function test()
    {
        
    }

}
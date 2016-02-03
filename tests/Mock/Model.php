<?php
namespace Tests\Mock;

use Pion\Support\Controllers\Traits\Navigation\NavigationModelTrait;

class Model
{
    use NavigationModelTrait;
    private $name;


    /**
     * Model constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the name for the object
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    public function getKey()
    {
        return 1;
    }

}
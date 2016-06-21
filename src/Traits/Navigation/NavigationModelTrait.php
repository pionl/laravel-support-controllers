<?php
namespace Pion\Support\Controllers\Traits\Navigation;

/**
 * Class NavigationModelTrait
 *
 * Basic trait to enable returning the models name for navigation.
 *
 * @package src\Traits\Navigation
 */
trait NavigationModelTrait
{
    /**
     * Returns the name for the object
     * @return string
     */
    abstract public function getName();

    /**
     * Returns the id for the object, defaulty implemented by the Eloquent model
     * @return int
     */
    abstract public function getKey();
}
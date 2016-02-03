<?php
namespace Pion\Support\Controllers\Traits\Navigation;

/**
 * Class CrumbsNavigationTrait
 *
 * Trait that supports crumbs navigation
 *
 * @package Pion\Support\Controllers\Traits\Navigation
 */
trait CrumbsNavigationTrait
{
    use AbstractNavigationTrait;

    /**
     * Adds a crumbs link
     * @param string $url
     * @param string $title
     * @return $this
     */
    protected function addNavigation($url, $title)
    {
        \Crumbs::add($url, $title);
        return $this;
    }

    /**
     * Adds current url address via crumbs
     * @param $title
     * @return $this
     */
    protected function addCurrentNavigation($title)
    {
        \Crumbs::addCurrent($title);
        return $this;
    }
}
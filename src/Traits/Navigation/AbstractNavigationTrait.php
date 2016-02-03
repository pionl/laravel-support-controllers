<?php
namespace Pion\Support\Controllers\Traits\Navigation;

use Pion\Support\Controllers\Traits\URLTrait;

/**
 * Class AbstractNavigationTrait
 * @package Pion\Support\Controllers\Traits\Navigation
 */
trait AbstractNavigationTrait
{
    use URLTrait;

    /**
     * A list title for index page
     * @var string|null
     */
    protected $listTitle = null;

    /**
     * Defines what method action should we use for detail navigaiton. Set null
     * for disable.
     * @var string
     */
    protected $detailModelAction = "show";

    /**
     * Defines what method action should we use for list navigaiton.
     * @var string
     */
    protected $listModelAction = "index";

    /**
     * Generates the navigation with list support.
     * @param string|null   $title              you can provide model to use as modelForShow. Title will have null value
     * @param Model|null    $modelForShow      indicates if we want to show a model with show url
     */
    protected function createNavigation($title = null, $modelForShow = null)
    {

        $hasList = is_string($this->listTitle);

        // check if title is not shortcut for model
        if (is_object($title)) {
            $modelForShow = $title;
            $title = null;
        }

        // when title and no model is proveded lets add current navigation
        if (is_null($title) && is_null($modelForShow) && $hasList) {
            $this->addCurrentNavigation($this->listTitle);
        } else {

            // add the current index url
            if ($hasList) {
                $this->addCrumbNavigationToList($this->listTitle);
            }

            // detect if we want to display show for the object
            if (is_object($modelForShow) && is_string($this->detailModelAction)
                && method_exists($this, $this->detailModelAction)) {

                // get the current action url
                $detailAction = $this->getCurrentActionURL($this->detailModelAction, [
                    $modelForShow->getKey()
                ]);

                $this->addNavigation($detailAction, $modelForShow->getName());

                // if current model action is same as current url we must disable
                // the add current method
                $currentUrl = $this->getCurrentFullURL();
                if ($detailAction === $currentUrl) {
                    $title = null;
                }
            }

            // check if we can add the current value
            if (is_string($title)) {
                $this->addCurrentNavigation($title);
            }
        }
    }

    /**
     * Ads a current index action with given title to navigation
     *
     * @param string $title
     *
     * @return $this
     */
    protected function addCrumbNavigationToList($title)
    {
        $this->addNavigation($this->getCurrentActionURL($this->listModelAction), $title);
        return $this;
    }

    /**
     * Adds a navigation link
     * @param string $url
     * @param string $title
     * @return $this
     */
    abstract protected function addNavigation($url, $title);

    /**
     * Adds a current page with title
     * @param string $title
     * @return $this
     */
    abstract protected function addCurrentNavigation($title);
}
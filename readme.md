# Traits

## Requirements

- Laravel 5.1+ or 5.2+ (5.2 is not supported when the Crumbs is - not updated yet)

## Install

Without Crumbs

    composer require pion/laravel-support-controllers
    
With Crumbs

    composer require pion/laravel-support-controllers
    composer require atorscho/crumbs 2.1.5

## URLTrait
Adds a new set of protected functions for the current controller. Enables getting the
controller name with the namespace without the controllers namespace (for custom namespace overide the
"getControllersRootNamespace" method). Also you can get current url, controllers action string for URL and
controllers URL for given action.

### Methods

    getCurrentActionForName($action);
    getCurrentActionURL($action, $parameters = []);
    getControllerName();
    getCurrentFullURL();
    
## AbstractNavigationTrait
Loads the URLTrait and enables creating a navigation for a resource controller (or any controller).
Support creating current page link, current page link with a link to a list page (index page), models 
name and link to detail action (or edit and etc). Samples of url can be:

### Examples
- set listTitle on construct (list page)
- the model must implement getName function (you can use NavigationModelTrait) to enable further functions
in future

/sites - call the createNavigation() without title
Result: list page

/sites/create -  call the createNavigation("New page"); 
Result: list page -> New page

/sites/1/edit - call the createNavigation("Edit", $object); 
Result: list page -> name -> Edit

/sites/1/edit - model has no detail view, call the createNavigation("Edit", $object); 
Result: list page -> name

etc.

## CrumbsNavigationTrait

Implements the Crumbs navigation with AbstractNavigationTrait trait
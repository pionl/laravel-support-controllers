# Traits

## Requirements

- Laravel 5.1+ or 5.2+

## Install

Without Crumbs

    composer require pion/laravel-support-controllers
    
With Crumbs

    composer require pion/laravel-support-controllers
    composer require atorscho/crumbs 2.2

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

## Customizations

You can change some properties:
- `$listModelAction` the controllers action name for a list
- `$detailModelAction` the controllers action name for the detail action (default is show, can be edit if not supported)
- `$listTitle` the title for the list 

You can handle some states when the createNavigation is triggered:

### beforeAddingListNavigation($title = null, $modelToShow = null)
Triggered before adding a list navigation. Called only if list page is supported

### beforeAddingModelActionNavigation($model, $title = null)
Triggered before the model action is added (edit/show/etc)

### addCrumbNavigationToList
Calls the addNavigation with list action

### addCrumbNavigationForModel
Calls the addNavigation with given url and the model names, method must return bool if the navigation was added.


## CrumbsNavigationTrait

Implements the Crumbs navigation with AbstractNavigationTrait trait
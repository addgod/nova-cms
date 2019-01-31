# NovaCMS
A customizeable CMS for Laravel Nova.

Made for nova, with nova, using nova. 

## Features 
- Custom components, build with pure nova fields.
- Supports both native nova fields, and custom nova fields.

## Installations
First install the composer packages.
```
composer install addgod\nova-cms
```

Then publish all the files. It will publish a resource, to be used in app\Nova, plus it add examples on how to use the data coming from the pages, in blade files.
```
php artisan vendor:publish Addgod\NovaCms\ToolServiceProvider
```

## Usage
To use this package, navigate to app\Nova\Page.php. Here there is some example code, on how to build up the components, that can be used on each page.

The components, and the represented blade files in the resources\views\nova-cms\components folder. 

## Known issues.
When removing a nested component, it will always remove the last component, no matter witch one is clicked on.

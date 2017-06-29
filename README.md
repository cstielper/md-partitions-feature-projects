# MD Partitions Feature Projects

Everything you should need for this is below. I have not grabbed anything in the way of styling. You will need to grab that from the [GitHub page](https://github.com/rejas/imagelightbox). I have the most recent version of the main script [here](lightbox.js).

1. [Import the ACF fields](feature-projects.json)
2. Add [these functions](functions.php) to your functions.php file

Call the function in your template file:
```php
if( function_exists('md_partitions_project_listing') ): md_partitions_project_listing(); endif;
```
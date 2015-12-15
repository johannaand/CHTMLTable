# chtmltable
PHP classes for simply output an HTML-table from a database table.

The package exists of a controller class, TableController, a simple class CHTMLTable and a DatabaseModel base class. 
The controller receives a databasemodel object, 
and uses CHTMLTable to create an html table string from it. There are also a view-file, 
a front-controller and a model class to be used for testing the package. 
The class CHTMLTable can also be used separately to make an html table-string from an array.   

The packages works with ANAX-MVC Framework, https://github.com/mosbth/Anax-MVC

Before using the package:
* The package uses the package mos/cdatabase, and the database config-file need to be changed and
moved to the right place in the Anax-MVC. See cdatabase documentation at 
http://dbwebb.se/opensource/cdatabase for more information.
* Move front-controller file table.php from jovis/chtmltable/webroot to Anax webroot
* Move chtmltable/view/list-all.tpl.php to a new directory Anax app/view/table/

The front-controller file uses a controller action to initiate the database table for testing.

This package is created as an assignment at a course in PHP MVC Framework at Blekingen Tekniska H�gskola.

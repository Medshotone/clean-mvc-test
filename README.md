# Information storage about movies on pure php with MVC

## Requirements
php 7.4, mysql 8.0.25 (can be tried to run on mysql 5.6+)

## Application launch instructions

### To launch the application:
1) Create a database and import database structure files
2) Fill in and rename the configuration file
3) Start the web server

### Create a database and import the database structure file
It is necessary to create a database in mysql and import .sql files from the database/migration folder in ascending order of the first number

### Fill in and rename the configuration file
It is necessary to rename the configuration file in the config folder from config.example.php to config.php

### Start the web server
For development, you can use the PHP local server for this, you need to run php -S localhost:8080 in the root folder of the web application.


## Overview and explanation of the application architecture

### Development
For development, additional functionality is implemented which is located in lib/Dev.php which can be connected in config/config.php

### Configuration file
The configuration file is connected globally. The default configuration parameters are presented in config/config.example.php

### Routing
Routing occurs according to the data of the routes/routes.php file where you can configure the available URLs and which function
they should lead to the controller. URLs support preg_match patterns. There is a special pattern (\d+) that allows you to transfer
the id to the function.

### Core MVC + Router
The MVC pattern is used in the web application. The choice fell on MVC because this pattern is popular and most familiar to me.
The default MVC classes and the class of work with routes are located in the app/core folder.
Basic database queries are implemented in the Model for convenience.
In the View, the functionality is implemented that connects the common layout for all pages.
In the Router, the functionality for working with URLs is implemented according to the routes/routes.php file

### Extends Controllers
Inheritable controller files are located in the app/controllers folder and must contain the word Controller at the end of the
class and file name.

### Extends Models
Inheritable model files are located in the app/models folder, the class and file name must match the table in the
database they work with, without the letter s. That is, for the films table, there should be a Film model. It is desirable to specify
the $fillable parameter in the model, with an array of available tables for writing.

### Views and public data
Page templates are located in the app/views folder. There is one mandatory template that is common to all pages app/views/layout.php
Public data, that is, everything that can be statically loaded on the page, is located in the public folder.

### Traits as common functionality for classes.
Traits are located in the app/traits folder and must contain the word Trait at the end of the file and class.
Used to create functionality that may be useful in different classes.

### Validation of input data
Classes with data validation are located in the app/validation folder and must contain the word Trait at the end of the class and file.
Validation is implemented through traits so that it is possible to attach to the necessary classes.

### Connecting to the database and migrations
The class for connecting to the database is located in database/Db.php. Implemented with the Singleton pattern to use everywhere
one connection to the database.
Migration files are located in database/migration. Migration is performed manually, by importing files into the database.

### index.php - entry point of the application
The file for the entry point of the application is index.php. It includes the global configuration file, the development file, the autoloader using spl_autoload_register, the start of the session, and the call of the router.

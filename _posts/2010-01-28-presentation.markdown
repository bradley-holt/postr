Zend Framework Introduction
===========================

Burlington, Vermont PHP Users Group

January 28, 2010

Examples from a demo blogging application named Postr are used throughout this
presentation. You can view, download, or fork the demo web application on GitHub:

[http://github.com/bradley-holt/postr](http://github.com/bradley-holt/postr)

Markdown text of this presentation can be found here:

http://github.com/bradley-holt/postr/blob/gh-pages/_posts/2010-01-28-presentation.markdown

Zend_Tool
---------

* Automated scaffolding of project and project components
* Used in creating the demo application, Postr
* Referenced throughout this presentation

Create a Project
----------------

    mkdir postr
    cd postr
    zf create project .

Project Structure
-----------------

    .zfproject.xml
    application/
        Bootstrap.php
        configs/
            application.ini
        controllers/
            ErrorController.php
            IndexController.php
        views/
            scripts/
                error/
                    error.phtml
                index/
                    index.phtml
    public/
        .htaccess
        index.php
    tests/
        application/
            bootstrap.php
        library/
            bootstrap.php
        phpunit.xml

Front Controller
----------------

* All HTTP requests for the application go through one script.
* Apache's rewrite module (or equivalent) makes this happen.

See:

* [Front Controller pattern](http://en.wikipedia.org/wiki/Front_Controller_pattern)
* [`public/index.php`](http://github.com/bradley-holt/postr/blob/master/public/index.php)
* [`public/.htaccess`](http://github.com/bradley-holt/postr/blob/master/public/.htaccess)

Zend_Application
----------------

* Bootstraps the application
* Provides reusable resources
* Sets up PHP environment

See:

* [Zend_Application](http://framework.zend.com/manual/en/zend.application.html)
* [`application/Bootstrap.php`](http://github.com/bradley-holt/postr/blob/master/application/Bootstrap.php)

Configuration
-------------

* Default configuration is in `application/configs/application.ini`
* Allows for configuration sections; for example:
  * production
  * staging
  * testing
  * development
* Sections can inherit from other sections

See:

* [`application/configs/application.ini`](http://github.com/bradley-holt/postr/blob/master/application/configs/application.ini)

Name the Project
----------------

Default application class name prefix is `Application_`.

    zf change application.class-name-prefix Postr_

Updated Configuration
---------------------

Added to `application/configs/application.ini`:

    [production]
    appnamespace = "Postr_"

See:

* [`application/configs/application.ini`](http://github.com/bradley-holt/postr/blob/master/application/configs/application.ini)

Model-View-Controller (MVC)
---------------------------

* Composite of several design patterns
* Isolates domain logic from input and presentation
* Model: domain logic
* View: presentation layer
* Controller: interprets input and passes it to the Model; provides Model data to the View 

See:

* [Model-view-controller](http://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)
* [`application/models/`](http://github.com/bradley-holt/postr/tree/master/application/models/)
* [`application/views/`](http://github.com/bradley-holt/postr/tree/master/application/views/)
* [`application/controllers/`](http://github.com/bradley-holt/postr/tree/master/application/controllers/)


Zend_Layout
-----------

* Implementation of the Two Step View pattern
* Allows for consistent layout across multiple pages
* Easier to manage than "includes"

See:

* [Zend_Layout](http://framework.zend.com/manual/en/zend.layout.html)
* [Two Step View](http://martinfowler.com/eaaCatalog/twoStepView.html)

Enable Layout
-------------

    zf enable layout
    
Layout View Script
------------------

    application/
        layouts/
            scripts/
                layout.phtml

Added to `application/configs/application.ini`:

    [production]
    resources.layout.layoutPath = APPLICATION_PATH "/layouts/scripts/"

See:

* [`application/layouts/scripts/layout.phtml`](http://github.com/bradley-holt/postr/blob/master/application/layouts/scripts/layout.phtml)
* [`application/configs/application.ini`](http://github.com/bradley-holt/postr/blob/master/application/configs/application.ini)

Controllers
-----------

* Connects the Model and the View
* Contains one or more actions
* URL based routing typically decides what controller and action to execute:
  `:controller/:action`
* Custom routing options available

View Scripts
------------

* PHP templates
* No domain logic please!
* Default suffix of `.phtml`
* One view script per controller action (by default)

Create a Controller
-------------------

    zf create controller Entry

Entry Controller and View Script
--------------------------------

    application/
        controllers/
            EntryController.php
        views/
            scripts/
                entry/
                    index.phtml
    tests/
        application/
            controllers/
                EntryControllerTest.php

See:

* [`application/controllers/EntryController.php`](http://github.com/bradley-holt/postr/blob/master/application/controllers/EntryController.php)
* [`application/views/scripts/entry/index.phtml`](http://github.com/bradley-holt/postr/blob/master/application/views/scripts/entry/index.phtml)
* [`tests/application/controllers/EntryControllerTest.php`](http://github.com/bradley-holt/postr/blob/master/tests/application/controllers/EntryControllerTest.php)

Create Additionl Controller Actions
-----------------------------------

    zf create action new Entry
    zf create action get Entry
    zf create action edit Entry
    zf create action post Entry
    zf create action put Entry
    zf create action delete Entry

Entry Actions
-------------

Methods added to `application/controllers/EntryController.php`:

* `newAction()`
* `getAction()`
* `editAction()`
* `postAction()`
* `putAction()`
* `deleteAction()`

View scripts created:

    application/
        views/
            scripts/
                entry/
                    delete.phtml
                    edit.phtml
                    get.phtml
                    new.phtml
                    post.phtml
                    put.phtml

See:

* [`application/controllers/EntryController.php`](http://github.com/bradley-holt/postr/blob/master/application/controllers/EntryController.php)
* [`application/views/scripts/entry/`](http://github.com/bradley-holt/postr/tree/master/application/views/scripts/entry/)

Zend_Test
---------

* Functional (end-to-end) testing of controllers
* Simulates HTTP requests to the application
* No web server required 
* Also provides a DB testing facility

See:

* [Zend_Test](http://framework.zend.com/manual/en/zend.test.html)
* [Functional Test](http://c2.com/cgi/wiki?FunctionalTest)
* [`tests/application/controllers/EntryControllerTest.php`](http://github.com/bradley-holt/postr/blob/master/tests/application/controllers/EntryControllerTest.php)

Models
------

* Models are specific to your domain
* No such thing as one-size-fits all models
* No Zend_Model
* However, some useful patterns have emerged

Create a Model
--------------

    zf create model Entry

Entry Model
-----------

    application/
        models/
            Entry.php

See:

* [`application/models/Entry.php`](http://github.com/bradley-holt/postr/blob/master/application/models/Entry.php)

Zend_Form
---------

* Input filtering
* Input validation
* Form and element rendering
* Huge time saver

See:

* [Zend_Form](http://framework.zend.com/manual/en/zend.form.html)
* [Zend_Filter](http://framework.zend.com/manual/en/zend.filter.html)
* [Zend_Validate](http://framework.zend.com/manual/en/zend.validate.html)

Create a Form
-------------

    zf create form Entry

Entry Form
----------

    application/
        forms/
            Entry.php

See:

* [`application/forms/Entry.php`](http://github.com/bradley-holt/postr/blob/master/application/forms/Entry.php)

Zend_Db_Table
-------------

* Object-oriented database interface
* Implements the Table Data Gateway and Row Data Gateway patterns

See:

* [Table Data Gateway](http://www.martinfowler.com/eaaCatalog/tableDataGateway.html)
* [Row Data Gateway](http://www.martinfowler.com/eaaCatalog/rowDataGateway.html)

Configure a DB Adapter
----------------------

    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/production.db"
    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/staging.db" -s staging
    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/testing.db" -s testing
    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/development.db" -s development

Updated Configuration
---------------------

Added to `application/configs/application.ini`:

    [production]
    resources.db.adapter = "Pdo_Sqlite"
    resources.db.params.dbname = APPLICATION_PATH "/../data/db/production.db"
    
    [staging : production]
    resources.db.adapter = "Pdo_Sqlite"
    resources.db.params.dbname = APPLICATION_PATH "/../data/db/staging.db"
    
    [testing : production]
    resources.db.adapter = "Pdo_Sqlite"
    resources.db.params.dbname = APPLICATION_PATH "/../data/db/testing.db"
    
    [development : production]
    resources.db.adapter = "Pdo_Sqlite"
    resources.db.params.dbname = APPLICATION_PATH "/../data/db/development.db"

See:

* [`application/configs/application.ini`](http://github.com/bradley-holt/postr/blob/master/application/configs/application.ini)

Load DB Schema
--------------

Project-specific and not built-in to Zend Framework:

    mkdir -p data/db
    php scripts/load.sqlite.php

See:

* [`scripts/load.sqlite.php`](http://github.com/bradley-holt/postr/blob/master/scripts/load.sqlite.php)
* [`scripts/schema.sqlite.sql`](http://github.com/bradley-holt/postr/blob/master/scripts/schema.sqlite.sql)

Create DB Tables from the Database
----------------------------------

    zf create dbtable.from-database

Entry and Entry Tag DB Tables
-----------------------------

    application/
        models/
            DbTable/
                Entry.php
                EntryTag.php

See:

* [`application/models/DbTable/Entry.php`](http://github.com/bradley-holt/postr/blob/master/application/models/DbTable/Entry.php)
* [`application/models/DbTable/EntryTag.php`](http://github.com/bradley-holt/postr/blob/master/application/models/DbTable/EntryTag.php)

Data Mapper
-----------

* Keeps your domain logic isolated from your database implementation
* Domain objects should not directly use data mappers

See:

* [Data Mapper](http://martinfowler.com/eaaCatalog/dataMapper.html)

Create a Data Mapper
--------------------

    zf create model EntryMapper

Entry Mapper
------------

    application/
        models/
            EntryMapper.php

See:

* [`application/models/EntryMapper.php`](http://github.com/bradley-holt/postr/blob/master/application/models/EntryMapper.php)

Zend_Paginator
--------------

* Pagination for database or any arbitrary data
* Several adapters available:
  * Array
  * DbSelect
  * DbTableSelect
  * Iterator
  * Null
  * Write your own in order to paginate domain objects

See:

* [Zend_Paginator](http://framework.zend.com/manual/en/zend.paginator.html)

Create a Paginator Adapter
--------------------------

    zf create model EntryPaginatorAdapter

Entry Paginator Adapter
-----------------------

    application/
        models/
            EntryPaginatorAdapter.php

See:

* [`application/models/EntryPaginatorAdapter.php`](http://github.com/bradley-holt/postr/blob/master/application/models/EntryPaginatorAdapter.php)

Zend_Date
---------

* Manipulate dates and times
* Useful for date and time calculations
* Allows for input from and output to various formats
* Used as a domain object in the Postr demo application:
  * Entry Updated
  * Entry Published

See:

* [Zend_Date](http://framework.zend.com/manual/en/zend.date.html)
* [`application/models/Entry.php`](http://github.com/bradley-holt/postr/blob/master/application/models/Entry.php)

Zend_Markup
-----------

* Renders BBcode or Textile markup into HTML or other formats
* Extensible so may see other markup languages in the future
* Used in the Postr demo application:
  * Entry Content and Entry Summary are stored as Textile markup
  * Entry Content and Entry Summary can optionally be retrieved as HTML

See:

* [Zend_Markup](http://framework.zend.com/manual/en/zend.markup.html)
* [BBCode](http://en.wikipedia.org/wiki/BBCode)
* [Textile](http://en.wikipedia.org/wiki/Textile_%28markup_language%29)
* [`application/models/Entry.php`](http://github.com/bradley-holt/postr/blob/master/application/models/Entry.php)

Zend_Navigation
---------------

* Create menus, breadcrumbs, links, and sitemaps
* Used to create the menu navigation in the Postr demo application

See:

* [Zend_Navigation](http://framework.zend.com/manual/en/zend.navigation.html)
* [`application/Bootstrap.php`](http://github.com/bradley-holt/postr/blob/master/application/Bootstrap.php)
* [`application/layouts/scripts/header.phtml`](http://github.com/bradley-holt/postr/blob/master/application/layouts/scripts/header.phtml)

Controller Plugins
------------------

* Allows developers to hook into various events during the controller process:
  * `routeStartup()`
  * `dispatchLoopStartup()`
  * `preDispatch()`
  * `postDispatch()`
  * `dispatchLoopShutdown()`
  * `routeShutdown()`

See:

* [Controller Plugins](http://framework.zend.com/manual/en/zend.controller.plugins.html)
* [`application/plugins/RouteContext.php`](http://github.com/bradley-holt/postr/blob/master/application/plugins/RouteContext.php)

References
----------

* Bradley Holt's demo application: [Postr](http://github.com/bradley-holt/postr)
* [Zend Framework Quick Start](http://framework.zend.com/docs/quickstart)
* Matthew Weier O'Phinney's demo application: [Pastebin](http://github.com/weierophinney/pastebin)
* Zend Framework [Programmer's Reference Guide](http://framework.zend.com/manual/en/)

Credits
-------

Author: Bradley Holt

Layout & Design: Jason Pelletier

This presenation licensed under a [Creative Commons -- Attribution 3.0 United
States License.](http://creativecommons.org/licenses/by/3.0/us/)

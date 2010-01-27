Zend Framework Introduction
===========================

Burlington, Vermont PHP Users Group

January 28, 2010

Examples from a demo blogging application named Postr are used throughout this
presentation. You can view, download, or fork the demo web application on GitHub:

[http://github.com/bradley-holt/postr](http://github.com/bradley-holt/postr)

Zend_Tool
---------

Automated scaffolding of project and project components

### Create a Project

    mkdir postr
    cd postr
    zf create project .

### Project Structure Created

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

### Name the Project

    zf change application.class-name-prefix Postr_

### Updated Configuration

Added to `application/configs/application.ini`:

    [production]
    appnamespace = "Postr_"

See:

* [`application/configs/application.ini`](http://github.com/bradley-holt/postr/blob/master/application/configs/application.ini)

### Enably Layout

    zf enable layout
    
### Layout View Script Created

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

### Create a Controller

    zf create controller Entry

### Controller Created

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

### Create Controller Actions

    zf create action new Entry
    zf create action get Entry
    zf create action edit Entry
    zf create action post Entry
    zf create action put Entry
    zf create action delete Entry

### Controller Actions Created

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

### Create a Model

    zf create model Entry

### Model Created

    application/
        models/
            Entry.php

See:

* [`application/models/Entry.php`](http://github.com/bradley-holt/postr/blob/master/application/models/Entry.php)

### Create a Form

    zf create form Entry

### Form Created

    application/
        forms/
            Entry.php

See:

* [`application/forms/Entry.php`](http://github.com/bradley-holt/postr/blob/master/application/forms/Entry.php)

### Configure a DB Adapter

    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/production.db"
    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/staging.db" -s staging
    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/testing.db" -s testing
    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/development.db" -s development

### Updated Configuration

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

### Load DB Schema

This step is project-specific and not part of `Zend_Tool`:

    mkdir -p data/db
    php scripts/load.sqlite.php

See:

* [`scripts/load.sqlite.php`](http://github.com/bradley-holt/postr/blob/master/scripts/load.sqlite.php)
* [`scripts/schema.sqlite.sql`](http://github.com/bradley-holt/postr/blob/master/scripts/schema.sqlite.sql)

### Create DB Table from the Database

    zf create dbtable.from-database

### DB Table Created

    application/
        models/
            DbTable/
                Entry.php
                EntryTag.php

See:

* [`application/models/DbTable/Entry.php`](http://github.com/bradley-holt/postr/blob/master/application/models/DbTable/Entry.php)
* [`application/models/DbTable/EntryTag.php`](http://github.com/bradley-holt/postr/blob/master/application/models/DbTable/EntryTag.php)

### Create a Data Mapper

    zf create model EntryMapper

### Data Mapper Created

    application/
        models/
            EntryMapper.php

See:

* [`application/models/EntryMapper.php`](http://github.com/bradley-holt/postr/blob/master/application/models/EntryMapper.php)

### Create a Paginator Adapter

    zf create model EntryPaginatorAdapter

### Paginator Adapter Created

    application/
        models/
            EntryPaginatorAdapter.php

See:

* [`application/models/EntryPaginatorAdapter.php`](http://github.com/bradley-holt/postr/blob/master/application/models/EntryPaginatorAdapter.php)

Zend_Application
----------------

Model-View-Controller (MVC)
---------------------------

Zend_Layout
-----------

Zend_Test
---------

Zend_Form
---------

Zend_Date
---------

Zend_Db_Table
-------------

Zend_Markup
-----------

Zend_Paginator
--------------

Zend_Navigation
---------------

Controller Plugins
------------------

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

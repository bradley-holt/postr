Zend Framework Introduction
===========================

Zend_Tool
---------

Automated scaffolding of project and project components

### Create a Project

    mkdir postr
    cd postr
    zf create project .

### Project

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

### Named Project

Added to application/configs/application.ini:

    [production]
    appnamespace = "Postr_"

### Enably Layout

    zf enable layout
    
### Layout Enabled

    application/
        layouts/
            scripts/
                layout.phtml

application/configs/application.ini

    [production]
    resources.layout.layoutPath = APPLICATION_PATH "/layouts/scripts/"

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

### Create Controller Actions

    zf create action get Entry
    zf create action post Entry
    zf create action put Entry
    zf create action delete Entry

### Actions Created

Added to application/controllers/EntryController.php:

    getAction()
    postAction()
    putAction()
    deleteAction()

View scripts created:

    application/
        views/
            scripts/
                entry/
                    delete.phtml
                    get.phtml
                    post.phtml
                    put.phtml


### Create a Model

    zf create model Entry

### Model Created

    application/
        models/
            Entry.php

### Create a Form

    zf create form Entry

### Form Created

    application/
        forms/
            Entry.php

### Configure a DB Adapter

    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/production.db"
    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/staging.db" -s staging
    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/testing.db" -s testing
    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/development.db" -s development

### DB Configuration

Added to application/configs/application.ini:

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

### Load DB Schema

This step is project-specific and not part of Zend_Tool:

    mkdir -p data/db
    php scripts/load.sqlite.php

### Create DB Table(s) from the Database

    zf create dbtable.from-database

### DB Table(s) Created

    application/
        models/
            DbTable/
                Entry.php

### Create a Data Mapper

    zf create model EntryMapper

### Data Mapper Created

    application/
        models/
            EntryMapper.php

### Create a Paginator Adapter

    zf create model EntryPaginatorAdapter

### Paginator Adapter Created

    application/
        models/
            PaginatorAdapter.php

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

Credits
-------

Author: Bradley Holt

Layout & Design: Jason Pelletier

This presenation licensed under a [Creative Commons — Attribution 3.0 United
States License.](http://creativecommons.org/licenses/by/3.0/us/)

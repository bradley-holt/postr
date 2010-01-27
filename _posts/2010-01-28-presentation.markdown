Zend Framework Introduction
===========================

Zend_Tool
---------

Automated scaffolding of project and project components

### Create a Project

    mkdir postr
    cd postr
    zf create project .

### Name the Project

    zf change application.class-name-prefix Postr_

### Enably Layout

    zf enable layout

### Create a Controller

    zf create controller Entry

### Create Controller Actions

    zf create action get Entry
    zf create action post Entry
    zf create action put Entry
    zf create action delete Entry

### Create a Model

    zf create model Entry

### Create a Form

    zf create form Entry

### Configure a DB Adapter

    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/production.db"
    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/staging.db" -s staging
    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/testing.db" -s testing
    zf configure dbadapter "adapter=Pdo_Sqlite&dbname=../data/db/development.db" -s development

### Load DB Schema

This step is project-specific and not part of Zend_Tool:

    mkdir -p data/db
    php scripts/load.sqlite.php

### Create DB Tables from the Database

    zf create dbtable.from-database

### Create a Data Mapper

    zf create model EntryMapper

### Create a Paginator Adapter

    zf create model EntryPaginatorAdapter

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

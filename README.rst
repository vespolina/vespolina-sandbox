Vespolina - Symfony2 ecommerce platform
=======================================

General Info
------------

The purpose of this project is to create an expandable ecommerce platform, built on interchangeable libraries that can be used independently of Vespolina, all managed by configurable processes and whenever possible, using established standards.

State of the Project
--------------------

Vespolina is in early stages.  We are currently in the progress of developing a sandbox which uses several Vespolina libraries.
A demo is available on http://try.vespolina.org with several deployed use cases.

Some of the libraries are already been used in production.  Information about basic functionality can be found on the
[wiki][vespolina_wiki] .  We love to hear your comments on our current understanding of different ecommerce scenarios.  You can find more information on the wiki such as use cases and process flow diagrams.

[vespolina_wiki]: https://github.com/vespolina/vespolina-sandbox/wiki


Contact
-------
* IRC on irc.freenode.org channel #vespolina
* [Google Groups Mailinglist](http://groups.google.com/group/vespolina-dev)

Requirements
------------

Symfony is only supported on PHP 5.3.4 and up. To check the compatibility of
your environment with Symfony, you can run the `web/check.php` script, bundled
with this sandbox. Also, you will need the mongodb driver for php, provided by
the mongo php extension.

Installation
------------

  1. Clone the git repository and move into that directory:

        $ git clone git://github.com/vespolina/vespolina-sandbox.git

        $ cd vespolina-sandbox/

  2. Setup file permissions: see http://symfony.com/doc/current/book/installation.html#configuration-and-setup

        $ mkdir app/cache

        $ mkdir app/logs

        $ chmod a+w app/cache/ app/logs/

        $ chmod a+x app/console

  3. Copy and adjust the configuration file
   
        $ cp app/config/parameters.yml.dist app/config/parameters.yml

  4. Initialize and install the vendors:

        $ curl -s http://getcomposer.org/installer | php

        $ php composer.phar install

  5. Set up the store
        $ php app/console vespolina:store-setup [--country="xx"] [--state="xx"][--type="beverages"]

Automated Tests
---------------

To run the automated test suite you must have [PHPUnit 3.5][phpunit]
installed, which is available on [GitHub][phpunit_github]. Once installed, run
the test suite using the `phpunit` command:

    $ cd app/
    $ phpunit

To customize PHPUnit configuration for your environment, copy
`app/phpunit.xml.dist` to `app/phpunit.xml` and add your
customization there.

[phpunit]: http://www.phpunit.de
[phpunit_github]: http://github.com/sebastianbergmann/phpunit

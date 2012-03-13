Vespolina - Symfony2 ecommerce
==============================

General Info
------------

The purpose of this project is to create an expandable Symfony2 based ecommerce platform, built on interchangeable bundles that can be used independently of Vespolina, all managed by a configurable workflow process and whenever possible, using established standards.

State of the Project
--------------------

Vespolina is in very early stages.  We are currently in the design phase and are gathering functional needs which you can find on the
[wiki][vespolina_wiki] .  We love to hear your comments on our current understanding of different ecommerce scenarios.  You can find more information on the wiki such as use cases and process flow diagrams.

[vespolina_wiki]: https://github.com/vespolina/vespolina/wiki


Contact
-------
* [Google Groups Mailinglist](http://groups.google.com/group/vespolina-dev)
* IRC on irc.freenode.org channel #vespolina

Requirements
------------

Symfony is only supported on PHP 5.3.2 and up. To check the compatibility of
your environment with Symfony, you can run the `web/check.php` script, bundled
with this sandbox.

Installation
------------

  1. Clone the git repository and move into that directory:

        $ git clone git://github.com/vespolina/vespolina-sandbox.git

        $ cd vespolina/

  2. Setup file permissions: see http://symfony.com/doc/current/book/installation.html#configuration-and-setup

        $ chmod a+w app/cache/ app/logs/

        $ chmod a+x app/console

  3. Copy and adjust the configuration file
   
        $ cp app/config/parameters.yml.dist app/config/parameters.yml

  4. Initialize and install the vendors:

        $ curl -s http://getcomposer.org/installer | php

        $ php composer.phar install

  5. Set up the store
        $ php app/console vespolina:setup [--country="xx"] [--type="fashion"]

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

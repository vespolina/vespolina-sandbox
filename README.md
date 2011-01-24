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

We have a chat meeting every Wednesday at 20h UTC

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

        $ git clone git@github.com:vespolina/vespolina.git
        $ cd vespolina/

  2. Initialize and update the submodules:

        $ git submodule update --init

  3. Setup file permissions:

        $ chmod a+w app/cache/ app/logs/
        $ chmod a+x app/console

Automated Tests
---------------

To run the automated test suite you must have [PHPUnit 3.5][phpunit]
installed, which is available on [GitHub][phpunit_github]. Once installed, run
the test suite using the `phpunit` command:

    $ phpunit -c frontend

To customize PHPUnit configuration for your environment, copy
`frontend/phpunit.xml.dist` to `frontend/phpunit.xml` and add your
customization there.

[phpunit]: http://www.phpunit.de
[phpunit_github]: http://github.com/sebastianbergmann/phpunit



Development
-----------

We are using git flow for our development workflow.  You can find read 
this [overview][gitflow_overview] and install [git flow][gitflow_github].

You can set configs

[gitflow_overview]: http://jeffkreeftmeijer.com/2010/why-arent-you-using-git-flow/
[gitflow_github]: https://github.com/nvie/gitflow

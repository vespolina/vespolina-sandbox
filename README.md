Vespolina - Symfony2 ecommerce
==============================

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

Documentation
-------------

Vespolina is in very early stages.  You can find some documentation in the 
[wiki][vespolina_wiki].

[vespolina_wiki]: https://github.com/vespolina/vespolina/wiki

Development
-----------

We are using git flow for our development workflow.  You can find read 
this [overview][gitflow_overview] and install [git flow][gitflow_github].

You can set configs

[gitflow_overview]: http://jeffkreeftmeijer.com/2010/why-arent-you-using-git-flow/
[gitflow_github]: https://github.com/nvie/gitflow

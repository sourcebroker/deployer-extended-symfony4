
deployer-extended-symfony4
==========================

    .. image:: https://img.shields.io/badge/license-MIT-blue.svg?style=flat
       :target: https://packagist.org/packages/sourcebroker/deployer-extended-symfony4

.. contents:: :local:

What does it do?
----------------

This package provides deploy task for deploying Symfony4 with deployer (deployer.org).

This "deploy" task depends on:

- `sourcebroker/deployer-extended`_ package which provides some deployer tasks that can be used for any framework or CMS

Additionally this package depends on two more packages that are not used directly for deploy but are useful
to database and media synchronization:

- `sourcebroker/deployer-extended-database`_ package which provides some php framework independent tasks
  to synchronize database

- `sourcebroker/deployer-extended-media`_  package which provides some php framework independent tasks
  to synchronize media


Installation
------------

1) Install with composer:
   ::

      composer require sourcebroker/deployer-extended-symfony4

2) If you are using deployer as composer package then just put following line in your deploy.php:
   ::

      new \SourceBroker\DeployerExtendedSymfony4\Loader();

3) If you are using deployer as phar then put following lines in your deploy.php:
   ::

      require_once(__DIR__ . '/vendor/sourcebroker/deployer-loader/autoload.php');
      new \SourceBroker\DeployerExtendedSymfony4\Loader();

4) Remove task "deploy" from your deploy.php. Otherwise you will overwrite deploy task defined in
   vendor/SourceBroker/deployer-extended-symfony4/deployer/deploy/task/deploy.php


Synchronizing database
----------------------

Database synchronization is done with `sourcebroker/deployer-extended-database`.

The command for synchronizing database from live media to local instance is:
::

   dep db:pull [instance]



Synchronizing media
-------------------

Media synchronization is done with `sourcebroker/deployer-extended-media`.

The command for synchronizing local media folders with live media folders is:
::

   dep media:pull [instance]


.. _sourcebroker/deployer-extended: https://github.com/sourcebroker/deployer-extended
.. _sourcebroker/deployer-extended-media: https://github.com/sourcebroker/deployer-extended-media
.. _sourcebroker/deployer-extended-database: https://github.com/sourcebroker/deployer-extended-database

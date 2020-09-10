
Changelog
---------

master
~~~~~~

1) [BREAKING] Increase deployer/dist version, and deployer-extended-* stack.
2) [BREAKING] Modify deploy tasks order / add new tasks to deploy.
3) [TASK] Remove settings which are default in new deployer (ssh_multiplexing, ssh_type). Add ``web_path``.
4) [TASK] Add buffer settings.
5) [BREAKING] Change shared file from .env to .env.local.
6) [TASK] Load deployer-loader settings.
7) [BREAKING] Remove ``bin_dir`` / ``var_dir``, refactor ``bin/console`` and ``console_options``.
8) [TASK] Set ``default_timeout`` to 900 sec.
9) [BREAKING] Remove ``default_stage`` and ``db_instance`` as they are not needed in new deployer-extended-* stack.
10) [BREAKING] Remove getInstanceName method from Symfony4Driver because its not longer used.


1.0.2
~~~~~

1) [BUGFIX] Symfony Dotenv->loadEnv available in Symfony Dotenv 4.2+ so increase composer dependency.

1.0.1
~~~~~

1) Documentation fixes.

1.0.0
~~~~~

1) Init version

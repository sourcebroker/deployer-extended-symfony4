<?php

namespace Deployer;

task('deploy', [

    // Read more on https://github.com/sourcebroker/deployer-extended#deploy-check-lock
    'deploy:check_lock',

    // Read more on https://github.com/sourcebroker/deployer-extended#deploy-check-composer-install
    'deploy:check_composer_install',

    // Standard deployer deploy:prepare
    'deploy:prepare',

    // Standard deployer deploy:lock
    'deploy:lock',

    // Standard deployer deploy:release
    'deploy:release',

    // Standard deployer deploy:update_code
    'deploy:update_code',

    // Special for symfony4
    'deploy:create_cache_dir',

    // Standard deployer deploy:shared
    'deploy:shared',

    // Standard deployer deploy:vendors
    'deploy:vendors',

    // Special for symfony4
    'deploy:database:update',

    // Special for symfony4
    'deploy:cache:clear',

    // Special for symfony4
    'deploy:cache:warmup',

    // Clear php cli cache.
    // Read more on https://github.com/sourcebroker/deployer-extended#php-clear-cache-cli
    'php:clear_cache_cli',

    // Standard deployer deploy:writable
    'deploy:writable',

    // Standard deployer deploy:clear_paths
    'deploy:clear_paths',

    // Standard deployers symlink (symlink release/x/ to current/)
    'deploy:symlink',

    // Standard deployer deploy:unlock
    'deploy:unlock',

    // Standard deployer cleanup.
    'cleanup',

])->desc('Deploy your Symfony3 project');

after('deploy', 'success');


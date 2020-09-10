<?php

namespace Deployer;

set('web_path', 'web/');
set('default_timeout', 900);
set('symfony_env', 'prod');
set('shared_dirs', ['var/logs', 'var/sessions']);
set('shared_files', ['.env.local.php', '.env.local']);
set('writable_dirs', ['var']);

set('bin/console', function () {
    return parse('{{release_path}}/bin/console');
});

set('console_options', function () {
    return '--no-interaction';
});

set('clear_paths', [
    '.git',
    '.gitignore',
    '.gitattributes',
    'composer.json',
    'composer.lock',
    'composer.phar',
    'web/app_*.php',
    'web/config.php',
]);

// Look https://github.com/sourcebroker/deployer-extended-media for docs
set('media',
    [
        'filter' => [
            '+ /web/',
            '+ /web/media/',
            '+ /web/media/**',
            '+ /web/uploads/',
            '+ /web/uploads/**',
            '- *'
        ]
    ]);

// Look https://github.com/sourcebroker/deployer-extended-database for docs
set('db_defaults', [
    'truncate_tables' => [],
    'ignore_tables_out' => [],
    'post_sql_in' => '',
    'post_sql_in_markers' => ''
]);

// Look https://github.com/sourcebroker/deployer-extended-database for docs
set('db_databases',
    [
        'database_default' => [
            get('db_defaults'),
            (new \SourceBroker\DeployerExtendedSymfony4\Drivers\Symfony4Driver)->getDatabaseConfig(),
        ]
    ]
);

// Look on https://github.com/sourcebroker/deployer-extended#buffer-start for docs
set('buffer_config', function () {
    return [
        'index.php' => [
            'entrypoint_filename' => get('web_path') . 'index.php',
        ],
    ];
});

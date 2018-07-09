<?php
return array (
    'development' => array (
        'type'           => 'mysqli',
        'connection'     => array (
            'hostname'       => 'localhost',
            'port'           => '3306',
            'database'       => 'tutorialspoint_bookdb',
            'username'       => 'root',
            'password'       => '1',
            'persistent'     => false,
            'compress'       => false,
        ),
        'identifier'     => '`',
        'table_prefix'   => '',
        'charset'        => 'utf8',
        'enable_cache'   => true,
        'profiling'      => false,
        'readonly'       => false,
    ),
    'production' => array (
        'type'           => 'mysqli',
        'connection'     => array (
            'hostname'       => 'localhost',
            'port'           => '3306',
            'database'       => 'tutorialspoint_bookdb',
            'username'       => 'root',
            'password'       => '1',
            'persistent'     => false,
            'compress'       => false,
        ),
        'identifier'     => '`',
        'table_prefix'   => '',
        'charset'        => 'utf8',
        'enable_cache'   => true,
        'profiling'      => false,
        'readonly'       => false,
    ),
);

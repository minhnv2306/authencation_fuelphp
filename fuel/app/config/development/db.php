<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
			'dsn'        => 'mysql:host=dockerfuel_mariadb_1;dbname=tutorialspoint_bookdb',
			'username'   => 'root',
			'password'   => '1',
		),
	),
);

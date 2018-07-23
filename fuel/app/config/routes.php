<?php
return array(
	'_root_'  => 'book/index',  // The default route
	'_404_'   => 'errors/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
    'books(/:book)?' => array('book/show', 'name' => 'books.show'),
);

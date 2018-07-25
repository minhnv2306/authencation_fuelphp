<?php

namespace Fuel\Migrations;

class Create_books
{
	public function up()
	{
		\DBUtil::create_table('books', array(
            'id' => array(
                'type' => 'int',
                'unsigned' => true,
                'null' => false,
                'auto_increment' => true,
                'constraint' => '11'
            ),
            'title' => array(
                'constraint' => '255',
                'null' => false,
                'type' => 'varchar'
            ),
            'author' => array(
                'constraint' => '255',
                'null' => false,
                'type' => 'varchar'
            ),
            'price' => array(
                'type' => 'int',
                'unsigned' => 'true',
            ),
            'cover_img' => array(
                'type' => 'varchar',
                'null' => false,
                'constraint' => 255
            )
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('books');
	}
}
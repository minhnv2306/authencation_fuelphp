<?php

namespace Fuel\Migrations;

class Create_posts_table
{
	public function up()
	{
		\DBUtil::create_table('posts', array(
            'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => '11'),
            'title' => array('constraint' => '255', 'null' => false, 'type' => 'varchar'),
            'content' => array('null' => false, 'type' => 'text'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('posts');
	}
}
<?php

namespace Fuel\Migrations;

class Create_users
{
	public function up()
	{
		\DBUtil::create_table('users', array(
			'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => 11),
			'username' => array('constraint' => 50, 'null' => false, 'type' => 'varchar'),
			'password' => array('constraint' => 255, 'null' => false, 'type' => 'varchar'),
			'group' => array('constraint' => 11, 'null' => false, 'type' => 'int'),
			'email' => array('constraint' => 255, 'null' => false, 'type' => 'varchar'),
			'last_login' => array('constraint' => 11, 'null' => false, 'type' => 'int'),
			'login_hash' => array('constraint' => 255, 'null' => false, 'type' => 'varchar'),
			'profile_fields' => array('null' => false, 'type' => 'text'),
			'created_at' => array('constraint' => 11, 'null' => true, 'type' => 'int', 'unsigned' => true),
			'updated_at' => array('constraint' => 11, 'null' => true, 'type' => 'int', 'unsigned' => true),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('users');
	}
}
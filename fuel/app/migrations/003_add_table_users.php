<?php

namespace Fuel\Migrations;

class Add_table_users
{
	public function up()
	{
        \DBUtil::create_table('users', [
            'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'name' => ['type' => 'varchar', 'constraint' => 255],
            'username' => ['type' => 'varchar', 'constraint' => 100, 'unique' => true], // Tên đăng nhập, duy nhất
            'password' => ['type' => 'varchar', 'constraint' => 255], // Mật khẩu đã mã hóa
            'created_at' => ['type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP')],
            'updated_at' => ['type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')],
        ], ['id']); // 'id' là khóa chính
	}

	public function down()
	{
        \DBUtil::drop_table('users');
	}
}
<?php

namespace Fuel\Migrations;

class Add_table_categories
{
	public function up()
	{
        \DBUtil::create_table('categories', [
            'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'name' => ['type' => 'varchar', 'constraint' => 255],
            'description' => ['type' => 'text', 'null' => true],
            'status' => ['type' => 'int', 'constraint' => 1, 'default' => 1], // 1: Active, 0: Inactive
            'created_at' => ['type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP')],
            'updated_at' => ['type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')],
        ], ['id']); // 'id' là khóa chính
	}

	public function down()
	{
        \DBUtil::drop_table('categories');
	}
}
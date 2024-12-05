<?php

namespace Fuel\Migrations;

class Add_table_posts
{
	public function up()
	{
        \DBUtil::create_table('posts', [
            'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'category_id' => ['type' => 'int', 'constraint' => 11],
            'title' => ['type' => 'varchar', 'constraint' => 255],
            'content' => ['type' => 'text'],
            'status' => ['type' => 'int', 'constraint' => 1, 'default' => 1], // 1: Active, 0: Inactive
            'created_at' => ['type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP')],
            'updated_at' => ['type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')],
        ], ['id']); // 'id' là khóa chính
//        \DB::query("ALTER TABLE posts ADD CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE")->execute();
	}

	public function down()
	{
        \DBUtil::drop_table('posts');
	}
}
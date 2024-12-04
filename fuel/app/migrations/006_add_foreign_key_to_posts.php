<?php

namespace Fuel\Migrations;

class Add_foreign_key_to_posts
{
	public function up()
	{
        \DB::query("ALTER TABLE posts 
            ADD CONSTRAINT fk_category 
            FOREIGN KEY (category_id) 
            REFERENCES categories(id) 
            ON DELETE CASCADE")->execute();
	}

	public function down()
	{

        \DB::query("ALTER TABLE posts 
            DROP FOREIGN KEY fk_category")->execute();
	}
}
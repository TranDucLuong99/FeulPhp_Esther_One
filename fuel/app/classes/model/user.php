<?php

class Model_User extends \Orm\Model
{
	protected static $_properties = array(
		"id",
		"name",
		"username",
		"password",
		"created_at",
		"updated_at",
	);

	protected static $_observers = array(
//		'Orm\Observer_CreatedAt' => array(
//			'events' => array('before_insert'),
//			'property' => 'created_at',
//			'mysql_timestamp' => false,
//		),
//		'Orm\Observer_UpdatedAt' => array(
//			'events' => array('before_update'),
//			'property' => 'updated_at',
//			'mysql_timestamp' => false,
//		),
	);

	protected static $_table_name = 'users';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(
	);

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
	);

    public static function insert_data_user(string $name, string $username, string $password)
    {
        // Mã hóa mật khẩu bằng password_hash
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        return DB::insert('users')
            ->columns(array('name', 'username', 'password'))
            ->values([
            'name' => $name,
            'username' => $username,
            'password' => $hashed_password,
        ])->execute();
    }
}

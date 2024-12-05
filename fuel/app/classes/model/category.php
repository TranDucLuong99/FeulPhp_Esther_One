<?php

class Model_Category extends \Orm\Model
{
	protected static $_properties = array(
        "id",
        "name",
        "description",
        "status",
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

//    protected static $_soft_delete = array(
//        'deleted_field' => 'deleted_at', // Cột để đánh dấu xóa mềm
//        'mysql_timestamp' => true,      // Sử dụng định dạng thời gian MySQL (Y-m-d H:i:s)
//    );

	protected static $_table_name = 'categories';

	protected static $_primary_key = array('id');

    // Thiết lập quan hệ 'has_many' với Post
    protected static $_has_many = array(
        'posts' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Post',
            'key_to' => 'category_id',
            'cascade_save' => false,
            'cascade_delete' => false,
        ),
    );

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
	);

}

<?php

class Model_Post extends \Orm\Model
{
	protected static $_properties = array(
		"id",
		"category_id",
        "title",
        "content",
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

	protected static $_table_name = 'posts';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(
	);

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

    // Thiết lập quan hệ 'belongs_to' với Category
    protected static $_belongs_to = array(
        'category' => array(
            'key_from' => 'category_id',
            'model_to' => 'Model_Category',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_delete' => false,
        ),
    );

}

<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.9-dev
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

return array(
	/**
	 * -------------------------------------------------------------------------
	 *  Default route
	 * -------------------------------------------------------------------------
	 *
	 */

	'_root_' => 'user/top',

	/**
	 * -------------------------------------------------------------------------
	 *  Page not found
	 * -------------------------------------------------------------------------
	 *
	 */

	'_404_' => 'welcome/404',

	/**
	 * -------------------------------------------------------------------------
	 *  Example for Presenter
	 * -------------------------------------------------------------------------
	 *
	 *  A route for showing page using Presenter
	 *
	 */

	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),

    'admin/post(/:num)?' => 'admin/post/index',
    'admin/post/create' => 'admin/post/create',
    'admin/post/edit/(:num)' => 'admin/post/edit/$1',
    'admin/post/delete/(:num)' => 'admin/post/delete/$1',

    //Nếu dùng phân trang thì phải thêm (/:num)?
    'admin/category(/:num)?' => 'admin/category/index',
    'admin/category/create' => 'admin/category/create',
    'admin/category/edit/(:num)' => 'admin/category/edit/$1',
    'admin/category/delete/(:num)' => 'admin/category/delete/$1',

    'admin/user' => 'admin/user/index',
    'admin/user/create' => 'admin/user/create',
    'admin/user/edit/(:num)' => 'admin/user/edit/$1',
    'admin/user/delete/(:num)' => 'admin/user/delete/$1',

    'admin/login' => 'admin/login/index',
    'admin/register' => 'admin/register/index',
    'admin/logout' => 'admin/login/logout',

);

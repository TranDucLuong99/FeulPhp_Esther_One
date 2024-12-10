<?php
if (!isset($_SERVER["HTTP_HOST"])) {
    $_SERVER["HTTP_HOST"] = '';
}

if (!isset($_SERVER["REQUEST_URI"])) {
    $_SERVER["REQUEST_URI"] = '';
}
$seg = '';
if (isset($_SERVER["REQUEST_URI"])) {
    $uri = explode('/', $_SERVER["REQUEST_URI"]);
    if (isset($uri[1])) {
        $seg = $uri[1];
    }
}
if ($seg == 'admin') {
    $arr = [
        'admin/post(/:num)?' => 'admin/post/index',
        'admin/post/create' => 'admin/post/create',
        'admin/post/edit/(:num)' => 'admin/post/edit/$1',
        'admin/post/delete/(:num)' => 'admin/post/delete/$1',
        'admin/post/export' => 'admin/post/export',
        'admin/post/import' => 'admin/post/import',
        'admin/post/change_status/(:num)', 'admin/post/change_status/$1',


        //Nếu dùng phân trang thì phải thêm (/:num)?
        'admin/category(/:num)?' => 'admin/category/index',
        'admin/category/create' => 'admin/category/create',
        'admin/category/edit/(:num)' => 'admin/category/edit/$1',
        'admin/category/delete/(:num)' => 'admin/category/delete/$1',
        'admin/category/change_status/(:num)', 'admin/category/change_status/$1',

        'admin/user(/:num)?' => 'admin/user/index',
        'admin/user/create' => 'admin/user/create',
        'admin/user/edit/(:num)' => 'admin/user/edit/$1',
        'admin/user/delete/(:num)' => 'admin/user/delete/$1',

        'admin/login' => 'admin/login/index',
        'admin/register' => 'admin/register/index',
        'admin/logout' => 'admin/login/logout',
    ];
} else {
//    $area_id	= "(?P<area_id>[0-9][0-9][0-9][0-9])";
//    $s_shop_id	= "(?P<s_shop_id>[A-Za-z0-9][A-Za-z0-9]*)"; //shop_mains.id
//    $prefs		= Arr::pluck(Model_Qzin_Area_Main::get_pref_names(), 'area_name2');
//    $prefarea	= '(?P<prefarea>(' . implode("|", $prefs) . '))';

    $arr = [
        '_404_' 											=> 'user/404',
        '_root_' 											=> 'user/top/index',

        'jobs' 												=> 'user/search/job/index',

        'no_result' 										=> 'user/noresult/index',

        'terms' 											=> 'user/termsofservice/index',
        'privacy' 											=> 'user/privacypolicy/index',
        'about' 											=> 'user/operatorinformation/index',
        'sitemap' 											=> 'user/sitemap/index',

        'user/ajax/tel_count_up'							=> 'user/ajax/tel_count_up',
        'user/ajax/line_count_up'							=> 'user/ajax/line_count_up',

        ":prefarea" 										=> 'user/search/prefarea/index',
//        "{$prefarea}/load_more" 							=> 'user/ajax/load_more_by_prefarea',
//        "{$prefarea}/a_{$area_id}" 							=> 'user/search/area/index',
//        "{$prefarea}/a_{$area_id}/load_more" 				=> 'user/ajax/load_more_by_area',
//
//        "{$prefarea}/a_{$area_id}/recruit/s_{$s_shop_id}" 	=> 'user/search/detail/index',
    ];
}
return $arr;

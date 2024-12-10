<?php

use Fuel\Core\Fuel;

define("CONST_ENV_PC", 'pc');
define("CONST_ENV_SP", 'sp');


if (Fuel::$env === Fuel::PRODUCTION) {
    $g_tagmanager_id = 'GTM-K8XXCHJS';
    $url = '';
    define("CONST_ENV_USER_URL", 'https://esthe-one.jp');
    $mailtofrom = 'info@esthe-one.jp';
    $image_url = "https://d2mo334kw8autn.cloudfront.net/";
} elseif (Fuel::$env === Fuel::DEVELOPMENT) {
    $g_tagmanager_id = 'GTM-NGGHMNHR';
    $url = 'dev';
    define("CONST_ENV_USER_URL", 'https://' . $url . '.esthe-one.jp');
    $mailtofrom = 'info@dev.esthe-one.jp';
    $image_url = "https://d3p5w8uyzz92c9.cloudfront.net/";
} elseif (Fuel::$env === Fuel::STAGING) {
    $g_tagmanager_id = 'GTM-NGGHMNHR';
    $url = 'staging';
    define("CONST_ENV_USER_URL", 'https://' . $url . '.esthe-one.jp');
    $mailtofrom = 'info@dev.esthe-one.jp';
    $image_url = "https://d3p5w8uyzz92c9.cloudfront.net/";
} elseif (Fuel::$env === "personal") {
    $g_tagmanager_id = 'GTM-NGGHMNHR';
    $url = Config::get('url_prefix');
    define("CONST_ENV_USER_URL", 'https://' . Config::get('url_prefix') . '.esthe-one.jp');
    $mailtofrom = 'info@dev.esthe-one.jp';
    $image_url = "https://d3p5w8uyzz92c9.cloudfront.net/";
} else {
    $g_tagmanager_id = 'GTM-NGGHMNHR';
    $url = 'local';
    define("CONST_ENV_USER_URL", 'https://local.qzin.jp');
    $mailtofrom = 'info@dev.esthe-one.jp';
    $image_url = "https://d3p5w8uyzz92c9.cloudfront.net/";
}
// googleタグマネージャーのID
define('GOOGLE_TAGMANAGER_ID', $g_tagmanager_id);
//コネクト様 エステワン側メールアドレス
define('CONST_ENV_MAIL_TOFROM', $mailtofrom);

define("CONST_ENV_IMG_URL", $image_url . 'shop_img/');

define("CONST_AGENT_TITLE", "エステワン管理");

define("CONST_ENV_DOMAIN_URL_PREFIX", $url);

return [
    'provisions' => [
        'qualifications' => [
            23  //子持ち・主婦歓迎
        ],
        'salaries' => [
            1,  //日払いOK
            4,  //短期・短時間・単発OK'
            7,  //給与保証制度あり'
            14, //面接交通費支給'
            18, //罰金・ノルマなし'
            20, //社会保険完備'
            29, //バック率70％以上'
        ],
        'working_days' => [
            19, //副業・Wワーク歓迎
            25, //月1出勤OK
        ],
        'working_hours' => [
            34, //早朝営業
            35, //深夜営業
            36, //24時間営業
        ],
        'reception_hours' => [
            8,  //出張面接あり
            49, //オンライン面接OK
        ],
        'benefits' => [
            5,  //送迎あり
            6,  //寮あり
            11, //個室待機OK
            12, //託児所提携
            22, //自宅待機OK
            27, //高級店
            45, //女性店長がいる
            46, //女性講習員がいる
        ]
    ],

    //XML
    'site_map_index' => [
        'sitemap.xml',
        'sitemap_pref_kyujin_list.xml',
        'sitemap_area_kyujin_list.xml',
        'sitemap_shop.xml',
    ],
    'site_map' => [
        [
            'name' => 'INDEX',
            'url' => ''
        ],
        [
            'name' => 'terms',
            'url' => 'terms'
        ],
        [
            'name' => 'privacy',
            'url' => 'privacy'
        ],
        [
            'name' => 'about',
            'url' => 'about'
        ],
        [
            'name' => 'sitemap',
            'url' => 'sitemap'
        ],
    ],
    // アクセス許可IP
    'agent_login_ip' => [
        '120.51.210.183',
        '202.212.21.73',
        '124.45.124.106',
        '202.75.235.63',
        '61.123.214.104',
        '27.96.63.192',
        '27.96.63.194',
        '210.134.78.38',
        '113.197.177.37',
        '183.77.213.203',
        '122.220.197.146',
        '27.96.45.43',
        '118.238.221.248',
        '27.96.45.22',
        '172.31.28.181',
        '118.243.155.105',
        '39.110.207.51',
        '113.34.111.162',
        '183.76.168.30',
        '39.110.211.18',
        '119.243.84.93',
        '66.11.61.141',
        '219.111.2.225',
        '221.113.37.254',
        '58.92.111.198',
        '118.238.250.205',
        '160.86.103.195',
        '124.102.217.152',
        '121.101.91.235',
        '121.2.64.139',
        '182.169.80.6',
        '39.110.207.61',
        '150.249.202.234',
        '54.85.207.188',
        '157.250.87.212',
        '27.96.32.123',
        '153.156.242.155',
        '114.156.152.222',
        '150.249.202.228',
        '150.249.202.229',
        '150.249.202.230',
        '13.231.99.172',
        '131.213.36.3',
        '92.203.96.20',
        '3.115.188.164',
        '18.180.101.192',
        '61.216.67.131',
        '152.165.122.118',
        '150.249.202.184',
        '219.98.15.174',
        '127.0.0.1',
        '220.100.12.241',
        '220.210.140.104',
        '192.168.33.1',
        '172.18.0.1',
        '39.110.211.11',
        '118.70.9.15',
        '217.178.48.215',
        '113.150.227.187',
        '115.163.19.164',
    ],
    // 店舗メイン画像 許可フォーマット
    'shop_main_img_allowed_format' => [
        'type'     => ['image'],                                      // Contents-Type
        'max_size' => 10485760,                                       // 最大アップロードサイズ 10MB
        'mime'     => ['image/jpg', 'image/jpeg', 'image/png'],       // MIME種類
        'ext'      => ['jpg', 'jpeg', 'JPG', 'JPEG', 'png', 'PNG'],   // 画像拡張子
    ],
];

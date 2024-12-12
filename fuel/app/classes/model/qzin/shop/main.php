<?php
/*
 * Model_Qzin_Shop_Main
 * 店舗マスタ
 */

use Fuel\Core\Date;
use Fuel\Core\DB;

class Model_Qzin_Shop_Main extends \Orm\Model
{
    protected static $_table_name = 'shop_mains';

    // 承認フラグ
    const AUTH_FLG_NO = 0;    // 未承認
    const AUTH_FLG_YES = 1;    // 承認
    const AUTH_FLG_CANCEL = 2;    // 却下
    // 掲載フラグ
    const IS_ACTIVE_NO = 0;    // NG
    const IS_ACTIVE_YES = 1;    // 掲載OK
    // オプションプラン
    const OPTION_FLG_A = 2;     //Aプラン
    const OPTION_FLG_B = 1;     //Bプラン
    const OPTION_FLG_C = 0;     //Cプラン

    // オプションサブステータス
    const OPTION_SUB_STATUS_NON = 0;   // ステータスなし
    const OPTION_SUB_STATUS_NAMI_HAIHU_C = 10;  // 並盛配布C

    const BANNER_LEVEL_MOST = 2;  // vanilla_flg：2⇒最上位
    const BANNER_LEVEL_UPPER = 1;  // vanilla_flg：1⇒上位
    const BANNER_LEVEL_NORMAL = 0;  // vanilla_flg：0⇒通常

    const ACTIVE_FLG_YES = 1;  // 表示
    const ACTIVE_FLG_NO = 0;  // 非表示

    const TEST_SHOP_YES = 1;
    const TEST_SHOP_NO = 0;

    const LOST_FLG_OK = 1;
    const LOST_FLG_NG = 2;
    const LOST_FLG_UNCONFIRMED = 3;

    const IS_PAYOFF_SHOP = 2; //有料落ち店舗
    const IS_FREE_SHOP = 0; //無料店舗

    // 新規店舗
    const IS_NEWSHOP_OFF = 0;
    const IS_NEWSHOP_ON = 1;

    const FUU_DELI_FLG_FUU = 0;    // 風デリ導線フラグ：風じゃ
    const FUU_DELI_FLG_DELI = 1;    // 風デリ導線フラグ：デリじゃ

    //風じゃ・デリじゃに共に掲載しているかの確認用定数
    const PUBLISH_FUZOKU = 1;  //風じゃに掲載
    const PUBLISH_DELI = 2;  //デリじゃに掲載
    const PUBLISH_BOTH = 3;  //両方に掲載

    // プレミアム店舗一覧で表示させる表示アイコン
    const MEDIA_TARGET_NONE = 0;  // 風・デリ双方にバニラautonumが未設定（全権で使用）
    const MEDIA_TARGET_FUU = 1;  // 風じゃアイコン表示（デフォルト）
    const MEDIA_TARGET_DELI = 2;  // デリじゃアイコン表示

    // 風・デリ掲載しているか
    const MEDIA_LINK_ALL_FUU = 1;      // 風・デリ双方に掲載（風じゃにリンク）
    const MEDIA_LINK_ALL_DELI = 2;      // 風・デリ双方に掲載（デリじゃにリンク）
    const MEDIA_LINK_FUU = 3;      // 風じゃのみの掲載（風じゃにリンク）
    const MEDIA_LINK_DELI = 4;      // デリじゃのみの掲載（デリじゃリンク）

    // 全権店舗検索 風・デリ 検索値
    const MEDIA_TARGET_ALL = 0;       // 全て
    const MEDIA_ALL_TERGET_FUU = 1;       // 風・デリにバニラautonum風じゃプレミアム画像
    const MEDIA_ALL_TERGET_DELI = 2;       // 風・デリにバニラautonumデリじゃプレミアム画像
    const MEDIA_ONE_SIDE_TERGET_FUU = 3;       // 風にバニラautonum風じゃプレミアム画像
    const MEDIA_ONE_SIDE_TERGET_DELI = 4;       // デリにバニラautonum風デリプレミアム画像

    // リンク設置不可容認
    const LINK_SETTING_OFF = 0;     // リンク設置容認OFF
    const LINK_SETTING_ON = 1;     // リンク設置容認ON

    // 相互リンク
    const LINKBANNER_OFF = 0;    // OFF
    const LINKBANNER_ON = 1;    // ON

    // 動画ウィジェット
    const WIDGET_OFF = 0;    // OFF
    const WIDGET_ON = 1;    // ON

    // 状況設定：オフィシャライズ化
    const OFFICIALIZE_NO = 0;
    const OFFICIALIZE_SP = 1;
    const OFFICIALIZE_PC = 2;
    const OFFICIALIZE_SP_PC = 3;

    // 相互リンク（リンクバナー）
    const OHPBANNER_NO = 0;    // 相互リンクPC or SP設定なし
    const OHPBANNER_YES = 1;    // 相互リンクPC or SP設定あり

    // 状況設定：動画ウィジェット
    const MOVIE_WIDGET_NO = 0;
    const MOVIE_WIDGET_YES = 1;

    // 状況設定：店長ブログウィジェット
    const BLOG_WIDGET_NO = 0;
    const BLOG_WIDGET_YES = 1;

    // 検索ステータス
    const All_POST_STOP = '1';  // 中止予定
    const All_POST_ON = '2';  // 掲載中
    const All_POST = '3';  // 掲載中全て

    //4lpフラグ
    //人妻
    const HITODUMA_PLAN_OFF = 0; //設定無し
    const HITODUMA_PLAN_STOP = 1; //中止予定
    const HITODUMA_PLAN_ON = 2; //掲載中

    //未経験
    const MIKEIKEN_PLAN_OFF = 0; // 設定無し
    const MIKEIKEN_PLAN_STOP = 1; // 中止予定
    const MIKEIKEN_PLAN_ON = 2; // 掲載中

    //体入
    const TAINYU_PLAN_OFF = 0; //設定無し
    const TAINYU_C_STOP_PLAN = 1; //体入C中止予定
    const TAINYU_B_STOP_PLAN = 2; //体入B中止予定
    const TAINYU_A_STOP_PLAN = 3; //体入A中止予定
    const TAINYU_S_STOP_PLAN = 4; //体入S中止予定
    const TAINYU_C_PLAN = 5; //体入C
    const TAINYU_B_PLAN = 6; //体入B
    const TAINYU_A_PLAN = 7; //体入A
    const TAINYU_S_PLAN = 8; //体入S

    //ぽっちゃり
    const POCCHARI_PLAN_OFF = 0; //設定無し
    const POCCHARI_PLAN_STOP_C = 1; // Cプラン中止予定
    const POCCHARI_PLAN_ON_C = 2; // Cプラン有効
    const POCCHARI_PLAN_STOP_B = 3; // Bプラン中止予定
    const POCCHARI_PLAN_ON_B = 4; // Bプラン有効
    const POCCHARI_PLAN_STOP_A = 5; // Aプラン中止予定
    const POCCHARI_PLAN_ON_A = 6; // Aプラン有効

    // 出稼ぎアイコン(workaway_flg)
    const WORKAWAY_ICO_ON = 1;
    const WORKAWAY_ICO_OFF = 0;

    // 4LP無料掲載
    const MIKEIKEN_FREE_PLAN_ON = 1;     // 掲載選択中
    const MIKEIKEN_FREE_PLAN_OFF = 0;     // 掲載選択中

    // サブオプション
    const OPTION_SUB_STATUS_STR_C = '並盛配布C';
    const OPTION_SUB_STATUS_SHORT_STR_C = '配布C';

    // 1日UP
    const OPTION_FIRSTUP_NON = 9;   // 1日UPしない

    // 掲載店舗検索（区分）
    const CONDITION_PAYFLG_NAMI_ALL = '3-9';       // 並盛全て
    const CONDITION_PAYFLG_NAMI = '3-0_1';     // 並盛掲載中
    const CONDITION_PAYFLG_NAMI_STOP = '3-2';       // 並盛中止予定
    const CONDITION_PAYFLG_FREE_ALL = '0_2-9';     // 無料全て
    const CONDITION_PAYFLG_FREE = '0-0';       // 無料掲載中
    const CONDITION_PAYFLG_STOP = '3_4_5-2';   // 継続中止予定
    const CONDITION_PAYFLG_PAY_ALL = '3_4_5-9';   // 有料全て

    const TAINYU_FREE_FLG_YES = 1;    // 無料体入店舗
    const TAINYU_FREE_FLG_NO = 0;    // 無料体入申請なし

    // コンサル定期訪問で使う定数
    const CONST_CONSUL_REGULARLY_ON = 2;    // 定期訪問 オン
    const CONST_CONSUL_REGULARLY_OFF = 1;   // 定期訪問 オフ
    const CONST_CONSUL_REGULARLY_NONE = 0;  // 定期訪問 担当未設定

    // 店舗のお店HPのフラグ
    const SHOP_HP_FLG_NONE = 0;    // 無し
    const SHOP_HP_FLG_FUU = 1;    // 風じゃ
    const SHOP_HP_FLG_DELI = 2;    // デリじゃ
    const SHOP_HP_FLG_EKI = 3;    // 駅ちか

    // お店HP固定フラグ
    const FIXED_HP_FLG_OFF = 0;    // 固定無し
    const FIXED_HP_FLG_ON = 1;    // 固定する

    // 新着求人情報取得数
    const NEW_SHOPS_LIMIT = 5;

    // こだわりのピックアップ求人情報取得数
    const EXTOP_PICKUP_SHOPS_LIMIT = 4;

    const TAINYU_DATA_NO_LIMIT = 0;
    const TAINYU_DATA_S_PLAN_SLIDE_LIMIT = 5;
    const TAINYU_DATA_DISPLAY_LIMIT = 20;

    // バニラ「shop_mainsのpay_dlg」
    const PAY_FLG_FREE_LISTING = 0;
    const PAY_FLG_PAID_LISTING = 2;
    const PAY_FLG_REGULAR_LISTING = 3;
    const PAY_FLG_LARGE_LISTING = 4;
    const PAY_FLG_EXTRA_LARGE_LISTING = 5;

    const SHOPSTATUS_ICON = [
        1 => '派遣型',
        2 => 'ルーム型'
    ];

    const TAINYU_FLG_OFF = 0; //0：無効
    const TAINYU_C_STOP_FLG = 1; //体入C中止予定
    const TAINYU_B_STOP_FLG = 2; //体入B中止予定
    const TAINYU_A_STOP_FLG = 3; //体入A中止予定
    const TAINYU_S_STOP_FLG = 4; //体入S中止予定
    const TAINYU_C_FLG = 5; //体入C
    const TAINYU_B_FLG = 6; //体入B
    const TAINYU_A_FLG = 7; //体入A
    const TAINYU_S_FLG = 8; //体入S

    const MIKEIKEN_FLG_OFF = 0; //0：無効
    const MIKEIKEN_FLG_STOP = 1; // 1:中止予定
    const MIKEIKEN_FLG_ON = 2; //2：有効

    const HITODUMA_FLG_OFF = 0; //0：無効
    const HITODUMA_FLG_STOP = 1; //1:中止予定
    const HITODUMA_FLG_ON = 2; //2：有効


    protected static $_properties = [
        'id',
        'shop_id',
        'active_flg',
        'pay_flg',
        'option_flg',
        'option_sub_status',
        'area1',
        'area2',
        'shop_name',
        'shop_name_estheone',
        'title',
        'job_info',
        'img_name',
        'area3',
        'test_shop',
        'shopstatus_icon',
        'hitoduma_flg',
        'mikeiken_flg',
        'tainyu_flg',
        'created_at',
        'updated_at'
    ];

    //主キー
    protected static $_primary_key = array('id', 'shop_id');

    /**
     * メンエス求人店舗の取得
     * @param ?int $small_area_id 小エリアのid(area_groups.area_id)
     * @param ?int $pref_id 都道府県のid(area_mains.area_id)
     * @return array
     */
    public static function get_shop_mains_autonum(?int $small_area_id = null, ?int $pref_id = null): array
    {
        $params = [];
        $sql  = " SELECT s.id \n";
        $sql .= " FROM " . Model_Qzin_Shop_Main::table() . " AS s \n";
        $sql .= " INNER JOIN " . Model_Qzin_Shop_Detail::table() . " AS sd \n";
        $sql .= " ON sd.shop_id = s.shop_id \n";
        $sql .= " LEFT JOIN " . Model_Qzin_Area_Main::table() . " AS am \n";
        $sql .= "   ON am.area_id = s.area2 \n";
        $sql .= " LEFT JOIN " . Model_Qzin_Area_Group::table() . " AS ag \n";
        $sql .= "   ON (am.area_id = ag.area_id OR am.group_area_id = ag.area_id) \n";
        $sql .= " WHERE \n";
        $sql .= "   s.active_flg = :active_flg \n";
        $sql .= "   AND s.test_shop = :test_shop \n";
        $sql .= "   AND s.option_sub_status != :option_sub_status \n";
        $sql .= "   AND s.pay_flg IN :pay_flg \n";
        $sql .= "   AND s.title IS NOT NULL \n";
        $sql .= "   AND s.job_info IS NOT NULL \n";
        $sql .= "   AND s.img_name IS NOT NULL \n";
        if (!is_null($small_area_id)) {
            $sql .= " AND ag.area_id = :small_area_id \n";
            $params['small_area_id'] = $small_area_id;
        } elseif (!is_null($pref_id)) {
            $sql .= " AND am.master_area3 = :pref_id \n";
            $params['pref_id'] = $pref_id;
        }
        $params['active_flg']        = Model_Qzin_Shop_Main::ACTIVE_FLG_YES;
        $params['option_sub_status'] = Model_Qzin_Shop_Main::OPTION_SUB_STATUS_NAMI_HAIHU_C;
        $params['pay_flg']           = [Model_Qzin_Shop_Main::PAY_FLG_REGULAR_LISTING, Model_Qzin_Shop_Main::PAY_FLG_LARGE_LISTING, Model_Qzin_Shop_Main::PAY_FLG_EXTRA_LARGE_LISTING];
        $params['test_shop']         = Model_Qzin_Shop_Main::TEST_SHOP_NO;

        $sql .= "ORDER BY \n";
        $sql .= "CASE \n";
        $sql .= "WHEN s.pay_flg = 5 THEN '3' \n";
        $sql .= "WHEN s.pay_flg = 4 THEN '3' \n";
        $sql .= "WHEN s.pay_flg = 3 AND s.option_flg = 2 THEN '3' \n";
        $sql .= "WHEN s.pay_flg = 3 AND s.option_flg = 1 THEN '2' \n";
        $sql .= "WHEN s.pay_flg = 3 AND s.option_flg = 0 THEN '1' \n";
        $sql .= "END \n";
        $sql .= "DESC, RAND() \n";
        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array(null, 'id');
    }

    /**
     * @param array $shops_autonum
     *
     * @return array
     */
    public static function get_shops_by_autonum(array $shops_autonum): array
    {
        $sql = "SELECT s.area2, s.shop_id, s.title, s.shop_name_estheone, s.area3, s.img_name, \n";
        $sql .= " sd.salary_type, sd.saiyo, sd.work_area, sd.work_time, sd.access,  \n";
        $sql .= " sd.daywage_money, sd.backrate_money,  \n";
        $sql .= "CASE \n";
        $sql .= "WHEN am.group_area_id = 0 THEN am.area_id \n";
        $sql .= "ELSE am.group_area_id \n";
        $sql .= "END AS group_area_id \n";
        $sql .= "FROM " . Model_Qzin_Shop_Main::table() . " s \n";
        $sql .= "INNER JOIN " . Model_Qzin_Shop_Detail::table() . " sd on s.shop_id = sd.shop_id \n";
        $sql .= "INNER JOIN area_mains am on am.area_id = s.area2 \n";
        $sql .= "WHERE s.id IN :shops_autonum \n";
        $sql .= "ORDER BY FIELD (s.id ";
        foreach ($shops_autonum as $key => $shop_autonum) {
            $sql .= ", " . ':shop_autonum_' . $key;
            $params['shop_autonum_' . $key] = $shop_autonum;
        }
        $sql .= ") \n";

        $params['shops_autonum'] = $shops_autonum;
        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array();
    }

    /**
     * @return array
     */
    public static function get_all_shop(): array
    {
        $sql  = " SELECT \n";
        $sql .= "   sm.id, \n";
        $sql .= "   sm.shop_id, \n";
        $sql .= "   sm.shop_name, \n";
        $sql .= "   sm.shop_name_estheone, \n";
        $sql .= "   sm.active_flg, \n";
        $sql .= "   sm.img_name, \n";
        $sql .= "   sm.title, \n";
        $sql .= "   sm.job_info, \n";
        $sql .= "   am1.master_area3, \n";
        $sql .= "   am2.area_name2, \n";
        $sql .= "   am3.area_name2 AS area1_area_name2, \n";
        $sql .= "   CASE \n";
        $sql .= "     WHEN am1.group_area_id != :group_area_id_none \n";
        $sql .= "       THEN am1.group_area_id \n";
        $sql .= "     ELSE am1.area_id \n";
        $sql .= "   END AS group_area_id, \n";
        $sql .= "   CASE \n";
        $sql .= "     WHEN sm.pay_flg = :pay_flg_paid_listing \n";
        $sql .= "       THEN '有料落ち' \n";
        $sql .= "     WHEN sm.pay_flg = :pay_flg_free_listing \n";
        $sql .= "       THEN '無料' \n";
        $sql .= "     WHEN sm.pay_flg = :pay_flg_regular_listing \n";
        $sql .= "          AND sm.option_flg = :option_flg_c \n";
        $sql .= "          AND sm.option_sub_status = :option_sub_status_haihu_c \n";
        $sql .= "       THEN '配布C' \n";
        $sql .= "     ELSE '' \n";
        $sql .= "   END AS pay_flg_text \n";
        $sql .= " FROM " . Model_Qzin_Shop_Main::table() . " AS sm \n";
        $sql .= " INNER JOIN area_mains AS am1 \n";
        $sql .= "   ON sm.area2 = am1.area_id \n";
        $sql .= " INNER JOIN area_mains AS am2 \n";
        $sql .= "   ON am1.master_area3 = am2.area_id \n";
        $sql .= " INNER JOIN area_mains AS am3 \n";
        $sql .= "   ON sm.area1 = am3.area_id \n";
        $sql .= " ORDER BY \n";
        $sql .= "   sm.id DESC \n";

        $params = [
            'group_area_id_none'        => Model_Qzin_Area_Main::GROUP_AREA_ID_NONE,
            'pay_flg_paid_listing'      => self::PAY_FLG_PAID_LISTING,
            'pay_flg_free_listing'      => self::PAY_FLG_FREE_LISTING,
            'pay_flg_regular_listing'   => self::PAY_FLG_REGULAR_LISTING,
            'option_flg_c'              => self::OPTION_FLG_C,
            'option_sub_status_haihu_c' => self::OPTION_SUB_STATUS_NAMI_HAIHU_C,
        ];

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array();
    }

    /**
     * 店舗の合計数を取得する
     *
     * @param ?int $small_area_id 小エリアのid(area_groups.area_id)
     * @param ?int $pref_id       都道府県のid(area_mains.area_id)
     * @return string 店舗の合計数
     */
    public static function get_total_shop(?int $small_area_id = null, ?int $pref_id = null): string
    {
        $params = [];
        $sql  = " SELECT COUNT(*) AS total \n";
        $sql .= " FROM " . Model_Qzin_Shop_Main::table() . " AS s \n";
        $sql .= " INNER JOIN " . Model_Qzin_Shop_Detail::table() . " AS sd \n";
        $sql .= " ON sd.shop_id = s.shop_id \n";
        $sql .= " LEFT JOIN " . Model_Qzin_Area_Main::table() . " AS am \n";
        $sql .= "   ON am.area_id = s.area2 \n";
        $sql .= " LEFT JOIN " . Model_Qzin_Area_Group::table() . " AS ag \n";
        $sql .= "   ON (am.area_id = ag.area_id OR am.group_area_id = ag.area_id) \n";
        $sql .= " WHERE \n";
        $sql .= "   s.active_flg = :active_flg \n";
        $sql .= "   AND s.test_shop = :test_shop \n";
        $sql .= "   AND s.option_sub_status != :option_sub_status \n";
        $sql .= "   AND s.pay_flg IN :pay_flg \n";
        $sql .= "   AND s.title IS NOT NULL \n";
        $sql .= "   AND s.job_info IS NOT NULL \n";
        $sql .= "   AND s.img_name IS NOT NULL \n";
        if (!is_null($small_area_id)) {
            $sql .= " AND ag.area_id = :small_area_id \n";
            $params['small_area_id'] = $small_area_id;
        } elseif (!is_null($pref_id)) {
            $sql .= " AND am.master_area3 = :pref_id \n";
            $params['pref_id'] = $pref_id;
        }
        $params['active_flg']        = Model_Qzin_Shop_Main::ACTIVE_FLG_YES;
        $params['option_sub_status'] = Model_Qzin_Shop_Main::OPTION_SUB_STATUS_NAMI_HAIHU_C;
        $params['pay_flg']           = [Model_Qzin_Shop_Main::PAY_FLG_REGULAR_LISTING, Model_Qzin_Shop_Main::PAY_FLG_LARGE_LISTING, Model_Qzin_Shop_Main::PAY_FLG_EXTRA_LARGE_LISTING];
        $params['test_shop']         = Model_Qzin_Shop_Main::TEST_SHOP_NO;

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->get('total');
    }

    /**
     * @param mixed $shop_id
     *
     * @return array
     */
    public static function get_shop_detail_by_shop_id($shop_id): array
    {
        $params = [];
        $sql = "SELECT * \n";
        $sql .= "FROM " . Model_Qzin_Shop_Main::table() . " s \n";
        $sql .= "INNER JOIN " . Model_Qzin_Shop_Detail::table() . " sd on s.shop_id = sd.shop_id \n";
        $sql .= "WHERE s.shop_id = :shop_id \n";
        $sql .= "AND s.active_flg = :active_flg \n";
        $sql .= "AND s.option_sub_status = :option_sub_status  \n";
        $sql .= "AND s.pay_flg IN :pay_flg  \n";
        $sql .= "AND s.title IS NOT NULL \n";
        $sql .= "AND s.job_info IS NOT NULL \n";
        $sql .= "AND s.img_name IS NOT NULL \n";
        $params['shop_id'] = $shop_id;
        $params['active_flg'] = Model_Qzin_Shop_Main::ACTIVE_FLG_YES;
        $params['option_sub_status'] = Model_Qzin_Shop_Main::OPTION_SUB_STATUS_NON;
        $params['pay_flg'] = [Model_Qzin_Shop_Main::PAY_FLG_REGULAR_LISTING, Model_Qzin_Shop_Main::PAY_FLG_LARGE_LISTING, Model_Qzin_Shop_Main::PAY_FLG_EXTRA_LARGE_LISTING];

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array();
    }

    /**
     * 公開店舗の有無を取得
     * @param string $shop_autonum
     * @return bool
     */
    public static function published_shop_exists_by_shop_autonum(string $shop_autonum): bool
    {
        $sql  = " SELECT \n";
        $sql .= "   1 \n";
        $sql .= " FROM " . Model_Qzin_Shop_Main::table() . " AS s \n";
        $sql .= " WHERE \n";
        $sql .= "   s.id = :shop_autonum \n";
        $sql .= "   AND s.active_flg = :active_flg \n";
        $sql .= "   AND s.option_sub_status = :option_sub_status  \n";
        $sql .= "   AND s.pay_flg IN :pay_flg  \n";
        $sql .= "   AND s.title IS NOT NULL \n";
        $sql .= "   AND s.job_info IS NOT NULL \n";
        $sql .= "   AND s.img_name IS NOT NULL \n";

        $params = [
            'shop_autonum'      => $shop_autonum,
            'active_flg'        => Model_Qzin_Shop_Main::ACTIVE_FLG_YES,
            'option_sub_status' => Model_Qzin_Shop_Main::OPTION_SUB_STATUS_NON,
            'pay_flg'           => [
                Model_Qzin_Shop_Main::PAY_FLG_REGULAR_LISTING,
                Model_Qzin_Shop_Main::PAY_FLG_LARGE_LISTING,
                Model_Qzin_Shop_Main::PAY_FLG_EXTRA_LARGE_LISTING
            ],
        ];

        return !empty(DB::query($sql, DB::SELECT)->parameters($params)->execute()->current());
    }

    /**
     * @param string $shop_id
     *
     * @return ?array
     */
    public static function get_shop_detail_for_shop_edit_by_shop_id(string $shop_id)
    {
        $params = [];
        $sql = "SELECT s.*, sd.*, am1.group_area_id, am2.area_name2 as pref_area_name, am3.area_name2 as large_area_name \n";
        $sql .= "FROM " . Model_Qzin_Shop_Main::table() . " s \n";
        $sql .= "INNER JOIN " . Model_Qzin_Shop_Detail::table() . " sd on s.shop_id = sd.shop_id \n";
        $sql .= "INNER JOIN " . Model_Qzin_Area_Main::table() . " am1 on s.area2 = am1.area_id \n";
        $sql .= "INNER JOIN " . Model_Qzin_Area_Main::table() . " am2 on am1.master_area3 = am2.area_id \n";
        $sql .= "INNER JOIN " . Model_Qzin_Area_Main::table() . " am3 on s.area1 = am3.area_id \n";

        $sql .= "WHERE s.shop_id = :shop_id \n";
        $params['shop_id'] = $shop_id;

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->current();
    }

    /**
     * @param string $from_connection
     *
     * @return int
     */
    public static function get_vanilla_total_shop_main_record(string $from_connection): int
    {
        $sql = " SELECT COUNT(shop_id) AS total FROM shop_mains ";
        $sql .= " WHERE genre = 22 "; //22：メンズエステ

        $total = DB::query($sql)->execute($from_connection)->get('total');

        return intval($total);
    }

    /**
     * @param int $chunk_size
     * @param mixed $offset
     * @param mixed $from_connection
     *
     * @return array
     */
    public static function get_vanilla_shop_main_data(int $chunk_size, $offset, $from_connection): array
    {
        $sql = " SELECT";
        $sql .= " id,";
        $sql .= " shop_id,";
        $sql .= " active_flg,";
        $sql .= " pay_flg,";
        $sql .= " option_flg,";
        $sql .= " option_sub_status,";
        $sql .= " area1,";
        $sql .= " area2,";
        $sql .= " shop_name,";
        $sql .= " area4,";
        $sql .= " area5,";
        $sql .= " test_shop,";
        $sql .= " shopstatus_icon,";
        $sql .= " hitoduma_flg,";
        $sql .= " mikeiken_flg,";
        $sql .= " tainyu_flg,";
        $sql .= " area_mains.area_name";
        $sql .= " FROM shop_mains";
        $sql .= " JOIN area_mains";
        $sql .= " ON area_mains.area_id = shop_mains.area3";
        $sql .= " WHERE shop_mains.genre = 22 "; //22：メンズエステ
        $sql .= " ORDER BY shop_mains.id ";
        $sql .= " LIMIT :limit OFFSET :offset";

        $shop_main_data = DB::query($sql)
            ->parameters(array('limit' => $chunk_size, 'offset' => $offset))
            ->execute($from_connection)->as_array();

        return $shop_main_data;
    }

    /**
     * @param array $shop_main_data
     * @param string $to_connection
     *
     * @return [type]
     */
    public static function insert_or_update_vanilla_shop_main(array $shop_main_data, string $to_connection)
    {
        $values = [];
        $shop_ids = [];
        $created_at = Date::time()->format("%Y-%m-%d %H:%M:%S");
        $updated_at = Date::time()->format("%Y-%m-%d %H:%M:%S");

        foreach ($shop_main_data as $data) {
            $data['area3'] = $data['area_name'] . $data['area4'] . $data['area5'];
            $data['shopstatus_icon'] = $data['shopstatus_icon'] ?? 1;
            $value = ' (' . DB::quote($data['id']) . ', ' . DB::quote($data['shop_id']) . ', ' . DB::quote(0) . ', ' . DB::quote($data['pay_flg']) . ', ';
            $value .= DB::quote($data['option_flg']) . ', ' . DB::quote($data['option_sub_status']) . ', ' . DB::quote($data['area1']) . ', ' . DB::quote($data['area2']) . ', ';
            $value .= DB::quote($data['shop_name']) . ', ' . DB::quote($data['shop_name']) . ', ' . DB::quote($data['area3']) . ', ' . DB::quote($data['test_shop']) . ', ';
            $value .= DB::quote($data['shopstatus_icon']) . ', ' . DB::quote($data['hitoduma_flg']) . ', ' . DB::quote($data['mikeiken_flg']) . ', ' . DB::quote($data['tainyu_flg']) . ', ';
            $value .= DB::quote($created_at) . ', ' . DB::quote($updated_at) . ') ';
            $values[] = $value;
            $shop_ids[] = $data['shop_id'];
        }

        $data_active_flgs = self::get_shops_active_flg($shop_ids);

        $sql = " INSERT INTO shop_mains";
        $sql .= " (id, shop_id, active_flg, pay_flg, option_flg, option_sub_status, area1, area2, shop_name,";
        $sql .= " shop_name_estheone, area3, test_shop, shopstatus_icon, hitoduma_flg, mikeiken_flg, tainyu_flg, created_at, updated_at)";
        $sql .= " VALUES ";
        $sql .= implode(', ', $values);
        $sql .= " AS insert_values ON DUPLICATE KEY UPDATE";
        $sql .= " id = insert_values.id, shop_id = insert_values.shop_id, active_flg = ";
        $sql .= " CASE ";
        foreach ($shop_main_data as $data) {
            if ($data['active_flg'] == 0) {
                $sql .= " WHEN shop_mains.shop_id = " . DB::quote($data['shop_id']) . " THEN " . DB::quote($data['active_flg']);
            } elseif ($data['active_flg'] == 1 && !empty($data_active_flgs[$data['shop_id']])) {
                $sql .= " WHEN shop_mains.shop_id = " . DB::quote($data['shop_id']) . " THEN " . DB::quote($data_active_flgs[$data['shop_id']]);
            }
        }
        $sql .= " END ";
        $sql .= ", pay_flg = insert_values.pay_flg, option_flg = insert_values.option_flg,";
        $sql .= " option_sub_status = insert_values.option_sub_status, area1 = insert_values.area1, area2 = insert_values.area2, shop_name = insert_values.shop_name, shopstatus_icon = insert_values.shopstatus_icon, hitoduma_flg = insert_values.hitoduma_flg,";
        $sql .= " mikeiken_flg = insert_values.mikeiken_flg, tainyu_flg = insert_values.tainyu_flg, updated_at = insert_values.updated_at";

        DB::query($sql)->execute($to_connection);
    }

    /**
     * @return array
     */
    public static function get_shops_data_for_sitemap_renew(): array
    {
        $params = [];

        $sql = "SELECT sm1.id, sm1.shop_id, sm1.area2, am1.master_area3, am2.area_name2, \n";
        $sql .= "CASE \n";
        $sql .= "WHEN am1.group_area_id != 0 THEN am1.group_area_id \n";
        $sql .= "ELSE am1.area_id \n";
        $sql .= "END AS group_area_id \n";
        $sql .= "FROM \n";

        $sql .= "(SELECT sm.id, sm.shop_id, sm.area2 \n";
        $sql .= "FROM " . Model_Qzin_Shop_Main::table() . " sm \n";
        $sql .= "WHERE sm.active_flg = :active_flg \n";
        $sql .= "AND sm.test_shop = :test_shop  \n";
        $sql .= "AND sm.option_sub_status != :option_sub_status  \n";
        $sql .= "AND sm.pay_flg IN :pay_flg  \n";
        $sql .= "AND sm.title IS NOT NULL \n";
        $sql .= "AND sm.job_info IS NOT NULL \n";
        $sql .= "AND sm.img_name IS NOT NULL) sm1 \n";

        $sql .= "INNER JOIN " . Model_Qzin_Area_Main::table() . " am1 \n";
        $sql .= "ON sm1.area2 = am1.area_id \n";

        $sql .= "INNER JOIN " . Model_Qzin_Area_Main::table() . " am2 \n";
        $sql .= "ON am1.master_area3 = am2.area_id \n";

        $params['active_flg'] = Model_Qzin_Shop_Main::ACTIVE_FLG_YES; // 表示
        $params['option_sub_status'] = Model_Qzin_Shop_Main::OPTION_SUB_STATUS_NAMI_HAIHU_C; // 並盛配布C
        $params['pay_flg'] = [Model_Qzin_Shop_Main::PAY_FLG_REGULAR_LISTING, Model_Qzin_Shop_Main::PAY_FLG_LARGE_LISTING, Model_Qzin_Shop_Main::PAY_FLG_EXTRA_LARGE_LISTING];
        $params['test_shop'] = Model_Qzin_Shop_Main::TEST_SHOP_NO;

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array();
    }

    /**
     * @param array $post
     * @param array $shopdata
     *
     * @return bool
     */
    public static function update_editshop(array $post = [], array $shopdata = []): bool
    {
        if (empty($post) || empty($shopdata)) {
            return false;
        }

        $params = [
            'shop_id'    => $shopdata['shop_id'],
            'updated_at' => (new DateTime())->format('Y-m-d H:i:s'),
        ];

        $sql_assignment_list = '';

        if ($post['shop_name_estheone'] !== $shopdata['shop_name_estheone']) {
            $sql_assignment_list .= " shop_name_estheone = :shop_name_estheone, " . PHP_EOL;
            $params['shop_name_estheone'] = $post['shop_name_estheone'];
        }

        if ($post['active_flg'] !== $shopdata['active_flg']) {
            $sql_assignment_list .= " active_flg = :active_flg, ";
            $params['active_flg'] = $post['active_flg'];
        }

        if (isset($post['img_name']) && $post['img_name'] !== $shopdata['img_name']) {
            $sql_assignment_list .= " img_name = :img_name, ";
            $params['img_name'] = $post['img_name'];
        }

        if ($post['title'] !== $shopdata['title']) {
            $sql_assignment_list .= " title = :title, ";
            $params['title'] = $post['title'];
        }

        if ($post['job_info'] !== $shopdata['job_info']) {
            $sql_assignment_list .= " job_info = :job_info, ";
            $params['job_info'] = $post['job_info'];
        }

        if ($post['area3'] !== $shopdata['area3']) {
            $sql_assignment_list .= " area3 = :area3, ";
            $params['area3'] = $post['area3'];
        }

        if ($sql_assignment_list !== '') {
            $sql_assignment_list .= " updated_at = :updated_at" . PHP_EOL;

            $sql  = " UPDATE " . self::table() . PHP_EOL;
            $sql .= "   SET " . $sql_assignment_list . PHP_EOL;
            $sql .= "   WHERE " . PHP_EOL;
            $sql .= "     shop_id = :shop_id " . PHP_EOL;

            DB::query($sql, DB::UPDATE)->parameters($params)->execute();

            return true;
        }
        return false;
    }

    /**
     * @param array $shop_ids
     *
     * @return array
     */
    public static function get_shops_active_flg(array $shop_ids): array
    {
        $params = [];
        $sql = "SELECT sm.shop_id, sm.active_flg \n";
        $sql .= "FROM " . Model_Qzin_Shop_Main::table() . " sm \n";
        $sql .= "WHERE sm.shop_id IN :shop_ids \n";

        $params['shop_ids'] = $shop_ids;
        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array('shop_id', 'active_flg');
    }
}

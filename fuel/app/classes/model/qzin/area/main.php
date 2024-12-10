<?php

/*
 * Model_Qzin_Area_Main
 * エリアマスタ
*/

use Fuel\Core\Date;
use Fuel\Core\DB;

class Model_Qzin_Area_Main extends \Orm\Model
{
    protected static $_table_name = 'area_mains';
    protected static $_primary_key = array('area_id');
    protected static $_properties = [
        'area_id',
        'area_name',
        'area_name2',
        'area_class',
        'master_area_id',
        'master_area3',
        'area_sort',
        'group_area_id',
        'group_area_text',
        'city_area_id',
        'created_at',
        'updated_at'
    ];

    private static $cache = null;

    // area_class
    const AREA_CLASS_MASTER_AREA = 0; // 大エリア（東北・関東など）
    const AREA_CLASS_SMALL_AREA = 1; // 小エリア（新宿・渋谷など）
    const AREA_CLASS_PREF = 2; // 都道府県（東京・沖縄など）
    const AREA_CLASS_CITY = 3; // 特殊小エリア (小エリア名古屋)

    // group_area_id
    const GROUP_AREA_ID_NONE = 0; // グループエリアなし

    // master_area_id（AREA_CLASS_MASTER_AREA）
    const MASTER_AREA_ID_CHUGOKU_SHIKOK = 7000; // 中国・四国

    // pref_id (AREA_CLASS_PREF)
    const PREF_ID_HIROSHIMA = 31;

    const MASTER_AREA_SORT = [
        'kanto',                //関東
        'kansai',               //関西
        'tokai',                //東海
        'kyusyu-okinawa',       //九州/沖縄
        'hokkaido-tohoku',      //北海道/東北
        'kitakanto',            //北関東
        'hokuriku-koshinetsu',  //北陸/甲信越
        'chugoku-shikoku',      //中国・四国
    ];

    public static function get_area_by_class(int $area_class = 0): array
    {
        $params = [];

        $sql  = "SELECT * \n";
        $sql .= "FROM " . Model_Qzin_Area_Main::table() . " s \n";
        $sql .= "WHERE s.area_class = :area_class \n";
        $sql .= "ORDER BY s.area_sort \n";

        $params['area_class'] = $area_class;

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array();
    }

    public static function get_area_by_class_and_master_area_id(int $area_class, int $master_area_id): array
    {
        $params = [];

        $sql  = "SELECT * \n";
        $sql .= "FROM " . Model_Qzin_Area_Main::table() . " s \n";
        $sql .= "WHERE s.area_class = :area_class \n";
        $sql .= "AND s.master_area_id = :master_area_id  \n";
        $sql .= "ORDER BY s.area_id \n";

        $params['area_class'] = $area_class;
        $params['master_area_id'] = $master_area_id;

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array();
    }

    /**
     * @return array
     */
    public static function get_pref_area_ids_has_shop()
    {
        $params = [];

        $sql  = "SELECT s.master_area3 \n";
        $sql .= "FROM " . Model_Qzin_Area_Main::table() . " s \n";
        $sql .= "INNER JOIN ( \n";
        $sql .= "SELECT area2 \n";
        $sql .= "FROM " . Model_Qzin_Shop_Main::table() . " sm \n";
        $sql .= "WHERE sm.active_flg = :active_flg \n";
        $sql .= "AND sm.test_shop = :test_shop  \n";
        $sql .= "AND sm.option_sub_status != :option_sub_status  \n";
        $sql .= "AND sm.pay_flg IN :pay_flg  \n";
        $sql .= "AND sm.title IS NOT NULL \n";
        $sql .= "AND sm.job_info IS NOT NULL \n";
        $sql .= "AND sm.img_name IS NOT NULL \n";
        $sql .= "GROUP BY area2 \n";
        $sql .= ") sm2 \n";
        $sql .= "ON s.area_id = sm2.area2 \n";

        $params['active_flg'] = Model_Qzin_Shop_Main::ACTIVE_FLG_YES;
        $params['option_sub_status'] = Model_Qzin_Shop_Main::OPTION_SUB_STATUS_NAMI_HAIHU_C;
        $params['pay_flg'] = [Model_Qzin_Shop_Main::PAY_FLG_REGULAR_LISTING, Model_Qzin_Shop_Main::PAY_FLG_LARGE_LISTING, Model_Qzin_Shop_Main::PAY_FLG_EXTRA_LARGE_LISTING];
        $params['test_shop'] = Model_Qzin_Shop_Main::TEST_SHOP_NO;

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array('master_area3', 'master_area3');
    }

    /**
     * @return array
     */
    public static function get_area_ids_has_shop_by_pref_id($pref_id)
    {
        $params = [];

        $sql  = "SELECT ag.area_id FROM " . Model_Qzin_Area_Group::table() . " AS ag \n";
        $sql .= "INNER JOIN ( \n";
        $sql .= "SELECT s.area_id, s.group_area_id \n";
        $sql .= "FROM " . Model_Qzin_Area_Main::table() . " s \n";
        $sql .= "INNER JOIN ( \n";
        $sql .= "SELECT area2 \n";
        $sql .= "FROM " . Model_Qzin_Shop_Main::table() . " sm \n";
        $sql .= "WHERE sm.active_flg = :active_flg \n";
        $sql .= "AND sm.test_shop = :test_shop  \n";
        $sql .= "AND sm.option_sub_status != :option_sub_status  \n";
        $sql .= "AND sm.pay_flg IN :pay_flg  \n";
        $sql .= "AND sm.title IS NOT NULL \n";
        $sql .= "AND sm.job_info IS NOT NULL \n";
        $sql .= "AND sm.img_name IS NOT NULL \n";
        $sql .= "GROUP BY area2 \n";
        $sql .= ") sm2 \n";
        $sql .= "ON s.area_id = sm2.area2 \n";
        $sql .= "WHERE s.master_area3 = :pref_id \n";
        $sql .= ") AS am \n";
        $sql .= "ON ( \n";
        $sql .= "ag.area_id = am.area_id OR ag.area_id = am.group_area_id \n";
        $sql .= ") \n";

        $params['active_flg'] = Model_Qzin_Shop_Main::ACTIVE_FLG_YES;
        $params['option_sub_status'] = Model_Qzin_Shop_Main::OPTION_SUB_STATUS_NAMI_HAIHU_C;
        $params['pay_flg'] = [Model_Qzin_Shop_Main::PAY_FLG_REGULAR_LISTING, Model_Qzin_Shop_Main::PAY_FLG_LARGE_LISTING, Model_Qzin_Shop_Main::PAY_FLG_EXTRA_LARGE_LISTING];
        $params['test_shop'] = Model_Qzin_Shop_Main::TEST_SHOP_NO;
        $params['pref_id'] = $pref_id;

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array('area_id', 'area_id');
    }

    /**
     * @return array
     */
    public static function get_pref_names()
    {
        $params = [];

        $sql  = "SELECT s.area_name2 \n";
        $sql .= "FROM " . Model_Qzin_Area_Main::table() . " s \n";
        $sql .= "WHERE s.area_class = :area_class \n";
        $sql .= "ORDER BY s.area_sort \n";

        $params['area_class'] = self::AREA_CLASS_PREF;

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array();
    }

    /**
     * @return array
     */
    public static function get_popular_areas(array $popular_areas)
    {
        $params = [];

        $sql  = "SELECT s.area_id, s.area_name, s2.area_name2 \n";
        $sql .= "FROM " . Model_Qzin_Area_Main::table() . " s \n";
        $sql .= "JOIN " . Model_Qzin_Area_Main::table() . " s2 \n";
        $sql .= "ON s.master_area3 = s2.area_id \n";
        $sql .= "WHERE s.area_id IN :area_ids \n";
        $sql .= "ORDER BY FIELD (s.area_id, " . implode(', ', $popular_areas) . " ) \n";

        $params['area_ids'] = $popular_areas;

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array();
    }

    public static function get_pref_area_by_area_name2($area_name2)
    {
        $params = [];

        $sql  = "SELECT * \n";
        $sql .= "FROM " . Model_Qzin_Area_Main::table() . " s \n";
        $sql .= "WHERE s.area_class = :area_class \n";
        $sql .= "AND s.area_name2 = :area_name2 \n";

        $params['area_class'] = self::AREA_CLASS_PREF;
        $params['area_name2'] = $area_name2;

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array();
    }

    public static function get_area_by_area_id($area_id)
    {
        $params = [];

        $sql  = "SELECT * \n";
        $sql .= "FROM " . Model_Qzin_Area_Main::table() . " s \n";
        $sql .= "WHERE s.area_id = :area_id \n";

        $params['area_id'] = $area_id;

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array();
    }

    public static function get_area_by_pref_id($pref_id, $select = '*')
    {
        $select = is_array($select) ? implode(',', $select) : $select;
        $select = $select ?: '*';

        $params = [];

        $sql  = "SELECT {$select} \n";
        $sql .= "FROM " . Model_Qzin_Area_Main::table() . " s \n";
        $sql .= "WHERE s.master_area3 = :pref_id \n";

        $params['pref_id'] = $pref_id;

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array();
    }

    /**
     * @param int $area_id
     *
     * @return int
     */
    public static function get_group_area_id_by_area_id(int $area_id): int
    {
        $params = [];

        $sql = "SELECT group_area_id \n";
        $sql .= "FROM " . Model_Qzin_Area_Main::table() . " \n";
        $sql .= "WHERE area_id = :area_id \n";

        $params['area_id'] = $area_id;

        return DB::query($sql)->parameters($params)->execute()->get('group_area_id');
    }

    /**
     *
     * @param string $from_connection
     *
     * @return array
     */
    public static function get_vanilla_area_main_data(string $from_connection): array
    {
        $sql = " SELECT";
        $sql .= " area_id,";
        $sql .= " area_name,";
        $sql .= " area_name2,";
        $sql .= " area_class,";
        $sql .= " master_area_id,";
        $sql .= " master_area3,";
        $sql .= " area_sort,";
        $sql .= " group_area_id,";
        $sql .= " group_area_text";
        $sql .= " FROM area_mains";

        $area_mains_data = DB::query($sql)->execute($from_connection)->as_array();

        return $area_mains_data;
    }

    /**
     * @param array $area_mains_data
     * @param string $to_connection
     *
     * @return [type]
     */
    public static function insert_or_update_vanilla_area_main(array $area_mains_data, string $to_connection)
    {
        $values = array();
        $created_at = Date::time()->format("%Y-%m-%d %H:%M:%S");
        $updated_at = Date::time()->format("%Y-%m-%d %H:%M:%S");

        foreach ($area_mains_data as $data) {
            $value = ' (' . DB::quote($data['area_id']) . ', ' . DB::quote($data['area_name']) . ', ' . DB::quote($data['area_name2']) . ', ' . DB::quote($data['area_class']) . ', ';
            $value .= DB::quote($data['master_area_id']) . ', ' . DB::quote($data['master_area3']) . ', ' . DB::quote($data['area_sort']) . ', ' . DB::quote($data['group_area_id']) . ', ';
            $value .= DB::quote($data['group_area_text']) . ', ' . DB::quote($created_at) . ', ' . DB::quote($updated_at) . ') ';
            $values[] = $value;
        }
        $sql = " INSERT INTO area_mains";
        $sql .= " (area_id, area_name, area_name2, area_class, master_area_id, master_area3, area_sort, group_area_id, group_area_text, created_at, updated_at)";
        $sql .= " VALUES ";
        $sql .= implode(', ', $values);
        $sql .= " AS insert_value ON DUPLICATE KEY UPDATE";
        $sql .= " area_name = insert_value.area_name, area_name2 = insert_value.area_name2, area_class = insert_value.area_class,";
        $sql .= " master_area_id = insert_value.master_area_id, master_area3 = insert_value.master_area3, area_sort = insert_value.area_sort,";
        $sql .= " group_area_id = insert_value.group_area_id, group_area_text = insert_value.group_area_text, updated_at = insert_value.updated_at";

        DB::query($sql)->execute($to_connection);
    }

    /**
     * get list small area ids if area has shop
     *
     * * @return array
     */
    public static function get_area_data_has_shop(): array
    {
        $params = [];

        $sql = "SELECT am11.area_id, am2.area_name2 \n";
        $sql .= "FROM \n";
        $sql .= "( SELECT ag.area_id, ag.master_area3 \n";
        $sql .= "FROM \n";
        $sql .= Model_Qzin_Area_Group::table() . " ag \n";
        $sql .= "INNER JOIN \n";
        $sql .= "( SELECT s.area_id, s.group_area_id, s.master_area3 \n";
        $sql .= "FROM " . Model_Qzin_Area_Main::table() . " s \n";
        $sql .= "INNER JOIN ( \n";
        $sql .= "SELECT area2 \n";
        $sql .= "FROM " . Model_Qzin_Shop_Main::table() . " sm \n";
        $sql .= "WHERE sm.active_flg = :active_flg \n";
        $sql .= "AND sm.test_shop = :test_shop  \n";
        $sql .= "AND sm.option_sub_status != :option_sub_status  \n";
        $sql .= "AND sm.pay_flg IN :pay_flg  \n";
        $sql .= "AND sm.title IS NOT NULL \n";
        $sql .= "AND sm.job_info IS NOT NULL \n";
        $sql .= "AND sm.img_name IS NOT NULL \n";
        $sql .= "GROUP BY area2 \n";
        $sql .= ") sm2 \n";
        $sql .= "ON s.area_id = sm2.area2) am1 \n";
        $sql .= "ON am1.area_id = ag.area_id OR am1.group_area_id = ag.area_id \n";
        $sql .= "GROUP BY ag.area_id) am11 \n";
        $sql .= "LEFT JOIN " . Model_Qzin_Area_Main::table() . " am2 \n";
        $sql .= "ON am11.master_area3 = am2.area_id \n";

        $params['active_flg'] = Model_Qzin_Shop_Main::ACTIVE_FLG_YES; // 表示
        $params['option_sub_status'] = Model_Qzin_Shop_Main::OPTION_SUB_STATUS_NAMI_HAIHU_C; // 並盛配布C
        $params['pay_flg'] = [Model_Qzin_Shop_Main::PAY_FLG_REGULAR_LISTING, Model_Qzin_Shop_Main::PAY_FLG_LARGE_LISTING, Model_Qzin_Shop_Main::PAY_FLG_EXTRA_LARGE_LISTING];
        $params['test_shop'] = Model_Qzin_Shop_Main::TEST_SHOP_NO;

        $pref_area_ids_has_shop = DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array();
        return $pref_area_ids_has_shop;
    }

    /**
     * get list area name
     *
     * @return array
     */
    public static function get_area_name_2_by_area_class_and_area_ids(): array
    {
        $params = [];
        $sql = "SELECT area_name2 \n";
        $sql .= "FROM area_mains \n";
        $sql .= "WHERE area_class = :area_class AND area_id IN :area_ids \n";

        $params['area_class'] = self::AREA_CLASS_PREF;
        $params['area_ids'] = self::get_pref_area_ids_has_shop();

        return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array();
    }


    /**
     * @param int $area1_id
     *
     * @return string
     */
    public static function get_large_area_name_by_area_id(int $area1_id): string
    {
        $params = [];

        $sql = "SELECT area_name2 \n";
        $sql .= "FROM " . Model_Qzin_Area_Main::table() . " \n";
        $sql .= "WHERE area_id = :area1_id AND master_area_id = 0 \n";

        $params['area1_id'] = $area1_id;

        return DB::query($sql)->parameters($params)->execute()->get('area_name2');
    }
}

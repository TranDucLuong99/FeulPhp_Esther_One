<?php

/*
 * Model_Qzin_Area_Main
 * エリアマスタ
*/

use Fuel\Core\Date;
use Fuel\Core\DB;

class Model_Qzin_Area_Group extends \Orm\Model
{
	protected static $_table_name = 'area_groups';
	protected static $_primary_key = array('area_id');
	protected static $_properties = [
		'area_id',
		'area_name',
		'area_class',
		'master_area_id',
		'master_area3',
		'area_sort',
		'created_at',
		'updated_at'
	];

	//area_class
	const AREA_CLASS_MASTER_AREA = 0; // 大エリア（東北・関東など）
	const AREA_CLASS_SMALL_AREA = 1; // 小エリア（新宿・渋谷など）
	const AREA_CLASS_PREF = 2; // 都道府県（東京・沖縄など）
	const AREA_CLASS_CITY = 3; // 特殊小エリア (小エリア名古屋)

	public static function get_area_by_pref_id($pref_id)
	{
		$params = [];

		$sql = "SELECT * \n";
		$sql .= "FROM " . Model_Qzin_Area_Group::table() . " ag \n";
		$sql .= "WHERE ag.master_area3 = :pref_id \n";
		$sql .= "AND ag.area_class = " . Model_Qzin_Area_Group::AREA_CLASS_SMALL_AREA. " \n";
		$sql .= "ORDER BY ag.area_sort ASC  \n";

		$params['pref_id'] = $pref_id;

		return DB::query($sql)->parameters($params)->execute()->as_array();
	}

	public static function get_area_group_name_by_id($area_group_id)
	{
		$params = [];

		$sql = "SELECT * \n";
		$sql .= "FROM " . Model_Qzin_Area_Group::table() . " ag \n";
		$sql .= "WHERE ag.area_id = :area_group_id \n";

		$params['area_group_id'] = $area_group_id;

		return DB::query($sql)->parameters($params)->execute()->as_array();
	}

	/**
	 * @param string $from_connection
	 *
	 * @return array
	 */
	public static function get_vanilla_area_group_data(string $from_connection): array
	{
		$sql = " SELECT";
		$sql .= " area_id,";
		$sql .= " area_name,";
		$sql .= " area_class,";
		$sql .= " master_area_id,";
		$sql .= " master_area3,";
		$sql .= " area_sort";
		$sql .= " FROM area_groups";

		$area_group_data = DB::query($sql)->execute($from_connection)->as_array();

		return $area_group_data;
	}

	/**
	 * @param array $area_group_data
	 * @param string $to_connection
	 *
	 * @return [type]
	 */
	public static function insert_or_update_vanilla_area_group(array $area_group_data, string $to_connection)
	{
		$values = array();
		$created_at = Date::time()->format("%Y-%m-%d %H:%M:%S");
		$updated_at = Date::time()->format("%Y-%m-%d %H:%M:%S");

		foreach ($area_group_data as $data) {
			$value = ' (' . DB::quote($data['area_id']) . ', ' . DB::quote($data['area_name']) . ', ' . DB::quote($data['area_class']) . ', ';
			$value .= DB::quote($data['master_area_id']) . ', ' . DB::quote($data['master_area3']) . ', ' . DB::quote($data['area_sort']) . ', ';
			$value .= DB::quote($created_at) . ', ' . DB::quote($updated_at) . ') ';

			$values[] = $value;
		}

		$sql = " INSERT INTO area_groups";
		$sql .= " (area_id, area_name, area_class, master_area_id, master_area3, area_sort, created_at, updated_at)";
		$sql .= " VALUES ";
		$sql .= implode(', ', $values);
		$sql .= " AS insert_values ON DUPLICATE KEY UPDATE";
		$sql .= " area_name = insert_values.area_name, area_class = insert_values.area_class, master_area_id = insert_values.master_area_id,";
		$sql .= " area_sort = insert_values.area_sort, updated_at = insert_values.updated_at";

		DB::query($sql)->execute($to_connection);
	}
}

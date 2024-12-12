<?php

use Fuel\Core\Date;
use Fuel\Core\DB;

class Model_Qzin_Provisions extends \Orm\Model
{
	protected static $_table_name = 'provisions';

	protected static $_properties = array(
		'provision_id',
		'provision_class',
		'provision_sort',
		'provision_name',
		'type',
		'del_flg',
		'created_at',
		'updated_at',
	);

	//主キーはジャンルID
	protected static $_primary_key = array('provision_id');

	public static function get_provisions(array $provision_ids): array
	{

		$params = [];
		$sql = "SELECT provision_id, provision_name \n";
		$sql .= "FROM " . Model_Qzin_Provisions::table() . " \n";
		$sql .= "WHERE provision_id in :provision_ids \n";
		$sql .= "order by provision_class, provision_sort \n";
		$params['provision_ids'] = $provision_ids;

		return DB::query($sql, DB::SELECT)->parameters($params)->execute()->as_array();
	}

	/**
	 * @param string $from_connection
	 * 
	 * @return array
	 */
	public static function get_vanilla_provisions_data(string $from_connection): array
	{
		$sql = " SELECT";
		$sql .= " provision_id,";
		$sql .= " provision_class,";
		$sql .= " provision_sort,";
		$sql .= " sp_detail_name,";
		$sql .= " type,";
		$sql .= " del_flg";
		$sql .= " FROM provisions";

		$provisions_data = DB::query($sql)->execute($from_connection)->as_array();

		return $provisions_data;
	}

	/**
	 * @param array $provisions_data
	 * @param string $to_connection
	 * 
	 * @return [type]
	 */
	public static function insert_or_update_vanilla_provisions(array $provisions_data, string $to_connection)
	{
		$values = array();
		$created_at = Date::time()->format("%Y-%m-%d %H:%M:%S");
		$updated_at = Date::time()->format("%Y-%m-%d %H:%M:%S");

		foreach ($provisions_data as $data) {
			$value = ' (' . DB::quote($data['provision_id']) . ', ' . DB::quote($data['provision_class']) . ', ' . DB::quote($data['provision_sort']) . ', ';
			$value .= DB::quote($data['sp_detail_name']) . ', ' . DB::quote($data['type']) . ', ' . DB::quote($data['del_flg']) . ', ' . DB::quote($created_at) . ', ' . DB::quote($updated_at) . ') ';
			$values[] = $value;
		}

		$sql = " INSERT INTO provisions";
		$sql .= " (provision_id, provision_class, provision_sort, provision_name, type, del_flg, created_at, updated_at)";
		$sql .= " VALUES ";
		$sql .= implode(', ', $values);
		$sql .= " AS insert_values ON DUPLICATE KEY UPDATE";
		$sql .= " provision_class = insert_values.provision_class, provision_sort = insert_values.provision_sort, provision_name = insert_values.provision_name,";
		$sql .= " type = insert_values.type, updated_at = insert_values.updated_at";

		DB::query($sql)->execute($to_connection);
	}
}

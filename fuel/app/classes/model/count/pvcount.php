<?php

/**
 * pv_countsテーブル
 * 店舗詳細ページビュー回数保存
 */
class Model_Count_Pvcount extends \Orm\Model
{
	/** @var string pv数を保存するテーブル名 */
	protected static $_table_name = 'pv_counts';

	/** @var array<string> pv数を保存するテーブルのカラム一覧 */
	protected static $_properties = [
		'id',
		'shop_autonum',
		'pc_pv',
		'sp_pv',
		'work_date',
		'created_at',
		'updated_at'
	];

	const PC_PV = 'pc_pv';
	const SP_PV = 'sp_pv';

	/**
	 * @param string $shop_autonum
	 * @param string $work_date
	 *
	 * @return void
	 */
	public static function insert_count_pc_pv(string $shop_autonum, string $work_date): void
	{
		$click_num = 1;
		$current_date_time = Date::time()->format("%Y-%m-%d %H:%M:%S");

		$sql = 'INSERT INTO ' . self::table();
		$sql .= " (shop_autonum, pc_pv, work_date, created_at, updated_at)" . PHP_EOL;
		$sql .= ' VALUES (:shop_autonum, :click_num, :work_date, :created_at, :updated_at);' . PHP_EOL;

		$params = [
			'shop_autonum' => $shop_autonum,
			'click_num' => $click_num,
			'work_date' => $work_date,
			'created_at' => $current_date_time,
			'updated_at' => $current_date_time
		];

		DB::query($sql, DB::INSERT)->parameters($params)->execute();
	}

	/**
	 * @param string $shop_autonum
	 * @param string $work_date
	 *
	 * @return void
	 */
	public static function insert_count_sp_pv(string $shop_autonum, string $work_date): void
	{
		$click_num = 1;
		$current_date_time = Date::time()->format("%Y-%m-%d %H:%M:%S");

		$sql = 'INSERT INTO ' . self::table();
		$sql .= " (shop_autonum, sp_pv, work_date, created_at, updated_at)" . PHP_EOL;
		$sql .= ' VALUES (:shop_autonum, :click_num, :work_date, :created_at, :updated_at);' . PHP_EOL;

		$params = [
			'shop_autonum' => $shop_autonum,
			'click_num' => $click_num,
			'work_date' => $work_date,
			'created_at' => $current_date_time,
			'updated_at' => $current_date_time
		];

		DB::query($sql, DB::INSERT)->parameters($params)->execute();
	}

	/**
	 * @param string $shop_autonum
	 * @param int $click_num
	 * @param string $work_date
	 *
	 * @return void
	 */
	public static function update_count_pc_pv(string $shop_autonum, int $click_num, string $work_date): void
	{
		$updated_at = Date::time()->format("%Y-%m-%d %H:%M:%S");

		$sql = "UPDATE " . self::table() . PHP_EOL;
		$sql .= "SET " . PHP_EOL;
		$sql .= "   pc_pv = :click_num," . PHP_EOL;
		$sql .= "   updated_at = :updated_at " . PHP_EOL;
		$sql .= "WHERE " . PHP_EOL;
		$sql .= "   shop_autonum = :shop_autonum " . PHP_EOL;
		$sql .= "   AND work_date = :work_date " . PHP_EOL;

		$params = [
			'click_num' => $click_num,
			'updated_at' => $updated_at,
			'shop_autonum' => $shop_autonum,
			'work_date' => $work_date,
		];

		DB::query($sql, DB::UPDATE)->parameters($params)->execute();
	}

	/**
	 * @param string $shop_autonum
	 * @param int $click_num
	 * @param string $work_date
	 *
	 * @return void
	 */
	public static function update_count_sp_pv(string $shop_autonum, int $click_num, string $work_date): void
	{
		$updated_at = Date::time()->format("%Y-%m-%d %H:%M:%S");

		$sql = "UPDATE " . self::table() . PHP_EOL;
		$sql .= "SET " . PHP_EOL;
		$sql .= "   sp_pv = :click_num," . PHP_EOL;
		$sql .= "   updated_at = :updated_at " . PHP_EOL;
		$sql .= "WHERE " . PHP_EOL;
		$sql .= "   shop_autonum = :shop_autonum " . PHP_EOL;
		$sql .= "   AND work_date = :work_date " . PHP_EOL;

		$params = [
			'click_num' => $click_num,
			'updated_at' => $updated_at,
			'shop_autonum' => $shop_autonum,
			'work_date' => $work_date,
		];

		DB::query($sql, DB::UPDATE)->parameters($params)->execute();
	}

	/**
	 * @param string $shop_autonum
	 * @param string $work_date
	 * @return array
	 */
	public static function get_pv_by_shop_autonum_and_date(string $shop_autonum, string $work_date): array
	{
		$sql = " SELECT \n";
		$sql .= "   pc_pv, \n";
		$sql .= "   sp_pv \n";
		$sql .= " FROM " . self::table() . " \n";
		$sql .= " WHERE  \n";
		$sql .= "   shop_autonum = :shop_autonum \n";
		$sql .= "   AND work_date = :work_date \n";

		$params = [
			'shop_autonum' => $shop_autonum,
			'work_date' => $work_date,
		];

		return DB::query($sql, DB::SELECT)->parameters($params)->execute()->current() ?? [];
	}
}

<?php

/**
 * telltap_countsテーブル
 * 電話タップ数を保存
 */
class Model_Count_Telltap extends \Orm\Model
{
	/** @var string 電話タップ数を保存するテーブル名 */
	protected static $_table_name = 'telltap_counts';

	/** @var array<string> 電話タップ数を保存するテーブルのカラム一覧 */
	protected static $_properties = [
		'id',
		'shop_autonum',
		'sp_telltap_a',
		'sp_telltap_b',
		'work_date',
		'created_at',
		'updated_at'
	];

	const SP_TELL_TAP_NUM_A = 'sp_telltap_a';          // 集計A(電話ボタンタップ時)
	const SP_TELL_TAP_NUM_B = 'sp_telltap_b';          // 集計B(ポップアップ内電話をする押下時)

	/**
	 * @param string $shop_autonum
	 * @param string $work_date
	 *
	 * @return void
	 */
	public static function insert_count_telltap_a(string $shop_autonum, string $work_date): void
	{
		$click_num = 1;
		$current_date_time = Date::time()->format("%Y-%m-%d %H:%M:%S");

		$sql = 'INSERT INTO ' . self::table();
		$sql .= " (shop_autonum, sp_telltap_a, work_date, created_at, updated_at)" . PHP_EOL;
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
	public static function insert_count_telltap_b(string $shop_autonum, string $work_date): void
	{
		$click_num = 1;
		$current_date_time = Date::time()->format("%Y-%m-%d %H:%M:%S");

		$sql = 'INSERT INTO ' . self::table();
		$sql .= " (shop_autonum, sp_telltap_b, work_date, created_at, updated_at)" . PHP_EOL;
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
	public static function update_count_telltap_a(string $shop_autonum, int $click_num, string $work_date): void
	{
		$updated_at = Date::time()->format("%Y-%m-%d %H:%M:%S");

		$sql = "UPDATE " . self::table() . PHP_EOL;
		$sql .= "SET " . PHP_EOL;
		$sql .= "   sp_telltap_a = :click_num," . PHP_EOL;
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
	public static function update_count_telltap_b(string $shop_autonum, int $click_num, string $work_date): void
	{
		$updated_at = Date::time()->format("%Y-%m-%d %H:%M:%S");

		$sql = "UPDATE " . self::table() . PHP_EOL;
		$sql .= "SET " . PHP_EOL;
		$sql .= "   sp_telltap_b = :click_num," . PHP_EOL;
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
	public static function get_tap_by_shop_autonum_and_date(string $shop_autonum, string $work_date): array
	{
		$sql = " SELECT \n";
		$sql .= "   sp_telltap_a, \n";
		$sql .= "   sp_telltap_b \n";
		$sql .= " FROM " . self::table() . " \n";
		$sql .= " WHERE shop_autonum = :shop_autonum \n";
		$sql .= " AND work_date = :work_date \n";

		$params = [
			'shop_autonum' => $shop_autonum,
			'work_date' => $work_date,
		];

		return DB::query($sql, DB::SELECT)->parameters($params)->execute()->current() ?? [];
	}
}
<?php

/*
 * Model_Qzin_Shop_Detail
 * 採用マスタ
*/

use Fuel\Core\Date;
use Fuel\Core\DB;

class Model_Qzin_Shop_Detail extends \Orm\Model
{
	//テーブル名
	protected static $_table_name = 'shop_details';

	const SALARY_TYPE_NO = 0; //入力なし
	const SALARY_TYPE_DAYWAGE = 1;
	const SALARY_TYPE_BACKRATE = 2;

	protected static $_properties = [
		'id',
		'shop_id',
		'occupation',
		'work_area',
		'work_day',
		'work_time',
		'access',
		'salary',
		'salary_check',
		'salary_money',
		'saiyo',
		'provision',
		'provision_list',
		'saiyo_open_time',
		'saiyo_close_time',
		'saiyo_tel',
		'saiyo_email',
		'saiyo_url',
		'saiyo_url2',
		'saiyo_url3',
		'saiyo_line_id',
		'saiyo_line_url',
		'workaway_flg',
		'shop_open_time',
		'shop_close_time',
		'touchspot_widget_flg',
		'created_at',
		'updated_at',
	];
	//主キー
	protected static $_primary_key = array('id', 'shop_id');

	const TOUCHSPOT_WIDGET_ON = 1; // タッチスポット動画ウィジェット表示
	const TOUCHSPOT_WIDGET_OFF = 0; // タッチスポット動画ウィジェット非表示
	const SALARY_SETTING_NO = 0; // 給与項目（月額・日給・時給）を設定してない場合

	/**
	 * @param string $from_connection
	 *
	 * @return int
	 */
	public static function get_vanilla_total_shop_detail_record(string $from_connection): int
	{
		$sql = " SELECT COUNT(shop_details.shop_id) AS total";
		$sql .= " FROM shop_details";
		$sql .= " JOIN shop_mains ON";
		$sql .= " (shop_mains.shop_id = shop_details.shop_id)";
		$sql .= " LEFT JOIN shop_salaries ON";
		$sql .= " (shop_mains.id = shop_salaries.shop_autonum)";
		$sql .= " WHERE shop_mains.genre = 22 "; //22：メンズエステ

		$total = DB::query($sql)->execute($from_connection)->get('total');
		return intval($total);
	}

	/**
	 * @param int $chunk_size
	 * @param int $offset
	 * @param string $from_connection
	 *
	 * @return array
	 */
	public static function get_vanilla_shop_detail_data(int $chunk_size, int $offset, string $from_connection): array
	{
		$sql = " SELECT";
		$sql .= " shop_details.id,";
		$sql .= " shop_details.shop_id,";
		$sql .= " saiyo,";
		$sql .= " work_area,";
		$sql .= " work_time,";
		$sql .= " work_day,";
		$sql .= " access,";
		$sql .= " provision_list,";
		$sql .= " saiyo_open_time,";
		$sql .= " saiyo_close_time,";
		$sql .= " shop_salaries.type,";
		$sql .= " shop_salaries.daywage_money,";
		$sql .= " shop_salaries.daywage_text,";
		$sql .= " shop_salaries.backrate_money,";
		$sql .= " shop_salaries.backrate_text,";
		$sql .= " saiyo_tel,";
		$sql .= " saiyo_line_id,";
		$sql .= " saiyo_line_url";
		$sql .= " FROM shop_details";
		$sql .= " JOIN shop_mains ON";
		$sql .= " (shop_mains.shop_id = shop_details.shop_id)";
		$sql .= " LEFT JOIN shop_salaries ON";
		$sql .= " (shop_mains.id = shop_salaries.shop_autonum)";
		$sql .= " WHERE shop_mains.genre = 22 "; //22：メンズエステ
		$sql .= " ORDER BY shop_details.id ";
		$sql .= " LIMIT :limit OFFSET :offset";

		$shop_detail_data = DB::query($sql)
			->parameters(array('limit' => $chunk_size, 'offset' => $offset))
			->execute($from_connection)->as_array();

		return $shop_detail_data;
	}

	/**
	 * @param array $shop_detail_data
	 * @param string $to_connection
	 *
	 * @return [type]
	 */
	public static function insert_or_update_vanilla_shop_detail(array $shop_detail_data, string $to_connection)
	{
		$values = array();
		$remark = '';            //後日リリースで使うので初期は空で登録
		$client_remark = '';    //後日リリースで使うので初期は空で登録
		$created_at = Date::time()->format("%Y-%m-%d %H:%M:%S");
		$updated_at = Date::time()->format("%Y-%m-%d %H:%M:%S");

		foreach ($shop_detail_data as $data) {
			$data['type'] = $data['type'] == null ? 0 : $data['type'];    //給与タイプ入力なし
			$value = ' (' . DB::quote($data['id']) . ', ' . DB::quote($data['shop_id']) . ', ' . DB::quote($data['saiyo']) . ', ' . DB::quote($data['work_area']) . ', ';
			$value .= DB::quote($data['work_time']) . ', ' . DB::quote($data['work_day']) . ', ' . DB::quote($data['access']) . ', ' . DB::quote($data['provision_list']) . ', ';
			$value .= DB::quote($data['saiyo_open_time']) . ', ' . DB::quote($data['saiyo_close_time']) . ', ' . DB::quote($data['type']) . ', ' . DB::quote($data['daywage_money']) . ', ';
			$value .= DB::quote($data['daywage_text']) . ', ' . DB::quote($data['backrate_money']) . ', ' . DB::quote($data['backrate_text']) . ', ' . DB::quote($data['saiyo_tel']) . ', ';
			$value .= DB::quote($data['saiyo_line_id']) . ', ' . DB::quote($data['saiyo_line_url']) . ', ' . DB::quote($remark) . ', ' . DB::quote($client_remark) . ', ';
			$value .= DB::quote($created_at) . ', ' . DB::quote($updated_at) . ') ';
			$values[] = $value;
		}

		$sql = " INSERT INTO shop_details";
		$sql .= " (id, shop_id, saiyo, work_area, work_time, work_day, access, provision_list, saiyo_open_time, saiyo_close_time,";
		$sql .= " salary_type, daywage_money, daywage_text, backrate_money, backrate_text, saiyo_tel, saiyo_line_id, saiyo_line_url,";
		$sql .= " remark, client_remark, created_at, updated_at)";
		$sql .= " VALUES ";
		$sql .= implode(', ', $values);
		$sql .= " AS insert_values ON DUPLICATE KEY UPDATE";
		$sql .= " id = insert_values.id, shop_id = insert_values.shop_id, provision_list = insert_values.provision_list, saiyo_open_time = insert_values.saiyo_open_time, saiyo_close_time = insert_values.saiyo_close_time,";
		$sql .= " salary_type = insert_values.salary_type, daywage_money = insert_values.daywage_money, backrate_money = insert_values.backrate_money, saiyo_tel = insert_values.saiyo_tel,";
		$sql .= " saiyo_line_id = insert_values.saiyo_line_id, saiyo_line_url = insert_values.saiyo_line_url, updated_at = insert_values.updated_at";

		DB::query($sql)->execute($to_connection);
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

	    if ($post['saiyo'] !== $shopdata['saiyo']) {
	        $sql_assignment_list .= " saiyo = :saiyo, " . PHP_EOL;
	        $params['saiyo'] = $post['saiyo'];
	    }

	    if ($post['work_area'] !== $shopdata['work_area']) {
	        $sql_assignment_list .= " work_area = :work_area, " . PHP_EOL;
	        $params['work_area'] = $post['work_area'];
	    }

	    if ($post['work_time'] !== $shopdata['work_time']) {
	        $sql_assignment_list .= " work_time = :work_time, " . PHP_EOL;
	        $params['work_time'] = $post['work_time'];
	    }

	    if ($shopdata['salary_type'] === (string)Model_Qzin_Shop_Detail::SALARY_TYPE_DAYWAGE) {
	        if ($post['salary_text'] !== $shopdata['daywage_text']) {
	            $sql_assignment_list .= " daywage_text = :daywage_text, " . PHP_EOL;
	            $params['daywage_text'] = $post['salary_text'];
	        }
	    }

	    if ($shopdata['salary_type'] === (string)Model_Qzin_Shop_Detail::SALARY_TYPE_BACKRATE) {
	        if ($post['salary_text'] !== $shopdata['backrate_text']) {
	            $sql_assignment_list .= " backrate_text = :backrate_text, " . PHP_EOL;
	            $params['backrate_text'] = $post['salary_text'];
	        }
	    }

	    if ($post['access'] !== $shopdata['access']) {
	        $sql_assignment_list .= " access = :access, " . PHP_EOL;
	        $params['access'] = $post['access'];
	    }

	    if ($post['work_day'] !== $shopdata['work_day']) {
	        $sql_assignment_list .= " work_day = :work_day, " . PHP_EOL;
	        $params['work_day'] = $post['work_day'];
	    }

	    if ($post['remark'] !== $shopdata['remark']) {
	        $sql_assignment_list .= " remark = :remark, " . PHP_EOL;
	        $params['remark'] = $post['remark'];
	    }

	    if ($post['client_remark'] !== $shopdata['client_remark']) {
	        $sql_assignment_list .= " client_remark = :client_remark, " . PHP_EOL;
	        $params['client_remark'] = $post['client_remark'];
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
}

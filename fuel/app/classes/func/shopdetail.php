<?php

class Func_Shopdetail
{
	/**
	 * @param string $shop_autonum
	 * @param string $media
	 *
	 * @return void
	 */
	public static function pv_count_up(string $shop_autonum, string $media): void
	{

		// 本番のみ社内IP除外(カウントしない)
		if (Fuel::$env === Fuel::PRODUCTION && Func_App::chk_ip()) {
			return;
		}

		// ユーザーエージェントに「googlebot」文字列が入っている場合カウントしない
		if (stripos($_SERVER['HTTP_USER_AGENT'], 'googlebot') !== false) {
			return;
		}

		if ($media == CONST_ENV_PC) {
			$type = Model_Count_Pvcount::PC_PV;
		} else {
			$type = Model_Count_Pvcount::SP_PV;
		}

		$date = date("Y-m-d");

		// その店舗が当日クリックされたか確認
		$today_pv = Model_Count_Pvcount::get_pv_by_shop_autonum_and_date($shop_autonum, $date);

		if (empty($today_pv)) {
			try {
				DB::start_transaction();

				if ($type == Model_Count_Pvcount::PC_PV) {
					Model_Count_Pvcount::insert_count_pc_pv($shop_autonum, $date);
				} else {
					Model_Count_Pvcount::insert_count_sp_pv($shop_autonum, $date);
				}

				DB::commit_transaction();
			} catch (Exception $e) {
				Log::error($e, '店舗詳細画面 店舗のPV数データ追加処理でエラーが発生しました。');
				DB::rollback_transaction();
			}
		} else {
			$click_num = (int)$today_pv[$type] + 1;

			try {
				DB::start_transaction();

				if ($type == Model_Count_Pvcount::PC_PV) {
					Model_Count_Pvcount::update_count_pc_pv($shop_autonum, $click_num, $date);
				} else {
					Model_Count_Pvcount::update_count_sp_pv($shop_autonum, $click_num, $date);
				}

				DB::commit_transaction();
			} catch (Exception $e) {
				Log::error($e, '店舗詳細画面 店舗のPV数データ更新処理でエラーが発生しました。');
				DB::rollback_transaction();
			}
		}
	}
}

<?php

class Service_User_Datalayer_Detail
{
	const TAP_POSITION_APPLY = 'apply';
	const SNS_TYPE_URL = '友達追加';
	const SNS_TYPE_ID = 'idコピー';

	public $shop_plan_array = [
		Model_Qzin_Shop_Main::PAY_FLG_FREE_LISTING => '10', //無料
		Model_Qzin_Shop_Main::PAY_FLG_PAID_LISTING => '11', //有料落ち
		Model_Qzin_Shop_Main::PAY_FLG_EXTRA_LARGE_LISTING => '21', //特盛
		Model_Qzin_Shop_Main::PAY_FLG_LARGE_LISTING => '22', //大盛
		Model_Qzin_Shop_Main::PAY_FLG_REGULAR_LISTING => '23', //並盛
	];

	/**
	 * @param mixed $region
	 * @param string $prefarea
	 * @param mixed $area
	 * @param null|array $shop_main
	 * @return string
	 */
	public function create_onmousedown_tel($region, $prefarea, $area, $shop_main): string
	{
		$datalayer = $this->make_datalayer($region, $prefarea, $area, $shop_main, 'tel_tap');
		$str = $this->make_datalayer_str($datalayer);
		return 'dataLayer.push({' . $str . '});';
	}

	/**
	 * @param mixed $region
	 * @param string $prefarea
	 * @param mixed $area
	 * @param null|array $shop_main
	 * @param string $sns_type
	 * @return string
	 */
	public function create_onmousedown_line($region, $prefarea, $area, $shop_main, $sns_type): string
	{
		$datalayer = $this->make_datalayer($region, $prefarea, $area, $shop_main, 'sns_tap', $sns_type);
		$str = $this->make_datalayer_str($datalayer);
		return 'dataLayer.push({' . $str . '});';
	}

	/**
	 *
	 * @return string
	 */
	public function create_onmousedown_mailto(): string
	{
		$datalayer = [
			'event' => 'select_mailto'
		];
		$str = $this->make_datalayer_str($datalayer);
		return 'dataLayer.push({' . $str . '});';
	}

	/**
	 * @param mixed $region
	 * @param string $prefarea
	 * @param mixed $area
	 * @param null|array $shop_main
	 * @param string $event
	 * @param null|string $sns_type
	 * @return array
	 */
	private function make_datalayer($region, $prefarea, $area, $shop_main, $event, $sns_type = null): array
	{
		$datalayer = [
			'event' => $event,
			'shop_region' => $region['area_name'],
			'shop_prefecture' => $prefarea['area_name'],
			'shop_area' => $area['area_name'],
			'shop_area_id' => $area['group_area_id'] != 0 ? $area['group_area_id'] : $area['area_id'],
			'shop_name' => Security::htmlentities(str_replace("'", "\'", $shop_main['shop_name_estheone'])),
			'shop_id' => $shop_main['id'],
			'shop_plan' => isset($shop_main['pay_flg']) ? $this->shop_plan_array[$shop_main['pay_flg']] ?? null : null,
			'tap_position' => self::TAP_POSITION_APPLY,
		];

		if ($sns_type) {
			$datalayer['sns_type'] = $sns_type;
		}

		return $datalayer;
	}

	/**
	 * @param array $datalayer
	 * @return string
	 */
	private function make_datalayer_str(array $datalayer): string
	{
		$str = '';
		foreach ($datalayer as $key => $value) {
			if (!empty($str)) {
				$str .= ',';
			}
			$str .= '\'' . $key . '\':' . '\'' . $value . '\'';
		}
		return $str;
	}
}
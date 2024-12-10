<?php

class Service_User_Shop
{

	/**
	 * @param int|null $small_area_id
	 * @param int|null $pref_id
	 * 
	 * @return array
	 */
	public function get_shop_mains_autonum(?int $small_area_id = null, ?int $pref_id = null): array
	{
		$shops = Model_Qzin_Shop_Main::get_shop_mains_autonum($small_area_id, $pref_id);

		return $shops;
	}

	/**
	 * @param array $shops_autonum
	 * 
	 * @return array
	 */
	public function get_shops_by_autonum(array $shops_autonum): array
	{
		$shops = Model_Qzin_Shop_Main::get_shops_by_autonum($shops_autonum);
		return $shops;
	}

	/**
	 * @param array<int> $area2_ids
	 * @return int
	 */
	public function get_total_shop_mains_record(?int $small_area_id = null, ?int $pref_id = null)
	{
		$total_shop_mains_record = Model_Qzin_Shop_Main::get_total_shop($small_area_id, $pref_id);

		return intval($total_shop_mains_record);
	}

	/**
	 * @param string $shop_id
	 * @return array|null
	 */
	public function get_shop_detail_by_shop_id(string $shop_id)
	{
		$shop = null;
		$shops = Model_Qzin_Shop_Main::get_shop_detail_by_shop_id($shop_id);

		if (!empty($shops)) {
			$shop = $shops[0];
		}
		if ($shop) {
			$area_service = new Service_User_Area();
			$area2 = $area_service->get_area_by_id($shop['area2']);
			$group_area_id = $area_service->get_group_area_id_by_area_id($shop['area2']);
			$shop['shopstatus_icon_txt'] = Model_Qzin_Shop_Main::SHOPSTATUS_ICON[$shop['shopstatus_icon']];
			$shop['area2_name'] = $area2['area_name'];
			if ($shop['provision_list']) {
				$shop['provisions'] = $this->make_provision_list($shop['provision_list']);
			} else {
				$shop['provisions'] = [];
			}
			$shop['group_area_id'] = $group_area_id == 0 ? $shop['area2'] : $group_area_id;
		}
		return $shop;
	}

	/**
	 * @param string $provision_list
	 * @return array{
	 *     qualifications: array<string>,
	 *     salaries: array<string>,
	 *     working_days: array<string>,
	 *     working_hours: array<string>,
	 *     reception_hours: array<string>,
	 *     benefits: array<string>
	 * }
	 */
	public function make_provision_list($provision_list)
	{
		$provision_ids = explode(',', $provision_list);
		$provision_datas = Model_Qzin_Provisions::get_provisions($provision_ids);
		$provisions = [
			'qualifications' => [],
			'salaries' => [],
			'working_days' => [],
			'working_hours' => [],
			'reception_hours' => [],
			'benefits' => [],
		];
		foreach ($provision_datas as $provision) {
			if (in_array($provision['provision_id'], Config::get('app.provisions.qualifications'))) {
				$provisions['qualifications'][] = $provision['provision_name'];
				continue;
			}
			if (in_array($provision['provision_id'], Config::get('app.provisions.salaries'))) {
				$provisions['salaries'][] = $provision['provision_name'];
				continue;
			}
			if (in_array($provision['provision_id'], Config::get('app.provisions.working_days'))) {
				$provisions['working_days'][] = $provision['provision_name'];
				continue;
			}
			if (in_array($provision['provision_id'], Config::get('app.provisions.working_hours'))) {
				$provisions['working_hours'][] = $provision['provision_name'];
				continue;
			}
			if (in_array($provision['provision_id'], Config::get('app.provisions.reception_hours'))) {
				$provisions['reception_hours'][] = $provision['provision_name'];
				continue;
			}
			if (in_array($provision['provision_id'], Config::get('app.provisions.benefits'))) {
				$provisions['benefits'][] = $provision['provision_name'];
			}
		}

		return $provisions;
	}
}

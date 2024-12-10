<?php

use Fuel\Core\Response;
use Fuel\Core\View;

/**
 * エリア検索ページコントローラ
 */
class Controller_User_Search_Prefarea extends Controller_User_Search_Base
{
	const OFFSET = 0;
	const LIMIT = 30;

	public function before()
	{
		parent::before();
		$this->add_css("user/common/modal.css");
		$this->add_css("user/list.css");
		$this->add_js("user/common/modal.js");
		$this->add_js("user/top.js");
		$this->add_js("user/search.js");
		$this->set_common_header("user/common/header_job");
		$this->set_common_footer("user/common/footer_job", ['is_detail' => $this->is_detail]);
	}

	public function action_index()
	{
        dd(1);
		$area_name_rp = preg_replace('/(県|都|府)$/u', '', $this->prefarea['area_name']);
		$this->meta['title']		= $area_name_rp . 'のメンズエステ求人【エステワン】';
		$this->meta['description']	= $area_name_rp . 'のメンズエステ求人情報を豊富に掲載しています。';
		$this->meta['noindex']		= 'index';
		$this->meta['nofollow']		= 'follow';
		$this->meta['canonical']	= Uri::base() . $this->prefarea['area_name2'] . '/';
		$this->meta['h1']			= $this->prefarea['area_name_rp'] . 'のメンズエステ求人';

		$service_shop = new Service_User_Shop();

		$total_shop_mains_record = $service_shop->get_total_shop_mains_record(null, $this->prefarea['area_id']);

		if ($total_shop_mains_record == 0) {
			$this->add_css("user/no_result.css");

			$this->set_common_header("user/common/header_404");
			$this->set_common_footer("user/common/footer_404");
			// GTM表示判定
			$this->disp_gtm = false;
			$this->set_page_content(View::forge("user/no_result"), 404);
			$this->meta['noindex'] = 'noindex';
			return;
		}

		$shops_autonum = $service_shop->get_shop_mains_autonum(null, $this->prefarea['area_id']);
		$init_shops_autonum = array_slice($shops_autonum, $this::OFFSET, $this::LIMIT, true);
		$remaining_shops_autonum = array_slice($shops_autonum, $this::LIMIT, null, true);

		$shops = $service_shop->get_shops_by_autonum($init_shops_autonum);

		$view_data = [
			'shops' => $shops,
			'total_shop_mains_record' => $total_shop_mains_record,
			'env_img_url' => CONST_ENV_IMG_URL,
			'limit_shop_per_page' => $this::LIMIT,
			'remaining_shops_autonum' => implode(',', $remaining_shops_autonum),
		];

		$this->set_page_content(View::forge("user/job", $view_data, false));
	}
}

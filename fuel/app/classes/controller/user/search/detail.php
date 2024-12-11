<?php

use Fuel\Core\View;

/**
 * 求人詳細検索ページコントローラ
 */
class Controller_User_Search_Detail extends Controller_User_Search_Base
{
	private $datalayer_obj = null;

	public function before()
	{
		parent::before();
		$this->add_css("user/common/modal.css");
		$this->add_css("user/detail.css");
		$this->add_js("user/common/modal.js");
		$this->add_js("user/top.js");
		$this->add_js("user/detail.js");
		$this->set_common_header("user/common/header_job");
		$this->set_common_footer("user/common/footer_job", ['is_detail' => true]);
	}

	public function action_index()
	{
        dd(1);
		$service_shop = new Service_User_Shop();
		$this->datalayer_obj = new Service_User_Datalayer_Detail();
		$id = $this->param('s_shop_id', null);
		$shop = $service_shop->get_shop_detail_by_shop_id($id);

		if (!$shop || ($this->area['area_id'] != $shop['group_area_id'])) {
			throw new HttpNotFoundException;
		}

		// 小エリアの都府県が消えてしまうため暫定対応
		$this->area['area_name_rp'] = $this->area['area_name'];

		$this->meta['title']		= $shop['shop_name_estheone'] . 'のメンズエステ求人【エステワン】';
		$this->meta['description']	= $shop['shop_name_estheone'] . 'のメンズエステ求人情報をご紹介します。';
		$this->meta['noindex']		= 'index';
		$this->meta['nofollow']		= 'follow';
		$this->meta['canonical']	= Uri::base() . $this->prefarea['area_name2'] . '/a_' . $this->area_id . '/recruit/s_' . $shop['shop_id'] . '/';
		$this->meta['h1']			= $shop['shop_name_estheone'] . 'のメンズエステ求人';

		$this->pankuzu->add("{$shop['shop_name_estheone']}のメンズエステ求人", Uri::create("/{$this->prefarea_name}/a_{$this->area['area_id']}/recruit/s_{$shop['shop_id']}/"));

		$datalayer_tel = $this->datalayer_obj->create_onmousedown_tel($this->region, $this->prefarea, $this->area, $shop);
		$datalayer_line_url = $this->datalayer_obj->create_onmousedown_line($this->region, $this->prefarea, $this->area, $shop, $this->datalayer_obj::SNS_TYPE_URL);
		$datalayer_line_id = $this->datalayer_obj->create_onmousedown_line($this->region, $this->prefarea, $this->area, $shop, $this->datalayer_obj::SNS_TYPE_ID);
		$env_img_url = CONST_ENV_IMG_URL;

		$view_data = [
			'shop' => $shop,
			'datalayer_tel' => $datalayer_tel,
			'datalayer_line_url' => $datalayer_line_url,
			'datalayer_line_id' => $datalayer_line_id,
			'env_img_url' => $env_img_url,
			'media' => $this->media,
		];

		$this->set_page_content(View::forge("user/job_detail", $view_data, false));

		Func_Shopdetail::pv_count_up($shop['id'], $this->media);
	}
}

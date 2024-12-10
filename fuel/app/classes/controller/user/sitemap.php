<?php

use Fuel\Core\View;

/**
 * サイトマップページコントローラ
 */
class Controller_User_Sitemap extends Controller_User_Base
{
	public function before()
	{
		parent::before();
		$this->add_css("user/site_map.css");
		$this->set_common_header("user/common/header_page");
		$this->set_common_footer("user/common/footer_page");

//		$this->pankuzu->add("サイトマップ", Uri::create("/sitemap/"));
	}

	public function action_index()
	{
		$service_area = new Service_User_Area();
		$this->meta['title']		= 'サイトマップ【エステワン】';
		$this->meta['description']	= 'エステワンのサイトマップです。';
		$this->meta['noindex']		= 'index';
		$this->meta['nofollow']		= 'follow';
		$this->meta['canonical']	= Uri::base() . 'sitemap/';
		$this->meta['h1']			= 'サイトマップ';

		$areas = $service_area->get_master_and_small_areas();

		$data = [
			'areas' => $areas
		];

		$this->set_page_content(View::forge("user/site_map", $data, false));
	}

}

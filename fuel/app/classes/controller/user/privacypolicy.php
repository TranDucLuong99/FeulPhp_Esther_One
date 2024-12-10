<?php

use Fuel\Core\View;

/**
 * プライバシーポリシーページコントローラ
 */
class Controller_User_Privacypolicy extends Controller_User_Base
{
	public function before()
	{
		parent::before();
		$this->add_css("user/privacy_policy.css");
		$this->set_common_header("user/common/header_page");
		$this->set_common_footer("user/common/footer_page");

		$this->pankuzu->add("プライバシーポリシー", Uri::create("/privacy/"));
	}

	public function action_index()
	{
		$this->meta['title']		= 'プライバシーポリシー【エステワン】';
		$this->meta['description']	= 'エステワンのプライバシーポリシーです。';
		$this->meta['noindex']		= 'index';
		$this->meta['nofollow']		= 'follow';
		$this->meta['canonical']	= Uri::base() . 'privacy/';
		$this->meta['h1']			= 'プライバシーポリシー';

		$view_data = [];

		$this->set_page_content(View::forge("user/privacy_policy", $view_data, false));
	}

}

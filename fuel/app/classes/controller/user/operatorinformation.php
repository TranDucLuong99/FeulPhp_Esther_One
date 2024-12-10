<?php

use Fuel\Core\View;

class Controller_User_Operatorinformation extends Controller_User_Base
{
	public function before()
	{
		parent::before();
		$this->add_css("user/operator_info.css");
		$this->set_common_header("user/common/header_page");
		$this->set_common_footer("user/common/footer_page");

		$this->pankuzu->add("運営者情報", Uri::create("/about/"));
	}

	public function action_index()
	{
		$this->meta['title']		= '運営者情報【エステワン】';
		$this->meta['description']	= 'エステワンの運営者情報です。';
		$this->meta['noindex']		= 'index';
		$this->meta['nofollow']		= 'follow';
		$this->meta['canonical']	= Uri::base() . 'about/';
		$this->meta['h1']			= '運営者情報';

		$view_data = [];

		$this->set_page_content(View::forge("user/operator_information", $view_data, false));
	}

}

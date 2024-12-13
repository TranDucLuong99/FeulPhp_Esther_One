<?php

use Fuel\Core\View;

/**
 * 利用規約ページコントローラ
 */
class Controller_User_Termsofservice extends Controller_User_Base
{
    public function before()
    {
        parent::before();
        $this->add_css("user/terms_of_service.css");
        $this->set_common_header("user/common/header_page");
        $this->set_common_footer("user/common/footer_page");

        $this->pankuzu->add("利用規約", Uri::create("/terms/"));
    }

    public function action_index()
    {
        $this->meta['title']		= '利用規約【エステワン】';
        $this->meta['description']	= 'エステワンの利用規約です。';
        $this->meta['noindex']		= 'index';
        $this->meta['nofollow']		= 'follow';
        $this->meta['canonical']	= Uri::base() . 'terms/';
        $this->meta['h1']			= '利用規約';

        $view_data = [];

        $this->set_page_content(View::forge("user/terms_of_service", $view_data, false));
    }

}

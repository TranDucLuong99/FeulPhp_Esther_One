<?php
class Controller_User_Top extends Controller_User_Base
{
    static public $popular_areas = [
        8002, // 博多
        1032, // 仙台
        1001, // すすきの(札幌)
        6010, // 日本橋
        7035, // 広島
        4044, // 名古屋駅(名駅)
        6001, // 梅田(キタ)
        6029, // 神戸三宮
        3001, // 池袋
    ];

    public function before()
    {
        parent::before();
        $this->add_css("user/top.css");
        $this->add_js("user/top.js");
        $this->set_common_header("user/common/header");
        $this->set_common_footer("user/common/footer");
    }
	public function action_index()
	{
        $service_area = new Service_User_Area();

        $this->meta['title']		= 'メンズエステ求人なら【エステワン】高収入の仕事情報満載！';
        $this->meta['description']	= 'エステワンでは全国のメンズエステ求人情報を豊富に掲載しています。';
        $this->meta['noindex']		= 'index';
        $this->meta['nofollow']		= 'follow';
        $this->meta['canonical']	= Uri::base();
        $this->meta['h1']			= 'メンズエステ求人なら【エステワン】高収入の仕事情報満載！';

        $areas = $service_area->get_master_and_small_areas();

        $popular_areas = $service_area->get_popular_areas();

        $data = [
            'areas' => $areas,
            'popular_areas' => $popular_areas,
            'media' => $this->media
        ];
        $this->set_page_content(View::forge("user/top", $data, false));
	}

}

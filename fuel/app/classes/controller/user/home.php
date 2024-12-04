<?php

class Controller_User_Home extends Controller_Template
{

	public function action_index()
	{
        // Mặc định sẽ dùng file template tạo sẵn
        // $data["subnav"] = array('index'=> 'active' );
        // $this->template->title = 'User/home &raquo; Index';
        // $this->template->content = View::forge('user/home/index', $data);

        // Sử dụng file template khác
        $this->template = \View::forge('common/template');

        // Truyền dữ liệu cho template
        $this->template->title = 'Custom Template Example';
        $this->template->content = \View::forge('user/home/index');

        $data = Model_Test::get_results();
	}

}

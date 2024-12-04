<?php

class Controller_Admin_User extends Controller_Admin_Base
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Admin/user &raquo; Index';
		$this->template->content = View::forge('admin/user/index', $data);
	}

}

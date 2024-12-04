<?php

class Controller_Admin_Category extends Controller_Admin_Base
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Admin/category &raquo; Index';
		$this->template->content = View::forge('admin/category/index', $data);
	}

}

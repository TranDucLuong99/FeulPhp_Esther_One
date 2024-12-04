<?php

class Controller_Base extends Controller_Template
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Base &raquo; Index';
		$this->template->content = View::forge('base/index', $data);
	}

}

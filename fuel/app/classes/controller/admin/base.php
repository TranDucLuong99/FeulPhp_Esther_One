<?php

class Controller_Admin_Base extends Controller_Template
{
    //Lưu ý khi tạo base controller thì chỉ được extends Controller không được extends Controller_template
    //Lưu ý muốn khi tạo base controller thì được extends Controller_template thì phải khởi tạo template trong view
    public $template = 'admin/template';

    public function before()
    {
        parent::before();
        // Load the template view
        if (!isset($this->template)) {
            $this->template = View::forge('template');
        }
//        $this->template = View::forge($this->template);
    }

    public function after($response)
    {
        // Render the content
        if (isset($this->template)){
            $response = Response::forge($this->template);
        }

        return parent::after($response);
    }

}

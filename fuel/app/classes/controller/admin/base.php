<?php

class Controller_Admin_Base extends Controller
{
    //Lưu ý khi tạo base controller thì chỉ được extends Controller không được extends Controller_template
    public $template = 'admin/template';

    public function before()
    {
        parent::before();
        // Load the template view
        $this->template = View::forge($this->template);
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

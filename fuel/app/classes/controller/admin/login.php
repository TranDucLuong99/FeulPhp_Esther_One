<?php
class Controller_Admin_Login extends Controller_Template
{

    public function action_index()
    {
        // Nếu người dùng đã đăng nhập, chuyển hướng đến trang dashboard
        if (Auth::check())
        {
            Response::redirect('admin/category/index');
        }

        if (Input::method() == 'POST')
        {
            $username = Input::post('username');
            $password = Input::post('password');

            // Kiểm tra đăng nhập
            if (Auth::login($username, $password))
            {
                Response::redirect('admin/category/index');  // Nếu đăng nhập thành công, chuyển hướng
            }
            else
            {
                Session::set_flash('error', 'Invalid login credentials');
            }
        }

        // Hiển thị form đăng nhập
        return View::forge('admin/login/index');
    }

    public function action_logout()
    {
        Auth::logout();
        Response::redirect('admin/login');
    }

}

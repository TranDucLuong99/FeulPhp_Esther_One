<?php

class Controller_Admin_Register extends Controller_Template
{
    public function action_index()
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (Auth::check())
        {
            Response::redirect('admin/dashboard');
        }

        if (Input::method() == 'POST')
        {
            $name     = Input::post('name');
            $username = Input::post('username');
            $password = Input::post('password');
            $email    = Input::post('email');

            // Đăng ký người dùng mới
            $user = Model_User::forge(array(
                'name'     => $name,
                'username' => $username,
                'password' => Auth::hash_password($password),  // Hash mật khẩu
                'email'    => $email,
            ));

            if ($user->save())
            {
                // Đăng nhập người dùng ngay sau khi đăng ký
                Auth::login($username, $password);
                Response::redirect('admin/category/index');
            }
            else
            {
                Session::set_flash('error', 'Error while registering user');
            }
        }
        return View::forge('admin/register/index');
    }
}

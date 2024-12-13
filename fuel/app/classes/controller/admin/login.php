<?php
class Controller_Admin_Login extends Controller_Template
{
    public function action_index()
    {
        if (Auth::check())
        {
            Response::redirect('admin/category/index');
        }

        if (Input::method() == 'POST')
        {
            $username = Input::post('username');
            $password = Input::post('password');
            if (Auth::login($username, $password)) {
                Response::redirect('admin/category/index');
            } else {
                Session::set_flash('error', 'Invalid login credentials');
            }
        }
        return View::forge('admin/login/index');
    }

    public function action_logout()
    {
        Auth::logout();
        Response::redirect('admin/login');
    }

}

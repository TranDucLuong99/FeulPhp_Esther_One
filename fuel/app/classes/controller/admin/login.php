<?php

class Controller_Admin_Login extends Controller_Template
{

    public function action_index()
    {
        // Render form đăng nhập
        return \View::forge('admin/login/index');
    }

    public function action_login()
    {
        // Lấy dữ liệu từ form
        $username = Input::post('username');
        $password = Input::post('password');

        // Kiểm tra dữ liệu
        if (empty($username) || empty($password)) {
            return 'Both username and password are required.';
        }

        // Giả lập xác thực từ database
        $user = \DB::select()
            ->from('users')
            ->where('username', $username)
            ->execute()
            ->current();

        if ($user) {
            // Xác minh mật khẩu
            if (\password_verify($password, $user['password'])) {
                // Lưu thông tin đăng nhập vào session
                Session::set('admin_logged_in', true);
                Session::set('admin_username', $username);

                // Redirect đến trang admin dashboard
                return \Response::redirect('admin/post');
            } else {
                return 'Invalid password.';
            }
        } else {
            return 'User not found.';
        }
    }

    public function action_logout()
    {
        Session::delete('admin_logged_in');

        Session::delete('admin_username');

        return \Response::redirect('admin/login');
    }

}

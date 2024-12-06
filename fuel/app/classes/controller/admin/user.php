<?php

class Controller_Admin_User extends Controller_Admin_Base
{

    public function action_index()
    {
        $users = Model_User::find('all');

        $data = [
            'title'   => 'Manage Users',
            'users'   => $users,
            'content' => 'Danh sách các bài user',
        ];
        $this->template->title = 'Admin/user &raquo; Index';
        $this->template->content = View::forge('admin/user/index', $data);
    }
    public function action_create()
    {
        if (\Input::method() === 'POST'){

            // Tạo đối tượng Validation
            $validation = Validation::forge();

            // Định nghĩa các quy tắc
            $validation->add_field('username', 'Username', 'required|min_length[3]|max_length[50]');
            $validation->add_field('name', 'Name', 'required');
            $validation->add_field('password', 'Password', 'required|min_length[6]');
            $validation->add_field('email', 'email', 'required|min_length[6]');

            // Kiểm tra dữ liệu từ form
            if ($validation->run()) {
//                // Dữ liệu hợp lệ
//                $data = $validation->validated();

                // Lấy dữ liệu từ form gửi lên
                $name = Input::post('name');
                $username = Input::post('username');
                $password = Input::post('password');
                $email = Input::post('email');

                try {
                    Model_User::insert_data_user($name, $username, $password, $email);

                    Session::set_flash('success', 'User created successfully!');

                    Response::redirect('admin/user');
                } catch (Exception $e) {
                    Session::set_flash($e->getMessage());
                }
            } else {
                $errors = $validation->error();

                foreach ($errors as $field => $error) {
                    Session::set_flash('error_' . $field, $error->get_message());
                }

                Response::redirect('admin/user/create');
            }
        }
        $this->template->content = \View::forge('admin/user/create');
    }
}

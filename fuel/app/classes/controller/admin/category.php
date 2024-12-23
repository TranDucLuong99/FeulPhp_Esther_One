<?php

class Controller_Admin_Category extends Controller_Admin_Base
{

	public function action_index()
	{
        /*
        Load cấu hình phân trang mới từ trong config/pagination.php
            $config = Config::get('pagination');
            $config['pagination_url'] = 'http://localhost:8000/admin/category/';
            $config['total_items'] = 5;
            $config['per_page'] = 2;
            $config['uri_segment'] = 3;
        */
        $config = [
            'pagination_url' => Uri::base() .  '/admin/category/',
            'total_items'    => Model_Category::count(),
            'per_page'       => 5,
        ];

        $pagination = Pagination::forge('mypagination', $config);

        $categories = Model_Category::query()
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();

        $data = [
            'title'   => 'Manage Categories',
            'categories'   => $categories,
            'content' => 'Danh sách danh mục',
        ];

        $this->template->set_global('pagination', $pagination, false);

        $this->template->content = \View::forge('admin/category/index', $data);
	}

    public function action_create()
    {

        if (\Input::method() === 'POST') {
            $category = new Model_Category([
                'name' => \Input::post('name'),
                'description' => \Input::post('description'),
                'status' => 1,
            ]);
            $category->save();

            \Response::redirect('/admin/category');
        }
        $this->template->content = \View::forge('admin/category/create');
    }

    public function action_edit($id)
    {
        $category = Model_Category::find($id);

        if (!$category) {
            Response::redirect('admin/post');
        }

        if (Input::method() == 'POST') {
            $category->name = Input::post('name');
            $category->description = Input::post('description');
            $category->save();

            Response::redirect('admin/category');
        }
        $data = [
            'title' => 'Chỉnh sửa danh mục',
            'category' => $category,
            'content' => 'Chỉnh sửa danh mục',
        ];
        $this->template->content = \View::forge('admin/category/edit', $data);
    }

    public function action_delete($id)
    {
        $category = Model_Category::find($id);

        if ($category) {
            $category->delete();
            Response::redirect('admin/category');
        } else {
            Response::redirect('admin/category');
        }
    }

    public function action_change_status($id)
    {
        $category = Model_Category::find($id);

        if ($category) {
            $category->status = ($category->status == 1) ? 0 : 1;
            $category->save();
        }

        // Thiết lập thông báo thành công
        Session::set_flash('success', 'Status updated successfully');
        Response::redirect('admin/category');
    }

}

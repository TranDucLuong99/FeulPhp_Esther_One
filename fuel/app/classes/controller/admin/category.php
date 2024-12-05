<?php

class Controller_Admin_Category extends Controller_Admin_Base
{

	public function action_index()
	{
        $categories = Model_Category::find('all');

        $data = [
            'title'   => 'Manage Categories',
            'categories'   => $categories,
            'content' => 'Danh sách danh mục',
        ];
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

}

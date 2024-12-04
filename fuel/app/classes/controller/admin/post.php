<?php

class Controller_Admin_Post extends Controller_Admin_Base
{
    public $template = 'admin/template';

    public function action_index()
	{
        // Load posts from database
        $posts = Model_Post::find('all', array(
            'related' => array('category')
        ));

        $data = [
            'title'   => 'Danh sách bài viết',
            'posts'   => $posts,
            'content' => 'Danh sách các bài viết',
        ];

        // Render view with posts
        $this->template->content = \View::forge('admin/post/index', $data);
	}

    public function action_create()
    {
        if (\Input::method() === 'POST')
        {
            // Lưu bài viết vào database
            $post = new Model_Post([
                'title' => \Input::post('title'),
                'content' => \Input::post('content'),
                'category_id' => 2,
                'status' => 1,
            ]);
            $post->save();

            \Response::redirect('/admin/post');
        }

        $categories = Model_Category::find('all');

        $data = [
            'title'   => 'Thêm mới bài viết',
            'categories'   => $categories,
            'content' => 'Thêm mới bài viết',
        ];
        // Render form
        $this->template->content = \View::forge('admin/post/create', $data);
    }

    public function action_delete($id)
    {
        // Tìm bài viết theo ID
        $post = Model_Post::find($id);

        if ($post) {
            // Xóa bài viết
            $post->delete();
            // Chuyển hướng về danh sách bài viết hoặc thông báo thành công
            Response::redirect('admin/post');
        } else {
            // Nếu không tìm thấy bài viết
            Response::redirect('admin/post'); // Hoặc hiển thị lỗi
        }
    }
}

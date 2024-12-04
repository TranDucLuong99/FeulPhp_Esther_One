<?php

class Controller_Admin_Post extends Controller_Admin_Base
{
    public $template = 'admin/template';

    public function action_index()
	{
        // Load posts from database
        $posts = Model_Post::find('all');

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
            ]);
            $post->save();

            \Response::redirect('/admin/post');
        }

        // Render form
        $this->template->content = \View::forge('admin/post/create');
    }
}

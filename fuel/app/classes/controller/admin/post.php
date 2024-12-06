<?php

class Controller_Admin_Post extends Controller_Admin_Base
{
    public function action_index()
	{
        // Load posts from database
        $config = array(
            'pagination_url' => 'http://localhost:8000/admin/post/',
            'total_items'    => Model_Post::count(),
            'per_page'       => 5,
        );

        $pagination = Pagination::forge('mypagination', $config);
        /*
         *  Cách viết 1
            $posts = Model_Post::find('all', array(
                'related' => array('category'),
                'limit'   => $pagination->per_page,   // Số lượng bản ghi mỗi trang
                'offset'  => $pagination->offset,     // Vị trí bắt đầu từ đâu (tính từ số trang)
            ));
        */
        $posts = Model_Post::query()
            ->related('category')    // Gọi quan hệ 'category'
            ->limit($pagination->per_page) // Giới hạn số lượng bản ghi mỗi trang
            ->offset($pagination->offset) // Xác định trang bắt đầu
            ->get();


        $data = [
            'title'   => 'Manage Posts',
            'posts'   => $posts,
        ];

        $this->template->set_global('pagination', $pagination, false);

        // Render view with posts
        $this->template->content = \View::forge('admin/post/index', $data);
	}

    public function action_create()
    {
        if (\Input::method() === 'POST') {
            // Lưu bài viết vào database
            $post = new Model_Post([
                'title' => \Input::post('title'),
                'content' => \Input::post('content'),
                'category_id' => \Input::post('category_id'),
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

    public function action_edit($id)
    {
        // Lấy bài viết theo ID
        $post = Model_Post::find($id);

        if (!$post) {
            // Nếu bài viết không tồn tại, chuyển hướng về danh sách
            Response::redirect('admin/post');
        }

        // Lấy tất cả các category để hiển thị trong select box
        $categories = Model_Category::find('all');

        if (Input::method() == 'POST') {
            // Nếu form được gửi, lấy dữ liệu từ form và cập nhật bài viết
            $post->title = Input::post('title');
            $post->content = Input::post('content');
            $post->category_id = Input::post('category_id');

            // Lưu lại bài viết
            $post->save();

            // Chuyển hướng về danh sách bài viết
            Response::redirect('admin/post');
        }
        $data = [
            'title' => 'Chỉnh sửa bài viết',
            'post' => $post,
            'categories' => $categories,
            'content' => 'Chỉnh sửa bài viết',
        ];
        // Truyền bài viết và các category vào view
        $this->template->content = \View::forge('admin/post/edit', $data);
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

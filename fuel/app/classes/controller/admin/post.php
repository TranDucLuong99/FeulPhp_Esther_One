<?php

class Controller_Admin_Post extends Controller_Admin_Base
{
    public function action_index()
	{
        // Load posts from database
        $config = array(
            'pagination_url' => Uri::base() . '/admin/post/',
            'total_items'    => Model_Post::count(),
            'per_page'       => 5,
        );

        $pagination = Pagination::forge('mypagination', $config);

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

    public function action_export()
    {
        $posts = Model_Post::query()->related('category')->get();

        $export = new \Service\Export();

        try {
            $export::export_posts_to_excel($posts);
//            Session::set_flash('success', 'Export successfully!');
//
//            Response::redirect('admin/post/index');
        } catch (Exception $e) {
            Session::set_flash('error', 'Đã xảy ra lỗi khi xuất dữ liệu: ' . $e->getMessage());
        }
    }

    public function action_import()
    {
        // Kiểm tra xem người dùng có upload file không
        if (Input::file('import_file')) {
            $file = Input::file('import_file');

            // Kiểm tra định dạng file (ví dụ CSV)
            if ($file['extension'] != 'csv') {
                Session::set_flash('error', 'File phải là định dạng CSV.');
                return Redirect::to('import');
            }

            // Sử dụng Service Import để xử lý dữ liệu
            try {
                Import::import_data($file['tmp_name']); // Gọi Service để import dữ liệu
                Session::set_flash('success', 'Dữ liệu đã được import thành công.');
            } catch (\Exception $e) {
                Session::set_flash('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
            }

            return Redirect::to('import');
        }

        Session::set_flash('error', 'Không có file để upload.');
        return Redirect::to('import');
    }

    public function action_change_status($id)
    {
        // Lấy bài viết theo ID
        $post = Model_Post::find($id);

        if ($post) {
            // Thay đổi trạng thái bài viết
            $post->status = ($post->status == 1) ? 0 : 1;
            $post->save();
        }

        // Thiết lập thông báo thành công
        Session::set_flash('success', 'Status updated successfully');
        Response::redirect('admin/post');
    }

}

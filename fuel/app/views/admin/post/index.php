<h2><?php echo $title; ?></h2>
<div class="top_filter">
    <a href="/admin/post/create" class="btn">Add New Post</a>

    <a href="/admin/post/export" class="btn" style="background: #2e6da4">Export Data</a>
</div>

<?php if (\Session::get_flash('success')): ?>
    <div class="alert alert-success" style="color: #0000BB">
        <?= \Session::get_flash('success'); ?>
    </div>
<?php endif; ?>
<table class="data-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Category</th>
        <th>Content</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?php echo $post->id; ?></td>
            <td><?php echo $post->title; ?></td>
            <td><?php echo $post->category->name; ?></td>
            <td><?php echo substr($post->content, 0, 100); ?>...</td> <!-- Chỉ hiển thị phần đầu của nội dung -->
            <td><?php echo $post->status; ?></td>
            <td><?php echo $post->created_at; ?></td>
            <td><?php echo $post->updated_at; ?></td>
            <td>
                <a href="/admin/post/edit/<?php echo $post->id; ?>" class="edit-btn">Edit</a> |
                <a href="/admin/post/delete/<?php echo $post->id; ?>" onclick="return confirm('Are you sure you want to delete this post?');" class="delete-btn" >Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="pagination">
    <?php echo $pagination; ?>
</div>
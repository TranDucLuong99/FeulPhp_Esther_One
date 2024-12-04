<h2>Manage Posts</h2>
<a href="/admin/post/create" class="btn">Add New Post</a>

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
<!--                <a href="--><?php //echo Uri::create('admin/post/delete/' . $post->id); ?><!--" onclick="return confirm('Are you sure you want to delete this post?');" class="delete-btn" >Delete</a>-->
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
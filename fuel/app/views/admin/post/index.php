<h2>Manage Posts</h2>
<a href="/admin/post/create" class="btn">Add New Post</a>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Category</th>
        <th>Content</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= $post->id; ?></td>
            <td><?= $post->title; ?></td>
            <td><?= $post->category_id; ?></td>
            <td><?= $post->content; ?></td>
            <td><?= $post->status; ?></td>
            <td><?= $post->created_at; ?></td>
            <td><?= $post->updated_at; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
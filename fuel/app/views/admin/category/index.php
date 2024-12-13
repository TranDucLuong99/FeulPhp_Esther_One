<h2><?php echo $title; ?></h2>
<a href="/admin/category/create" class="btn">Add New Category</a>
<?php if (\Session::get_flash('success')): ?>
    <div class="alert alert-success" style="color: #0000BB">
        <?= \Session::get_flash('success'); ?>
    </div>
<?php endif; ?>
<table class="data-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($categories as $category): ?>
        <tr>
            <td><?php echo $category->id; ?></td>
            <td><?php echo $category->name; ?></td>
            <td><?php echo $category->description; ?></td>
            <td>
                <a href="<?php echo Uri::create('admin/category/change_status/'.$category->id); ?>"
                   class="btn-<?php echo ($category->status == 1) ? 'active' : 'inactive'; ?>"
                   onclick="return confirm('Are you sure you want to change status this category?');"
                   style="color: <?php echo ($category->status == 1) ? '#1b6d85' : '#d32f2f'; ?>"
                >
                    <?php echo ($category->status == 1) ? 'Active' : 'Inactive'; ?>
                </a>
            </td>
            <td><?php echo $category->created_at; ?></td>
            <td><?php echo $category->updated_at; ?></td>
            <td>
                <a href="/admin/category/edit/<?php echo $category->id; ?>" class="edit-btn">Edit</a> |
                <a href="/admin/category/delete/<?php echo $category->id; ?>" onclick="return confirm('Are you sure you want to delete this category?');" class="delete-btn" >Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<!-- Hiển thị nút phân trang -->
<div class="pagination">
    <?php echo $pagination; ?>
</div>
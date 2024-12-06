<h2><?php echo $title; ?></h2>
<a href="/admin/category/create" class="btn">Add New Category</a>

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
            <td><?php echo $category->status; ?></td>
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
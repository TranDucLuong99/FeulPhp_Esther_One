<h2><?php echo $title; ?></h2>

<a href="/admin/user/create" class="btn">Add New User</a>

<?php if (\Session::get_flash('success')): ?>
    <div class="alert alert-success">
        <?= \Session::get_flash('success'); ?>
    </div>
<?php endif; ?>


<table class="data-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Username</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user->id; ?></td>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->created_at; ?></td>
            <td><?php echo $user->updated_at; ?></td>
            <td>
                <a href="/admin/user/edit/<?php echo $user->id; ?>" class="edit-btn">Edit</a> |
                <a href="/admin/user/delete/<?php echo $user->id; ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="delete-btn">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
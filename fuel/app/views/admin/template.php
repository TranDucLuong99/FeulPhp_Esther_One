<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="/assets/css/admin/style.css">
</head>
<body>
<div class="header">
    <h1>Admin Panel</h1>
    <nav>
        <ul>
            <li><a href="/admin/post">Posts</a></li>
            <li><a href="/admin/category">Categories</a></li>
            <li><a href="/admin/user">Users</a></li>
        </ul>
    </nav>
</div>

<div class="content">
    <?php
        if (isset($content)) {
            echo $content;
        }else{
            echo 'No content available';
        }
    ?>
<!--    --><?php //isset($content) ? echo $content : echo 'No content available'; ?>
</div>

<div class="footer">
    <p>&copy; <?= date('Y'); ?> Admin Panel. All Rights Reserved.</p>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Esther One</title>
    <link rel="stylesheet" href="/assets/css/admin/style.css">
</head>
<body>

<?php echo View::forge('admin/layouts/header'); ?>

<div class="content">
    <?php
        if (isset($content)) {
            echo $content;
        }else{
            echo 'No content available';
        }
    ?>
</div>

<?php echo View::forge('admin/layouts/footer'); ?>

</body>
</html>

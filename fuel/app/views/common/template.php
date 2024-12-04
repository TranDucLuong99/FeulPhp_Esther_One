<!DOCTYPE html>
<html>
<head>
    <title><?= isset($title) ? $title : 'Default Title'; ?></title>
</head>
<body>
<?php echo View::forge('common/header')?>
<div>
    <?= isset($content) ? $content : ''; ?>
</div>
<?php echo View::forge('common/footer')?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
<!--    <link rel="stylesheet" href="style.css">-->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 50px;
        }

        .register-container {
            background: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 3px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #218838;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #f5c6cb;
            border-radius: 3px;
        }

        p {
            text-align: center;
        }

        p a {
            color: #007bff;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<div class="register-container">
    <h2>Đăng Ký Tài Khoản</h2>

    <?php if (Session::get_flash('error')): ?>
        <div class="error-message">
            <?php echo Session::get_flash('error'); ?>
        </div>
    <?php endif; ?>

    <?php echo Form::open(); ?>
    <div class="form-group">
        <?php echo Form::label('Name', 'name'); ?>
        <?php echo Form::input('name', Input::post('name'), array('class' => 'form-input', 'placeholder' => 'Nhập tên người dùng')); ?>
    </div>
    <div class="form-group">
        <?php echo Form::label('Username', 'username'); ?>
        <?php echo Form::input('username', Input::post('username'), array('class' => 'form-input', 'placeholder' => 'Nhập tên người dùng')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('Email', 'email'); ?>
        <?php echo Form::input('email', Input::post('email'), array('class' => 'form-input', 'placeholder' => 'Nhập email của bạn')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('Password', 'password'); ?>
        <?php echo Form::password('password', '', array('class' => 'form-input', 'placeholder' => 'Nhập mật khẩu')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('Confirm Password', 'password_confirm'); ?>
        <?php echo Form::password('password_confirm', '', array('class' => 'form-input', 'placeholder' => 'Xác nhận mật khẩu')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::submit('register', 'Đăng Ký', array('class' => 'submit-btn')); ?>
    </div>
    <?php echo Form::close(); ?>

    <p>Đã có tài khoản? <a href="/admin/login">Đăng Nhập</a></p>
</div>

</body>
</html>

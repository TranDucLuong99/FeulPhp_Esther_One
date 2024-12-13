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

        .login-container {
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

<div class="login-container">
    <h2>Admin Esther One Login</h2>

    <?php if (Session::get_flash('error')): ?>
        <div class="error-message">
            <?php echo Session::get_flash('error'); ?>
        </div>
    <?php endif; ?>

    <?php echo Form::open(); ?>

    <div class="form-group">
        <?php echo Form::label('Username', 'username'); ?>
        <?php echo Form::input('username', Input::post('username'), array('class' => 'form-input', 'placeholder' => 'Nhập tên người dùng')); ?>
    </div>


    <div class="form-group">
        <?php echo Form::label('Password', 'password'); ?>
        <?php echo Form::password('password', '', array('class' => 'form-input', 'placeholder' => 'Nhập mật khẩu')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::submit('register', 'Đăng Nhập', array('class' => 'submit-btn')); ?>
    </div>
    <?php echo Form::close(); ?>
    <p>Bạn chưa có tài khoản? <a href="/admin/register">Đăng Ký</a></p>
</div>

</body>
</html>

<style>
    /* Tổng thể */
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #74b9ff, #0984e3);
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Container chính */
    .login-container {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* Form login */
    .login-form {
        width: 100%;
        text-align: center;
    }

    .login-form h2 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #fff;
    }

    /* Nhóm form (label và input) */
    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    .form-group label {
        font-size: 14px;
        color: #fff;
        margin-bottom: 5px;
        display: block;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        background: rgba(255, 255, 255, 0.9);
        color: #2d3436;
        outline: none;
        transition: all 0.3s ease;
    }

    .form-group input:focus {
        border: 2px solid #0984e3;
        background: #fff;
    }

    /* Nút đăng nhập */
    .btn-submit {
        width: 100%;
        padding: 10px 20px;
        font-size: 16px;
        background-color: #0984e3;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #74b9ff;
    }

    /* Responsive */
    @media screen and (max-width: 480px) {
        .login-container {
            padding: 15px;
        }
        .login-form h2 {
            font-size: 20px;
        }
    }

</style>
<div class="login-container">
    <div class="login-form">
        <h2>Admin Login</h2>
        <?php echo Form::open('admin/login', array('method' => 'post')); ?>

        <div class="form-group">
            <label for="username">Username:</label>
            <?php echo Form::input('username', '', array('id' => 'username', 'placeholder' => 'Enter your username')); ?>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <?php echo Form::password('password', '', array('id' => 'password', 'placeholder' => 'Enter your password')); ?>
        </div>

        <div class="form-group">
            <?php echo Form::submit('submit', 'Login', array('class' => 'btn-submit')); ?>
        </div>

        <?php echo Form::close(); ?>
    </div>
</div>


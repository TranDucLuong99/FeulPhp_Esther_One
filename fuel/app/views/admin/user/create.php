<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        padding: 40px;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-size: 14px;
        color: #333;
        margin-bottom: 8px;
    }

    .input-field {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s ease;
    }

    .input-field:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 8px rgba(76, 175, 80, 0.4);
    }

    .submit-btn {
        background-color: #4CAF50;
        color: #fff;
        padding: 12px 20px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #45a049;
    }

    .submit-btn:active {
        background-color: #388e3c;
    }

</style>

<div class="container">
    <?php if (Session::get_flash('error_username')): ?>
        <p style="color:red;"><?= Session::get_flash('error_username'); ?></p>
    <?php endif; ?>

    <?php if (Session::get_flash('error_name')): ?>
        <p style="color:red;"><?= Session::get_flash('error_name'); ?></p>
    <?php endif; ?>

    <?php if (Session::get_flash('error_password')): ?>
        <p style="color:red;"><?= Session::get_flash('error_password'); ?></p>
    <?php endif; ?>

    <?php if (Session::get_flash('error_email')): ?>
        <p style="color:red;"><?= Session::get_flash('error_email'); ?></p>
    <?php endif; ?>

    <h1>Create New User</h1>

    <?php echo Form::open(array('action' => 'admin/user/create', 'enctype' => 'multipart/form-data', 'method' => 'post')); ?>

    <div class="form-group">
        <?php echo Form::label('Name', 'name', array('id' => 'name')) ?>
        <?php echo Form::input('name', '', array('id' => 'form_name', 'class' => 'input-field', 'placeholder' => 'Enter name user')); ?>
    </div>

    <div class="form-group">
        <label for="username">User Name</label>
        <?php echo Form::input('username', '', array('id' => 'username', 'class' => 'input-field', 'placeholder' => 'Enter username user')); ?>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <?php echo Form::input('email', '', array('id' => 'email', 'class' => 'input-field', 'placeholder' => 'Enter email user')); ?>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <?php echo Form::password('password', '', array('id' => 'password', 'class' => 'input-field', 'placeholder' => 'Enter password user')); ?>
    </div>

    <div class="form-group">
        <label for="image">Avatar User</label>
        <?php echo Form::file('image', array('id' => 'image', 'class' => 'input-field')); ?>
    </div>

    <div class="form-group">
        <button type="submit" class="submit-btn">Create User</button>
    </div>
    <?php echo Form::close(); ?>
</div>

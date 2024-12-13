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
    <h1>Create New Category</h1>

    <?php echo Form::open(array('action' => 'admin/category/create')); ?>

    <div class="form-group">
        <label for="name">Title</label>
        <?php echo Form::input('name', '', array('id' => 'name', 'class' => 'input-field', 'placeholder' => 'Enter category title')); ?>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <?php echo Form::textarea('description', '', array('id' => 'description', 'class' => 'input-field', 'placeholder' => 'Enter category description')); ?>
    </div>

    <div class="form-group">
        <button type="submit" class="submit-btn">Create Category</button>
    </div>
</div>
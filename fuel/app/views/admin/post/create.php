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
    <h1>Create New Post</h1>

    <?php echo Form::open(array('action' => 'admin/post/create')); ?>

    <div class="form-group">
        <label for="title">Title</label>
        <?php echo Form::input('title', '', array('id' => 'title', 'class' => 'input-field', 'placeholder' => 'Enter post title')); ?>
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <?php echo Form::textarea('content', '', array('id' => 'content', 'class' => 'input-field', 'placeholder' => 'Enter post content')); ?>
    </div>

    <div class="form-group">
        <label for="category_id">Category</label>
        <?php
        // Tạo select box với name là category_id và giá trị là id của category
        $categories_options = array();
        foreach ($categories as $category) {
            $categories_options[$category->id] = $category->name;
        }
        echo Form::select('category_id', '', $categories_options, array('id' => 'category_id', 'class' => 'input-field'));
        ?>
    </div>

    <div class="form-group">
        <button type="submit" class="submit-btn">Create Post</button>
    </div>
</div>
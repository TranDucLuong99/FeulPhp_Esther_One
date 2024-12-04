<h2>Create New Post</h2>

<form method="POST" action="/admin/post/create">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="content">Content:</label>
    <textarea name="content" id="content" required></textarea>

    <button type="submit">Save Post</button>
</form>
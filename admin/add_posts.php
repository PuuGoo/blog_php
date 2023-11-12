<style>
    .add_form_select {
        display: block;
        width: 10%;
        height: 34px;
        padding: 6px 8px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #f3f3f3;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    }
</style>


<?php

if (isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, 
    post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES('$post_category_id', '{$post_title}', '{$post_author}', now(), 
    '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
    $create_posts_query = mysqli_query($connection, $query);

    confirmQuery($create_posts_query);
}

?>




<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control">
    </div>
    <div class="form-group">
        <select class="add_form_select" name="post_category_id" id="">

            <!-- Add Categories for form add post -->
            <?php

            $query = "SELECT * FROM categories";
            $select_categories_query = mysqli_query($connection, $query);

            confirmQuery($select_categories_query);

            while ($row = mysqli_fetch_assoc($select_categories_query)) {

                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='$cat_id'>$cat_title</option>";
            }



            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" class="form-control">
    </div>
    <div class="form-group">
        <select class="add_form_select" name="post_status" id="">
            <option value="published">published</option>
            <option value="draft">draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" name="post_content" class="form-control" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="create_post" class="btn btn-primary" value="Publish Post">
    </div>
</form>
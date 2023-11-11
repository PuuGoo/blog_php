<style>
    .update_form_select {
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
// Show post by id
if (isset($_GET['update_post_id'])) {
    $update_post_id = $_GET['update_post_id'];
}

$query = "SELECT * FROM posts where post_id = $update_post_id";
$select_posts_query = mysqli_query($connection, $query);

confirmQuery($select_posts_query);

if (!$select_posts_query) {

    die("Query Failed" . mysqli_error($connection));
}

while ($row = mysqli_fetch_assoc($select_posts_query)) {
    $post_id = $row['post_id'];
    $post_category_id = $row['post_category_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_status = $row['post_status'];
}

// Update Post

if (isset($_POST['update_post'])) {

    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    // Không được để biến $pót_image trống
    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $update_post_id ";
        $select_image_query = mysqli_query($connection, $query);

        confirmQuery($select_image_query);

        while ($row = mysqli_fetch_assoc($select_image_query)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '$post_title', ";
    $query .= "post_category_id = '$post_category_id', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '$post_author', ";
    $query .= "post_status = '$post_status', ";
    $query .= "post_image = '$post_image', ";
    $query .= "post_tags = '$post_tags', ";
    $query .= "post_content = '$post_content' ";
    $query .= "WHERE post_id = $update_post_id";
    $update_posts_query = mysqli_query($connection, $query);

    confirmQuery($update_posts_query);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <select name="post_category" id="" class="update_form_select">
            <?php

            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            confirmQuery($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='$cat_id'>$cat_title</option>";
            }

            ?>

        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" class="form-control" value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" name="post_status" class="form-control" value="<?php echo $post_status; ?>">
    </div>
    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image ?>" alt="">
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" name="post_content" class="form-control" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="update_post" class="btn btn-primary" value="Update Post">
    </div>
</form>
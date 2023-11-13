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

if (isset($_POST['create_user'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];

    // $post_image = $_FILES['post_image']['name'];
    // $post_image_temp = $_FILES['post_image']['tmp_name'];

    $user_role = $_POST['user_role'];
    echo $user_firstname;
    // $post_date = date('d-m-y');

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO users(user_username, user_password, user_firstname, user_lastname, 
    user_email, user_role ) ";
    $query .= "VALUES('{$user_username}', '{$user_password}', 
    '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_role}')";
    $create_user_query = mysqli_query($connection, $query);

    confirmQuery($create_user_query);
}

?>




<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <select class="add_form_select" name="user_role" id="">

            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="user_username">Username</label>
        <input type="text" name="user_username" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>
    <!-- <div class="form-group">
        <select class="add_form_select" name="post_status" id="">
            <option value="published">published</option>
            <option value="draft">draft</option>
        </select>
    </div> -->
    <div class="form-group">
        <input type="submit" name="create_user" class="btn btn-primary" value="Add User">
    </div>
</form>
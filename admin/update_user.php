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
if (isset($_GET['update_user_id'])) {
    $update_user_id = $_GET['update_user_id'];
}

$query = "SELECT * FROM users where user_id = $update_user_id";
$select_users_query = mysqli_query($connection, $query);

confirmQuery($select_users_query);

while ($row = mysqli_fetch_assoc($select_users_query)) {
    $user_id  = $row['user_id'];
    $user_username = $row['user_username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
}

// Update Post

if (isset($_POST['update_user'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    // $post_image = $_FILES['post_image']['name'];
    // $post_image_temp = $_FILES['post_image']['tmp_name'];

    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    // Không được để biến $pót_image trống
    // if (empty($post_image)) {
    //     $query = "SELECT * FROM posts WHERE post_id = $update_post_id ";
    //     $select_image_query = mysqli_query($connection, $query);

    //     confirmQuery($select_image_query);

    //     while ($row = mysqli_fetch_assoc($select_image_query)) {
    //         $post_image = $row['post_image'];
    //     }
    // }

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '$user_firstname', ";
    $query .= "user_lastname = '$user_lastname', ";
    $query .= "user_role = '$user_role', ";
    $query .= "user_username = '$user_username', ";
    $query .= "user_email = '$user_email', ";
    $query .= "user_password = '$user_password' ";
    $query .= "WHERE user_id = $update_user_id";
    $update_user_query = mysqli_query($connection, $query);

    confirmQuery($update_user_query);
}
?>

<!-- Form Edit User -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" name="user_firstname" class="form-control" value=<?php echo $user_firstname ?>>
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" name="user_lastname" class="form-control" value=<?php echo $user_lastname ?>>
    </div>
    <div class="form-group">
        <select name="user_role" id="" class="update_form_select">
            <?php

            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
            confirmQuery($select_users);

            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $user_role = $row['user_role'];

                if ($user_role === "Admin") {
                    echo "<option selected value='$user_role'>$user_role</option>";
                } else {
                    echo "<option value='$user_role'>$user_role</option>";
                }
            }

            ?>

        </select>
    </div>
    <div class="form-group">
        <label for="user_username">Username</label>
        <input type="text" name="user_username" class="form-control" value=<?php echo $user_username ?>>
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" class="form-control" value=<?php echo $user_email ?>>
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" class="form-control" value=<?php echo $user_password ?>>
    </div>
    <div class="form-group">
        <input type="submit" name="update_user" class="btn btn-primary" value="Update User">
    </div>
</form>
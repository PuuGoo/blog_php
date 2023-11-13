<?php

function confirmQuery($create_posts_query)
{
    global $connection;
    if (!$create_posts_query) {
        // Because on localhost development you have settings in php.ini that display verbose error messages and they fire off 
        // as soon as the error pops up. So on localhost it's much more useful to get a full detailed error message like 
        // the one you got in order to debug the problem than to get a plain text inside die() function that we specified.
        // die() is useful when you upload your project on a shared hosting and you do not have access to php.ini configuration, 
        // so you would still get some feedback.
        die("Query Failed ." . mysqli_error($connection));
    }
}
function showAllUsers()
{

    global $connection;
    $query = "SELECT * FROM users";
    $select_users_query = mysqli_query($connection, $query);

    confirmQuery($select_users_query);

    while ($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row['user_id'];
        $user_username = $row['user_username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];

?>

        <tr>
            <td><?php echo $user_id ?></td>
            <td><?php echo $user_username ?></td>
            <td><?php echo $user_firstname ?></td>
            <td><?php echo $user_lastname ?></td>
            <td><?php echo $user_email ?></td>
            <td><?php echo $user_role ?></td>

            <td><a href="users.php?source=admin_user&admin_user_id=<?php echo $user_id ?>">Admin</a></td>
            <td><a href="users.php?source=subscriber_user&subscriber_user_id=<?php echo $user_id ?>">Subscriber</a></td>
            <td><a href="users.php?source=update_user&update_user_id=<?php echo $user_id ?>">Edit</a></td>
            <td><a href="users.php?source=delete_user&delete_user_id=<?php echo $user_id ?>">Delete</a></td>

        </tr>


<?php }
}


function deleteUser()
{
    global $connection;

    if (isset($_GET['delete_user_id'])) {

        $delete_user_id = $_GET['delete_user_id'];
    }

    $query = "DELETE FROM users WHERE user_id  = $delete_user_id";
    $delete_user_query = mysqli_query($connection, $query);

    confirmQuery($delete_user_query);

    header("Location: users.php");
}

function adminUser()
{
    global $connection;

    if (isset($_GET['admin_user_id'])) {

        $admin_user_id = $_GET['admin_user_id'];
    }

    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $admin_user_id";
    $admin_user_query = mysqli_query($connection, $query);

    confirmQuery($admin_user_query);

    header("Location: users.php");
}


function subscriberUser()
{
    global $connection;

    if (isset($_GET['subscriber_user_id'])) {

        $subscriber_user_id = $_GET['subscriber_user_id'];
    }

    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $subscriber_user_id";
    $subscriber_user_query = mysqli_query($connection, $query);

    confirmQuery($subscriber_user_query);

    header("Location: users.php");
}

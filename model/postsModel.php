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
function showAllPosts()
{

    global $connection;
    $query = "SELECT * FROM posts";
    $select_posts_query = mysqli_query($connection, $query);

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
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
?>

        <tr>
            <td><?php echo $post_id ?></td>
            <td><?php echo $post_author ?></td>
            <td><?php echo $post_title ?></td>
            <td><?php echo $post_category_id ?></td>
            <td><?php echo $post_status ?></td>
            <td><img width="100" style="mix-blend-mode: multiply;" src="../images/<?php echo $post_image ?>" alt=""></td>
            <td><?php echo $post_tags ?></td>
            <td><?php echo $post_comment_count ?></td>
            <td><?php echo $post_date ?></td>
            <td><a href="posts.php?source=update_post&update_post_id=<?php echo $post_id ?>">Edit</a></td>
            <td><a href="posts.php?source=delete_post&delete_post_id=<?php echo $post_id ?>">Delete</a></td>
        </tr>


<?php }
}

function deletePost()
{
    global $connection;

    if (isset($_GET['delete_post_id'])) {

        $delete_post_id = $_GET['delete_post_id'];
    }

    $query = "DELETE FROM posts WHERE post_id = $delete_post_id";
    $delete_post_query = mysqli_query($connection, $query);

    confirmQuery($delete_post_query);

    header("Location: posts.php");
}

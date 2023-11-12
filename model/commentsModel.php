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
function showAllComments()
{

    global $connection;
    $query = "SELECT * FROM comments";
    $select_comments_query = mysqli_query($connection, $query);

    confirmQuery($select_comments_query);

    while ($row = mysqli_fetch_assoc($select_comments_query)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
?>

        <tr>
            <td><?php echo $comment_id ?></td>
            <td><?php echo $comment_author ?></td>
            <td><?php echo $comment_content ?></td>

            <td><?php echo $comment_email ?></td>
            <td><?php echo $comment_status ?></td>

            <!-- Show title of post in Field In Responce to of Comments -->
            <?php

            $query = "SELECT * FROM posts WHERE post_id =  $comment_post_id";
            $select_post_id_query = mysqli_query($connection, $query);

            confirmQuery($select_post_id_query);

            while ($row = mysqli_fetch_assoc($select_post_id_query)) {

                $post_id = $row['post_id'];
                $post_title = $row['post_title'];

                echo "<td><a href='../post.php?post_id=$post_id'>$post_title</a></td>";
            }



            ?>
            <td><?php echo $comment_date ?></td>
            <td><a href="comments.php?source=approve_comment&approve_comment_id=<?php echo $comment_id ?>">Approve</a></td>
            <td><a href="comments.php?source=unapprove_comment&unapprove_comment_id=<?php echo $comment_id ?>">Unapprove</a></td>
            <td><a href="comments.php?source=delete_comment&delete_comment_id=<?php echo $comment_id ?>">Delete</a></td>

        </tr>


<?php }
}

function approveComment()
{
    global $connection;

    if (isset($_GET['approve_comment_id'])) {

        $approve_comment_id = $_GET['approve_comment_id'];
    }

    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approve_comment_id";
    $approve_comment_query = mysqli_query($connection, $query);

    confirmQuery($approve_comment_query);

    header("Location: comments.php");
}


function unapproveComment()
{
    global $connection;

    if (isset($_GET['unapprove_comment_id'])) {

        $unapprove_comment_id = $_GET['unapprove_comment_id'];
    }

    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $unapprove_comment_id";
    $unapprove_comment_query = mysqli_query($connection, $query);

    confirmQuery($unapprove_comment_query);

    header("Location: comments.php");
}

function deleteComment()
{
    global $connection;

    if (isset($_GET['delete_comment_id'])) {

        $delete_comment_id = $_GET['delete_comment_id'];
    }

    $query = "DELETE FROM comments WHERE comment_id  = $delete_comment_id";
    $delete_comment_query = mysqli_query($connection, $query);

    confirmQuery($delete_comment_query);

    header("Location: comments.php");
}

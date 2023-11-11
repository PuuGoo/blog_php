<?php include "./includes/admin_header.php" ?>
<?php include "../model/postsModel.php" ?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include "./includes/admin_navigation.php" ?>
    <div id="page-wrapper">

        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>
                    <!-- Show All Posts -->
                    <?php

                    if (isset($_GET['source'])) {

                        $source = $_GET['source'];
                    } else {

                        $source = '';
                    }

                    switch ($source) {
                        case "add_posts":

                            include "./add_posts.php";
                            break;

                        case "delete_post":

                            deletePost();
                            break;

                        case "update_post":

                            include "./update_post.php";
                            break;

                        default:
                            include "./view_all_posts.php";
                            break;
                    }

                    ?>




                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "./includes/admin_footer.php" ?>
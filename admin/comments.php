<?php include "./includes/admin_header.php" ?>
<?php include "../model/commentsModel.php" ?>


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
                        case "approve_comment":

                            approveComment();
                            break;
                        case "unapprove_comment":

                            unapproveComment();
                            break;

                        case "delete_comment":

                            deleteComment();
                            break;

                        default:
                            include "./view_all_comments.php";
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
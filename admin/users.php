<?php include "./includes/admin_header.php" ?>
<?php include "../model/usersModel.php" ?>


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
                        case "add_user":

                            include "./add_user.php";
                            break;

                        case "delete_user":

                            deleteUser();
                            break;

                        case "admin_user":

                            adminUser();
                            break;
                        case "subscriber_user":

                            subscriberUser();
                            break;

                        case "update_user":

                            include "./update_user.php";
                            break;

                        default:
                            include "./view_all_users.php";
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
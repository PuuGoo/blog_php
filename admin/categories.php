<?php include "./includes/admin_header.php" ?>
<?php include "../model/categoriesModel.php" ?>


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

                    <div class="col-lg-6">
                        <!-- Add Categories -->
                        <?php addCategories(); ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input type="text" name="cat_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
                            </div>
                        </form>

                        <!-- Update Categories  -->
                        <?php updateCategories(); ?>

                    </div> <!-- Add Category Form -->

                    <div class="col-lg-6">


                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- Show All Categories -->
                                <?php showAllCategories(); ?>
                                <!-- Delete one category -->
                                <?php deleteCategories(); ?>
                            </tbody>
                        </table>


                    </div>



                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "./includes/admin_footer.php" ?>
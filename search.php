<?php include_once "../cms/includes/db.php" ?>

<?php include_once "../cms/includes/header.php" ?>



<!-- Navigation -->
<?php include_once "../cms/includes/navigation.php" ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <!-- First Blog Post -->
            <!-- Bên dưới là cách để lồng ghép html vô giữa câu lệnh php -->
            <?php

            if (isset($_POST['submit'])) {

                $search = $_POST['search'];
                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                $search_query = mysqli_query($connection, $query);
                if (!$search_query) {

                    die("Query Failed" . mysqli_error($connection));
                }

                $count = mysqli_num_rows($search_query);

                if ($count == 0) {

                    echo "<h1>NO FOUND</h1>";
                } else {

                    while ($row = mysqli_fetch_assoc($search_query)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
            ?>

                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>
                        <h2>
                            <a href="#"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?> at 10:00 PM</p>
                        <hr>
                        <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="" width="100%">
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

            <?php }
                }
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include_once "../cms/includes/slidebar.php" ?>


    </div>
    <!-- /.row -->

    <hr>

    <?php include_once "../cms/includes/footer.php" ?>
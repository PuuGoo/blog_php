                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Edit Category</label>

                                <?php
                                if (isset($_GET['edit'])) {
                                    $cat_id = $_GET['edit'];
                                    $query = "SELECT * FROM categories where cat_id = $cat_id";
                                    $select_categories_id = mysqli_query($connection, $query);
                                    while ($row = mysqli_fetch_assoc($select_categories_id)) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                ?>

                                        <input type="text" value="<?php if (isset($cat_title)) {
                                                                        echo $cat_title;
                                                                    } ?>" name="cat_title" class="form-control">

                                <?php }
                                } ?>
                            </div>

                            <!-- Update Categories -->
                            <div class="form-group">
                                <input type="submit" name="update_category" class="btn btn-primary" value="Update">
                            </div>
                        </form>
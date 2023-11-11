




<?php
function addCategories()
{
    global $connection;
    if (isset($_POST['submit'])) {

        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {

            echo "<span style='color: red'>This field should not empty</span>";
        } else {

            // Truy van du Lieu
            $query = "INSERT INTO categories(cat_title)";
            $query .= "VALUES('$cat_title')";
            $create_categories = mysqli_query($connection, $query);

            if (!$create_categories) {

                die("Query Failed" . mysqli_error($connection));
            }
        }
    }
}

function showAllCategories()
{
    global $connection;
    // Truy Van Du Lieu // Find All Categories
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);


    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<th>{$cat_id}</th>";
        echo "<th>{$cat_title}</th>";
        echo "<th><a href='categories.php?delete={$cat_id}'>Delete</a></th>";
        echo "<th><a href='categories.php?edit={$cat_id}'>Edit</a></th>";
        echo "</tr>";
    }
}

function updateCategories()
{
    global $connection;
    if (isset($_GET['edit'])) {
        $cat_id = $_GET['edit'];
        include "./includes/update_categories.php";
    }
    if (isset($_POST['update_category'])) {
        // Update Query  
        $the_cat_title = $_POST['cat_title'];
        $query = "UPDATE categories SET cat_title = '$the_cat_title' WHERE cat_id = $cat_id";
        $update_query = mysqli_query($connection, $query);
        if (!$update_query) {

            die("Query Failed" . mysqli_error($connection));
        }

        header("Location: categories.php?edit='$cat_id'");
    }
}


function deleteCategories()
{
    if (isset($_GET['delete'])) {
        global $connection;
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $delete_query = mysqli_query($connection, $query);
        // Chuyển hướng trang: Bằng cách sử dụng header, bạn có thể chuyển hướng người dùng đến một trang web khác hoặc trang mới sau khi xử lý một yêu cầu. 
        // Ví dụ: chuyển hướng sau khi người dùng đăng nhập thành công hoặc chuyển hướng từ một trang không tồn tại đến trang lỗi.
        header("Location: categories.php"); //Hàm này cần được gọi trước bất kỳ nội dung nào được xuất ra từ mã PHP.
    }
}

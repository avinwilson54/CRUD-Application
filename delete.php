<?php
include "config.php";
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // echo "Deleted Successfully";
        header("location:index.php");
    } else {
        die(mysqli_error($conn));
    }
}

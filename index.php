<?php
include "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</head>

<body>

    <navbar class="navbar navbar-expand-sm navbar-light bg-light">

        <a class="navbar-brand" href="#">Users</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>

            <form class="form-inline ml-auto">
                <input id="myInput" class="form-control mr-sm-2" type="text" placeholder="Search..">
            </form>
        </div>

    </navbar>

    <div class="container">

        <a href="user.php" class="btn btn-primary my-2" type="button">Add user</a>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ph no.</th>
                    <th scope="col">Address</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php
                $sql = "SELECT * FROM users";
                $result = mysqli_query($conn, $sql);
                $results_per_page = 3;
                $number_of_results = mysqli_num_rows($result);
                // if (mysqli_num_rows($result) > 0) {
                //     while ($row = mysqli_fetch_assoc($result)) {
                //         echo "<tr>";
                //         echo "<th>" . $row['id'] . "</th>";
                //         echo "<td>" . $row['first_name'] . "</td>";
                //         echo "<td>" . $row['last_name'] . "</td>";
                //         echo "<td>" . $row['email'] . "</td>";
                //         echo "<td>" . $row['phone_number'] . "</td>";
                //         echo "<td>" . $row['address'] . "</td>";
                //         echo "<td>";
                //         echo '<a href="update.php?updateid=' . $row['id'] . '" class="btn btn-primary">Update</a>';
                //         echo '<a href="delete.php?deleteid=' . $row['id'] . '" class="btn btn-danger">Delete</a>';
                //         echo "</td>";
                //         echo "</tr>";
                //     }
                // }
                $number_of_pages = ceil($number_of_results / $results_per_page);

                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }

                $this_page_result = ($page - 1) * $results_per_page;

                $sql = "SELECT * FROM users LIMIT " . $this_page_result . "," . $results_per_page;
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<th>" . $row['id'] . "</th>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone_number'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>";
                    echo '<a href="update.php?updateid=' . $row['id'] . '" class="btn btn-primary">Update</a>';
                    echo '<a href="delete.php?deleteid=' . $row['id'] . '" class="btn btn-danger">Delete</a>';
                    echo "</td>";
                    echo "</tr>";
                }
                ?>

                <ul class='pagination mt-2 justify-content-end'>

                    <?php for ($page = 1; $page <= $number_of_pages; $page++)
                        echo "<li class='page-item'><a class='page-link' href='index.php?page=" . $page . "'> $page </a></li>";
                    ?>

                </ul>

            </tbody>
        </table>
    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
<?php
$showError = false;
if(!isset($_SESSION['delete'])){

    // echo $_SESSION['delete'];
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Deleted!</strong> Your account is now deleted and now create new one
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div> ';
        // session_unset($_SESSION['delete']);
        }
        else{
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $showError.'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div> ';
    }
?>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Employees Details</h2>
                        <a href="create1.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a>
                    </div>
                    <?php    
                    // Include config file
                    include 'config.php';
                    session_start();
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM full_emp";
                    $sql1 = "SELECT * FROM `gender_view`";
                    $sql2 = "SELECT * FROM `qa_view` ";
                    $sql3 = "SELECT * FROM `hob_view` ";
                    
                    if ($result = mysqli_query($link, $sql)) {
                        $result1 = mysqli_query($link, $sql1);
                        // print_r( $result1);
                        $result2 = mysqli_query($link, $sql2);
                        $result3 = mysqli_query($link, $sql3);
                        if (mysqli_num_rows($result) > 0) {
                            // mysqli_num_rows($result1);
                            // mysqli_num_rows($result2);
                            // mysqli_num_rows($result3);
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Name</th>";
                            echo "<th>Email</th>";
                            echo "<th>Password</th>";
                            echo "<th>Details</th>";
                            echo "<th>Gender</th>";
                            echo "<th>Qualification</th>";
                            echo "<th>Hobby</th>";
                            echo "<th>Salary</th>";
                            echo "<th>Age</th>";
                            echo "<th>Image</th>";
                            echo "<th>Action</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            while ($row = mysqli_fetch_array($result)) {
                                $row1 = mysqli_fetch_array($result1);
                                $row2 = mysqli_fetch_array($result2);
                                // print_r($row['q_nm']);
                                // exit;
                                // $row4 = implode(",",$row['q_nm']);
                                // foreach($row['q_nm'] as $qq ){
                                //     print_r($qq);
                                $row3 = mysqli_fetch_array($result3);
                                // print_r($row3['h_nm']);
                                echo "<tr>";
                                echo "<td>" . $row['eid'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['password'] . "</td>";
                                echo "<td>" . $row['det'] . "</td>";
                                echo "<td>" . $row['sx'] . "</td>";
                                echo "<td>" . $row['q_nm'] . "</td>";
                                echo "<td>" . $row['h_nm'] . "</td>";
                                echo "<td>" . $row['salary'] . "</td>";
                                echo "<td>" . $row['age'] . "</td>";
                                echo "<td>" .'<img src="uploadeddata/'.$row['image'].'" " title='. $row['image'] .' style="width:100px;height:100px">'. "</td>";
                                echo "<td>";
                                echo '<a href="read.php?eid=' . $row['eid'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="update.php?eid=' . $row['eid'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="delete.php?eid=' . $row['eid'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                $_SESSION['delete'] = "Deleted";
                                echo "</td>";
                                echo "</tr>";
                        }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);}
                        else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
// Check existence of id parameter before processing further
if (isset($_GET["eid"]) && !empty(trim($_GET["eid"]))) {
    // Include config file
    include 'db.php';


    // Prepare a select statement
    $eid = trim($_GET['eid']);

    $sql = "SELECT * FROM employees WHERE eid = $eid ";
    $result = mysqli_query($link, $sql);



    if (mysqli_num_rows($result) == 1) {
        /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
        $row = mysqli_fetch_array($result);
        // print_r($row);
        // $row1 = mysqli_fetch_assoc($result1); // Gender


        // Retrieve individual field value
        $name = $row["name"];
        $email = $row["email"];
        $password = $row["password"];
        $details = $row["det"];
        $salary = $row["salary"];
        $age = $row["age"];
    }
} else {
    // URL doesn't contain valid id parameter. Redirect to error page
    echo "Oops! Something went wrong. Please try again later.";
    header("location: error.php");
    exit();
}




// Close connection
mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Name</label>
                        <p><b><?php echo $row["name"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label> Email </label>
                        <p><b><?php echo $row["email"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label> Password </label>
                        <p><b><?php echo $row["password"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label> Details </label>
                        <p><b><?php echo $row["det"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Salary</label>
                        <p><b><?php echo $row["salary"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <p><b><?php echo $row["age"]; ?></b></p>
                    </div>

                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
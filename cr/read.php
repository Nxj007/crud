<?php
// Check existence of id parameter before processing further
if (isset($_GET["eid"]) && !empty(trim($_GET["eid"]))) {
    // Include config file
    include 'config.php';


    // Prepare a select statement
    $eid = trim($_GET['eid']);

    $sql = "SELECT * FROM employees WHERE eid = $eid ";
    $result = mysqli_query($link, $sql);

    $sql1 = "SELECT `sx` FROM `gender_view` WHERE eid = $eid ";
    $result1 = mysqli_query($link, $sql1);

    $sql2 = "SELECT `q_nm` FROM `qa_view` WHERE eid = $eid ";
    $result2 = mysqli_query($link, $sql2);

    $sql3 = "SELECT `hid` FROM `e_hob` WHERE eid = $eid";
    $result3 = mysqli_query($link, $sql3);

    if (mysqli_num_rows($result) == 1) {
        mysqli_num_rows($result1) == 1;
        mysqli_num_rows($result2) == 1;
        mysqli_num_rows($result3) == 1;
        /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
        $row = mysqli_fetch_array($result);
        // print_r($row);
        $row1 = mysqli_fetch_array($result1);
        $row2 = mysqli_fetch_array($result2);
        print_r($row2);
        echo "<br>";
        foreach ($row2 as $ur) {
            print_r("This is rr:=" . $ur);
            while (in_array($row2,$ur)){
                echo "<br>";
                exit();
            }
        }
        echo "<br>";
        $row3 = mysqli_fetch_array($result3);
        $row4 = implode(",", $row3);
        print_r($row4);
        echo "<br>";
        foreach ($row3 as $urw) {
            print_r($urw);
        }

        // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        // $row1 = mysqli_fetch_array($result1);
        // print_r($row1['sx']);
        // $row2 = mysqli_fetch_array($result2);
        // $row3 = mysqli_fetch_array($result3);


        // Retrieve individual field value
        $name = $row["name"];
        $email = $row["email"];
        $password = $row["password"];
        $details = $row["det"];
        $gender = $row1["sx"];
        $qua = $row2["q_nm"];
        $hobby = $row3["hid"];
        $salary = $row["salary"];
        $age = $row["age"];
    }
} else {
    // URL doesn't contain valid id parameter. Redirect to error page
    echo "Oops! Something went wrong. Please try again later.";
    header("location: error.php");
    exit();
}



// Close statement
// mysqli_stmt_close($result);
// mysqli_stmt_close($result1);
// mysqli_stmt_close($result2);
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
                        <label>Gender</label>
                        <p><b><?php echo $gender; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Qualifications</label>
                        <p><b><?php echo $qua; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Hobby</label>
                        <p><b><?php echo $hobby; ?></b></p>
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
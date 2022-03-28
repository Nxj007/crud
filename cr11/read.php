<?php
// Check existence of id parameter before processing further
if (isset($_GET["eid"]) && !empty(trim($_GET["eid"]))) {
    // Include config file
    include 'db.php';


    // Prepare a select statement
    $eid = trim($_GET['eid']);

    $sql = "SELECT * FROM employees WHERE eid = $eid ";
    $result = mysqli_query($link, $sql);
    $sql1 = "SELECT `sx` FROM `gender_view` WHERE eid = $eid ";
    $result1 = mysqli_query($link, $sql1);
    $sql2 = "SELECT `q_nm` FROM `qa_view` WHERE eid = $eid ";
    $result2 = mysqli_query($link, $sql2);
    $sql3 = "SELECT `h_nm` FROM `hob_view` WHERE eid = $eid";
    $result3 = mysqli_query($link, $sql3);


    if (mysqli_num_rows($result) == 1) {
        mysqli_num_rows($result1) == 1;
        mysqli_num_rows($result2) == 1;
        /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
        $row = mysqli_fetch_array($result);
        // print_r($row);
        // $row1 = mysqli_fetch_assoc($result1); // Gender
        $sql1 = "SELECT `sx` FROM `gender_view` where eid=$eid ";
        $result1 = mysqli_query($link, $sql1); // gender_view
        $row1 = mysqli_fetch_array($result1);
        echo "<td>" . $row1['sx'] . "</td>";

        $sql2 = "SELECT `q_nm` FROM `qa_view` where eid=$eid ";
        $result2 = mysqli_query($link, $sql2); // qa_view
        $q_rw = [];
        while ($row2 = mysqli_fetch_array($result2)) {
            $q1 = $row2['q_nm'];
            $q_rw[] = $q1;
            // print_r($q_rw);
        }
        $q2 = implode(",", $q_rw); // CSV created
        // echo "<td>". var_dump($q2). "</td>";
      

        $sql3 = "SELECT `h_nm` FROM `hobby_view` where eid='$eid' ";
        $result3 = mysqli_query($link, $sql3); // hobby_view
        $h_rw = [];
        while ($row3 = mysqli_fetch_array($result3)) {
            $h1 = $row3['h_nm'];
            $h_rw[] = $h1;
        }
        $h2 = implode(",", $h_rw);

        // Retrieve individual field value
        $name = $row["name"];
        $email = $row["email"];
        $password = $row["password"];
        $details = $row["det"];
        $gender = $row1['sx'];
        // $qua = $row2["q_nm"];
        $qua = $q2;
        // $hobby = $row3;
        $hobby = $h2;
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
                        <!-- <p><b> echo var_dump($hobby); </b></p> -->
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
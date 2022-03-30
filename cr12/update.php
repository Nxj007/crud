<?php

$showAlert = false;
$showError = false;
// Include config file
include 'db.php';

// Define variables and initialize with empty values
// $name = $email = $password = $det =  $salary = $age  = $img = $uty =  "";
// $name_err = $email_err = $pass_err = $det_err = $salary_err = $age_err = $img_err = "";

// Processing form data when form is submitted
// Get hidden input value
if (isset($_POST["update"]) && !empty($_POST["update"])) {

$eid = $_POST["update"];

// Validate name
// $input_name = trim($_POST["name"]);
// if (empty($input_name)) {
//     $name_err = "Please enter a name.";
// } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
//     $name_err = "Please enter a valid name.";
// } else {
//     $name = $input_name;
// }

// // Validate Email
// $input_email = trim($_POST["email"]);
// if (empty($input_email)) {
//     $email_err = "Please enter an email.";
// } else {
//     $email = $input_email;
// }

// // Validate password
// $input_pass = trim($_POST["password"]);
// if (empty($input_pass)) {
//     $pass_err = "Please enter an password.";
// } else {
//     $password = $input_pass;
// }


// // Validate details 
// $input_det = trim($_POST["det"]);
// if (empty($input_det)) {
//     $det_err = "Please enter an Details.";
// } else {
//     $det = $input_det;
// }

// Check input errors before inserting in database
// if (empty($name_err) && empty($email_err) && empty($pass_err) && empty($det_err) && empty($gen_err) && empty($hobby_err) && empty($qua_err) && empty($salary_err) && empty($age_err) && empty($img_err)) {
// Prepare an update statement
if ($_POST('update')) {
    #$id = $_POST["id"];
    $eid = mysqli_insert_id($link);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $det = $_POST['det'];
    $salary = $_POST['salary'];
    $age = $_POST['age'];
    $img = $_FILES['image'];
    $imgfl = $_FILES["image"]["name"];
    $uty = $_POST['utype'];


    $sql1 = "UPDATE `employees` SET $name, $email, $password, $det, $salary, $age, $imgfl, $uty  WHERE eid = $eid ";
    
    // "UPDATE `employees` SET `name` = 'Prath', `email` = 'abc@hh.in', `password` = 'prar', `det` = 'prar', `salary` = '10000', `age` = '22' WHERE `employees`.`eid` = 461";

    if ($stmt1 = mysqli_query($link, $sql1)) {
        // Attempt to execute the prepared 
        echo $stmt1;
        exit;
        $showAlert = true;
        echo "<script>alert('Data Updated successfully');</script>";        
    }
}
// Close statement
mysqli_stmt_close($stmt1);
}
// Check existence of id parameter before processing further
if (isset($_GET["update"]) && !empty(trim($_GET["update"]))) {
    // Get URL parameter
    $eid =  trim($_GET["update"]);

    // Prepare a select statement
    $sql = "SELECT * FROM employees WHERE eid = '$eid' ";
    // $sql1 = "SELECT * FROM e_gender WHERE eid = ?";
    if ($result = mysqli_query($link, $sql)) {
        // $stmt1 = mysqli_prepare($link, $sql1);
        // Set parameters

        // Attempt to execute the prepared statement


        if (mysqli_num_rows($result) == 1) {
            /* Fetch result row as an associative array. Since the result set
                only one row, we don't need to use while loop */
            while ($row = mysqli_fetch_array($result)) {
                $name = $row["name"];
                $email = $row["email"];
                $password = $row["password"];
                $det = $row["det"];
                $salary = $row["salary"];
                $age = $row["age"];
                // $gender = $row1["gid"];
                $img = $row["image"];
                $uty = $row["utype"];
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
            header("location: error.php");
            exit();
        }

        // Close statement
        // mysqli_stmt_close($result);

        // Close connection
        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if (isset($_SESSION['update'])) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now updated and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    } elseif ($showError) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>

                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <label>Name</label>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>

                        <label> Email </label>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>

                        <label> Password </label>
                        <div class="form-group">
                            <input type="text" name="password" class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $pass_err; ?></span>
                        </div>

                        <label> Details </label>
                        <div class="form-group">
                            <input type="text" name="det" class="form-control <?php echo (!empty($det_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $det; ?>">
                            <span class="invalid-feedback"><?php echo $det_err; ?></span>
                        </div>


                        <label> Age : </label>
                        <div class="form-group">
                            <input type="number"     value="<?php echo $age; ?>" id="age" name="age" min="10" max="55">
                            <div class="error" id="ageErr"></div>
                            <span class="invalid-feedback"><?php echo $age_err; ?></span>
                        </div>


                        <label> Salary </label>
                        <div class="form-group">
                            <input type="number" name="salary" min="5000" max="20000" step="1000" value="<?php echo $salary; ?>" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>"> </input>
                            <!-- <div class="error" id="salaryErr"></div> -->
                            <span class="invalid-feedback"><?php echo $salary_err; ?></span>
                        </div>


                        <label> Upload Image </label>
                        <div class="form-group">
                            <input type="file" name="image" value="<?php echo $img; ?>" class="form-control <?php echo (!empty($img_err)) ? 'is-invalid' : ''; ?>" required />
                            <!-- <div class="error" id="imgErr"></div> -->
                            <span class="invalid-feedback"><?php echo $img_err; ?></span>
                        </div>

                        <label> User_Type </label>
                        <div class="form-group">
                            <select name="utype">
                                <option value=<?php if ($uty == "User") {
                                                    echo "selected";
                                                } ?>> User </option>
                                <option value=<?php if ($uty == "Admin") {
                                                    echo "selected";
                                                } ?>> Admin </option>
                            </select>
                        </div>

                        <input type="hidden" name="eid" value="<?php echo $eid; ?>" />
                        <input type="submit" class="btn btn-primary" value="update">

                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
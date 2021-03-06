<?php
// Check existence of id parameter before processing further
if(isset($_GET["eid"]) && !empty(trim($_GET["eid"]))){
    // Include config file
    include 'partials/_dbconnect.php';

    
    // Prepare a select statement
    $sql = "SELECT * FROM employees WHERE eid = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["eid"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                session_start();
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["name"];
                $email = $row["email"];
                $pass = $row["password"];
                $details = $row["det"];
                $salary = $row["salary"];
                $age = $row["age"];
                $img = $row["img"];


            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
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
                    
                    <div class="form-group">
                        <label>Image</label>
                        <!-- <p><b> echo $row["img"]; </b></p> -->
                        <input type="file" name="image" class="form-control <?php echo (!empty($img_err)) ? 'is-invalid' : ''; ?>" value="'.<?php echo $row["img"]; ?>.'" required />
                    </div>


                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

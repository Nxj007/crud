<?php
$showAlert = false;

$showError = false;
// Include config file
include 'partials/_dbconnect.php';

// Define variables and initialize with empty values
$name = $email = $password = $det = $gender = $hobby = $qua = $salary = $age  = $img = $uty =  "";
$name_err = $email_err = $pass_err = $det_err = $gen_err = $hobby_err = $qua_err = $salary_err = $age_err = $img_err = "";
// Static Tables, No Touching;
$query = 'SELECT * FROM master_hobby';
$hob = $link->query($query);

$query1 = 'SELECT * FROM master_qa';
$qa = $link->query($query1);

$query2 = 'SELECT * FROM master_gender';
$gn = $link->query($query2);

// Processing form data when form is submitted
if (isset($_POST["eid"]) && !empty($_POST["eid"])) {
    // Get hidden input value
    $eid = $_POST["eid"];

    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    // Validate Email
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter an email.";
    } else {
        $email = $input_email;
    }

    // Validate password
    $input_pass = trim($_POST["password"]);
    if (empty($input_pass)) {
        $pass_err = "Please enter an password.";
    } else {
        $password = $input_pass;
    }


    // Validate details 
    $input_det = trim($_POST["det"]);
    if (empty($input_det)) {
        $det_err = "Please enter an Details.";
    } else {
        $det = $input_det;
    }

    // Check input errors before inserting in database
    // if (empty($name_err) && empty($email_err) && empty($pass_err) && empty($det_err) && empty($gen_err) && empty($hobby_err) && empty($qua_err) && empty($salary_err) && empty($age_err) && empty($img_err)) {
        // Prepare an update statement
        if($_POST('submit')){
        #$id = $_POST["id"];
        $eid = mysqli_insert_id($link);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $det = $_POST['det'];
        $gid = $_POST['sx']; // For Ref Tbl

        $hobby = $_POST['hob'];
        
        $hid = implode(",", $hobby);
        
        $qua = $_POST['qa'];
        $qid = implode(",", $qua);
        
        $salary = $_POST['salary'];
        $age = $_POST['age'];

        $img = $_FILES['image'];
        $imgfl=$_FILES["image"]["name"];

        // $uty = $_POST['utype'];

        // $sql1 = "UPDATE employees SET name=?, email=?, password=?, det=?, gender=?, mhobby=?, mqn=? WHERE id=?";
        $sql1 = "UPDATE `employees` SET ('$name', '$email', '$password', '$det', '$salary', '$age', '$imgfl')  WHERE eid='$eid' ";
        if ($stmt1 = mysqli_prepare($link, $sql1)) {
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt1)) {
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            }

            $sql3 = "UPDATE `e_gender` SET `gid`='$gid' WHERE eid='$eid'";
            $stmt3= mysqli_prepare($link, $sql3);
            if ($stmt3) {
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt3)) {
                    // Records updated successfully. Redirect to landing page
                    header("location: index.php");
                    exit();
                }
                
            $sql2 = "UPDATE `e_hob` SET `hid`='$hid' WHERE eid='$eid'";
            $stmt2= mysqli_prepare($link, $sql2);
            if(isset($_POST['hob'])){
                // $eid = $_POST['eid'] ; 
                // $eid =  trim($_GET["eid"]);
                $hob_up = $_POST['hob'];
                $query3=" SELECT * FROM `e_hob` WHERE eid = $eid ";
                $q_run = mysqli_query($link, $query3);
                $hob_val = []; // Empty Values

             foreach($q_run as $hob_dt){
                $hob_val = $hob_dt['hid'];
                echo $hob_dt['hid'];
             }
             foreach($hob_up as $in_val){ // Insert Data
                 if(!in_array($in_val, $hob_val)){
                    echo $in_val." Insert <br> ";
                    $ins_qry = " INSERT INTO `e_hob` VALUES ($eid, $in_val) ";
                    $ins_qry_run = mysqli_query($link, $ins_qry);
                }
            }
            foreach($hob_val as $hob_rw){ // Delete Data
                if(!in_array($hob_rw, $hob_up)){
                    echo $hob_rw."Deleted <br>";
                    $del_qry = " DELETE FROM `e_hob` WHERE eid=$eid and hid=$hob_rw ";
                    $del_qry_run = mysqli_query($link, $del_qry);
                    }
                }
                header("location: index.php");
                exit(0);
            }
            $sql4 = "UPDATE `e_qa` SET `qid`='$qid' WHERE eid='$eid'";
            $stmt4= mysqli_prepare($link, $sql4);
            if ($stmt4) {
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt4)) {
                    // Records updated successfully. Redirect to landing page
                    header("location: index.php");
                    exit();
                }
            else {
                echo "Oops! Something went wrong. Please try again later.";
            }

        }
    }
        // Close statement
        mysqli_stmt_close($stmt1);
        mysqli_stmt_close($stmt2);
        mysqli_stmt_close($stmt3);
        mysqli_stmt_close($stmt4);
        }
        }
        // Close connection
    mysqli_close($link);
} 

    else {
    // Check existence of id parameter before processing further
    if (isset($_GET["eid"]) && !empty(trim($_GET["eid"]))) {
        // Get URL parameter
        $eid =  trim($_GET["eid"]);

        // Prepare a select statement
        $sql = "SELECT * FROM employees WHERE eid = ?";
        // $sql1 = "SELECT * FROM e_gender WHERE eid = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // $stmt1 = mysqli_prepare($link, $sql1);
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            // mysqli_stmt_bind_param($stmt1, "i", $param_id);
            session_start();
            // Set parameters
            $param_id = $eid;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // mysqli_stmt_execute($stmt1);
                $result = mysqli_stmt_get_result($stmt);
                // $result1 = mysqli_stmt_get_result($stmt1);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    // $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                    // Retrieve individual field value
                    $name = $row["name"];
                    $email = $row["email"];
                    $password = $row["password"];
                    $det = $row["det"];
                    $salary = $row["salary"];
                    $age = $row["age"];
                    // $gender = $row1["gid"];
                    $img = $row["image"];
                    $uty = $row["utype"];
                    } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                    }
            }   else {
                echo "Oops! Something went wrong. Please try again later.";
                }   
        }

        // Close statement
        mysqli_stmt_close($stmt);

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
if(isset($_SESSION['update'])){
  echo $_SESSION['update'];
  if($_SESSION['update']){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now updated and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }}
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
                            <input type="text"  name="det" class="form-control <?php echo (!empty($det_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $det; ?>" >
                            <span class="invalid-feedback"><?php echo $det_err; ?></span>
                        </div>


                        <label>Gender</label>
                        <div class="form-group">
                            <?php 
                            include 'config.php';
                            $sql2 = "SELECT * FROM e_gender WHERE eid = '$eid' ";
                            $stmt1 = mysqli_prepare($link, $sql2) or mysqli_connect_error($link);
                            if (mysqli_stmt_execute($stmt1)) {
                                $result = mysqli_stmt_get_result($stmt1);
                
                                if (mysqli_num_rows($result) == 1) {
                                    /* Fetch result row as an associative array. Since the result set
                                    contains only one row, we don't need to use while loop */
                                    $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                }
                            }
                            ?>
                            <?php foreach ($gn as $g1 => $value2) : ?>
                                <input type="radio" name="sx" <?php if (in_array($row1, $value2)) {
                                                                    echo "checked";
                                                                } ?> value="<?php echo htmlspecialchars($gender); ?>">
                                <?php echo htmlspecialchars($value2['sx']); ?>
                            <?php endforeach; ?>
                        </div>
                        


                        <label>Hobby</label>
                        <div class="form-group">
                            
                            <select name="hob[]" multiple>
                            <?php 
                             if(isset($_POST['hob'])){
                                // $eid = $_POST['eid'] ; 
                                $eid =  trim($_GET["eid"]);
                                $hob_up = $_POST['hob'];
                                $query3=" SELECT * FROM `e_hob` WHERE eid = '$eid' ";
                                $q_run = mysqli_query($link, $query3);

                                $hob_val = []; // Empty Values
                             foreach($q_run as $hob_dt){
                                $hob_val = $hob_dt['hid'];
                                echo $hob_dt['hid'];

                             }
                            // Insert Data
                            foreach($hob_up as $in_val){
                                if(!in_array($in_val, $hob_val)){
                                    echo $in_val." Insert <br> ";
                                }
                            }
                        }
                            ?>                                                                

                                <!-- $mhobbby = implode(",", $row['hby']);  -->
                                <?php foreach ($hob as $h1 => $value) : ?>
                                    <option value="<?php echo $value['hid'] ?>"<?php if(!in_array($in_val, $hob_val)) {echo "selected";}?>>
                                    <?php echo htmlspecialchars($value['h_nm']); ?></option>
                                    <?php endforeach ?>
                            </select>
                        </div>
                        <!-- if (in_array($row2['hid'], $value['hid'])) {echo "selected";}  -->


                        <label>Qualifications</label>
                        <div class="form-group">
                             <!-- $mqn1 = implode(",", $mqn);  -->
                              <!-- if (in_array($mqn, $value1)) echo "checked";   -->
                              <!-- Comparing values php code -->
                            <?php foreach ($qa as $q1 => $value1) : ?>
                                <input type="checkbox" name="qa[]" <?php if (in_array($row3['qid'], $value1)) {echo "checked";} ?> value="<?php echo $value1['qid'] ?>">
                                <?php echo htmlspecialchars($value1['q_nm']); ?> <br>
                            <?php endforeach; ?>
                            <div class="error" id="quaErr"></div>
                        </div>


                        <label> Age : </label>
                        <div class="form-group">
                            <input type="number" value="<?php echo $age; ?>" id="age" name="age" min="10" max="55">
                            <div class="error" id="ageErr"></div>
                            <span class="invalid-feedback"><?php echo $age_err; ?></span>
                        </div>


                        <label> Salary </label>
                        <div class="form-group">
                            <input type="number" name="salary" value="<?php echo $salary; ?>" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>"> </input>
                            <!-- <div class="error" id="salaryErr"></div> -->
                            <span class="invalid-feedback"><?php echo $salary_err; ?></span>
                        </div>


                        <label> Upload Image </label>
                        <div class="form-group">
                            <input type="file" name="image" value="<?php echo $img; ?>" class="form-control <?php echo (!empty($img_err)) ? 'is-invalid' : ''; ?>" required />
                            <!-- <div class="error" id="imgErr"></div> -->
                            <span class="invalid-feedback"><?php echo $img_err; ?></span>
                        </div>

                        
                        <input type="hidden" name="eid" value="<?php echo $eid; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">

                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
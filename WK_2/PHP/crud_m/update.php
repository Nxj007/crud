<?php
// Include config file
include "config.php";

include 'partials/_dbconnect.php';
 
// Define variables and initialize with empty values
$name = $email = $password = $gender = $hobby = $qua = $salary = $age  = $img =  "";
$name_err = $email_err = $pass_err = $gen_err = $hobby_err = $qua_err = $salary_err = $age_err = $img_err = "";
 
$query = 'SELECT * FROM master_hobby';
$hob = $link->query($query);

$query1 = 'SELECT * FROM master_qa';
$qa = $link->query($query1);

$query2 = 'SELECT * FROM master_gender';
$gn = $link->query($query2);

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate Email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an email.";     
    } else{
        $email = $input_email;
    }

    // Validate pass
    $input_pass = trim($_POST["pass"]);
    if(empty($input_pass)){
        $pass_err = "Please enter an pass.";     
    } else{
        $pass = $input_pass;
    }
    
    
    // Validate details 
    $input_det = trim($_POST["det"]);
    if(empty($input_det)){
        $det_err = "Please enter an Details.";     
    } else{
        $det = $input_det;
    }

    
    
    // Check input errors before inserting in database
    if (empty($name_err) && empty($email_err) && empty($pass_err) && empty($gen_err) && empty($hobby_err) && empty($qua_err) && empty($salary_err) && empty($age_err) && empty($img_err)) {
        // Prepare an update statement
        #$id = $_POST["id"];
        $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $gender = $_POST['sx'];
            $hobby = $_POST['hob'];
            $mhobby = implode(",", $hobby);
            $qua = $_POST['qa'];
            $mqn = implode(",", $qua);
            $salary = $_POST['salary'];
            $age = $_POST['age'];
            $img = $_FILES['img'];
        // $last_id = mysqli_insert_id($link);

        // $sql1 = "UPDATE employees SET name=?, email=?, pass=?, det=?, gender=?, mhobby=?, mqn=? WHERE id=?";
        $sql1 ="UPDATE `employees` SET ('$name', '$email', '$password', '$gender', '$mhobby', '$mqn', '$salary', '$age', '$img')  WHERE id='$id' ";
        if($stmt1 = mysqli_prepare($link, $sql1)){
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt1)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt1);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM employees WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row["name"];
                    $email = $row["email"];
                    $pass = $row["password"];                    
                    $gender = $row["gender"];                    
                    $mhobby = $row["hobby"];                    
                    $mqn = $row["qua"];                    
                    $salary = $row["salary"];                    
                    $age = $row["age"];
                    $img = $row["img"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        
                        <label>Name</label>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        
                        <label> Email </label>
                        <div class="form-group">
                            <input type="email" id="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>
                        
                        <label> Password </label>
                        <div class="form-group">
                            <input type="text" id="password" name="password" class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pass; ?>">
                            <span class="invalid-feedback"><?php echo $pass_err;?></span>
                        </div>
                        
                        
                        
                        <label>Hobby</label> 
                        <div class="form-group">
                        <?php $mhobbby = implode(",", $row['hby']);?>
                            <select name="hob[]" multiple>
                            <?php foreach ($hob as $h1 => $value): ?>
                            <option <?php if(in_array($mhobby, $value)) {echo "selected";}?> value="<?php echo $value['h_nm']?>"> <?php echo htmlspecialchars($value['h_nm']); ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <label>Qualifications</label>
                        <div class="form-group">
                            <?php $mqn1 = implode(",", $mqn);?>
                            <?php foreach ($qa as $q1 => $value1):?>
                                <input type="checkbox" name="qa[]" <?php if(in_array($mqn, $value1)) echo "checked"; ?> value="<?php echo $value1['q_nm']?>" > 
                                <?php echo htmlspecialchars($value1['q_nm']); ?> <br>
                                <?php endforeach; ?>    
                                <div class="error" id="quaErr"></div>
                        </div>

                        <label>Gender</label>
                        <div class="form-group">
                        <?php foreach ($gn as $g1 => $value2): ?>
                            <input type="radio" name="sx" <?php if(in_array($gender, $value2)){echo "checked";}?> value="<?php echo htmlspecialchars($value2['sx']); ?>" >
                            <?php echo htmlspecialchars($value2['sx']); ?>   
                            <?php endforeach; ?>
                        </div>
                        

                        <label> Age : </label>
                        <div class="form-group">
                            <input type="number" value="<?php echo $age;?>" id="age" name="age" min="10" max="55">
                            <div class="error" id="ageErr"></div>
                            <span class="invalid-feedback"><?php echo $age_err;?></span>
                        </div>


                        <label> Salary </label>
                        <div class="form-group">
                            <input type="number" name="salary" value="<?php echo $salary; ?>" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>"> </input>
                            <!-- <div class="error" id="salaryErr"></div> -->
                            <span class="invalid-feedback"><?php echo $salary_err; ?></span>
                        </div>
                        

                        <label> Upload Image </label>
                        <div class="form-group">
                            <input type="file" name="image" class="form-control <?php echo (!empty($img_err)) ? 'is-invalid' : ''; ?>" required />
                            <!-- <div class="error" id="imgErr"></div> -->
                            <span class="invalid-feedback"><?php echo $img_err; ?></span>
                        </div>









                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
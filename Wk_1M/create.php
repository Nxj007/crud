<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $det = $salary = $email = $pass = "";

$name_err = $det_err = $salary_err = $email_err = $pass_err = "";

$query = 'SELECT * FROM master_hobby';
$hob = $link->query($query);

$query1 = 'SELECT * FROM master_qa';
$qu = $link->query($query1);

$query2 = 'SELECT * FROM master_gender';
$gn = $link->query($query2);


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
        $det_err = "Please enter an det.";     
    } else{
        $det = $input_det;
    }
    
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($det_err) && empty($salary_err) && empty($email_err) && empty($pass_err) ){
        // Prepare an insert statement
        $sql =" INSERT INTO employees (name, email, pass, det, salary) VALUES (?, ?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_email, $param_pass, $param_det, $param_salary);
            
            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_pass = $pass;
            $param_det = $det;
            $param_salary = $salary;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        

       
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<style>
.error {color: #FF0000;}
</style>    
<meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        
                        
                        <div class="form-group">
                            <label> Email </label>
                            <input type="email" id="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"> <?php echo $email_err;?> </span>
                        </div>
                        

                        <div class="form-group">
                            <label> Pass </label>
                            <input type="pass" id="pass" name="pass" class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pass; ?>">
                            <span class="invalid-feedback"> <?php echo $pass_err;?> </span>
                        </div>
                        

                        <div class="form-group">
                            <label for=""> Hobbies: </label>
                            <select name="hob" multiple>
                            <?php foreach ($hob as $h1 => $value): ?>
                                <option value="<?php echo $value['h_nm']?>"> <?php echo htmlspecialchars($value['h_nm']); ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for=""> Qualifications : </label>
                            <?php foreach ($qu as $q1 => $value): ?>
                            <input type="checkbox" id="qu" name="qu" value="<?php echo $value['q_nm']?>">
                            <label for="qu"> <?php echo htmlspecialchars($value['q_nm']); ?> </label><br>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="form-group">
                            <label> Gender : </label>
                            <?php foreach ($gn as $g1 => $value): ?>
                            <input type="radio" id="gnd" name="gnd" value="<?php echo $value['sx']?>">
                            <label for="gnd"> <?php echo htmlspecialchars($value['sx']); ?> </label><br>
                            <?php endforeach; ?>
                        </div>

                        <div class="form-group">
                            <label> Details </label>
                            <textarea name="det" id="det" rows="5" cols="20" class="form-control <?php echo (!empty($det_err)) ? 'is-invalid' : ''; ?>"> <?php echo $det; ?> </textarea>
                            <span class="invalid-feedback"><?php echo $det_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>

                    </form>
                    
                </div>
            </div>        
        </div>
    </div>
</body>

</html>
<?php
$showAlert = false;
$showError = false;

// Include config file
include "config.php";

include 'partials/_dbconnect.php';

$query = 'SELECT * FROM master_hobby';
$hob = $link->query($query);

$query1 = 'SELECT * FROM master_qa';
$qa = $link->query($query1);

$query2 = 'SELECT * FROM master_gender';
$gn = $link->query($query2);
 
// Define variables and initialize with empty values
$fname = $det = $email = $password = $hobby  = "";

$name_err = $det_err = $email_err = $pass_err = $rd_btn = $hobby_err = "";




// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
   $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $fname = $input_name;
    }


    // Validate Email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an email.";     
    } else{
        $email = $input_email;
    }
    
    // Validate pass
    $input_pass = trim($_POST["password"]);
    if(empty($input_pass)){
        $pass_err = "Please enter an pass.";     
    } else{
        $password = $input_pass;
    }
    

    // Validate details
    $input_det = trim($_POST["det"]);
    if(empty($input_det)){
        $det_err = "Please enter an det.";     
    } else{
        $det = $input_det;
    }
    
    $rd_btn = array(); 
    if(!isset($_POST['sx'])){ 
        $rd_btn[] = "No radio buttons were checked."; 
    } 
    else{
        $gender = $rd_btn;
    }
   

    if (isset($_POST['submit'])) {

        $fname = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $det = $_POST['det'];
        $gender = $_POST['sx'];
        $hobby = $_POST['hob'];
        $mhobby = implode(",", $hobby);
        $qua = $_POST['qa'];
        $mqn = implode(",", $qua);
        
        $sql = "INSERT INTO `employees` VALUES (NULL, '$fname', '$email', '$password', '$det', '$gender', '$mhobby', '$mqn')";
        $sql1 = "INSERT INTO `e_gender` VALUES (NULL, '$gender')";
        
        $result = $link->query($sql);
        $result1 = $link->query($sql1);
    
        if ($result == TRUE) {
        echo "New record created successfully.";
    }
            
    else{
        echo "Error:". $sql . "<br>". $link->error;
        echo "Error:". $sql1 . "<br>". $link->error;
    } 
    $link->close();
}
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>

<script>
    // Defining a function to display error message
    function printError(elemId, hintMsg) {
        document.getElementById(elemId).innerHTML = hintMsg;
    }
// Defining a function to validate form 
function validateForm() {
    // Retrieving the values of form elements 
    var name = document.contactForm.name.value;
    var email = document.contactForm.email.value;
    var gender = document.contactForm.gender.value;
    var qua =  [];
    var hob =  document.contactForm.hob.value;

    var checkboxes = document.getElementsByName("qua[]");
    for(var i=0; i < checkboxes.length; i++) {
        if(checkboxes[i].checked) {
            // Populate qua array with selected values
            qua.push(checkboxes[i].value);
        }
    }

    var nameErr = emailErr = genderErr = quaErr = hobErr = true;

    if(name == "") {
        printError("nameErr", "Please enter your name");
    } else {
        var regex = /^[a-zA-Z\s]+$/;                
        if(regex.test(name) === false) {
            printError("nameErr", "Please enter a valid name");
        } else {
            printError("nameErr", "");
            nameErr = false;
        }
    }


     // Validate email address
     if(email == "") {
        printError("emailErr", "Please enter your email address");
    } else {
        // Regular expression for basic email validation
        var regex = /^\S+@\S+\.\S+$/;
        if(regex.test(email) === false) {
            printError("emailErr", "Please enter a valid email address");
        } else{
            printError("emailErr", "");
            emailErr = false;
        }
    }

     // Validate gender
     if(gender == "") {
        printError("genderErr", "Please select your gender");
    } else {
        printError("genderErr", "");
        genderErr = false;
    }

    
  

  // Validate hob
  if(hob == "") {
        printError("hobErr", "Please select your hob");
    } else {
        printError("hobErr", "");
        hobErr = false;
    }



// Prevent the form from being submitted if there are any errors
if((nameErr || emailErr || genderErr || quaErr || hobErr) == true) {
       return false;
    } else {
        // Creating a string from input data for preview
        var dataPreview = "You've entered the following details: \n" +
                          "Full Name: " + name + "\n" +
                          "Email Address: " + email + "\n" + 
                          "Gender: " + gender + "\n" +
                          "Hobbies: " + hob + "\n" ;
        if(qua.length) {
                dataPreview += "Qua: " + qua.join(", ");
        }
        // Display input data in a dialog box before submitting the form
        alert(dataPreview);
    }
};
</script>


</head>
<body>
<?php require 'partials/_nav.php' ?>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form name="contactForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onsubmit="return validateForm()">
                        
                        <label>Name</label>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fname; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                            <div class="error" id="nameErr"></div>
                        </div>
                        
                        
                        <label> Email </label>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"> <?php echo $email_err;?> </span>
                            <div class="error" id="emailErr"></div>
                        </div>
                        

                        <label> Pass </label>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"> <?php echo $pass_err;?> </span>
                        </div>

                        <label> Hobbies: </label>
                        <div class="form-group">
                            <select name="hob[]" multiple>
                            <?php foreach ($hob as $h1 => $value): ?>
                            <option value="<?php echo $value['h_nm']?>"> <?php echo htmlspecialchars($value['h_nm']); ?></option>
                            <?php endforeach; ?>
                            </select>
                            <div class="error" id="hobErr"></div>
                        </div>

                        <label> Qualifications : </label>
                        <div class="form-group">
                            <?php foreach ($qa as $q1 => $value): ?>
                            <input type="checkbox" name="qa[]" value="<?php echo $value['q_nm']?>">
                            <label> <?php echo htmlspecialchars($value['q_nm']); ?> </label><br>
                            <?php endforeach; ?>
                            <div class="error" id="quaErr"></div>
                        </div>
                        
                        <label> Gender : </label>
                        <div class="form-group">
                            <?php foreach ($gn as $g1 => $value): ?>
                            <input type="radio" name="sx" value="<?php echo $value['sx']?>">
                            <label for="sx"><?php echo htmlspecialchars($value['sx']); ?></label><br>
                            <?php endforeach; ?>
                            <span class="invalid-feedback"> <?php echo $rd_btn;?> </span>
                            <div class="error" id="genderErr"></div>
                        </div>

                        <label> Details </label>
                        <div class="form-group">
                            <textarea name="det" class="form-control <?php echo (!empty($det_err)) ? 'is-invalid' : ''; ?>"><?php echo $det; ?></textarea>
                            <span class="invalid-feedback"><?php echo $det_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="submit" name="submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>

                    </form>
                    
                </div>
            </div>        
        </div>
    </div>
</body>

</html>
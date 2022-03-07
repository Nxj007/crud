<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>JavaScript Form validation</title>
<link rel="stylesheet" href="style.css">
<?php
include "config.php";

$query = 'SELECT * FROM master_gender';
$gender = $link->query($query);

$query1 = 'SELECT * FROM master_qa';
$qua = $link->query($query1);

$query3 = 'SELECT * FROM master_hobby';
$hob = $link->query($query3);

?>


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

     // Validate gender
     if(qua == "") {
        printError("quaErr", "Please select your Qua");
    } else {
        printError("quaErr", "");
        quaErr = false;
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


    <form name="contactForm" onsubmit="return validateForm()" action="" method="post">
    <h2>Application Form</h2>
    <div class="row">
        <label>Full Name</label>
        <input type="text" name="name">
        <div class="error" id="nameErr"></div>
    </div>
    
    <div class="row">
        <label>Email Address</label>
        <input type="text" name="email">
        <div class="error" id="emailErr"></div>
    </div>

    <label>Gender</label>
        <div class="form-inline">
            <?php foreach ($gender as $g1 => $value): ?>
            <input type="radio" name="gender" value="<?php echo $value['sx']?>">
            <label><?php echo htmlspecialchars($value['sx']); ?></label><br>
            <?php endforeach; ?>
            <div class="error" id="genderErr"></div>
        </div>
    
        
        
        <label>Qualifications :</label>
        <div class="form-inline">
            <?php foreach ($qua as $q1 => $value): ?>
                <input type="checkbox" name="qua[]" value="<?php echo $value['q_nm']?>">
                <label> <?php echo htmlspecialchars($value['q_nm']); ?> </label><br>
                <?php endforeach; ?>
                <div class="error" id="quaErr"></div>
            </div>
            
            <label> Hobbies: </label>
            <div class="form-inline">
                    <select name="hob" multiple>
                    <?php foreach ($hob as $h1 => $value): ?>
                    <option value="<?php echo $value['h_nm']?>"> <?php echo htmlspecialchars($value['h_nm']); ?></option>
                    <?php endforeach; ?>
                    </select>
                    <div class="error" id="hobErr"></div>
            </div>

    <div class="row">
        <input type="submit" value="Submit">
    </div>



</form>
</body>
</html>    
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
$name = $email = $password = $gender = $hobby = $qua = $salary = $age  = $img =  "";

$name_err = $email_err = $pass_err = $gen_err = $hobby_err = $qua_err = $salary_err = $age_err = $img_err = "";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name. PHP";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name. PHP";
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

    // Validate pass
    $input_pass = trim($_POST["pass"]);
    if (empty($input_pass)) {
        $pass_err = "Please enter an pass.";
    } else {
        $password = $input_pass;
    }


    // Validate details
    
    
    //Validate Gender
    $input_gen = trim($gender);
    if (empty($input_gen)) {
        $gen_err = "No radio buttons were Selected.";
    } else {
        $gender = $gn($gender);
    }
    
    // Validate Hobby
    // $input_hob = implode(",",$hob['h_nm']);
    // if (empty($input_hob)) {
    //     $hobby_err = "Select yours...";
    // } else {
    //     $hobby = $input_hob;
    // }
    
    // $input_img = trim($_POST["img"]);
    // if (empty($input_img)) {
    //     $img_err = "Please enter an Image....";
    // } else {
    //     $img = $input_img;
    // }


    //Validate Qualification
    // $input_qua = $qa;
    // if (empty($input_qua)) {
    //     $qua_err = "Anyone Value...";
    // } else {
    //     $qua = $_POST['qa'];
    //     $mqn = implode(",", $qua);
    // }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($email_err) && empty($pass_err) && empty($gen_err) && empty($hobby_err) && empty($qua_err) && empty($salary_err) && empty($age_err) && empty($img_err)) {
        if (isset($_POST['submit'])) {

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
            $last_id = mysqli_insert_id($link);


            $sql = "INSERT INTO `employees` VALUES ($last_id,'$name', '$email', '$password', '$gender', '$mhobby', '$mqn', '$salary', '$age', '$img')";
            $sql1 = "INSERT INTO `e_gender` VALUES ($last_id,'$gender')";
            $sql2 = "INSERT INTO `e_hob` VALUES ($last_id,'$mhobby')";
            $sql3 = "INSERT INTO `e_qa` VALUES ($last_id,'$mqn')";



            if (mysqli_query($link, $sql)) {
                if (mysqli_query($link, $sql1)) {
                    if (mysqli_query($link, $sql2)) {
                        if (mysqli_query($link, $sql3)) {


                            $result = $link->query($sql);
                            $result1 = $link->query($sql1);
                            $result2 = $link->query($sql2);
                            $result3 = $link->query($sql3);
                        }
                    }
                }
            }


        if ($result1 == TRUE) {
        if ($result2 == TRUE) {
        if ($result3 == TRUE) {
        echo "New record created successfully.";
            }
        }
    }
else {
                echo "Error:" . $sql . "<br>" . $link->error;
                echo "Error:" . $sql1 . "<br>" . $link->error;
                echo "Error:" . $sql2 . "<br>" . $link->error;
                echo "Error:" . $sql3 . "<br>" . $link->error;
            }
            $link->close();
        }
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
        .wrapper {
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
            var pass = document.contactForm.pass.value;
            var gender = document.contactForm.gender.value;
            var hob = document.contactForm.hob.value;
            var qua = [];
            var det = document.contactForm.det.value;

            var checkboxes = document.getElementsByName("qua[]");
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    // Populate qua array with selected values
                    qua.push(checkboxes[i].value);
                }
            }

            var nameErr = detErr = emailErr = passErr = genderErr = quaErr = hobErr = true;

            if (name == "") {
                printError("nameErr", "Please enter your name JS");
            } else {
                var regex = /^[0-9A-Z\d]+$/;
                if (regex.test(name) === false) {
                    printError("nameErr", "Please enter a valid name JS");
                } else {
                    printError("nameErr", "");
                    nameErr = false;
                }
            }

            // Validate Details
            if (det == "") {
                printError("detErr", "Enter your details");
            } else {
                printError("detErr", "");
                detErr = false;
            }

            // Validate email address
            if (email == "") {
                printError("emailErr", "Please enter your email address");
            } else {
                // Regular expression for basic email validation
                var regex = /^\S+@\S+\.\S+$/;
                if (regex.test(email) === false) {
                    printError("emailErr", "Please enter a valid email address");
                } else {
                    printError("emailErr", "");
                    emailErr = false;
                }
            }
            // Validate Pass
            if (pass == "") {
                printError("passErr", "**Fill the password please!");
                return false;  
            }
            if(pass.length < 6) {  
                printError("passErr", "**Password length must be atleast 6 characters");
                return false;
            }
            else {
                printError("passErr", "");
                passErr = false;
            }

            // Validate gender
            if (gender == "") {
                printError("genderErr", "Please select your gender");
            } else {
                printError("genderErr", "");
                genderErr = false;
            }

            // Validate hob
            if (hob == "") {
                printError("hobErr", "Please select your hob");
            } else {
                printError("hobErr", "");
                hobErr = false;
            }

            // Validate Qualificatiob
            if (qua == "") {
                printError("quaErr", "Select any one");
            } else {
                printError("quaErr", "");
                quaErr = false;
            }



            // Prevent the form from being submitted if there are any errors
            if ((nameErr || detErr || emailErr || passErr || genderErr || hobErr || quaErr) == true) {
                return false;
            } else {
                alert("Eee");
            }
        };
        function selectOnlyThis(id){
        var myCheckbox = document.getElementsByName("myCheckbox");
        Array.prototype.forEach.call(myCheckbox,function(el){
        el.checked = false;
  });
  id.checked = true;    
}
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
                    <form name="contactForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">

                        <label>Name</label>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <div class="error" id="nameErr"></div>
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>
                        

                        <label> Email </label>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <div class="error" id="emailErr"></div>
                            <span class="invalid-feedback"> <?php echo $email_err; ?> </span>
                        </div>


                        <label> Password </label>
                        <div class="form-group">
                            <input type="password" name="pass" class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <div class="error" id="passErr"></div>
                            <span class="invalid-feedback"> <?php echo $pass_err; ?> </span>
                        </div>

                        <label> Hobbies: </label>
                        <div class="form-group">
                            <select class="form-control <?php echo (!empty($hobby_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $hobby; ?>" name="hobby" multiple >
                                <?php foreach ($hob as $h1 => $value) : ?>
                                    <option value="<?php echo $value['h_nm'] ?>"> <?php echo htmlspecialchars($value['h_nm']); ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="error" id="hobErr"></div>
                            <span class="invalid-feedback"> <?php echo $hobby_err; ?> </span>
                        </div>

                        <label> Qualifications : </label>
                        <div class="form-group">
                            <?php foreach ($qa as $q1 => $value) : ?>
                                <input type="checkbox" class="<?php echo (!empty($qua_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $qua; ?>" name="myCheckbox" onclick="selectOnlyThis(this)" />
                                <label> <?php echo htmlspecialchars($value['q_nm']); ?> </label><br>
                                <?php endforeach; ?>
                                <div class="error" id="quaErr"></div>
                                <span class="invalid-feedback"> <?php echo $qua_err; ?> </span>
                        </div>

                        <label> Gender : </label>
                        <div class="form-group">
                            <?php foreach ($gn as $g1 => $value) : ?>
                                <input type="radio" class="<?php echo (!empty($gen_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $gender; ?>" name="sx" value="<?php echo $value['sx'] ?>" >
                                <label for="sx"><?php echo htmlspecialchars($value['sx']); ?></label><br>
                            <?php endforeach; ?>
                            <div class="error" id="genderErr"></div>
                            <span class="invalid-feedback"> <?php echo $gen_err; ?> </span>
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


                       
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>

                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
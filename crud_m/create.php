<?php
$showAlert = false;
$showError = false;


// Include config file
include 'partials/_dbconnect.php';

// include 'partials/functions.php';
$query = 'SELECT * FROM master_hobby';
$hob = $link->query($query);

$query1 = 'SELECT * FROM master_qa';
$qa = $link->query($query1);

$query2 = 'SELECT * FROM master_gender';
$gn = $link->query($query2);

// Define variables and initialize with empty values
$name = $email = $password = $det = $gender = $hobby = $qua = $salary = $age  = $img = $uty =  "";

$name_err = $email_err = $pass_err = $det_err = $gen_err = $hobby_err = $qua_err = $salary_err = $age_err = $img_err = "";


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
    $input_det = trim($_POST["det"]);
    if (empty($input_det)) {
        $det_err = "Please enter an pass.";
    } else {
        $det = $input_det;
    }


    //Validate Gender
    $input_gen = trim($gender);
    if (empty($input_gen)) {
        $gen_err = "No radio buttons were Selected.";
    } else {
        $gender = $gn($gender);
    }

    // Validate Hobby
    $input_hob = trim($hobby);
    if (empty($input_hob)) {
        $hobby_err = "Select Hobby...";
    } else {
        $hobby = $input_hob;
    }


    // Validate Qualification
    $input_qua = trim($qua);
    if (empty($input_qua)) {
        $qua_err = "Anyone Value...";
    } else {
        $qua = $input_qua;
    }


}
    // Check input errors before inserting in database
    
        if (isset($_POST['submit'])) {

            $eid = mysqli_insert_id($link);
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $det = $_POST['det'];

            $gid = $_POST['sx'];
            
            $hobby = $_POST['hob'];
            $hid = implode(",", $hobby);
            
            $qua = $_POST['qa'];
            $qid = implode(",", $qua);
            
            $salary = $_POST['salary'];
            $age = $_POST['age'];
            
            $img = $_FILES['img'];
            $imgfl=$_FILES["img"]["name"];
            
            $uty = $_POST['utype'];



            $sql = "INSERT INTO `employees` VALUES ('$eid', '$name', '$email', '$password', '$det', '$salary', '$age', '$imgfl', '$uty')";
            $result = $link->query($sql) or die($link->error);
            echo "Insert successful. Latest ID is: " . $eid;
            if ($result){
                $showAlert = true;
              }

            $eid2 = mysqli_insert_id($link);
            $sql1 = "INSERT INTO `e_gender` VALUES ('$eid2','$gid')";
            $result1 = $link->query($sql1) or die($link->error);
            echo "Insert successful. Latest ID is: " . $eid2;
            if ($result1){
                $showAlert = true;
            }

            $sql2 = "INSERT INTO `e_hob` VALUES ('$eid','$hid')";
            $link->query($sql2) or die($link->error);
            
            $sql3 = "INSERT INTO `e_qa` VALUES ('$eid','$qid')";
            $link->query($sql3) or die($link->error);

            
            if ($result == TRUE) {
                echo "New record created successfully.";
            } else {
                echo "Error:" . $sql . "<br>" . $link->error;
                echo "Error:" . $sql1 . "<br>" . $link->error;
                echo "Error:" . $sql2 . "<br>" . $link->error;
                echo "Error:" . $sql3 . "<br>" . $link->error;
            }
            $link->close();
        }

?>

<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
            var det = document.contactForm.det.value;
            var gender = document.contactForm.gender.value;
            var hob = document.contactForm.hob.value;
            var qua = [];

            var checkboxes = document.getElementsByName("qua[]");
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    // Populate qua array with selected values
                    qua.push(checkboxes[i].value);
                }
            }

            var nameErr = emailErr = passErr = detErr = genderErr = quaErr = hobErr = true;

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
            if (pass.length < 6) {
                printError("passErr", "**Password length must be atleast 6 characters");
                return false;
            } else {
                printError("passErr", "");
                passErr = false;
            }

            // Validate gender
            if (gender == "") {
                printError("genderErr", "AnyOne.....");
            } else {
                printError("genderErr", "");
                genderErr = false;
            }

            // Validate hob
            if (hob == "") {
                printError("hobErr", "Select Yours ");
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
            // Validate Qualificatiob
            // if (IM == "") {
            //     printError("quaErr", "Select any one");
            // } else {
            //     printError("quaErr", "");
            //     quaErr = false;
            // }



            // Prevent the form from being submitted if there are any errors
            if ((nameErr || detErr || emailErr || passErr || genderErr || hobErr || quaErr) == true) {
                return false;
            } else {
                alert("Eee");
            }
        };

        function selectOnlyThis(id) {
            var qa = document.getElementsByName("qa");
            Array.prototype.forEach.call(qa, function(el) {
                el.checked = false;
            });
            id.checked = true;
        }
    </script>
</head>

<body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
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
    }
    ?>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form name="contactForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">

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

                        <label> Details </label>
                        <div class="form-group">
                            <input type="text" name="det" class="form-control <?php echo (!empty($det_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $det; ?>">
                            <div class="error" id="detErr"></div>
                            <span class="invalid-feedback"> <?php echo $det_err; ?> </span>
                        </div>

                        <label> Hobbies: </label>
                        <div class="form-group">
                            <select class="form-control <?php echo (!empty($hobby_err)) ? 'is-invalid' : ''; ?>" name="hob[]" value="<?php echo $value; ?>" multiple>
                                <?php foreach ($hob as $h1 => $value) : ?>
                                    <option value="<?php echo $value['hid'] ?>"> <?php echo htmlspecialchars($value['h_nm']); ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="error" id="hobErr"></div>
                            <span class="invalid-feedback"> <?php echo $hobby_err; ?> </span>
                        </div>

                        <label> Qualifications : </label>
                        <div class="form-group">
                            <?php foreach ($qa as $q1 => $value1) : ?>
                                <input type="checkbox" name="qa" class="<?php echo (!empty($qua_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $value1['qid']; ?>" onclick="selectOnlyThis(this)" />
                                <label> <?php echo htmlspecialchars($value1['q_nm']); ?> </label><br>
                            <?php endforeach; ?>
                            <div class="error" id="quaErr"></div>
                            <span class="invalid-feedback"> <?php echo $qua_err; ?> </span>
                        </div>

                        <label> Gender : </label>
                        <div class="form-group">
                            <?php foreach ($gn as $g1 => $value2) : ?>
                                <input type="radio" name="sx" class="<?php echo (!empty($gen_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $value2['gid']; ?>">
                                <label for="sx"><?php echo htmlspecialchars($value2['sx']); ?></label><br>
                            <?php endforeach; ?>
                            <div class="error" id="genderErr"></div>
                            <span class="invalid-feedback"> <?php echo $gen_err; ?> </span>
                        </div>

                        <label> Age : </label>
                        <div class="form-group">
                            <input type="number" value="<?php echo $age; ?>" id="age" name="age" min="10" max="55">
                            <div class="error" id="ageErr"></div>
                            <span class="invalid-feedback"><?php echo $age_err; ?></span>
                        </div>


                        <label> Salary </label>
                        <div class="form-group">
                            <input type="number" name="salary" min="5000" max="20000" step="1000" value="<?php echo $salary; ?>" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>"> </input>
                            <!-- <div class="error" id="salaryErr"></div> -->
                            <span class="invalid-feedback"><?php echo $salary_err; ?></span>
                        </div>

                        <label> User_Type: </label>
                        <div class="form-group">
                            <select class="form-control" name="utype" value="<?php echo $uty; ?>">
                                <option value="User"> User </option>
                                <option value="Admin"> Admin </option>
                            </select>
                        </div>

                        <label> Upload Image </label>
                        <div class="form-group">
                            <input type="file" name="image" class="form-control <?php echo (!empty($img_err)) ? 'is-invalid' : ''; ?>" required />
                            <!-- <div class="error" id="imgErr"></div> -->
                            <span class="invalid-feedback"><?php echo $img_err; ?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" name="Submit" value="Submit">
                        <a href="login.php" class="btn btn-primary">Sign-In</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
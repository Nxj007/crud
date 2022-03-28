<?php
session_start();
require_once "db.php";

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="wi dth=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .form-group {
            color: black;
        }

        .error {
            color: red;
        }
    </style>

    <title>Edit Employee</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Php Login System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#"> <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>



            </ul>
        </div>
    </nav>
    <?php
    // define variables and set to empty values
    $nameErr = $emailErr = $lnameErr = $genderErr = $ageErr = $hobErr = $studyErr = $imgErr = "";
    $name = $email = $lname = $gender = $comment = $age = $hob = $study = $img = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["emp_fname"])) {
            $nameErr = "Name is required";
        } else {
            $name = trim($_POST["emp_fname"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["emp_email"])) {
            $emailErr = "Email is required";
        } else {
            $email = trim($_POST["emp_email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }
        if (empty($_POST["emp_lname"])) {
            $lnameErr = "last Name is required";
        } else {
            $lname = trim($_POST["emp_lname"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
                $lnameErr = "Only letters and white space allowed";
            }
        }
        if (empty($_POST["emp_details"])) {
            $comment = "";
        } else {
            $comment = trim($_POST["emp_details"]);
        }
        if (empty($_POST["emp_ages"])) {
            $ageErr = "Age is required";
        } else {
            $age = trim($_POST["emp_ages"]);
            // check if e-mail address is well-formed
            if (!preg_match("/^(['.'0-9_])*$/", $age)) {
                $ageErr = "only number allow";
            }
        }

        if (empty($_POST["gen"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = ($_POST["gen"]);
        }
        if (empty($_POST["hob"])) {
            $hobErr = "hobbies are required";
        } else {
            $hob = ($_POST["hob"]);
        }
        if (empty($_POST["studylist"])) {
            $studyErr = "please select qualification";
        } else {
            $study = ($_POST["studylist"]);
        }
        if (empty($_POST["emp_img"])) {
            $imgErr = "please upload image file";
        } else {
            $img = ($_POST["emp_img"]);
        }
    }



    ?>


    <div class="container mt-4">
        <h3>Please Update Here:</h3>
        <?php
        require_once "db.php";
        if (isset($_GET['update'])) {
            $edit_id = $_GET['update'];

            // $select="SELECT * FROM emp_data WhERE emp_id='$edit_id'";
            $select = "SELECT employee.eid,employee.name,employee.email,employee.det,employee.salary,employee.age,employee.image
            FROM employee
            WHERE emmployee.eid = '$edit_id'";
            $run = mysqli_query($conn, $select);
            $row_emp = mysqli_fetch_array($run);
            $ID = $row_emp['eid'];
            $username = $row_emp['email'];
            $name = $row_emp['name'];
            $dt = $row_emp['dte'];
            $Age = $row_emp['age'];
            $image = $row_emp['imgage'];
            //   $details = $row_emp['emp_details'];
            //   $Gender = $row_emp['emp_gender'];
            $select1 = "SELECT hobby_view.hid,hobby_view.h_nm  FROM hobby_view WHERE hobby_view.eid='$edit_id'";
            $runs = mysqli_query($conn, $select1);
            $row_emp1 = mysqli_fetch_array($runs);
            echo $hobbies = $row_emp1['hid'];
            // $study=$row_emp['s_id'];
            //$h_id=$row_emp['emp_id'];

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


                            <label>Gender</label>
                            <div class="form-group">
                                <?php
                                include 'db.php';
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

                                <?php
                                require_once "db.php";
                                if (isset($_GET['update'])) {
                                    $edit_id = $_GET['update'];
                                    $user_hob = "SELECT hid FROM e_hob WHERE eid='$edit_id'";
                                    $user_hob_result = mysqli_query($link, $user_hob);
                                    $h_array = [];
                                    foreach ($user_hob_result as $rowh) {
                                        $h_array[] = $rowh['hid'];
                                    }
                                }
                                ?>
                                <select name=hob[] multiple required>
                                    <?php foreach ($hob as $h1 => $value) : ?>
                                        <option value="<?php echo $value['hid'] ?>" <?php echo in_array($value['hid'], $h_array) ? 'selected' : '' ?>>
                                            <?php echo $value['h_nm']; ?></option>

                                    <?php endforeach; ?>


                                </select>
                            </div>
                            <!-- if (in_array($row2['hid'], $value['hid'])) {echo "selected";}  -->


                            label>study:</label>
                                    <div class="form-group">
                                    <?php
                                    require_once "db.php";
                                    // $conn = mysqli_connect('localhost','root','root','data1');

                                    #include __DIR__ .'/../includes/DatabaseConn.php';

                                    $query1 = 'SELECT * FROM master_qa';
                                    $study_run = mysqli_query($link, $query1);
                                    if (mysqli_num_rows($study_run) > 0) {
                                        foreach ($study_run as $study) {

                                        require_once "db.php";
                                        if (isset($_GET['update'])) {
                                            $edit_id = $_GET['update'];
                                            $user_study = "SELECT qid FROM e_qa WHERE eid='$edit_id'";
                                            $user_study_result = mysqli_query($link, $user_study);
                                            $s_array = [];
                                            foreach ($user_study_result as $rows) {
                                            $s_array[] = $rows['qid'];
                                            }
                                        }
                                    ?>
                                     <input type="checkbox" name="studylist[]" value="<?php echo $study['qid']; ?>" <?php echo in_array($study['qid'], $s_array) ? 'checked' : '' ?>><?= $study['q_nm']; ?>
                                    <?php
                                        }
                                    }
                                    ?>

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
                            <input type="submit" name='insert-btn'class="btn btn-primary" value="Submit">

                            <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>


        < <?php

            // require_once "config.php";
            // //$conn = mysqli_connect('localhost','root','root','data1');
            // if (isset($_POST["inset-btn"])) {
            //     $edit_id = $_GET['update'];
            //     $hobbies_input = $_POST['hob'];

            //     $query = "SELECT * FROM hobbies WHERE emp_id='$edit_id'";
            //     $query_run = mysqli_query($conn, $query);

            //     $hob_values = [];
            //     foreach ($query_run as $hob_data) {
            //         $hob_values[] = $hob_data['h_id'];
            //     }

            //     foreach ($hobbies_input as $input_val) {
            //         if (!in_array($input_val, $hob_values)) {
            //             //echo $input_val;
            //             $insert_array = "INSERT INTO hobbies(emp_id,h_id)values('$edit_id','$input_val')";
            //             $insert_array_run = mysqli_query($link, $insert_array);
            //         }
            //     }
            //     //DELETE
            //     foreach ($hob_values as $hob_row) {
            //         if (!in_array($hob_row, $hobbies_input)) {
            //             //echo $hob_row;
            //             $delete_query = "DELETE FROM hobbies WHERE emp_id='$edit_id' AND h_id='$hob_row'";
            //             $delete_query_run = mysqli_query($conn, $delete_query);
            //         }
            //     }

            //     //update for study
            //     $edit_id = $_GET['edit'];
            //     $study_input = $_POST['studylist'];

            //     $query1 = "SELECT * FROM study WHERE emp_id='$edit_id'";
            //     $query_run = mysqli_query($conn, $query1);

            //     $study_values = [];
            //     foreach ($query_run as $study_data) {
            //         $study_values[] = $study_data['s_id'];
            //     }

            //     foreach ($study_input as $input_val1) {
            //         if (!in_array($input_val1, $study_values)) {
            //             $insert_arrays = "INSERT INTO study(emp_id,s_id)values('$edit_id','$input_val1')";
            //             $insert_array_run = mysqli_query($conn, $insert_arrays);
            //         }
            //     }
            //     //DELETE
            //     foreach ($study_values as $study_row) {
            //         if (!in_array($study_row, $study_input)) {
            //             $delete_query = "DELETE FROM study WHERE emp_id='$edit_id' AND s_id='$study_row'";
            //             $delete_query_run = mysqli_query($conn, $delete_query);
            //         }
            //     }
            // }
            //if ($_SESSION['username'] == 'kalyani@gmail.com') {
                if (isset($_POST["inset-btn"])) {
                    $eusername = $_POST["email"];
                    $employee_fname = $_POST['name'];
                    $employee_details = $_POST['det'];
                    $employee_Age = $_POST['age'];
                    $eimage = $_FILES['image']['name'];
                    $temp_name = $_FILES['image']['tmp_name'];
                  // $employee_details = $_POST['emp_details'];
                    $employee_hobbies = $_POST['hob'];
                    //$employee_gender = $_POST['gen'];
                    $employee_study = $_POST['studylist'];
                    //$checkhob=implode(",",$_POST['hob']);
                    $checkgen = implode(",", $_POST['gen']);
                    //echo $checkstudy=implode($_POST['studylist']);

                    if (empty($eimage)) {
                        $eimage = $image;
                    }

                    $update = "UPDATE employee
              SET email='$eusername',name='$employee_fname',age='$employee_Age',image='$eimage',det='$employee_details'
              WHERE employee.eid = '$edit_id'";
                    $run_update = mysqli_query($link, $update);
                    if ($run_update == true) {
                       // $_SESSION['username'] = "DATA HAS BEEN UPDATED";
                        //header("location:home.php");
                        move_uploaded_file($temp_name, "upload/$eimage");
                    }
            //         if (isset($_SESSION['username'])) {
            ?> <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <!-- // <strong></strong><?php echo $_SESSION['username']; ?> -->
            // <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            //     <span aria-hidden="true">&times;</span>
            </button>
    </div>
<?php

                    }
                
            


?>
<a class="btn btn-primary" href="home.php">VIEW_DATA</a>

</div>

</body>
<script>
    // Defining a function to display error message
    function printError(elemId, hintMsg) {
        document.getElementById(elemId).innerHTML = hintMsg;
    }
    // Defining a function to validate form
    function validateForm() {
        // Retrieving the values of form elements
        var name = document.forms['myphp']["emp_fname"].value;
        var email = document.forms['myphp']["emp_email"].value;
        var lname = document.forms['myphp']["emp_lname"].value;
        var pass = document.forms['myphp']["emp_password"].value;
        var age = document.forms['myphp']["emp_ages"].value;
        //var hobbies=document.forms['myphp']["hob"].value;
        // var study=document.forms['myphp']["studylist"].value;
        // var gender=document.forms['myphp']["gen"].value
        // var checkboxes = document.getElementsByName("study");
        // for(var i=0; i < checkboxes.length; i++) {
        // if(checkboxes[i].checked) {
        // Populate qua array with selected values
        // studylist.push(checkboxes[i].value);




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
        //validation lname
        if (lname == "") {
            printError("lnameErr", "Please enter your name JS");
        } else {
            var regex = /^[0-9A-Z\d]+$/;
            if (regex.test(lname) === false) {
                printError("lnameErr", "Please enter a valid name JS");
            } else {
                printError("lnameErr", "");
                lnameErr = false;
            }
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
        //validate password 
        if (pass == "") {
            printError("passErr", "**Fill the password please!");
            return false;
            //minimum password length validation  
        }
        if (pass.length < 6) {
            printError("passErr", "**Password length must be atleast 6 characters");
        } else {
            printError("passErr", "");
            passErr = false;
        }
        //validate Age
        if (age == "") {
            printError("ageErr", "Please enter your age");
        }
        if (isNaN(age) || age < 1 || age > 100) {
            printError("ageErr", "The age must be a number between 1 and 100");
        } else {
            printError("ageErr", "no record found");
            ageErr = false;
        }
        //validate dropdown
        if (document.form.hob[h_id].selected == false) {
            printError("hobErr", "Please select at least one .");
            hobErr = false;
        }

        //validate checkbox

        if (document.form.studylist[s_id].checked == false) {
            printError("studyErr", "Please select at least one .");
            studyErr = false;
        }
        //radiobutton
        if (document.form.gen['emp_gender'].checked == false) {
            printError("genErr", "Please select at least one .");
            genErr = false;
        }



        var nameErr = lnameErr = emailErr = passErr = ageErr = hobErr = studyErr = genderErr = true;

    }
</script>

</html>
<?php
session_start();
require_once "db.php";
if (!isset($_SESSION['username'])) {
  echo "<script>window.open('login.php','_self');</script>";
}
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

    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = trim($_POST["email"]);
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
    if (isset($_GET['edit'])) {
      $edit_id = $_GET['edit'];

      // $select="SELECT * FROM emp_data WhERE emp_id='$edit_id'";
      $select = "SELECT emp_data.emp_id,emp_data.username,emp_data.password,emp_data.emp_fname,emp_data.emp_lname,emp_data.emp_age,emp_data.emp_img,emp_data.emp_details,emp_data.emp_gender
            FROM emp_data
            WHERE emp_data.emp_id = '$edit_id'";
      $run = mysqli_query($conn, $select);
      $row_emp = mysqli_fetch_array($run);
      $ID = $row_emp['emp_id'];
      $email = $row_emp['username'];
      $name = $row_emp['emp_fname'];
      $lastname = $row_emp['emp_lname'];
      $Age = $row_emp['emp_age'];
      $image = $row_emp['emp_img'];
      $details = $row_emp['emp_details'];
      $Gender = $row_emp['emp_gender'];
      $select1 = "SELECT hobbies_view.h_id,hobbies_view.hobbies  FROM hobbies_view WHERE hobbies_view.emp_id='$edit_id'";
      $runs = mysqli_query($conn, $select1);
      $row_emp1 = mysqli_fetch_array($runs);
      $hobbies = $row_emp1['h_id'];
      // $study=$row_emp['s_id'];
      //$h_id=$row_emp['emp_id'];

    }


    ?>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label>EMAIL-ID:</label>
        <input type="email" class="form-control" value="<?php echo  $email; ?>" placeholder="Enter email" name="email" required>
        <span class="error">*<?php echo $emailErr; ?></span>
        <span class="error" id="emailErr"></span>
      </div>

      <div class="mb-3">
        <label>First_Name:</label>
        <input type="fname" class="form-control" value="<?php echo $name; ?>" placeholder="First Name" name="emp_fname" required>
        <span class="error">*<?php echo $nameErr; ?></span>
        <span class="error" id="nameErr"></span>
      </div>

      <div class="mb-3">
        <label>Age:</label>
        <input type="age" class="form-control" value="<?php echo $Age; ?>" placeholder="Age" name="emp_ages" required>
        <span class="error">*<?php echo $ageErr; ?></span>
        <span class="error" id="ageErr"></span>
      </div>

      <div class="mb-3">
        <label>Hobbies:</label>
        <div class="form-group">
          <?php

          require_once "db.php";
          $query = 'SELECT * FROM master_hobbies';
          $hob = $conn->query($query);

          ?>
          <?php
          require_once "db.php";
          if (isset($_GET['edit'])) {
            $edit_id = $_GET['edit'];
            $ouser_hb = "SELECT h_id FROM hobbies WHERE emp_id='$edit_id'";
            $user_hob_result = mysqli_query($conn, $user_hob);
            $h_array = [];
            foreach ($user_hob_result as $rowh) {
              $h_array[] = $rowh['h_id'];
            }
          }
          ?>
          <select name=hob[] multiple required>
            <?php foreach ($hob as $h1 => $value) : ?>
              <option value="<?php echo $value['h_id'] ?>" <?php echo in_array($value['h_id'], $h_array) ? 'selected' : '' ?>>
                <?php echo $value['hobbies']; ?></option>

            <?php endforeach; ?>


          </select>
          <span class="error">*<?php echo $hobErr; ?></span>
          <span class="error" id="hobErr"></span>




        </div>
      </div>

      <div class="mb-3">

        <label>study:</label>
        <div class="form-group">
          <?php
          require_once "db.php";
          // $conn = mysqli_connect('localhost','root','root','data1');

          #include __DIR__ .'/../includes/DatabaseConn.php';

          $query1 = 'SELECT * FROM master_study';
          $study_run = mysqli_query($conn, $query1);
          if (mysqli_num_rows($study_run) > 0) {
            foreach ($study_run as $study) {

              require_once "db.php";
              if (isset($_GET['edit'])) {
                $edit_id = $_GET['edit'];
                $user_study = "SELECT s_id FROM study WHERE emp_id='$edit_id'";
                $user_study_result = mysqli_query($conn, $user_study);
                $s_array = [];
                foreach ($user_study_result as $rows) {
                  $s_array[] = $rows['s_id'];
                }
              }
          ?>

              <input type="checkbox" name="studylist[]" value="<?php echo $study['s_id']; ?>" <?php echo in_array($study['s_id'], $s_array) ? 'checked' : '' ?>><?= $study['emp_study']; ?>
          <?php
            }
          }
          ?>
          <span class="error" id="studyErr"></span>
          <span class="error">*<?php echo $studyErr; ?></span>

        </div>
      </div>

      <div class="mb-3">
        <label for="">Gender:</label>
        <div class="form-group">
          <?php
          require_once "db.php";
          // $conn = mysqli_connect('localhost','root','root','data1');

          #include __DIR__ .'/../includes/DatabaseConn.php';

          $query2 = 'SELECT * FROM gender';
          $gen = $conn->query($query2);

          ?>
          <?php foreach ($gen as $g1 => $value2) : ?>

            <label> <?php echo htmlspecialchars($value2['emp_gender']); ?>
              <input type="radio" name=gen[] value="<?php echo $value2['emp_gender'] ?>" <?php if ($Gender == $value2['emp_gender']) echo "checked"; ?>>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
            </label>
          <?php endforeach; ?>
          <span class="error" id="genErr"></span>
          <span class="error">*<?php echo $genderErr; ?></span>

        </div>
      </div>




      <div class="mb-3">
        <label for="image">Image:</label>
        <input type="file" class="form-control" accept=".png ,.jpeg, .jpg, .webp" placeholder="image" name="emp_img" value="<?php echo  $image; ?>">
        <span class="error">*<?php echo $imgErr; ?></span>

      </div>
      <div class="mb-3">
        <label for="details">Description:</label>
        <textarea class="form-control" name="emp_details" required><?php echo $details; ?></textarea>
      </div>

      <button type="submit" name="inset-btn" class="btn btn-primary">Submit</button>
    </form>
    <?php

    require_once "db.php";
    //$conn = mysqli_connect('localhost','root','root','data1');
    if (isset($_POST["inset-btn"])) {
      $edit_id = $_GET['edit'];
      $hobbies_input = $_POST['hob'];

      $query = "SELECT * FROM hobbies WHERE emp_id='$edit_id'";
      $query_run = mysqli_query($conn, $query);

      $hob_values = [];
      foreach ($query_run as $hob_data) {
        $hob_values[] = $hob_data['h_id'];
      }

      foreach ($hobbies_input as $input_val) {
        if (!in_array($input_val, $hob_values)) {
          //echo $input_val;
          $insert_array = "INSERT INTO hobbies(emp_id,h_id)values('$edit_id','$input_val')";
          $insert_array_run = mysqli_query($conn, $insert_array);
        }
      }
      //DELETE
      foreach ($hob_values as $hob_row) {
        if (!in_array($hob_row, $hobbies_input)) {
          //echo $hob_row;
          $delete_query = "DELETE FROM hobbies WHERE emp_id='$edit_id' AND h_id='$hob_row'";
          $delete_query_run = mysqli_query($conn, $delete_query);
        }
      }

      //update for study
      $edit_id = $_GET['edit'];
      $study_input = $_POST['studylist'];

      $query1 = "SELECT * FROM study WHERE emp_id='$edit_id'";
      $query_run = mysqli_query($conn, $query1);

      $study_values = [];
      foreach ($query_run as $study_data) {
        $study_values[] = $study_data['s_id'];
      }

      foreach ($study_input as $input_val1) {
        if (!in_array($input_val1, $study_values)) {
          $insert_arrays = "INSERT INTO study(emp_id,s_id)values('$edit_id','$input_val1')";
          $insert_array_run = mysqli_query($conn, $insert_arrays);
        }
      }
      //DELETE
      foreach ($study_values as $study_row) {
        if (!in_array($study_row, $study_input)) {
          $delete_query = "DELETE FROM study WHERE emp_id='$edit_id' AND s_id='$study_row'";
          $delete_query_run = mysqli_query($conn, $delete_query);
        }
      }
    }
      if (isset($_POST["inset-btn"])) {
        $eusername = $_POST["email"];
        $employee_fname = $_POST['emp_fname'];
        $employee_Age = $_POST['emp_ages'];
        $eimage = $_FILES['emp_img']['name'];
        $temp_name = $_FILES['emp_img']['tmp_name'];
        $employee_details = $_POST['emp_details'];
        $employee_hobbies = $_POST['hob'];
        //$employee_gender = $_POST['gen'];
        $employee_study = $_POST['studylist'];
        //$checkhob=implode(",",$_POST['hob']);
        $checkgen = implode(",", $_POST['gen']);
        //echo $checkstudy=implode($_POST['studylist']);

        if (empty($eimage)) {
          $eimage = $image;
        }

        $update = "UPDATE emp_data
              SET username='$eusername',emp_fname='$employee_fname',emp_lname='$employee_lname',emp_age='$employee_Age',emp_img='$eimage',emp_details='$employee_details',emp_gender='$checkgen'
              WHERE emp_data.emp_id = '$edit_id'";
        $run_update = mysqli_query($conn, $update);
        if ($run_update == true) {
          $_SESSION['username'] = "DATA HAS BEEN UPDATED";
          //header("location:home.php");
          move_uploaded_file($temp_name, "upload/$eimage");
        }
        if (isset($_SESSION['username'])) {
    ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong></strong><?php echo $_SESSION['username']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
    <?php

        }
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
    var email = document.forms['myphp']["email"].value;
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
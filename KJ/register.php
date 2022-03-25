<?php
session_start();
//error_reporting(0);
//if (!isset($_SESSION['username'])) {
//echo "<script>window.open('login.php','_self');</script>";
//}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Javascript validation for user inputs -->
  <style>
    .form-group {
      color: black;
    }

    .error {
      color: red;
    }
  </style>


</head>

<body>

  <title>PHP login system!</title>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Php Login System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
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
  $nameErr = $emailErr = $lnameErr = $genderErr = $ageErr = $hobErr = $QuaErr = $imgErr = $passErr = $cpassErr = "";
  $name = $email = $lname = $gender = $comment = $age = $hob = $study = $img = $password = $cpassword = "";

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
    if (empty($_POST["emp_password"])) {
      $passErr = "password is required";
    } else {
      $password = trim($_POST["emp_password"]);
      // check if e-mail address is well-formed
      if (strlen($_POST["emp_password"]) <= 6) {
        $passErr = "Your Password Must Contain At Least 6 Characters!";
      }
    }
    if ($_POST["cpassword"] = '') {
      $cpassErr = "confirm password is required";
      // success!
    } else {
      $cpassword = trim($_POST['cpassword']);
      if ($_POST["emp_password"] === $_POST["cpassword"]) {
        // success!
      } else {
        $cpassErr = "please enter same password";
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
      $QuaErr = "study are required";
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

  <div class="container mb-3">
    <h3>Please Register Here:</h3>
    <p><span class="error">* required field</span></p>
    <form id='form' name="myphp" method="post" onsubmit="return validateForm()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" required>

      <div class="mb-3 ">
        <label>EMAIL-ID:</label>
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Enter email" name="email" required>
          <span class="error" id="emailErr"></span>
          <span class="error">*<?php echo $emailErr; ?></span>
        </div>

      </div>
      <div class="mb-3 ">
        <label>Password:</label>
        <div class="form-group">

          <input id="password" type="password" class="form-control" placeholder="Enter password" name="emp_password" required>
          <span class="error" id="passErr"></span>
          <span class="error">*<?php echo $passErr; ?></span>
        </div>
      </div>
      <div class="mb-3 ">
        <label>Confirm Password:</label>
        <div class="form-group">
          <input id="password" name="cpassword" class="form-control" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" placeholder="confirm Password" required>
          <!-- <input id="cpassword" type="cpassword" class="form-control" placeholder="Re-Enter password" name="cpassword" required> -->
          <!-- <span class="error" id="cpassErr"></span> -->
          <!-- <span class="error">*<?php echo $cpassErr; ?></span> -->
        </div>
      </div>
      <div class="mb-3 ">
        <div class="form-group">
          <label>First_Name:</label>
          <input id="name" type="name" class="form-control" placeholder="First Name" name="emp_fname" required>
          <span class="error" id="nameErr"></span>
          <span class="error">*<?php echo $nameErr; ?></span>
        </div>
      </div>

      <div class="mb-3 ">
        <div class="form-group">
          <label>Age:</label>
          <input type="number" class="form-control" placeholder="Age" name="emp_ages" required>
          <span class="error" id="ageErr"></span>
          <span class="error">*<?php echo $ageErr; ?></span>

        </div>
      </div>
      <div class="mb-3 ">
        <label>Hobbies:</label><br />
        <div class="form-group">
          <select name="hob[]" multiple required>
            <?php
            require_once "config.php";
            $query = 'SELECT * FROM master_hobbies';
            $hob = $link->query($query);

            ?>
            <?php foreach ($hob as $h1 => $value) : ?>
              <option value="<?php echo $value['h_id'] ?>" id=hob><?php echo $value['hobbies']; ?></option>
            <?php endforeach; ?>

          </select>
          <span class="error" id="hobErr"></span>
          <span class="error">*<?php echo $hobErr; ?></span>




        </div>
      </div>

      <div class="mb-3">

        <label>study:</label>
        <div class="form-group">
          <?php
          require_once "config.php";
          // $link = mysqli_connect('localhost','root','root','data1');

          #include __DIR__ .'/../includes/DatabaseConn.php';

          $query1 = 'SELECT * FROM master_qa';
          $qa_run = mysqli_query($link, $query1);
          if (mysqli_num_rows($qa_run) > 0) {
            foreach ($qa_run as $qua) {
          ?>
              <input type="checkbox" id=qua name=studylist[] value="<?php echo $qua['s_id']; ?>"><?= $qua['emp_study']; ?>

          <?php
            }
          }
          ?>
          <span class="error" id="QuaErr"></span>
          <span class="error">*<?php echo $QuaErr; ?></span>


        </div>
      </div>

      <?php
      require_once "config.php";
      // $link = mysqli_connect('localhost','root','root','data1');

      #include __DIR__ .'/../includes/DatabaseConn.php';

      $query2 = 'SELECT * FROM gender';
      $gen = $link->query($query2);

      ?>

      <div class="mb-3 ">
        <label>Gender:</label>

        <div class="form-group">
          <?php foreach ($gen as $g1 => $value2) : ?>

            <label> <?php echo htmlspecialchars($value2['emp_gender']); ?>
              <input type="radio" id="gen" name="gen[]" value=<?php echo htmlspecialchars($value2['emp_gender']); ?> onclick="selectOnlyThis(this.id)" required>

              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
            </label>


          <?php endforeach; ?>
          <span class="error" id="genErr"></span>
          <span class="error">*<?php echo $genderErr; ?></span>

        </div>
      </div>

      <div class="mb-3 ">
        <label>User_type:</label>
        <div class="form-group">
          <select name="user_type" class="form-control">
            <option value="Admin">Admin</option>
            <option value="User">user</option>
          </select>
          <div>
            <div>



              <div class="mb-3 ">
                <label>Image:</label>
                <div class="form-group">
                  <input type="file" class="form-control" accept=".png ,.jpeg, .jpg, .webp" placeholder="image" name="emp_img">
                  <span class="error">*<?php echo $imgErr; ?></span>
                </div>
              </div>
              <div class="mb-3 " id="details">
                <label>Description:</label>
                <div class="form-group">
                  <textarea class="form-control" name="emp_details"></textarea>
                </div>
              </div>

              <button type="submit" name="inset-btn" class="btn btn-primary" onclick="submit">Submit</button>
    </form>
    <?php

    require_once "config.php";
    //  $link = mysqli_connect('localhost','root','root','data1');

    if (isset($_POST["inset-btn"])) {
      $username = $_POST["email"];
      $pass = $_POST["emp_password"];
      $pass = md5($pass);
      $cpass = $_POST['cpassword'];
      $cpass = md5($cpass);
      $employee_fname = $_POST['emp_fname'];
      $employee_Age = $_POST['emp_ages'];
      $image = $_FILES['emp_img']['name'];
      $temp_name = $_FILES['emp_img']['tmp_name'];
      $employee_details = $_POST['emp_details'];
      $employee_hobbies = $_POST['hob'];
      $employee_gender = $_POST['gen'];
      $employee_study = isset($_POST['studylist']) ? $_POST['studylist'] : '';
      $employee_user = $_POST['user_type'];
      //$arr=$_POST['hob'];
      // $checkhob = implode(",", $employee_hobbies);
      // $check = implode(",", $employee_study);
      $checkgen = implode($employee_gender);
      //secho "$check";


      //php validation
      $duplicate = mysqli_query($link, "select `username` from emp_data where `username`='$username' ");
      if (mysqli_num_rows($duplicate) > 0) {
        // header("Location: register.php?message=User name  already exists.");
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Duplicate ENTRY!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              </button>
            </div>';
      } else {
        if ($username == "" || $pass == "" || $cpass == '' || $employee_fname == "" || $employee_lname == "" || $employee_details == "" || $image == "" || $employee_study == "" || $employee_hobbies == "" || $employee_gender == "" || $employee_user == "") {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Error</strong> All fields are required
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        } else {
          try {

            $insert = "INSERT INTO emp_data VALUES('$username','$pass','$employee_fname','$employee_lname','$employee_Age','$image','$employee_details','$checkgen','$employee_user')";
            $run_insert = mysqli_query($link, $insert);

            if ($run_insert == true) {
              echo $id = $link->insert_id;
              if (isset($_POST['inset-btn'])) {
                $hobbies = $_POST['hob'];
                foreach ($hobbies as $item) {
                  // echo $item."<br>";
                  $data = "INSERT INTO hobbies(emp_id,h_id)VALUES('$id','$item')";
                  $data_run = mysqli_query($link, $data);
                }
              }
            }

            //$insert1 ="INSERT INTO hobbies(emp_id,emp_hobbies) VALUES('$id','$checkhob')";


            $study = $_POST['studylist'];
            foreach ($study as $item1) {
              // echo $item."<br>";
              $data1 = "INSERT INTO study(emp_id,s_id) VALUES('$id','$item1')";
              $run_insert2 = mysqli_query($link, $data1);
            }


            // $insert2 = "INSERT INTO study(emp_id,s_id) VALUES('$id','$check')";
            //echo $item;

            //$insert1 ="INSERT INTO hobbies(emp_id,emp_hobbies) VALUES('$id','$employee_hobbies_n')";

            // }
            //$insert1 ="INSERT INTO hobbies(emp_id,emp_hobbies) VALUES('$id','$employee_hobbies_n')";
            //$insert2 ="INSERT INTO study(emp_id, study) VALUES(emp_id,'$employee_study')";

            //$run_insert = mysqli_query($link,$insert);
            //$run_insert1 = mysqli_query($link,$insert1);

            if ($run_insert2 == true) {

              move_uploaded_file($temp_name, "upload/$image");
              // $emp_id = $link->insert_id;
              //$insert1 ="INSERT INTO hobbies(emp_id,emp_hobbies)VALUES('$emp_id',$employee_hobbies_n')";
              // $run_insert1= mysqli_query($link,$insert1);
              if ($run_insert2) {
                $_SESSION['username'] = "DATA INSERTED SUCEESSFULLY";
                // header('location:register.php');

              }





              if (isset($_SESSION['username'])) {

    ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong></strong><?php echo $_SESSION['username']; ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  </button>
                </div>
    <?php
                //unset($_SESSION['username']);
              }
            }
          } catch (PDOException $e) {
            echo $insert . "
  " . $e->getMessage();
          }
        }
      }
    }



    ?>

  </div>

  <?php

  ?>
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
    var pass = document.forms['myphp']["emp_password"].value;
    var age = document.forms['myphp']["emp_ages"].value;
    var cpass = document.forms['myphp']["cpassword"].value;
    //var hob = [];
    var studylist = [];
    // var study = document.getElementsByClassName("studylist");
    // var newvar = 0;
    // var count
    // for (count = 0; count < a.length; count++) {
    //   if (a[count].checked == true) {
    //     // Populate qua array with selected values
    //     newvar = newvar + 1;
    //   }
    // }
    // if (newvar == 1) {
    //   document.getElementById('QuaErr').innerHTML = "please select"
    //   return false;
    // }
    // var form_data = new FormData(document.querySelector("form"));
    // if(!form_data.getAll("studylist[]"))
    //     {
    //       printError("QuaErr", "Please select");

    //       }
    // if(!form.studylist.checked) {
    //   printError("QuaErr","The checkbox IS NOT checked");
    // } else {
    //     printError("QuaErr", "");
    //     QuaErr = false;
    //   }





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
    if (pass != cpass) {
      // success!
      printError("cpassErr", "please enter same password");
    } else {
      printError('cpassErr', "");
      cpassErr = false;
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
    if (document.form.hob.selected == false) {
      printError("hobErr", "Please select at least one .");
      hobErr = false;
    }

    //validate checkbox
    // Validate gender
    // if (document.form.studylist.checked == false) {
    //   printError('QuaErr', "Please select at least one .");
    //   QuaErr = false;
    // }
    //radiobutton
    // 
    if (document.getElementsByName("studylist").checked = false) {
      printError('QuaErr', "Please select at least one .");
      //ssgenErr = false;
    }
    if (document.form.gen.checked == false) {
      printError('genErr', "Please select at least one .");
      genErr = false;
    }











    var nameErr = lnameErr = emailErr = passErr = cpassErr = ageErr = hobErr = QuaErr = genErr = true;

  }
</script>

</html>
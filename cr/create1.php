 <?php
  $showAlert = false;

  $showError = false;
  include "config.php";

  // $query = 'SELECT * FROM master_hobby';
  // $hob = $link->query($query); // Dropdown Btn 

  $query1 = 'SELECT * FROM master_qa';
  $q = $link->query($query1); // Checkbox Btn 

  $query2 = 'SELECT * FROM master_gender';
  $gn = $link->query($query2); // Radio Btn

  $name = $email = $password = $det = $gid = $hobby = $qua = $salary = $age = $uty =  "";


  $name_err = $email_err = $pass_err = $det_err = $gen_err = $hobby_err = $qua_err = $salary_err = $age_err = $utype_err = "";

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
    $input_pass = trim($_POST["password"]);
    if (empty($input_pass)) {
      $pass_err = "Enter password....";
    } else {
      $password = $input_pass;
    }


    // Validate details
    $input_det = trim($_POST["det"]);
    if (empty($input_det)) {
      $det_err = "Enter your Details....";
    } else {
      $det = $input_det;
    }


    //Validate Gender
    $input_gen = trim($gid);
    if (empty($input_gen)) {
      $gen_err = "No Value Selected....";
    } else {
      $gid = $input_gen;
    }

    // Validate Hobby
    $input_hob = trim($hobby);
    if (empty($input_hob)) {
      $hobby_err = "Select Any Hobby...";
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

    // Validate Salary
    $input_sal = trim($_POST["salary"]);
    if (empty($input_sal)) {
      $salary_err = "Enter your salary...";
    } else {
      $salary = $input_sal;
    }
    // Validate age
    $input_age = trim($_POST["age"]);
    if (empty($input_age)) {
      $age_err = "Enter your Age...";
    } else {
      $age = $input_age;
    }

    // Validate User
    $input_utype = trim($_POST["utype"]);
    if (empty($input_utype)) {
      $utype_err = "Select your User type...";
    } else {
      $uty = $input_utype;
    }
  }


  if (isset($_POST['submit'])) {
    session_start();
    $_SESSION['create'] = "Data Added";

    $eid = mysqli_insert_id($link);
    // $eid = $link->insert_id;

    echo "<h1> Eid :- $eid</h1>";  // Single Values/ Text ones;
    $first_name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $det = $_POST['det'];
    $salary = $_POST['salary'];
    $age = $_POST['age'];
    $uty = $_POST['utype'];

    // $img = $_POST["img"];
    // Img Validation Done here......
    $imgfile = $_FILES["img"]["name"];
    echo "<h1>Image is this $imgfile</h1>";
    $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
    // allowed extensions
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
    // Validation for allowed extensions
    if (!in_array($extension, $allowed_extensions)) {
      echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {
      $imgnewfile = md5($imgfile) . $extension;
      move_uploaded_file($_FILES["img"]["tmp_name"], "uploadeddata/" . $imgnewfile);  // Code for move image into directory
    }


    // 1st 
    $sql = "INSERT INTO `employees` VALUES ('$eid', '$first_name', '$email', '$password', '$det', '$salary', '$age' , '$imgnewfile' , '$uty')";
    // $result = $link->query($sql);
    // $result = $link->query($sql) or die($link->error);
    $result = mysqli_query($link, $sql) or mysqli_connect_error($link);
    if ($result) {
      $showAlert = true;
      echo "Insert successful in emp_tbl. Latest ID is: " . $eid;
      echo "<script>alert('Data inserted successfully');</script>";
      // echo "<button> <a href=".login.php."> Cancel </a> </button>";

    } else {
      $showError = "No values Passed";
    }

    // 2nd
    $gid = $_POST['sx'];
    $eid2 = mysqli_insert_id($link);
    $sql1 = "INSERT INTO `e_gender` VALUES ('$eid2', '$gid')";
    $result1 = $link->query($sql1) or die($link->error);
    if ($result1) {
      $showAlert = true;
      echo "<br>";
      echo "Insert successful in Gender_tbl. Latest EID is: " . $eid2;
    } else {
      $showError = "No Values Passed";
    }

    // 3rd
    $hobby = $_POST['hby'];
    // echo "<pre>"; // print_r($hobby);    // exit;
    // echo "<h1> This is eid3 :-$eid2</h1>";
    foreach ($hobby as $hobrow) {
      echo "<h1> This is Hid:- $hobrow</h1>"; // Drop- down Values
      $sql4 = "INSERT INTO `e_hob` VALUES ($eid2,$hobrow)";
      $result2 = $link->query($sql4) or die($link->error);
      // $result2 = mysqli_query($link, $sql4);
    }
    if ($result2) {
      $_SESSION['hob'] = "Hobbies Inserted";
      // header("location : index.php");
    } else {
      echo "<h1> Not Inserted into Hobbies...</h1>";
    }

    // 4th
    $qua = $_POST['qa'];
    // echo "<h1> This is eid4 .$eid2.</h1>";
    foreach ($qua as $quarw) {
      echo "<h1> This is Qid $quarw</h1>";
      $sql3 = "INSERT INTO `e_qa` VALUES ('$eid2', '$quarw') ";
      $result3 = $link->query($sql3) or die($link->error);
      // $result3 = mysqli_query($link, $sql3);
    }
    if ($result3) {
      $_SESSION['qa'] = "Qua Inserted";
      // header("location : index.php");
    } else {
      echo "<h1> Not Inserted in qa</h1>";
    }

    if ($result == TRUE) {
      $result1 == TRUE;
      echo "New record created successfully.";
    } else {
      echo "Error:" . $sql . "<br>" . $link->error;
      echo "Error:" . $sql1 . "<br>" . $link->error;
      echo "Error:" . $sql3 . "<br>" . $link->error;
    }

    $link->close();
  }
  ?>

 <!DOCTYPE html>
 <html>

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
       var password = document.contactForm.password.value;
       var det = document.contactForm.det.value;
       var sx = document.contactForm.sx.value;
       var hby = document.contactForm.hby.value;
       var qa = [];
       var det = document.contactForm.det.value;
       var salary = document.contactForm.salary.value;
       var age = document.contactForm.age.value;
       var img = document.contactForm.img.value;
       var utype = document.contactForm.utype.value;



       var checkboxes = document.getElementsByName("qa[]");
       for (var i = 0; i < checkboxes.length; i++) {
         if (checkboxes[i].checked) {
           // Populate qua array with selected values
           qa.push(checkboxes[i].value);
         }
       }

       var nameErr = detErr = emailErr = passErr = genderErr = quaErr = hobErr = salaryErr = ageErr = true;

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
       if (password == "") {
         printError("passErr", "**Fill the password please!");
         return false;
       }
       if (password.length < 6) {
         printError("passErr", "**Password length must be atleast 6 characters");
         return false;
       } else {
         printError("passErr", "");
         passErr = false;
       }


       // Validate Details
       if (det == "") {
         printError("detErr", "Enter your details");
       } else {
         printError("detErr", "");
         detErr = false;
       }


       // Validate gender
       if (sx == "") {
         printError("genderErr", "Please select your sex");
       } else {
         printError("genderErr", "");
         genderErr = false;
       }

       // Validate hob
       if (hby == "") {
         printError("hobErr", "Please select your hob");
       } else {
         printError("hobErr", "");
         hobErr = false;
       }


       // Validate Qualificatiob
       if (qa == "") {
         printError("quaErr", "Select any one...");
       } else {
         printError("quaErr", "");
         quaErr = false;
       }

       if (salary == "") {
         printError("salaryErr", "Enter Your Salary..");
       } else {
         printError("salaryErr", "");
         salaryErr = false;
       }

       if (age == "") {
         printError("ageErr", "Enter Your Age..");
       } else {
         printError("ageErr", "");
         ageErr = false;
       }


       if (utype == "") {
         printError("utyErr", "Select any one");
       } else {
         printError("utyErr", "");
         utyErr = false;
       }

       // Prevent the form from being submitted if there are any errors
       if ((nameErr || emailErr || passErr || detErr || genderErr || hobErr || quaErr || salaryErr || ageErr || utyErr) == true) {
         return false;
       } else {
         alert("Eee");
       }
     };

     function selectOnlyThis(id) {
       var myCheckbox = document.getElementsByName("myCheckbox");
       Array.prototype.forEach.call(myCheckbox, function(el) {
         el.checked = false;
       });
       id.checked = true;
     }
   </script>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 </head>

 <body>
   <?php require 'partials/_nav.php' ?>
   <?php
    if (isset($_SESSION['create'])) {
      // echo $_SESSION['create'];
      if ($_SESSION['create']) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
      }
      if (isset($_SESSION['hob'])) {
        echo "<h4>" . $_SESSION['hob'] . "</h4>";
        unset($_SESSION['hob']);
      }
      if ($showError) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
      }
    }
    ?>
   <div class="wrapper">
     <div class="container-fluid">
       <div class="row">
         <div class="col-md-12">
           <h2 class="mt-5">Signup Form</h2>

           <form name="contactForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateform()" enctype="multipart/form-data">

             <fieldset>

               <legend>Personal information:</legend>

               <br>Name:<br>
               <div class="form-group">
                 <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                 <div class="error" id="nameErr"></div>
                 <span class="invalid-feedback"><?php echo $name_err; ?></span>
               </div>

               <br>Email:<br>
               <div class="form-group">
                 <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                 <div class="error" id="emailErr"></div>
                 <span class="invalid-feedback"><?php echo $email_err; ?></span>
               </div>

               <br> Password:<br>
               <div class="form-group">
                 <input type="password" name="password" class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                 <div class="error" id="passErr"></div>
                 <span class="invalid-feedback"><?php echo $pass_err; ?></span>
               </div>

               Details:<br>
               <div class="form-group">
                 <input type="text" name="det" class="form-control <?php echo (!empty($det_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $det; ?>"><br>
                 <div class="error" id="detErr"></div>
                 <span class="invalid-feedback"><?php echo $det_err; ?></span>
               </div>

               Gender:
               <div class="form-group">
                 <?php foreach ($gn as $g1 => $value) : ?>
                   <input type="radio" name="sx" value="<?php echo $value['gid'] ?>">
                   <label> <?php echo htmlspecialchars($value['sx']); ?> </label><br>
                   <?php echo $gid; ?>
                   <!-- <div class="error" id="genErr"></div> -->
                 <?php endforeach; ?>
               </div>

               <br>
               Hobbies </br>
               <div class="form-group">
                 <select name="hby[]" multiple>
                   <?php
                    $query11 = 'SELECT * FROM master_hobby';
                    // $hob = $link->query($query); // Dropdown Btn 
                    $q_run = mysqli_query($link, $query11);
                    if (mysqli_num_rows($q_run) > 0) {
                      foreach ($q_run as $row11) {
                        // echo $row11['hid'];
                    ?>
                       <option value="<?php echo $row11['hid'] ?>"> <?php echo htmlspecialchars($row11['h_nm']); ?> </option>
                   <?php
                      }
                    } else {
                      echo "No HID found";
                    }
                    ?>
                   <!-- <div class="error" id="hobbyErr"></div> -->
                 </select>
               </div>
               <br>

               <label> Qualifications : </label>
               <div class="form-group">
                 <?php foreach ($q as $q1 => $value1) : ?>
                   <input type="checkbox" name="qa" value="<?php echo $value1['qid']; ?>">
                   <label> <?php echo htmlspecialchars($value1['q_nm']); ?> </label><br>
                 <?php endforeach; ?>
                 <!-- <div class="error" id="quaErr"></div> -->
               </div>

               Salary:<br>
               <div class="form-group">
                 <input type="number" name="salary" value="<?php echo $salary; ?>" min="5000" max="20000" step="1000">
                 <span class="invalid-feedback"> <?php echo $salary_err; ?> </span>
                 <br>
               </div>

               Age:<br>
               <div class="form-group">
                 <input type="number" name="age" value="<?php echo $age; ?>" min="10" max="55">
                 <div class="error" id="ageErr"></div>
                 <span class="invalid-feedback"><?php echo $age_err; ?></span>
                 <br>
               </div>

               Image :</br>
               <div class="form-group">
                 <input type="file" name="img"> <br>
                 <br>
               </div>


               User_Type <br>
               <div class="form-group">
                 <select name="utype">
                   <option value="User" selected> User </option>
                   <option value="Admin"> Admin </option>
                   <!-- <div class="error" id="utyErr"></div> -->
                 </select>
                 <br>
               </div>

               <br>
               <input type="submit" class="btn btn-primary" name="Submit" value="Submit">
               <!-- <button> <a href="login.php"> Cancel </a> </button> -->
               <a href="login.php" class="btn btn-primary">Sign-In</a>


             </fieldset>

           </form>
         </div>
         <!-- Optional JavaScript -->
         <!-- jQuery first, then Popper.js, then Bootstrap JS -->
         <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 </body>

 </html>
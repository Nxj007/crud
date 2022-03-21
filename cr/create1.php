 <?php
$showAlert = false;

$showError = false;
include "config.php";


$query = 'SELECT * FROM master_hobby';
$hob = $link->query($query); // Dropdown Btn 

$query1 = 'SELECT * FROM master_qa';
$q = $link->query($query1); // Checkbox Btn 

$query2 = 'SELECT * FROM master_gender';
$gn = $link->query($query2); // Radio Btn



  if (isset($_POST['submit'])) {
    session_start();
    $_SESSION['create']="Data Added";
    $eid =mysqli_insert_id($link);
    // $eid = $link->insert_id;
    echo "<h1> Eid :- $eid</h1>";
    $first_name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $det = $_POST['det'];
    
    $gid = $_POST['sx'];
    // echo "<h1>$gid</h1>";
    
    $hobby = $_POST['hby'];
    $hid = implode(",", $hobby);
    // $hid1 = explode(" ", $hobby);
    echo "<h1> This is Hid $hid</h1>";

    $qua = $_POST['qa'];
    $mqid = implode(",", $qua);
    echo "<h1>Qid is this $mqid</h1>";

    $salary = $_POST['salary'];
    $age = $_POST['age'];
    
    // $img = $_POST["img"];
    $imgfile=$_FILES["img"]["name"];
    echo "<h1>Image is this $imgfile</h1>";
    $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
    // allowed extensions
    $allowed_extensions = array(".jpg","jpeg",".png",".gif");
    // Validation for allowed extensions
    if(!in_array($extension,$allowed_extensions))
    {
    echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    }
    else
    {
      $imgnewfile=md5($imgfile).$extension;  
      
      move_uploaded_file($_FILES["image"]["tmp_name"],"uploadeddata/".$imgnewfile);  // Code for move image into directory
    }
    $uty = $_POST['utype'];    
    
   
      
  



    $uty = $_POST['utype'];    
    
    $sql = "INSERT INTO `employees` VALUES ('$eid', '$first_name', '$email', '$password', '$det', '$salary', '$age' , '$imgnewfile' , '$uty')";
    // $result = $link->query($sql);
    // $result = $link->query($sql) or die($link->error);
    $result = mysqli_query($link, $sql) or mysqli_connect_error($link);
    if ($result){
      $showAlert = true;
      echo "Insert successful. Latest ID is: " . $eid;
      echo "<script>alert('Data inserted successfully');</script>";
    }
    else{
      $showError = "No values Passed";
    }
   
    $eid2 =mysqli_insert_id($link);
    $sql1 = "INSERT INTO `e_gender` VALUES ('$eid2', '$gid')";
    $result1 = $link->query($sql1) or die($link->error);
    if ($result1){
      $showAlert = true;
      echo "Insert successful. Latest EID is: " . $eid2;
    }
    else{
      $showError = "No Values Passed";
    } 
    
    
    $sql2 = "INSERT INTO `e_qa` VALUES ('$eid2', '$mqid') ";
    $result2 = $link->query($sql2) or die($link->error);
    if ($result2){
      $showAlert = true;
      echo "Insert successful. Latest EID is: " . $eid2."<br>";
    }
    else{
      $showError = "No Values Passed";
    } 

    
    $eid3 =mysqli_insert_id($link);
    $sql3 = "INSERT INTO `e_hob` VALUES ('$eid3', '$hid') ";
    $result3 = $link->query($sql3) or die($link->error);
    if ($result3){
      $showAlert = true;
      echo "Insert successful. Latest EID is: " . $eid3;
    }
    else{
      $showError = "No Values Passed";
    } 

    
    // $sql2= "SELECT eid from `employees` where eid='$eid3'";
    // $result = $link->query($sql2) or die($link->error);
    // $row = $result->fetch_assoc();
    // $eid3=$row['eid'];
    // $sql3 = "INSERT INTO `e_hob` VALUES ('$eid3', '$hid')";
    // $link->query($sql3);


    // $sql7 = "INSERT INTO `e_qa` VALUES ('$eid','$mqid')";
    // $link->query($sql7) or die($link->error);
    // echo "Insert successful. Latest ID is: " . $eid;

    // if ( $eid2 ){
    //   $sql1 = "INSERT INTO `e_gender` VALUES ('$eid2', '$gid')";
    //   $link->query($sql1) or die($link->error);
    //     if($eid2){
    //       $sql4 = "INSERT INTO `e_hob` VALUES ('$eid','$hid')";
    //       $link->query($sql4) or die($link->error);
    //     }
    //     if($eid2){
    //       $sql7 = "INSERT INTO `e_qa` VALUES ('$eid','$mqid')";
    //       $link->query($sql7) or die($link->error);
    //     }
      
    // }
    // else{
    //   $sql2= "SELECT eid from `employees` where eid='$eid2'";
    //   $result = $link->query($sql2) or die($link->error);
    //   $row = $result->fetch_assoc();
    //   $eid2=$row['eid'];
    //   $sql3 = "INSERT INTO `e_gender` VALUES ('$eid2', '$gid')";
    //   $link->query($sql3);
  
    //     $sql6= "SELECT eid from `employees` where eid='$eid'";
    //     $result = $link->query($sql6) or die($link->error);
    //     $sql5 = "INSERT INTO `e_hob` VALUES ('$eid','$hid')";
    //     $link->query($sql5);

    //     $sql8 = "SELECT eid from `employees` where eid='$eid'";
    //     $result = $link->query($sql8) or die($link->error);
    //     $sql9 = "INSERT INTO `e_qa` VALUES ('$eid','$mqid')";
    //     $link->query($sql9);
    //   }
    $link->close();
  }
  ?>

 <!DOCTYPE html>
 <html>

 <head>
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
       var gender = document.contactForm.gender.value;
       var hby = document.contactForm.hby.value;
       var qua = [];
       var det = document.contactForm.det.value;
       var salary = document.contactForm.salary.value;
       var age = document.contactForm.age.value;
       var img = document.contactForm.img.value;
       var utype = document.contactForm.utype.value;
       


       var checkboxes = document.getElementsByName("qua[]");
       for (var i = 0; i < checkboxes.length; i++) {
         if (checkboxes[i].checked) {
           // Populate qua array with selected values
           qua.push(checkboxes[i].value);
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

       // Validate gender
       if (gender == "") {
         printError("genderErr", "Please select your gender");
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
       if (qua == "") {
         printError("quaErr", "Select any one");
       } else {
         printError("quaErr", "");
         quaErr = false;
       }

       if (salary == "") {
         printError("salaryErr", "Select any one");
       } else {
         printError("salaryErr", "");
         salaryErr = false;
       }

       if (age == "") {
         printError("ageErr", "Select any one");
       } else {
         printError("ageErr", "");
         ageErr = false;
       }

       // Prevent the form from being submitted if there are any errors
       if ((nameErr || detErr || emailErr || passErr || genderErr || hobErr || quaErr || salaryErr || ageErr) == true) {
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
   <h2>Signup Form</h2>
   <?php
if(isset($_SESSION['create'])){
  echo $_SESSION['create'];
  if($_SESSION['create']){
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
    }}
    ?>
    <div class="container my-4">

   <form name="contactForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateform()" enctype="multipart/form-data">

     <fieldset>

       <legend>Personal information:</legend>

       <br>Name:<br>

       <input type="text" name="name">
       <div class="error" id="nameErr"></div>

       <br>Email:<br>

       <input type="text" name="email">
       <div class="error" id="emailErr"></div>

       <br> Password:<br>

       <input type="password" name="password">
       <div class="error" id="passErr"></div>

       <br>Details:<br>
       <input type="text" name="det"><br>


       <br>Gender:</br>

       <?php foreach ($gn as $g1 => $value) : ?>
         <input type="radio" id="sx" name="sx" value="<?php echo $value['gid'] ?>">
         <label><?php echo htmlspecialchars($value['sx']); ?></label><br>
       <?php endforeach; ?>
      

       <br>
       Hobbies </br>
       <select name="hby[]" multiple>
         <?php foreach ($hob as $h1 => $value1) : ?>
           <option value="<?php echo $value1['hid'] ?>"> <?php echo htmlspecialchars($value1['h_nm']); ?> </option>
         <?php endforeach; ?>
       </select>
       <br>


       <br>
       Qualifications : <br>
       <?php foreach ($q as $q1 => $value2) : ?>
         <input type="checkbox" name="qa[]" value="<?php echo $value2['qid'] ?>">
         <label > <?php echo htmlspecialchars($value2['q_nm']); ?> </label> <br>
       <?php endforeach; ?>


       <br>
       Salary:<br>
       <input type="number" name="salary" min="5000" max="20000" step="1000">
       <br>


       <br>
       Age:<br>
       <input type="number" name="age" min="10" max="55">
       <br>


      <br> Image :</br>
      <input type="file" name="img"> <br>
      <br>

      
      <br> User_Type <br>
      <select name="utype">
      <option value="User"> User </option>      
      <option value="Admin"> Admin </option>
      </select>
      <br>
      <br>
      <input type="submit" name="submit" value="submit">
      
      <button> <a href="login.php"> Cancel </a> </button>

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
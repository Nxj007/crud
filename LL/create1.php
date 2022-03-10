 <?php

  include "config.php";

  $query = 'SELECT * FROM master_hobby';
  $hob = $link->query($query);

  $query1 = 'SELECT * FROM master_qa';
  $q = $link->query($query1);

  $query2 = 'SELECT * FROM master_gender';
  $gn = $link->query($query2);



  if (isset($_POST['submit'])) {

    $first_name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $det = $_POST['det'];
    $gender = $_POST['sx'];
    $hobby = $_POST['hob'];
    $mhobby = implode(",", $hobby);
    $qua = $_POST['q'];
    $mqn = implode(",", $qua);
    $salary = $_POST['salary'];
    $age = $_POST['age'];

    $sql = "INSERT INTO `employees1` VALUES (NULL, '$first_name', '$email', '$password', '$det', '$gender', '$mhobby', '$mqn', '$salary', '$age')";
    # $sql1 = "INSERT INTO `hobby` VALUES ('$chobby')";


    $result = $link->query($sql);

    if ($result == TRUE) {
      echo "New record created successfully.";
    } else {

      echo "Error:" . $sql . "<br>" . $link->error;
    }
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
       var hob = document.contactForm.hob.value;
       var qua = [];
       var det = document.contactForm.det.value;
       var salary = document.contactForm.salary.value;
       var age = document.contactForm.age.value;


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
 </head>

 <body>
   <h2>Signup Form</h2>

   <form name="contactForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateform()">

     <fieldset>

       <legend>Personal information:</legend>

       Name:<br>

       <input type="text" name="name">
       <div class="error" id="nameErr"></div>

       <br>


       Email:<br>

       <input type="text" name="email">
       <div class="error" id="emailErr"></div>

       <br> Password:<br>

       <input type="password" name="password">
       <div class="error" id="passErr"></div>

       <br>

       Details:<br>

       <input type="text" name="det">

       <br>
       Gender:<br>

       <?php foreach ($gn as $g1 => $value) : ?>
         <input type="radio" id="sx" name="sx" value="<?php echo $value['sx'] ?>">
         <label for="sx"><?php echo htmlspecialchars($value['sx']); ?></label><br>
       <?php endforeach; ?>

       Hobbies <br>
       <select name="hob[]" multiple>
         <?php foreach ($hob as $h1 => $value) : ?>
           <option value="<?php echo $value['h_nm'] ?>"> <?php echo htmlspecialchars($value['h_nm']); ?> </option>
         <?php endforeach; ?>
       </select>

       <br>
       Qualifications : <br>
       <?php foreach ($q as $q1 => $value) : ?>
         <input type="checkbox" id="q" name="q[]" value="<?php echo $value['q_nm'] ?>">
         <label for="q"> <?php echo htmlspecialchars($value['q_nm']); ?> </label><br>
       <?php endforeach; ?>

       <br>
       Salary:<br>

       <input type="number" name="salary">

       <br>

       <br>
       Age:<br>

       <input type="number" name="age" min="10" max="55">

       <br>
       <input type="submit" name="submit" value="submit">

     </fieldset>

   </form>

 </body>

 </html>
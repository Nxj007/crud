<?php
$showAlert = false;

$showError = false;
include "db.php";

            
            if (isset($_GET['eid'])) {
                $update_id = $_GET['eid'];
                echo "<h1>".$update_id."</h1>";
                exit;
            }
$query = 'SELECT * FROM master_hobby';
$hob = $link->query($query); // Dropdown Btn 

$query1 = 'SELECT * FROM master_qa';
$q = $link->query($query1); // Checkbox Btn 

$query2 = 'SELECT * FROM master_gender';
$gn = $link->query($query2); // Radio Btn

$query3 = "SELECT * FROM employees where eid ='$eid' ";
$emp = $link->query($query3); // Emp

$row = mysqli_fetch_array($emp);

$eid1 = $row['eid'];
echo  $row['eid'];
echo  $row['name'];
echo  $row['email'];
echo  $row['password'];
echo  $row['det'];
echo  $row['salary'];
echo  $row['age'];
echo  '<img src="uploadeddata/' . $row['image'] . '" " title=' . $row['image'] . ' style="width:100px;height:100px">';

if (isset($_POST['submit'])) {
    session_start();
    $_SESSION['create'] = "Data Added";

    $eid = mysqli_insert_id($link);
    // $eid = $link->insert_id;
    // echo "<h1> Eid :- $eid</h1>";
    $first_name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $det = $_POST['det'];
    $salary = $_POST['salary'];
    $age = $_POST['age'];
    $uty = $_POST['utype'];

    // $img = $_POST["img"];
    $imgfile = $_FILES["img"]["name"];
    echo "<script>alert('Image Added');</script>";
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
        // echo "Insert successful in emp_tbl. Latest ID is: " . $eid;
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
        // echo "<br>";
        // echo "Insert successful in Gender_tbl. Latest EID is: " . $eid2;
    } else {
        $showError = "No Values Passed";
    }

    // 3rd
    $hobby = $_POST['hob'];
    // echo "<pre>"; // print_r($hobby);    // exit;
    // echo "<h1> This is eid3 :-$eid2</h1>";
    foreach ($hobby as $hobrow) {
        // echo "<h1> This is Hid $hobrow</h1>"; // Drop- down Values
        $sql4 = "INSERT INTO `e_hob` VALUES ($eid2, $hobrow)";
        $result2 = $link->query($sql4) or die($link->error);
        // $result2 = mysqli_query($link, $sql4);
    }
    if ($result2) {
        $showAlert = true;
        // echo "<br>";
        // echo "Insert successful in Hob_tbl. Latest EID is: " . $eid2;
        // $_SESSION['hob'] = "Hobbies Inserted";
        // header("location : index.php");
    } else {
        echo "<h1> Not Inserted</h1>";
    }

    // 4th
    $qua = $_POST['qa'];
    // echo "<h1> This is eid4 .$eid2.</h1>";
    foreach ($qua as $quarw) {
        // echo "<h2> This is Qid $quarw</h2>";
        // echo "<h1> This is qua :- $qua</h1>";
        $sql3 = "INSERT INTO `e_qa` VALUES ('$eid2', '$quarw') ";
        $result3 = $link->query($sql3);
        //  or die($link->error);
        // $result3 = mysqli_query($link, $sql3);
    }
    if ($result3) {
        // echo "<br>";
        // echo "Insert successful in Qua_tbl. Latest EID is: " . $eid2;
        $_SESSION['qa'] = "Qua Inserted";
        // header("location : index.php");
    } else {
        echo "<h1> Not Inserted in qa</h1>";
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

        //  function selectOnlyThis(id) {
        //    var qa = document.getElementsByName("qa");
        //    Array.prototype.forEach.call(qa, function(el) {
        //      el.checked = false;
        //    });
        //    id.checked = true;
        //  }
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
    if (isset($_SESSION['create'])) {
        // echo $_SESSION['create'];
        if ($_SESSION['create']) {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $_SESSION['create'] . '</div>';
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
    <div class="container my-4">

        <form name="contactForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateform()" enctype="multipart/form-data">
        <?php
            include "db.php";
            
            $query3 = 'SELECT * FROM employees where eid = "$eid" ';
            // $emp = $link->query($query3); // Emp
            $emp = mysqli_query($link, $query3);
            $row = mysqli_fetch_array($emp);

            $eid1 = $row['eid'];
            echo "<td>".$row['eid'];
            echo  $row['name'];
            echo  $row['email'];
            echo  $row['password'];
            echo  $row['det'];
            echo  $row['salary'];
            echo  $row['age'];
            echo "</td>";
            echo  '<img src="uploadeddata/' . $row['image'] . '" " title=' . $row['image'] . ' style="width:100px;height:100px">';
            ?>
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
                    <input type="radio" name="sx" value="<?php echo $value['gid'] ?>">
                    <label><?php echo htmlspecialchars($value['sx']); ?></label><br>
                <?php endforeach; ?>


                <label> Hobbies: </label>
                <div class="form-group">
                    <select class="form-control" name="hob[]" multiple>
                        <?php foreach ($hob as $h1 => $value) : ?>
                            <option value="<?php echo $value['hid'] ?>">
                                <?php echo htmlspecialchars($value['h_nm']); ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <!-- <div class="error" id="hobErr"></div> -->
                    <span class="invalid-feedback"> <?php echo $hobby_err; ?> </span>
                </div>


                <label> Qualifications : </label>
                <div class="form-group">
                    <?php foreach ($q as $value1) : ?>
                        <!-- <input type="checkbox" name="qa" value="" onclick="selectOnlyThis(this)" /> -->
                        <input type="checkbox" name="qa[]" value="<?php echo $value1['qid']; ?>">
                        <label> <?php echo htmlspecialchars($value1['q_nm']); ?> </label><br>
                    <?php endforeach; ?>
                    <div class="error" id="quaErr"></div>
                    <span class="invalid-feedback"> <?php echo $qua_err; ?> </span>
                </div>


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
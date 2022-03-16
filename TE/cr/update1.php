<?php
// Include config file
include "config.php";

session_start();

$query = 'SELECT * FROM master_hobby';
$hob = $link->query($query);

$query1 = 'SELECT * FROM master_qa';
$q = $link->query($query1);

$query2 = 'SELECT * FROM master_gender';
$gn = $link->query($query2);

    //$id = mysqli_insert_id($link);
    $name = $_POST['name'];
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


    


    $sql1 = "UPDATE `employees` SET ('$name', '$email', '$password', '$det' ,'$gender', '$mhobby', '$mqn', '$salary', '$age')  WHERE id='$id' ";
    if ($stmt1 = mysqli_prepare($link, $sql1)) {
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt1)) {
            // Records updated successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    // mysqli_stmt_close($stmt1);

// Close connection
// mysqli_close($link);

else {
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Get URL parameter
    $id =  trim($_GET["id"]);

    // Prepare a select statement
    $sql = "SELECT * FROM employees WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = $id;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $name = $row["name"];
                $email = $row["email"];
                $password = $row["password"];
                $det = $row["det"];
                $gender = $row["gender"];
                $mhobby = $row["hby"];
                $mqn = $row["q_nm"];
                $salary = $row["salary"];
                $age = $row["age"];
                // $img = $row["img"];
            } else {
                // URL doesn't contain valid id. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    // mysqli_stmt_close($stmt);

    // // Close connection
    // mysqli_close($link);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
}



?>
<!DOCTYPE html>

 <html>

 <head>

 </head>
 <body>
<h2>Signup Form</h2>

<form name="contactForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateform()">

    <fieldset>

    <legend>Personal information:</legend>
    <div class="form-group">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    </div>

    Name:<br>

    <input type="text" name="name" value="<?php echo $name; ?>">
    <div class="error" id="nameErr"></div>

    <br>
    Email:<br>

    <input type="text" name="email" value="<?php echo $email; ?>">
    <div class="error" id="emailErr"></div>

    <br> Password:<br>

    <input type="password" name="password" value="<?php echo $password; ?>">
    <div class="error" id="passErr"></div>

    <br>
    Details:<br>
    <input type="text" name="det" value="<?php echo $det; ?>">

    <br>
    Gender:<br>

    <?php foreach ($gn as $g1 => $value) : ?>
        <input type="radio" name="sx" <?php if (in_array($gender, $value)) { echo "checked";} ?>
        value="<?php echo $value['sx']; ?>" >
        <label ><?php echo htmlspecialchars($value['sx']); ?></label><br>
    <?php endforeach; ?>

    <br>Hobbies <br>
    <select name="hob[]" multiple>
        <?php foreach ($hob as $h1 => $value1) : ?>
        <option value="<?php echo $value1['h_nm'] ?>"> <?php echo htmlspecialchars($value1['h_nm']); ?> </option>
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

    <input type="number" name="salary" value="<?php echo $salary; ?>">

    <br>

    <br>
    Age:<br>

    <input type="number" name="age" value="<?php echo $age; ?>" min="10" max="55">

    <br>
    <input type="submit" name="submit" value="submit">
    <button> <a href="index.php">Cancel</a> </button>

    </fieldset>

</form>

</body>


 </html>
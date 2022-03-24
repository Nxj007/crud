<?php
include "config.php";

$query = 'SELECT * FROM master_hobby';
$hob = $link->query($query); // Dropdown Btn 

$query1 = 'SELECT * FROM master_qa';
$q = $link->query($query1); // Checkbox Btn 

$query2 = 'SELECT * FROM master_gender';
$gn = $link->query($query2); // Radio Btn


if (isset($_POST['submit'])) {

    // $eid = mysqli_insert_id($link);
    // echo "<h1> Eid :- $eid</h1>";
    $fname = $_POST['fname'];
    echo "<h1> fname is :- $fname</h1>";

    // 1st 
    $sql = "INSERT INTO `emp` VALUES ('$fname')";
    // $result = $link->query($sql);
    $result = $link->query($sql) or die($link->error);
    // $result = mysqli_query($link, $sql) or mysqli_connect_error($link);
    if ($result) {
        echo "Insert successful in emp_tbl. Latest ID is: " . $eid;
        echo "<script>alert('Data inserted successfully');</script>";
        // echo "<button> <a href=".login.php."> Cancel </a> </button>";
    } else {

        echo "Error:" . $sql . "<br>" . $link->error;
        // echo "Error:" . $sql1 . "<br>" . $link->error;
        // echo "Error:" . $sql3 . "<br>" . $link->error;
    }

    // 2nd
    $gid = $_POST['sx'];
    echo "<h1> Sx is :- $gid</h1>";
    $eid2 = mysqli_insert_id($link);
    $sql1 = "INSERT INTO `e_gender` VALUES ('$eid2', '$gid')";
    $result1 = $link->query($sql1) or die($link->error);
    if ($result1) {
        echo "<br>";
        echo "Insert successful in Gender_tbl. Latest EID is: " . $eid2;
    } else {
        $showError = "No Values Passed";
    }

    // 3rd
    $hobby = $_POST['hob'];
    echo "<pre>";
    print_r($hobby);
    echo "<h1> This is eid3 :-$eid2</h1>";
    foreach ($hobby as $hobrow) {
        echo "<h1> This is Hid $hobrow</h1>"; // Drop- down Values
        $sql4 = "INSERT INTO `e_hob` VALUES ($eid2,$hobrow)";
        // $q_run = $link->query($sql4) or die($link->error);
        $q_run = mysqli_query($link, $sql4);
    }
    if ($q_run) {
        $_SESSION['hob'] = "Hobbies Inserted";
        // header("location : index.php");
    } else {
        echo "<h1> Not Inserted</h1>";
    }

    // 4th
    $qua = $_POST['qa'];
    echo "<h1> This is eid4 .$eid2.</h1>";
    echo "<h1> Qa is :- $qua</h1>";
    foreach ($qua as $quarw) {
        echo "<h1> This is Qid $quarw</h1>";
        $sql3 = "INSERT INTO `e_qa` VALUES ('$eid2', '$quarw') ";
        // $result3 = $link->query($sql3) or die($link->error);     
        $result3 = mysqli_query($link, $sql3);
    }
    if ($result3) {
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
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- <form action="create.php" method="post"> -->

        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mt-5">Signup Form</h2>
                             <!-- echo "<h1> Eid :- $eid</h1>"; -->
                            
                            <br>Name:<br>
                            <div class="form-group">
                                <input type="text" name="fname">
                                <!-- echo "<h1> Name is :- $fname</h1>";  -->
                            </div>

                            <br>
                            <label> Gender : </label>
                            <div class="form-group">
                                <?php foreach ($gn as $g1 => $value2) : ?>
                                    <input type="radio" name="sx" value="<?php echo $value2['gid']; ?>">
                                    <label for="sx"><?php echo htmlspecialchars($value2['sx']); ?></label><br>
                                <?php endforeach; ?>
                            </div>
                            <br>

                            <label> Hobbies: </label>
                            <div class="form-group">
                                <select class="form-control" name="hob[]" multiple>
                                    <?php foreach ($hob as $h1 => $value) : ?>
                                        <option value="<?php echo $value['hid'] ?>"> <?php echo htmlspecialchars($value['h_nm']); ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- <div class="error" id="hobErr"></div> -->
                            </div>
                            <br>

                            <label> Qualifications : </label>
                            <div class="form-group">
                                <?php foreach ($q as $q1 => $value1) : ?>
                                    <input type="checkbox" name="qa" value="<?php echo $value1['qid']; ?>">
                                    <label> <?php echo htmlspecialchars($value1['q_nm']); ?> </label><br>
                                <?php endforeach; ?>
                            </div>


                            <br>
                            <input type="submit" class="btn btn-primary" name="Submit" value="Submit">
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>
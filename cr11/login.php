<?php
$login = false;
$showError = false;


include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $email = $_POST["email"];
    $password = $_POST["password"];
    // $uty = trim($_POST['utype']);



    $sql = " Select * from `employees` where email= $email AND password=$password ";
    $result = mysqli_query($link, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        
        header("location: welcome.php");


        // $sql1="SELECT * FROM `employees` WHERE utype='$uty' ";
        // // $link->query($sql1) or die($link->error);
        // $result = mysqli_query($link, $sql1);
        // $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // mysqli_free_result($result);


        //     if(($user['email'] == 'admin') && (['password'] == $password)) {
        //     header("Location: adminpage.php");
        // }
        //     else {
        //         echo "<script language='javascript'>";
        //         echo "alert('WRONG INFORMATION')";
        //         echo "</script>";
        //         die();
        //     }

    }
    /*
        while($row=mysqli_fetch_assoc($result)){
            
            else{
                $showError = "Invalid Credentials"}}}"";
                */ else {
        $showError = "Invalid Credentials";
    }

    mysqli_close($link);
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>
</head>

<body>
    <?php require 'partials/_nav.php' ?>

    <?php
    if ($login) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if ($showError) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    ?>

    <div class="container my-4">
        <h1 class="text-center">Login to our website</h1>
        <form action="/cr11/" method="post">

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" aria-describedby="emailHelp">

            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password">
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
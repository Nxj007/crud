<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Hello Admin</h2>
    <h3> You're here</h3>
<h4>
    
    <?php
foreach($users as $user) {
    
    if(($user['adminname'] == $adminname) &&
    ($user['utype'] == $utype)) {
        // header("Location: \cr\index.php");
        print_r("<h1>".$user['utype']."</h1>");
    }else {
        echo "<script language='javascript'>";
        echo "alert('WRONG INFORMATION')";
        print_r("<h1>".$user['utype']."</h1>");
        // echo "alert("<h1>". $user['adminname'] . "</h1>")";
        echo "</script>";
        die();
    }
}
?>
</h4>
</body>

</html>
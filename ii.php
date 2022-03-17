<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Set session variables
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "Dog";

echo "<br>";
// session_unset();
// session_destroy();
echo $_SESSION["favcolor"];
// echo ($_SESSION["favanimal"]) ;

if (isset($_SESSION['favanimal']))
{
    echo "Session variables are set.";
    echo '<div class="msg">';
    echo "<br>";
    echo $_SESSION['favanimal']; 
    unset($_SESSION['favanimal']);
    // echo $_SESSION['favanimal']; 
}
?>

</body>
</html>

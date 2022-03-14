<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php

require_once "config.php";

// define variables and set to empty values
$name = $email = $gender = $comment = $website = "";

$query2 = 'SELECT * FROM master_gender';
$gn = $link->query($query2);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $website = test_input($_POST["website"]);
  $comment = test_input($_POST["comment"]);
  $gender = test_input($_POST["gender"]);
}

              
$sql = "INSERT INTO e_gender(sx) VALUES (?)";
if($stmt = mysqli_prepare($link, $sql)) {
  mysqli_stmt_bind_param($stmt, "s", $param_sx);

  $param_sx = $gender;

  if(mysqli_stmt_execute($stmt)) {
    // Records created successfully. Redirect to landing page
    echo "Scc";
    exit();
} else{
    echo "Oops! Something went wrong. Please try again later.";
}
/*
mysqli_stmt_close($stmt);
mysqli_close($link);
*/
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  <br><br>
  E-mail: <input type="text" name="email">
  <br><br>
  Website: <input type="text" name="website">
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <?php foreach ($gn as $g1 => $value): ?>

  <input type="radio" name="gender" value="<?php echo $value['sx']?>"> <label> "<?php echo htmlspecialchars($value['sx']); ?>" </label>
  
  <?php endforeach; ?>
  
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>

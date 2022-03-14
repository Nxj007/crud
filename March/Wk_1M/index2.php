<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php

require_once "config.php";

// define variables and set to empty values
$name = $email = $qu = $comment = $website = "";


$query1 = 'SELECT * FROM master_qa';
$qua = $link->query($query1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $website = test_input($_POST["website"]);
  $comment = test_input($_POST["comment"]);
  $qu = test_input($_POST["qu"]);
}

$sql = "INSERT INTO e_qa(q_nm) VALUES (?)";
if($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $param_qu);

    $param_qu = $qu;

    if(mysqli_stmt_execute($stmt)) {
      // Records created successfully. Redirect to landing page
      echo "Scc";
      exit();
  } else{
      echo "Oops! Something went wrong. Please try again later.";
  }
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

  Qualification:

  <?php foreach ($qua as $q1 => $value): ?>
  
  <input type="checkbox" id="qu" name="qu" value="<?php echo $value['q_nm']?>">
  
  <label for="qu"> <?php echo htmlspecialchars($value['q_nm']); ?> </label><br>
  
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
echo $qu;
?>

</body>
</html>

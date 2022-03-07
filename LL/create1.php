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
    
    $sql = "INSERT INTO `employees` VALUES (NULL, '$first_name', '$email', '$password', '$det', '$gender', '$mhobby', '$mqn')";
    # $sql1 = "INSERT INTO `hobby` VALUES ('$chobby')";
    

    $result = $link->query($sql);

    if ($result == TRUE) {
    echo "New record created successfully.";

    }
        
    else{

      echo "Error:". $sql . "<br>". $link->error;

    } 
    $link->close(); 

}

?>

<!DOCTYPE html>

<html>

  <head>
    </head>  
    <body>
    <h2>Signup Form</h2>
    
<form name="myform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onsubmit="return validateform()">

  <fieldset>

    <legend>Personal information:</legend>

    Name:<br>

    <input type="text" name="name">

    <br>

    
    Email:<br>
    
    <input type="text" name="email">
    
    <br> Password:<br>
    
    <input type="password" name="password">
    
    <br>
    
    Details:<br>

    <input type="text" name="det">

    <br>
  Gender:<br>
  
  <?php foreach ($gn as $g1 => $value): ?>
  <input type="radio" id="sx" name="sx" value="<?php echo $value['sx']?>">
  <label for="sx"><?php echo htmlspecialchars($value['sx']); ?></label><br>
  <?php endforeach; ?>
    
  Hobbies <br>
  <select name="hob[]" multiple>
  <?php foreach ($hob as $h1 => $value): ?>
      <option value="<?php echo $value['h_nm']?>"> <?php echo htmlspecialchars($value['h_nm']); ?> </option>
  <?php endforeach; ?>
  </select>

    <br>
  Qualifications : <br>
  <?php foreach ($q as $q1 => $value): ?>
  <input type="checkbox" id="q" name="q[]" value="<?php echo $value['q_nm']?>">
  <label for="q"> <?php echo htmlspecialchars($value['q_nm']); ?> </label><br>
  <?php endforeach; ?>
                        




  <input type="submit" name="submit" value="submit">

  </fieldset>

</form>

</body>

</html>
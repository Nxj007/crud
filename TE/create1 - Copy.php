 <?php 

include "config.php";

$query = 'SELECT * FROM master_hobby';
$hob = $link->query($query);

$query1 = 'SELECT * FROM master_qa';
$qa = $link->query($query1);

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
    $qua = $_POST['qa'];
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
  
  <script type = "text/javascript" src="main.js"></script>  

    </head>  
    <body>
      
    <h2>Signup Form</h2>
    
<form name="myform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onsubmit="return validateForm()">

  <fieldset>

    <legend>Personal information:</legend>

    <label> Name: </label>
    <input type="text" name="name">
    <div class="error" id="nameErr"></div>
    
    <label> Email:</label>
    <input type="text" name="email">
    <div class="error" id="emailErr"></div>

    <label> Password:</label>
    <input type="password" name="password">
    <div class="error" id="passErr"></div>
    
    <div class="form-inline">
    <label> Details: </label>
    <input type="text" name="det">
    <div class="error" id="detErr"></div>
    </div>

  <label> Gender:</label>
    <?php foreach ($gn as $g1 => $value): ?>
    <input type="radio" name="sx" value="<?php echo $value['sx']?>">
    <label><?php echo htmlspecialchars($value['sx']); ?></label><br>
    <?php endforeach; ?>
  <div class="error" id="genderErr"></div>
    
  <label> Hobbies </label>
    <select name="hob[]" multiple>
    <?php foreach ($hob as $h1 => $value): ?>
    <option value="<?php echo $value['h_nm']?>"> <?php echo htmlspecialchars($value['h_nm']); ?> </option>
    <?php endforeach; ?>
  <div class="error" id="hobErr"></div>
    </select>

  <label> Qualifications : </label>
  <?php foreach ($qa as $q1 => $value): ?>
  <input type="checkbox" name="qa[]" value="<?php echo $value['q_nm']?>">
  <label> <?php echo htmlspecialchars($value['q_nm']); ?> </label><br>
  <?php endforeach; ?>
                        

  <input type="submit" name="submit" value="submit">

  </fieldset>

</form>

</body>

</html>
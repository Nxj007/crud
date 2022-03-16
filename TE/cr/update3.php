<?php
include "config.php";

$query = 'SELECT * FROM master_hobby';
$hob = $link->query($query);

$query1 = 'SELECT * FROM master_qa';
$q = $link->query($query1);

$query2 = 'SELECT * FROM master_gender';
$gn = $link->query($query2);





$id = $_GET['id'];
$query3 = 'SELECT * FROM employees WHERE id =' . $_GET['id'];
$result = mysqli_query($link, $query3) or die(mysqli_error($link));
while ($row = mysqli_fetch_array($result)) {
  $name = $row["name"];
  $email = $row["email"];
  $password = $row["password"];
  $det = $row["det"];
  $gender = $row["gender"];
  $mhobby = $row["hby"];
  $mqn = $row["q_nm"]; //Qua Data
  // $mqn1 = explode(",", $mqn); // Str to Arr
  // print_r($mqn1);
  $salary = $row["salary"];
  $age = $row["age"];
}

$id = $_GET['id'];
// $ii = $_POST['id'];
?>
<!DOCTYPE html>

<html>

<head>

<body>
  <?php
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $dt = $_POST['det'];
  $gender = $_POST['sx'];
  $mhobby = $_POST['hob'];
  $qq = $_POST['qua'];
  $mqn = implode(",", $qq);
  $salary = $_POST['salary'];
  $age = $_POST['age'];

  include('connection.php');

  $query = 'UPDATE employees set name ="' . $name . '", email ="' . $email . '", password="' . $password . '",det=' . $dt . ', gender="' . $gender . '",hby=' . $mhobby . ', q_nm="' . $mqn . '",salary=' . $salary . ', age="' . $age . '" WHERE id ="' . $id . '"';
  $result = mysqli_query($link, $query) or die(mysqli_error($link));

  ?>
  <!-- <script type="text/javascript">
			alert("Update Successfull.");
			window.location = "index.php";
		</script> -->
</body>

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
      <!-- Radio Btn -->
      <?php foreach ($gn as $g1 => $value) : ?>
        <input type="radio" id="sx" name="sx" <?php if (in_array($gender, $value)) {
                                                echo "checked";
                                              } ?> value="<?php echo ($value['sx']); ?>">
        <label for="sx"><?php echo htmlspecialchars($value['sx']); ?></label><br>
      <?php endforeach; ?>
      <label>Gender</label>



      

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
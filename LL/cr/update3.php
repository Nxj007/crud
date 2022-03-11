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
  $mqn1 = explode(",", $mqn); // Str to Arr
  print_r($mqn1);
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
  $ii = $_POST['id'];
  $nn = $_POST['name'];
  $em = $_POST['email'];
  $pass = $_POST['password'];
  $dt = $_POST['det'];
  $gen = $_POST['sx'];
  $hh = $_POST['hob'];
  $qq = $_POST['qua'];
  $qq1 = implode(",", $qq);
  $sal = $_POST['salary'];
  $ag = $_POST['age'];

  include('connection.php');

  $query = 'UPDATE employees set name ="' . $nn . '", email ="' . $em . '", password="' . $pass . '",det=' . $dt . ', gender="' . $gen . '",hby=' . $hh . ', q_nm="' . $qq1 . '",salary=' . $sal . ', age="' . $ag . '" WHERE id ="' . $ii . '"';
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


      <br>Hobbies <br>
      <!-- Dropdown Btn  -->
      <select name="hob[]" multiple>
        <?php foreach ($hob as $h1 => $value1) : ?>

          <option value="<?php echo $mhobby; ?>">
            <?php echo ($value1['h_nm']); ?> </option>
        <?php endforeach; ?>

      </select>

      <br>
      Qualifications : <br>
      <!-- Checkbox -->
      <?php foreach ($q as $q1 => $value) : ?>
        <input type="checkbox" name="qua[]" <?php
        if (in_array($mqn, $mqn1)) {
          echo "checked";
        }
        ?> value="<?php echo $mqn; ?>">
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
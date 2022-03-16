<?php
include('config.php');

$query = 'SELECT * FROM master_hobby';
$hob = $link->query($query);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $mysqli->insert_id;
    $hobby = $_POST["hob"];
    $mhobby = implode(" ", $hobby);

    $sql1 = "INSERT INTO `e_hob` VALUES ('$id','$mhobby')";
    $result = $link->query($sql1);

    if ($result == TRUE) {
      echo "New record created successfully.";
    } else {

      echo "Error:" . $sql1 . "<br>" . $link->error;
    }
    $link->close();
  }
?>

<html>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<br>

<label> Hobbies: </label>
<div class="form-group">

<select value="<?php echo $hobby; ?>" name="hob[]" multiple >
<?php foreach ($hob as $h1 => $value) : ?>
<option value="<?php echo $value['h_nm'] ?>" name="hob[]"> <?php echo htmlspecialchars($value['h_nm']); ?> </option>
<?php endforeach; ?>
</div>
</select>
                        
    <input type="submit" name="submit" value="submit">
    <button> <a href="index.php">Cancel</a> </button>

</form>
</body>
       </html>
<?php
include('config.php');

$query1 = 'SELECT * FROM master_qa';
$qa = $link->query($query1);


if (isset($_POST['submit'])) {
    $id=mysqli_insert_id($link);
    $qua = $_POST["qa"];
    $mqn = implode(" ", $qua);

    $sql1 = "INSERT INTO `emp` VALUES ('$id','$mqn')";
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
       Qualifications : <br>
       <?php foreach ($qa as $q1 => $value) : ?>
         <input type="checkbox" name="qa[]" value="<?php echo $value['q_nm'] ?>">
         <label > <?php echo htmlspecialchars($value['q_nm']); ?> </label><br>
       <?php endforeach; ?>
       <br>
    <input type="submit" name="submit" value="submit">
    <button> <a href="index.php">Cancel</a> </button>

</form>
</body>
       </html>
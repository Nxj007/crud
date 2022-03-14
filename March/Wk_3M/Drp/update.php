<?php
include('config.php');

$query1 = 'SELECT * FROM master_hobby';
$hob = $link->query($query1);

if(isset($_REQUEST["id"]))
{
	  $id=$_REQUEST["id"];
    $query = (" SELECT * FROM e_hob where id='$id' ");
    $q=$link->query($query);
}

if(isset($_POST["submit"]))
{
  
  $hobby=$_POST["hob"];
  $mhobby = implode(" ", $hobby);
   $upd=("UPDATE e_hob set h_nm='$hobby' where id='$id' ");
   $q1=$link->query($upd);
	 header('location:index.php');
}

 /*if (isset($_POST['submit'])) {
    
    $hobby = $_POST['hobby'];
    $mhobby = implode(" ", $hobby);

    $sql1 = "INSERT INTO `e_hob` VALUES ('NULL','$mhobby')";
    $result = $link->query($sql1);

    if ($result == TRUE) {
      echo "New record created successfully.";
    } else {

      echo "Error:" . $sql1 . "<br>" . $link->error;
    }
    $link->close();
  } */
?>


<html>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<br>

<label> Hobbies: </label>
<select value="<?php echo $hobby; ?>" name="hobby">
<?php foreach ($hob as $h1 => $value) : ?>
<option value="<?php echo $value['h_nm'] ?>">
<?php 
if($value["h_nm"]=='$hobby') {echo "selected";} ?>
<?php echo htmlspecialchars($value['h_nm']); ?> </option>
<?php endforeach; ?>
</select>
                        
    <input type="submit" name="submit" value="submit">
    <button> <a href="index.php">Cancel</a> </button>

</form>
</body>
       </html>
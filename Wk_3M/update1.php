<?php
include('config.php');

$query1 = 'SELECT * FROM master_qa';
$qa = $link->query($query1);

if(isset($_REQUEST["id"]))
{
	  $id=$_REQUEST["id"];
	  $query = ("SELECT * FROM emp where id='$id'");
	  $q=$link->query($query);
	  $a=$row["qua"];
	  $b=explode(",",$a);
}

if(isset($_REQUEST["submit"]))
{
	$upd=("UPDATE emp set qua='$d' where id='$id' ");
	$upd1 = $link->query($upd);

	$c=$_REQUEST["qua"];
	$d=implode(" ",$c);
	header('location:select.php');
}
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<table border="1" align="center">

<tr>

<label>Qualifications</label>
<td>
<?php foreach ($qa as $q1 => $value1) : ?>
<input type="checkbox" name="qua[]" <?php if (in_array($a, $b)) { echo "checked"; } ?> value="<?php echo $qa ?>">
<!-- echo htmlspecialchars($value1['q_nm']); ?> <br>  -->
<?php echo htmlspecialchars($value1['q_nm']); ?> <br>
<?php endforeach; ?>

</td>


<td><input type="submit" value="submit" name="submit"></td>
</tr>
</table>
</form>
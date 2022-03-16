<?php
include 'config.php';

$query1 = 'SELECT * FROM master_qa';
$q = $link->query($query1);

if(isset($_REQUEST["eid"]))
{
	  $eid=$_REQUEST["eid"];
	  $query = "SELECT * FROM emp where eid='$eid'";
	  $row = $link->query($query);	 
	  $a=$row["qua"];
	  $b=explode(",",$a);
	  
	  
}

if(isset($_REQUEST["submit"]))
{
	
	 $c=$_REQUEST["qua"];
	 $d=implode(",",$c);
	 $sql1 = "UPDATE `emp` SET ()  WHERE eid='$eid' ";
	
}
?>


<form method="post">
<table border="1" align="center">

<tr>
<td>Qualifications</td>
<td>
<?php foreach ($q as $q1 => $value) : ?>
<input type="checkbox" id="q" name="q[]" value="<?php echo $value['q_nm'] ?>"
<?php 
if(in_array($value['q_nm'],$b))
{
	  echo "checked";
}

?>

></td>
<label> <?php echo htmlspecialchars($value['q_nm']); ?> </label><br>
    <?php endforeach; ?>


</tr>

<tr>
<td><input type="submit" value="submit" name="submit"></td>
</tr>
</table>
</form>
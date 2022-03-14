<?php
include('config.php');
if(isset($_REQUEST["eid"]))
{
	  $eid=$_REQUEST["eid"];
	  $query=mysql_query("select * from user where id='$eid'");
	  $row=mysql_fetch_array($query);
	  $a=$row["education"];
	  $b=explode(",",$a);
	  
	  
}

if(isset($_REQUEST["submit"]))
{
	
	 $c=$_REQUEST["education"];
	 $d=implode(",",$c);
	 mysql_query("update user set education='$d' where id='$eid'");
	 header('location:select.php');
}
?>


<form method="post">
<table border="1" align="center">

<tr>
<td>Education</td>
<td><input type="checkbox" name="education[]" value="diploma"

<?php 
if(in_array("diploma",$b))
{
	  echo "checked";
}

?>

>Diploma
<input type="checkbox" name="education[]" value="b.tech" <?php 
if(in_array("b.tech",$b))
{
	  echo "checked";
}

?>>B.tech
<input type="checkbox" name="education[]" value="mba" <?php 
if(in_array("mba",$b))
{
	  echo "checked";
}

?>>MBA
</td>
</tr>

<tr>
<td><input type="submit" value="submit" name="submit"></td>
</tr>
</table>
</form>
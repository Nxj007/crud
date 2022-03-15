<?php
error_reporting(0);
?>
<?php
$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {

	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];	
		$folder = "image/".$filename;
		
	$database = mysqli_connect("localhost", "root", "root", "crud");

		// Get all the submitted data from the form
		$sql = "INSERT INTO `imag` VALUES ('$filename')";

		// Execute query
		mysqli_query($database, $sql);
		
		// Now let's move the uploaded image into the folder: image
		if (move_uploaded_file($tempname, $folder)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
	}
}
$sql1 = "SELECT * FROM `imag` ";
$result = mysqli_query($database, $sql1);
while($data = mysqli_fetch_array($result))
{

	?>
<img src="<?php echo $data['Filename']; ?>">

<?php
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Image Upload</title>
<link rel="stylesheet" type= "text/css" href ="style.css"/>
<div id="content">

<form method="POST" action="" enctype="multipart/form-data">
	<input type="file" name="uploadfile" value=""/>
		
	<div>
		<button type="submit" name="upload">UPLOAD</button>
		</div>
</form>
</div>
</body>
</html>

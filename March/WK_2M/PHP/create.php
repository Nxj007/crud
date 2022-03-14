<?php
include 'partials/_dbconnect.php';
// 1. Add enctype="multipart/form-data" to form
// 2. var_dump $_FILES
// echo '<pre>';
// var_dump($_FILES);
// echo '</pre>';

// 5. Create $errorMessage variable
$errorMessage = '';
// 3. Check if file was uploaded and save it locally
if (isset($_FILES['file'])) {
  if (isset($_POST['submit'])) {

  // 7. Get the file extension
  $imgtitle = $_POST['imagetitle'];
  $imgfile = $_FILES['file']["name"];

  $ext = pathinfo($imgfile, PATHINFO_EXTENSION);
  // 9. Convert $ext into lowercase
  $ext = strtolower($ext);
  

  // 4. Check if the file size is more than 5MB and show error
  if ($_FILES['file']['size'] > 5 * 1024 * 1024) {
    $errorMessage = 'File size can not be more than 5MB';
    // 6. Display error message in HTML
  } elseif (!in_array($ext, ['jpg', 'png', 'jpeg', 'svg'])) { 
    $errorMessage = 'You can only upload images';
  } elseif ($_FILES['file']['error'] === 0) {
    $sql = "INSERT INTO `tblimages` VALUES (NULL,$imgtitle, $imgfile)";
    $query = mysqli_query($link, $sql);
    
  }
  
}
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <p><?php echo $errorMessage ?></p>
  <form name="uploadimage" method="post" enctype="multipart/form-data">
    <tr>
      <th width="26%" height="60" scope="row">Image Title:</th>
      <td width="74%"><input type="text" name="imagetitle" autocomplete="off" class="form-control" required /></td>
    </tr>

    <th height="60" scope="row">Upload Image :</th>
    <input type="file" name="file"><br>
    <td><input type="submit" value="Submit" name="submit" class="btn-primary" /></td>
  </form>
</body>

</html>
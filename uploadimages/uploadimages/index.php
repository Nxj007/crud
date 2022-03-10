<?php

include_once("config.php");

if(isset($_POST['submit']))

{

// Posted Values    

$imgtitle=$_POST['imagetitle'];

$imgfile=$_FILES["image"]["name"];

// get the image extension

$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));

// allowed extensions

$allowed_extensions = array(".jpg","jpeg",".png",".gif");

// Validation for allowed extensions

if(!in_array($extension,$allowed_extensions))

{

echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";

}

else

{

//rename the image file

$imgnewfile=md5($imgfile).$extension;  

// Code for move image into directory

move_uploaded_file($_FILES["image"]["tmp_name"],"uploadeddata/".$imgnewfile);

// Query for insertion data into database  

$query=mysqli_query($con,"insert into tblimages(ImagesTitle,Image) values('$imgtitle','$imgnewfile')");

if($query)

{

echo "<script>alert('Data inserted successfully');</script>";

}

else

{

echo "<script>alert('Data not inserted');</script>";

}}



}

 ?>

<!DOCTYPE html>

<html lang="en">

	<head>

		<meta http-equiv="content-type" content="text/html; charset=UTF-8">

		<meta charset="utf-8">

		<title>PHP GURUKUL | Upload Images</title>

		<meta name="generator" content="Bootply" />

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<link href="css/bootstrap.min.css" rel="stylesheet">

		<link href="css/styles.css" rel="stylesheet">

	</head>

	<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

	<div class="navbar-header">

        <a class="navbar-brand" rel="home" href="https://phpgurukul.com/">PHPGURUKUL</a>

		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

		<span class="sr-only">Toggle navigation</span>

		<span class="icon-bar"></span>

		<span class="icon-bar"></span>

		<span class="icon-bar"></span>

		</button>

	</div>

	

</nav>



<div class="container-fluid">

  

     

 <!--/left-->

  

  <!--center-->

  <div class="col-sm-6">

    <div class="row">

      <div class="col-xs-12">

        <h3>How to upload image in PHP</h3>



<form name="uploadimage" enctype="multipart/form-data" method="post">

<table width="100%"  border="0">

<tr>

<th width="26%" height="60" scope="row">Image Title:</th>

<td width="74%"><input type="text" name="imagetitle" autocomplete="off" class="form-control" required /></td>

</tr>



<tr>

<th height="60" scope="row">Upload Image :</th>

<td><input type="file" name="image"  required /></td>

</tr>



<tr>

<th height="60" scope="row">&nbsp;</th>

<td><input type="submit" value="Submit" name="submit" class="btn-primary" /></td>

</tr>

</table>

</form>

 

      </div>

    </div>

    <hr>

        

   

  </div><!--/center-->
 <div class="col-sm-6">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- newone1 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-8906663933481361"
     data-ad-slot="2147202735"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>


</div><!--/container-fluid-->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- horizental ad -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-8906663933481361"
     data-ad-slot="6662734336"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
	<!-- script references -->

		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

		<script src="js/bootstrap.min.js"></script>

	</body>

</html>
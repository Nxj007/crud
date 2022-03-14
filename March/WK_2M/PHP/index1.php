<?php
include 'partials/_dbconnect.php';

if (isset($_POST['submit'])) {
    // Posted Values
    $imgtitle = $_POST['imagetitle'];
    $imgfile = $_FILES["image"]["name"];
    // get the image extension
    $ext = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
    // allowed extensions
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
    // Validation for allowed extensions .in_array() function searches an array for a specific value.
    if (!in_array($ext, $allowed_extensions)) {
        echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {
        //rename the image file
        $imgnewfile = md5($imgfile) . $ext;
        // Code for move image into directory
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploadeddata/" . $imgnewfile);
        // Query for insertion data into database
        $sql = "INSERT INTO `tblimages` VALUES (NULL,$imgtitle, $imgfile)";
        $query = mysqli_query($link, $sql);
        if ($query) {
            echo "<script>alert('Data inserted successfully');</script>";
        } else {
            echo "<script>alert('Data not inserted');</script>";
        }
    }
}
?>
<html>
<form name="uploadimage" enctype="multipart/form-data" method="post">
    <table width="100%" border="0">
        <tr>
            <th width="26%" height="60" scope="row">Image Title:</th>
            <td width="74%"><input type="text" name="imagetitle" autocomplete="off" class="form-control" required /></td>
        </tr>
        <tr>
            <th height="60" scope="row">Upload Image :</th>
            <td><input type="file" name="image" required /></td>
        </tr>
        <tr>
            <th height="60" scope="row">&nbsp;</th>
            <td><input type="submit" value="Submit" name="submit" class="btn-primary" /></td>
        </tr>
    </table>
</form>

</html>
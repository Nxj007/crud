<?php

require_once("connection.php");

if(isset($_REQUEST["btn_insert"]))
{
	if(isset($_REQUEST["chk_fruit"]))
	{
		$fruit=implode(",",$_REQUEST["chk_fruit"]);
	}
	
	if(empty($fruit))
	{
		$errorMsg="Please Select Checkbox";
	}
	else
	{
		try
		{
			if(!isset($errorMsg))
			{
				$insert_stmt=$db->prepare("INSERT INTO tbl_fruits(name) VALUES(:fname)"); //sql insert query					
				$insert_stmt->bindParam(':fname',$fruit);	//bind parameter
				
				if($insert_stmt->execute())
				{
					$insertMsg="Insert Successfullt....."; //execute query success message
					header("refresh:3;index.php"); //refresh 3 second and after redirect to index.php page
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Multiple Checkbox Value Add,Edit,Delete in PHP PDO With MySQL</title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="js/jquery-1.12.4-jquery.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
	
    <body>
	<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="https://onlyxscript.blogspot.com/">onlyxscript.blogspot.com</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="https://onlyxscript.blogspot.com/2019/01/multiple-checkbox-value-add-edit-delete.html">Back to Tutorial</a></li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="wrapper">
	
	<div class="container">
				<h2 align="center">Insert Page</h2><br>
		<div class="col-lg-12">
			
			<form method="post" class="form-horizontal">
			
				<div class="form-group">
				<label class="col-sm-5 control-label">Hobbies</label>
				<div class="col-sm-6">
				<input type="checkbox" name="chk_fruit[]" value="apple">Apple	
				<input type="checkbox" name="chk_fruit[]" value="banana">Banana	
				<input type="checkbox" name="chk_fruit[]" value="orange">Orange	
				<input type="checkbox" name="chk_fruit[]" value="mango">Mango	
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-sm-offset-5 col-sm-9 m-t-15">
				<input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
				<a href="index.php" class="btn btn-danger">Cancel</a>
				</div>
				</div>
				
			</form>
			
			<?php
			if(isset($errorMsg))
			{
				?>
				<div class="alert alert-danger">
					<strong>WRONG ! <?php echo $errorMsg; ?></strong>
				</div>
				<?php
			}
			if(isset($insertMsg)){
			?>
				<div class="alert alert-success">
					<strong>SUCCESS ! <?php echo $insertMsg; ?></strong>
				</div>
			<?php
			}
			?>   
			
		</div>
		
	</div>
	
	</div>
	
    
	</body>
</html>
	

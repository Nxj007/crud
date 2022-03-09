<?php

error_reporting( ~E_NOTICE ); //avoid error notice

require_once("connection.php");

if(isset($_REQUEST["update_id"]))
{
	try
	{
		$id = $_REQUEST["update_id"]; //get "update_id" from index.php file through anchor tag operation and store in "$id" variable
		$select_stmt = $db->prepare("SELECT * FROM tbl_fruits WHERE id =:id"); //sql select query
		$select_stmt->bindParam(":id",$id); //bind parameter 
		$select_stmt->execute(); //execute query
		$row = $select_stmt->fetch(PDO::FETCH_ASSOC); //fetch record and store in "$row" variable
		extract($row);
	}
	catch(PDOException $e)
	{
		$e->getMessage();
	}
}

if(isset($_REQUEST['btn_update']))
{
	if(isset($_REQUEST["chk_fruit"]))
	{
		$fruit_update=implode(",",$_REQUEST["chk_fruit"]);	//checkbox name "chk_fruit"
	}
		
	if(empty($fruit_update))
	{
		$errorMsg="Please Select Checkbox Fruit";
	}
	else
	{	
		try
		{
			if(!isset($errorMsg))
			{
				$update_stmt=$db->prepare('UPDATE tbl_fruits SET name=:fruit_up WHERE id=:id'); //sql update query
				$update_stmt->bindParam(':fruit_up',$fruit_update);
				$update_stmt->bindParam(':id',$id);					//bind all parameter
				 
				if($update_stmt->execute())	//execute query
				{
					$updateMsg="Record Update Successfully.......";	//update success message
					header("refresh:3;index.php");	//refresh 3 second and after redirect to index.php page
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
				<h2 align="center">Edit Page</h2><br>
		<div class="col-lg-12">
			
			<form method="post" class="form-horizontal">
			
				<div class="form-group">
				<label class="col-sm-5 control-label">Hobbies</label>
				<div class="col-sm-6">
				<?php
				
				$divide=explode(",",$row["name"]);
				
				$fruit=array("apple","banana","orange","mango");
					
				foreach($fruit as $result)
				{
					
					if($result==$divide[0] OR $result==$divide[1] OR $result==$divide[2] OR $result==$divide[3])
                    {
					?>
						<input checked="checked" type="checkbox" name="chk_fruit[]" value="<?php echo $result;?>"><?php echo $result;?>
					<?php
					}
					else
					{
					?>
						<input type="checkbox" name="chk_fruit[]" value="<?php echo $result;?>"><?php echo $result;?>
					<?php
					}
					
				}
			
				?>	
				</div>
				</div>
			
				
				<div class="form-group">
				<div class="col-sm-offset-5 col-sm-9 m-t-15">
				<input type="submit" name="btn_update" class="btn btn-primary" value="Update">
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
			if(isset($updateMsg)){
			?>
				<div class="alert alert-success">
					<strong>SUCCESS ! <?php echo $updateMsg; ?></strong>
				</div>
			<?php
			}
			?>   
			
		</div>
		
	</div>
	
	</div>
	
    
	</body>
</html>
	

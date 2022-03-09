<?php

require_once ("connection.php");
	
if(isset($_REQUEST['delete_id']))
{
	// select record from db to delete
	$id=$_REQUEST['delete_id'];	//get delete_id though anchor tag operation and store in $id variable
		
	$select_stmt= $db->prepare('SELECT * FROM tbl_fruits WHERE id =:id');	//sql select query
	$select_stmt->bindParam(':id',$id);	//bind parameter
	$select_stmt->execute();
	$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
		
	//delete an orignal record from db
	$delete_stmt = $db->prepare('DELETE FROM tbl_fruits WHERE id =:id');
	$delete_stmt->bindParam(':id',$id);
	$delete_stmt->execute();
	
	header("Location:index.php");
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
		<div class="col-lg-12">
			
			<div class="panel panel-default">
                        <div class="panel-heading">
                           <h3><a href="add.php"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Record</a></h3>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									
									$select_stmt=$db->prepare("SELECT * FROM tbl_fruits"); //sql select query
									$select_stmt->execute();
									while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
									{									
									?>
                                        <tr>
                                            <td><?php echo $row["name"]; ?></td>
                                            <td><a href="edit.php?update_id=<?php echo $row["id"]; ?>" class="btn btn-warning">Edit</a></td>
                                            <td><a href="?delete_id=<?php echo $row["id"]; ?>" class="btn btn-danger">Delete</a></td>
                                        </tr>
                                    <?php
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
			
			
		</div>
		
	</div>
	
	</div>
	
    
	</body>
</html>
	

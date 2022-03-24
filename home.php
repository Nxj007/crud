<?php
session_start();
require_once "config.php";
if (!isset($_SESSION['username'])) {
  echo "<script>window.open('login.php','_self');</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>php login system</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="container mt-3">
    <?php
    require_once "config.php";
    if (isset($_GET['del'])) {
      $del_id = $_GET['del'];
      // $delete="DELETE FROM emp_data WHERE emp_id='$del_id'";
      if($_SESSION['username']=='kalyani@gmail.com'){
      $delete = "DELETE emp_data, hobbies,study
       FROM emp_data
       INNER JOIN hobbies ON emp_data.emp_id = hobbies.emp_id
       INNER JOIN study ON emp_data.emp_id = study.emp_id
       WHERE emp_data.emp_id='$del_id'";
      $run_delete = mysqli_query($conn, $delete);
      if ($run_delete == true) {
        $_SESSION['username'] = "DATA HAS BEEN DELETED";
        if (isset($_SESSION['username'])) {
    ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong></strong><?php echo $_SESSION['username']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

    <?php
     // unset($_SESSION['username']);
        }
      }
    }
  }




    ?>
    <?php

    require_once "config.php";
    if (isset($_GET['login'])) {
      echo $id = $_GET['login'];
    }
    ?>
    <h2>Employee Data</h2>
    <p></p>
    <table class="table table-dark">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>First_name</th>
          <th>Last_name</th>
          <th>Age</th>
          <th>Image</th>
          <th>details</th>
          <th>Gender</th>
          <th>hobbies</th>
          <th>Qualification</th>
          <th>DELETE</th>
          <th>UPDATE</th>

        </tr>
      </thead>
      <tbody>
        <?php
        require_once "config.php";
        // $select="SELECT * FROM emp_data where username='".$_SESSION['username']."' ";
        $select = "SELECT emp_data.emp_id,emp_data.username,emp_data.password,emp_data.emp_fname,emp_data.emp_lname,emp_data.emp_age,emp_data.emp_img,emp_data.emp_details,emp_data.emp_gender,emp_data.user_type
          FROM emp_data";

        // $select ="SELECT * FROM emp_data";
        // $select="select emp_data.emp_id, emp_data.username,emp_data.emp_fname, emp_data.emp_lname,emp_data.emp_age,emp_data.emp_img,emp_data.emp_details,emp_data.emp_gender,emp_data.user_type,hobbies_view.hobbies,study_view.emp_study from emp_data
        // INNER JOIN hobbies_view ON emp_data.emp_id = hobbies_view.emp_id
        //INNER JOIN study_view ON emp_data.emp_id = study_view.emp_id";


        $run = mysqli_query($conn, $select);
        while ($row_emp = mysqli_fetch_array($run)) {
          $ID = $row_emp['emp_id'];
          $username = $row_emp['username'];
          $name = $row_emp['emp_fname'];
          $lastname = $row_emp['emp_lname'];
          $Age = $row_emp['emp_age'];
          $image = $row_emp['emp_img'];
          $details = $row_emp['emp_details'];
          $Gender = $row_emp['emp_gender'];
          // $usertype=$row_emp['user_type'];
          // $hobbies=$row_emp['hobbies'];

          // $study=$row_emp['emp_study'];
          //$s_row[]=$study;
          //echo $checks= implode(",",$s_row);
          //  $h_row[]=$hobbies;
          // $check= implode(",",$h_row);
          //echo $check;
          // $checkhob = implode(",", $hobbies);



        ?>

          <?php
          // $l_id = $conn->insert_id;
          $select1 = "SELECT hobbies FROM hobbies_view where hobbies_view.emp_id='$ID'";
          $runs = mysqli_query($conn, $select1);
          $h_row = [];
          while ($row_emp1 = mysqli_fetch_array($runs)) {
            $hobbies = $row_emp1['hobbies'];
            $h_row[] = $hobbies;
          }
          ?>
          <?php
          $check = implode(",", $h_row);

          ?>
          <?php
          // $l_id = $conn->insert_id;
          $select2 = "SELECT emp_study FROM study_view where study_view.emp_id='$ID'";
          $runs = mysqli_query($conn, $select2);
          $s_row = [];
          while ($row_emp2 = mysqli_fetch_array($runs)) {
            $study = $row_emp2['emp_study'];
            $s_row[] = $study;
          }

          $studys = implode(",", $s_row);

          ?>

          <tr>
            <td><?php echo $ID ?></td>
            <td><?php echo $username ?></td>
            <td><?php echo $name ?></td>
            <td><?php echo $lastname ?></td>
            <td><?php echo $Age ?></td>
            <td><img src="upload/<?php echo $image; ?>" height=30px"></td>
            <td><?php echo $details ?></td>
            <td><?php echo $Gender ?></td>
            <td><?php echo $check ?></td>
            <td><?php echo $studys ?></td>



            <td><a class="btn btn-danger" href="home.php?del=<?php echo $ID; ?>">Delete</a></td>
            <td><a class="btn btn-success" href="edit_emp.php?edit=<?php echo $ID; ?>">EDIT</a></td>
          <?php  } ?>






          </tr>


          <a class="btn btn-danger" href="logout.php">logout</a>
          <a class="btn btn-danger" href="register.php" style="float: right;">Add employee here</a>
      </tbody>
    </table>

  </div>

</body>

</html>
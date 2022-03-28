<?php
session_start();
require_once "db.php";
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
    require_once "db.php";
    if (isset($_GET['del'])) {
      $del_id = $_GET['del'];
      // $delete="DELETE FROM emp_data WHERE eid='$del_id'";
      $delete = "DELETE employee, e_hob,e_qa
       FROM employee
       INNER JOIN e_hob ON employee.eid = e_hob.eid
       INNER JOIN e_qa ON employee.eid = e_qa.eid
       WHERE employee.eid='$del_id'";
      $run_delete = mysqli_query($link, $delete);
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




    ?>
    <?php

    require_once "db.php";
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
          <th>Email</th>
          <th>First_name</th>
          <th>Age</th>
          <th>Image</th>
          <th>Details</th>
          <th>Gender</th>
          <th>Hobbies</th>
          <th>Qualification</th>

          <th>DELETE</th>
          <th>UPDATE</th>

        </tr>
      </thead>
      <tbody>
        <?php
        require_once "db.php";
        // $select="SELECT * FROM emp_data where username='".$_SESSION['username']."' ";
        $select = "SELECT * FROM employee";

        // $select ="SELECT * FROM emp_data";
        // $select="select emp_data.emp_id, emp_data.email,emp_data.emp_fname, emp_data.emp_lname,emp_data.emp_age,emp_data.emp_img,emp_data.emp_details,emp_data.emp_gender,emp_data.user_type,hobbies_view.hobbies,study_view.emp_study from emp_data
        // INNER JOIN hobbies_view ON emp_data.emp_id = hobbies_view.emp_id
        //INNER JOIN study_view ON emp_data.emp_id = study_view.emp_id";


        $run = mysqli_query($link, $select);
        while ($row_emp = mysqli_fetch_array($run)) {
          $ID = $row_emp['emp_id'];
          $email = $row_emp['email'];
          $name = $row_emp['emp_fname'];
          $Age = $row_emp['emp_age'];
          $image = $row_emp['emp_img'];
          $details = $row_emp['emp_details'];
          $Gender = $row_emp['emp_gender'];
          // $usertype=$row_emp['user_type'];
          // $hobbies=$row_emp['hobbies'];

          // $q_nm=$row_emp['emp_study'];
          //$s_row[]=$q_nm;
          //echo $checks= implode(",",$s_row);
          //  $h_row[]=$hobbies;
          // $hobb= implode(",",$h_row);
          //echo $hobb;
          // $checkhob = implode(",", $hobbies);



        ?>

          <?php
          // $l_id = $link->insert_id;
          $select1 = "SELECT h_nm FROM hobby_view where hobby_view.eid='$ID'";
          $result1 = mysqli_query($link, $select1);
          $h_row = [];
          while ($row_emp1 = mysqli_fetch_array($result1)) {
            $h_nm = $row_emp1['h_nm'];
            $h_row[] = $h_nm;
          }
          ?>
          <?php
          $hobb = implode(",", $h_row);

          ?>
          <?php
          // $l_id = $link->insert_id;
          $select2 = "SELECT q_nm FROM qa_view where qa_view.eid='$ID'";
          $result2 = mysqli_query($link, $select2);
          $q_row = [];
          while ($row_emp2 = mysqli_fetch_array($result2)) {
            $q_nm = $row_emp2['q_nm'];
            $q_row[] = $q_nm;
          }

          $qaul = implode(",", $q_row);

          ?>

          <tr>
            <td><?php echo $ID ?></td>
            <td><?php echo $email ?></td>
            <td><?php echo $name ?></td>
            <td><?php echo $lastname ?></td>
            <td><?php echo $Age ?></td>
            <td><img src="upload/<?php echo $image; ?>" height="30px"></td>
            <td><?php echo $details ?></td>
            <td><?php echo $Gender ?></td>
            <td><?php echo $hobb ?></td>
            <td><?php echo $qaul ?></td>



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
<?php
if (isset($_GET["eid"]) && !empty(trim($_GET["eid"]))) {
      // Get URL parameter
      $eid =  trim($_GET["eid"]);
      // Prepare a select statement
      $sql = "SELECT * FROM employees WHERE eid = '$eid' ";
      $stmt = mysqli_prepare($link, $sql);
        $sql1 = "SELECT * FROM e_gender WHERE eid = '$eid' ";
        $stmt1 = mysqli_prepare($link, $sql1) or mysqli_connect_error($link);
      $sql2 = "SELECT * FROM e_hob WHERE eid = '$eid' ";
      $stmt2 = mysqli_prepare($link, $sql2);
      $sql3 = "SELECT * FROM e_qa WHERE eid = '$eid' ";
      $stmt3 = mysqli_prepare($link, $sql3);
      if($stmt==0){
        $result = mysqli_stmt_execute($stmt);
        $result1 = mysqli_stmt_execute($stmt1);
        if(mysqli_stmt_get_result($result)){
          if (mysqli_num_rows($result) == 1) {
            /* Fetch result row as an associative array. Since the result set
            contains only one row, we don't need to use while loop */
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            // Retrieve individual field value
            $name = $row["name"];
            $email = $row["email"];
            $password = $row["password"];
            $det = $row["det"];
            $salary = $row["salary"];
            $age = $row["age"];
            $img = $row["image"];
            $uty = $row["utype"];
        } else {
            // URL doesn't contain valid id. Redirect to error page
            header("location: error.php");
            exit();
        }
    }
}
}
  ?>
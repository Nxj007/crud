<?php
include "config.php";

$query = 'SELECT * FROM master_hobby';
$hob = $link->query($query); // Dropdown Btn 

$link->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width= <label>Hobby</label>
    <div class="form-group">
        <select name="hob[]" multiple>
            <?php
            if (isset($_POST['hob'])) {
                $eid = 432; 
                // $eid =  trim($_GET["eid"]);
                $hob_up = $_POST['hob'];
                $query3 = " SELECT * FROM `e_hob` WHERE eid = $eid ";
                $q_run = mysqli_query($link, $query3);
                $hob_val = []; // Empty Values

                foreach ($q_run as $hob_dt) {
                    $hob_val = $hob_dt['hid'];
                    echo $hob_dt['hid'];
                }
                foreach ($hob_up as $in_val) { // Insert Data
                    if (!in_array($in_val, $hob_val)) {
                        echo $in_val . " Insert <br> ";
                        $ins_qry = " INSERT INTO `e_hob` VALUES ($eid, $in_val) ";
                        $ins_qry_run = mysqli_query($link, $ins_qry);
                    }
                }
                foreach ($hob_val as $hob_rw) { // Delete Data
                    if (!in_array($hob_rw, $hob_up)) {
                        echo $hob_rw . "Deleted <br>";
                        $del_qry = " DELETE FROM `e_hob` WHERE eid=$eid and hid=$hob_rw ";
                        $del_qry_run = mysqli_query($link, $del_qry);
                    }
                }
                header("location: index.php");
                exit(0);
            }

            ?>
            <!-- $mhobbby = implode(",", $row['hby']);  -->
            <?php foreach ($hob as $h1 => $value) : ?>
               
                <option value="<?php echo $value['hid'] ?>" >
                    <?php echo htmlspecialchars($value['h_nm']);   ?></option>
            <?php endforeach ?>
        </select>
    </div>
</head>
<body>
    
</body>
</html>
<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'ims');



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['assign_id'];     
        $svisor= test_input($_POST['svisor']);
        print_r($id);
        $query = "UPDATE student SET SUPERVISOR ='$svisor' WHERE STUDENT_ID = '$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:staff_studentlist.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>
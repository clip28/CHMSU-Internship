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
        $id = $_POST['update_id'];
        
        $sname = test_input($_POST['sname']);
         $email = test_input($_POST['email']);

        $course = test_input($_POST['course']);

        $gender = test_input($_POST['gender']);

        $ystdy = test_input($_POST['ystdy']);
 

        $query = "UPDATE student SET NAME='$sname', STUDENT_EMAIL='$email', COURSE='$course', GENDER=' $gender', YEAR_OF_STUDY='$ystdy' WHERE STUDENT_ID='$id'";

      
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
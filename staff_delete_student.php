<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'ims');

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];


    $query = "DELETE FROM student_review_table WHERE STUDENT_ID = '$id'";
    $query_run = mysqli_query($connection, $query);

    $query = "DELETE FROM applicants WHERE STUDENT_ID ='$id'";
    $query_run = mysqli_query($connection, $query);

    $query = "DELETE FROM student WHERE STUDENT_ID ='$id'";
    $query_run = mysqli_query($connection, $query);


    if($query_run)
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("Location:staff_studentlist.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
        header("Location:staff_studentlist.php");
    }
}

?>




















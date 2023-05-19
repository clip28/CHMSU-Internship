<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'ims');

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
    print_r($id);


    $nodelete = "SELECT * FROM applicants a inner join jobs j on a.Job_ID = j.Job_ID WHERE j.REGIS_NO = '$id' and Status is not null";
    $checkrows = mysqli_query($connection, $nodelete);
    $count = mysqli_num_rows($checkrows);



            if ($count > 0) {


                header("Location: staff_companylist.php?msg=1");

            }
            else{

                    


                    $query = "DELETE FROM jobs WHERE REGIS_NO ='$id'";
                    $query_run = mysqli_query($connection, $query);


                    $query = "DELETE FROM industry WHERE REGIS_NO ='$id'";
                    $query_run = mysqli_query($connection, $query);

                    if($query_run)
                    {
                        echo '<script> alert("Data Deleted"); </script>';
                       header("Location:staff_companylist.php");
                    }
                    else
                    {
                        echo '<script> alert("Data Not Deleted"); </script>';
                       header("Location:staff_companylist.php");
                    }
                }
}

?>
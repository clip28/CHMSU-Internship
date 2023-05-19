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
        
        $cname = test_input($_POST['cname']);
        $address = test_input($_POST['address']);
        $website = test_input($_POST['website']);
        $contact = test_input($_POST['contact']);
        $email = test_input($_POST['email']);

        $query = "UPDATE industry SET COMPANY_NAME='$cname', COMPANY_ADDRESS='$address', WEBSITE='$website', CONTACT_NO=' $contact', Email ='$email' WHERE REGIS_NO='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:staff_companylist.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>
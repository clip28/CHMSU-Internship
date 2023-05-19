
<?php
			
			// include autoloader
			require_once 'dompdf/autoload.inc.php';
 
			// reference the Dompdf namespace
			use Dompdf\Dompdf;





			if(isset($_GET['data'])){
			// instantiate and use the dompdf class
			$pdf = new Dompdf();

             $pdf->set_option('isRemoteEnabled', TRUE);


      //$dompdf = new Dompdf(array('enable_remote' => true));


             if(isset($_GET['data'])){

               $hid = $_GET['data'];
            

             } 

               $connection = mysqli_connect("localhost","root","");
               $db = mysqli_select_db($connection, 'ims');

                $getid = "SELECT * from history where id = '$hid'";
                $qgetid  = mysqli_query($connection, $getid);
                $y = mysqli_fetch_assoc($qgetid);

                $cid = $y['Student_id'];
                $jid = $y['Job_ID'];
                var_dump($jid);

                $query = "SELECT * from student where STUDENT_ID = '$cid'";
                $query_run = mysqli_query($connection, $query);
                $x = mysqli_fetch_assoc($query_run);
                $sname = $x['NAME'];

			//Using html contents here
			//using output buffer
			ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<?php


?>
<h1 style="color: green; text-align: center ;"> <?php echo "$cid" ?> </h1>
<h2 style="text-align: center;">Student Report </h2>
<p><?php echo "$sname" ?> has completed the WIL internship program, this document provides information about the company and job details they worked on. This is a demo document.</p>
<br>

<p>Student details: </p>


<table>
  <tr><th>STUDENT ID</th><td><?php echo $x['STUDENT_ID']; ?></td></tr>
  <tr><th>Student Name</th></th><td><?php echo $x['NAME']; ?></td></tr>
  <tr><th>Student Email</th></th><td><?php echo $x['STUDENT_EMAIL']; ?></td></tr>
  <tr><th>Course</th></th><td><?php echo $x['COURSE']; ?></td></tr>
  <tr><th>Supervisor</th></th><td><?php echo $x['SUPERVISOR']; ?></td></tr>
  <tr><th>Gender</th></th><td><?php echo $x['GENDER']; ?></td></tr>
  <tr><th>Address</th></th><td><?php echo $x['CURRENT_RESIDENCE']; ?></td></tr>
  <tr><th>Contact Number</th></th><td><?php echo $x['CONTACT_NO']; ?></td></tr>
  <tr><th>Year of Study</th></th><td><?php echo $x['YEAR_OF_STUDY']; ?></td></tr>
</table>
<p>Company Details:</p>

<table>
      <?php

            $newquery = "SELECT * from history h inner join student s on h.Student_id = s.STUDENT_ID inner join applicants a on s.STUDENT_ID = a.STUDENT_ID inner join jobs j on a.Job_ID = j.Job_ID inner join industry i on j.REGIS_NO = i.REGIS_NO WHERE h.id ='$hid' and j.Job_ID = '$jid' AND (a.Status = 'Ended' OR a.Status = 'Completed')";
            $y = mysqli_query($connection, $newquery);
           foreach($y as $row)
         {
      ?>
     
        <tr><th>Company Name</th><td><?php echo $row['COMPANY_NAME']; ?></td></tr>
        <tr><th>Registration Number</th><td><?php echo $row['REGIS_NO']; ?> </td></tr>
        <tr><th>Email address</th><td><?php echo $row['Email']; ?> </td></tr>
        <tr><th>Category</th><td><?php echo $row['Category']; ?> </td></tr>
        <tr><th>Job ID</th><td><?php echo $row['Job_ID']; ?> </td></tr>
        <tr><th>Job Title</th><td><?php echo $row['Job_Title']; ?> </td></tr>
        <tr><th>Location</th><td><?php echo $row['Location']; ?> </td></tr>
        <tr><th>Position</th><td><?php echo $row['Position']; ?> </td></tr>
        <tr><th>Date Applied</th><td><?php echo $row['Date_Applied']; ?> </td></tr>
        <tr><th>Completion Date</th><td><?php echo $row['Completion_date']; ?> </td></tr>
      </tr>
    <?php
      }
    ?>

</table>

<p>
  Dr Bibiana Lim Chiu-Yiong <br>
  PhD Msc GCLT BBus <br>
  Head Of learning and Teaching Unit <br>
  Faculty of Business, Design and Arts | CHMSU University of Technology <br>
  (Sarawak Campus) <br>
  Phone +60-------- <br>
  Room - -- |level 4, building B |Jalan Simpang Tiga <br>

  Signature: <br> 
<br>
<br>
<br>
_________________________
</p>

</body>
</html>



<?php

			//get the obs data
			$html = ob_get_clean();

			//insert variable
			$pdf->loadHtml($html);

			// (Optional) Setup the paper size and orientation
			$pdf->setPaper('A4');

			// Render the HTML as PDF
			$pdf->render();

			// Output the generated PDF to Browser
			$pdf->stream('result.pdf', Array('Attachent'=>0));


}			
			
?>



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

               $cid = $_GET['data'];
            

             } 

               $connection = mysqli_connect("localhost","root","");
               $db = mysqli_select_db($connection, 'ims');

                $query = "SELECT s.NAME, s.COURSE, s.STUDENT_ID, j.Job_Title, j.Job_ID, a.Date_Applied, i.COMPANY_NAME from student s inner join applicants a on s.STUDENT_ID = a.STUDENT_ID inner join jobs j on a.Job_ID = j.Job_ID inner join industry i on j.REGIS_NO = i.REGIS_NO
                  where a.Status = 'Ended' or a.Status = 'Completed' and j.REGIS_NO = '$cid'";
                $query_run = mysqli_query($connection, $query);
                $x = mysqli_fetch_assoc($query_run);
                $cname = $x['COMPANY_NAME'];

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


<h1 style="color: green; text-align: center;"> <?php echo "$cname" ?> </h1>
<h2 style="text-align: center;">Company Report</h2>
<p>This Company has complied with CHMSU guidelines and has provided our students with working experience. Below are the students this company employed for internships</p>

<table>
  <thead>
  <tr>
    <th>Student</th>
    <th>Course</th>
    <th>Student ID</th>
    <th>Job ID</th>
    <th>Job Title</th>
    <th>Date Applied</th>

  </tr>
</thead>
<tbody>
      <?php
                       foreach($query_run as $row)
                               {
      ?>
      <tr>
        <td><?php echo $row['NAME']; ?> </td>
        <td><?php echo $row['COURSE']; ?> </td>
        <td><?php echo $row['STUDENT_ID']; ?> </td>
        <td><?php echo $row['Job_ID']; ?> </td>
        <td><?php echo $row['Job_Title']; ?> </td>
        <td><?php echo $row['Date_Applied']; ?> </td>
      </tr>
    <?php
      }
    ?>
</tbody>


</table>

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


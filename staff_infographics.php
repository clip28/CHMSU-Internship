

<?php 
  session_start();

  if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) { 
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

 <?php  
 $connect = mysqli_connect("localhost", "root", "", "ims");  
 $query = "SELECT COURSE, count(*) as number FROM student GROUP BY COURSE";  
 $result = mysqli_query($connect, $query);  
 ?>  



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Course', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["COURSE"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of student courses',  
                      //is3D:true,  
                      pieHole: 0.4,
                      backgroundColor: { fill:'transparent' },
                      height:600,
                      width:600
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
    </script> 
<?php  
 $connect = mysqli_connect("localhost", "root", "", "ims");  
 $query1 = "SELECT GENDER, count(*) as number FROM student GROUP BY GENDER";  
 $result1 = mysqli_query($connect, $query1);  
 ?>  


  <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Gender', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result1))  
                          {  
                               echo "['".$row["GENDER"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of student gender',  
                      //is3D:true,  
                      pieHole: 0.4,
                      backgroundColor: { fill:'transparent' },
                      height:600,
                      width:600

                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart2'));  
                chart.draw(data, options);  
           }  
    </script>

<?php  
 $connect = mysqli_connect("localhost", "root", "", "ims");  
 $query2 = "SELECT COMPANY_NAME, count(*) as number FROM student_job_details GROUP BY COMPANY_NAME";  
 $result2 = mysqli_query($connect, $query2);  
 ?> 



             <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Company Name', 'Student Count'],  
                          <?php  
                          while($row = mysqli_fetch_array($result2))  
                          {  
                               echo "['".$row["COMPANY_NAME"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Most popular comapnies',  
                      //is3D:true,  
                      pieHole: 0.4,
                      backgroundColor: { fill:'transparent' },
                      height:600,
                      width:600

                     };  
                var chart = new google.visualization.BarChart(document.getElementById('barchart1'));  
                chart.draw(data, options);  
           }  
    </script>













<script>
    window.onload = function () {
        document.getElementById("download")
            .addEventListener("click", () => {
                const invoice = this.document.getElementById("page-content-wrapper");
                console.log(invoice);
                console.log(window);
                var opt = {
                    filename: 'analytics.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    jsPDF: { unit: 'in', format: 'a3', orientation: 'landscape' }
                };
                html2pdf().from(invoice).set(opt).save();
            })
}
</script>



    <title>IMS</title>
</head>



<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-address-book me-1"></i>CHMSU</div>
            <div class="list-group list-group-flush my-3">
                <a href="staff_internshiplisting.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Internship listing</a>
                <a href="staff_studentlist.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Student listing</a>
                  <a href="staff_companylist.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Company listing</a>
                        <a href="staff_approval.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Student Approval</a>                   
                <a href="staff_infographics.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-chart-line me-2"></i>Analytics</a>
                <a href="staff_student_feedbacklist.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-paperclip me-2"></i>Student Feedback </a>
                <a href="staff_industry_feedback.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-paperclip me-2"></i>Industry Feedback </a>
                <a href="staff_history.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Internship History</a> 
                <a href="staff_logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Analytics of <?php $today = date("F , Y"); echo $today; ?></h2>

                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?=$_SESSION['user_full_name']?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
                <!-- Content wrapper -->
            <div class="container-fluid px-4">
                <div class="row my-5">
                    <div class="col-md-12 text-right mb-3">
                             <button class="btn btn-danger" id="download"> Download charts</button>
                         </div>
                    <h3 class="fs-4 mb-3">User count data</h3>
                        <div class="col-lg-2 col-md-2">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    Total Number of Students 
                                    <?php 
                                    $connection = mysqli_connect("localhost","root","");
                                    $db = mysqli_select_db($connection, 'ims');
                                    $query = "SELECT * FROM student";
                                    $query_run = mysqli_query($connection, $query);

                                    if($student_total = mysqli_num_rows($query_run))
                                    {
                                        echo '<h4 class="mb=0"> '.$student_total.' </h4>';
                                    }
                                    else 
                                    {
                                        echo '<h4 class="mb=0"> No data </h4>';
                                    }


                                    ?>
                                </div> 
                            </div>
                        </div>
                    
                       <div class="col-lg-2 col-md-2">
                          <div class="card bg-light text-black mb-4">
                                <div class="card-body">
                                    Total Number of Industry
                                    <?php 
                                    $connection = mysqli_connect("localhost","root","");
                                    $db = mysqli_select_db($connection, 'ims');
                                    $query = "SELECT * FROM industry";
                                    $query_run = mysqli_query($connection, $query);

                                    if($industry_total = mysqli_num_rows($query_run))
                                    {
                                        echo '<h4 class="mb=0"> '.$industry_total.' </h4>';
                                    }
                                    else 
                                    {
                                        echo '<h4 class="mb=0"> No data </h4>';
                                    }


                                    ?>
                                </div> 
                            </div>
                        </div>

                         <div class="col-lg-2 col-md-2">
                          <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    Total Number of Staff
                                    <?php 
                                    $connection = mysqli_connect("localhost","root","");
                                    $db = mysqli_select_db($connection, 'ims');
                                    $query = "SELECT * FROM admin";
                                    $query_run = mysqli_query($connection, $query);

                                    if($staff_total = mysqli_num_rows($query_run))
                                    {
                                        echo '<h4 class="mb=0"> '.$staff_total.' </h4>';
                                    }
                                    else 
                                    {
                                        echo '<h4 class="mb=0"> No data </h4>';
                                    }


                                    ?>
                                </div> 
                            </div>
                        </div>

                </div>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Student data</h3>

                    <div class="col-lg-2 col-md-2">
                          <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    Number of successfull applications to companies
                                    <?php 
                                    $connection = mysqli_connect("localhost","root","");
                                    $db = mysqli_select_db($connection, 'ims');
                                    $query = "SELECT * FROM applicants where confirmation = 'YES' ";
                                    $query_run = mysqli_query($connection, $query);

                                    if($stud_total = mysqli_num_rows($query_run))
                                    {
                                        echo '<h4 class="mb=0"> '.$stud_total.' </h4>';
                                    }
                                    else 
                                    {
                                        echo '<h4 class="mb=0"> No data </h4>';
                                    }


                                    ?>
                                </div> 
                            </div>
                        </div>

                         <div class="col-lg-2 col-md-2">
                          <div class="card bg-light text-black mb-4">
                                <div class="card-body">
                                    Number of students fully enrolled
                                    <?php 
                                    $connection = mysqli_connect("localhost","root","");
                                    $db = mysqli_select_db($connection, 'ims');
                                    $query = "SELECT * FROM applicants where Status = 'Confirmed' ";
                                    $query_run = mysqli_query($connection, $query);

                                    if($confirm_total = mysqli_num_rows($query_run))
                                    {
                                        echo '<h4 class="mb=0"> '.$confirm_total.' </h4>';
                                    }
                                    else 
                                    {
                                        echo '<h4 class="mb=0"> No data </h4>';
                                    }


                                    ?>
                                </div> 
                            </div>
                        </div>

                          <div class="col-lg-2 col-md-2">
                          <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    Number of students assigned with supervisor 
                                    <?php 
                                    $connection = mysqli_connect("localhost","root","");
                                    $db = mysqli_select_db($connection, 'ims');
                                    $query = "SELECT * FROM student where SUPERVISOR != 'NULL' ";
                                    $query_run = mysqli_query($connection, $query);

                                    if($stude_total = mysqli_num_rows($query_run))
                                    {
                                        echo '<h4 class="mb=0"> '.$stude_total.' </h4>';
                                    }
                                    else 
                                    {
                                        echo '<h4 class="mb=0"> No data </h4>';
                                    }


                                    ?>
                                </div> 
                            </div>
                        </div>

                </div>

                 <div class="row my-5">
                    <h3 class="fs-4 mb-3">Student Demographics</h3>
                      <div class="col-xl-3 col-md-6">
                        <div id="piechart"></div> 
                    </div> 

                    <div class="col-xl-3 col-md-6">
                        <div id="piechart2"></div>
                    </div>      
                 </div>


                 <div class="row my-5">
                    <h3 class="fs-4 mb-3">Industry data</h3>
                         <div class="col-xl-3 col-md-6 ">
                            <div id="barchart1"></div>
                        </div>    

                
                </div>  





            </div>
        </div>
    </div>


    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>

<?php 
}else {
   header("Location:staff_login.php");
}
 ?>



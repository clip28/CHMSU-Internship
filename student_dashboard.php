<?php 
  session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) { 

    $id = $_SESSION['user_id'];
    //test

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <title>IMS</title>
</head>




<body>


       <?php 


                             $conn = new mysqli('localhost', 'root', '', 'ims');


                             $check = "SELECT * from student WHERE STUDENT_ID =$id";
                             $checklist = $conn ->query($check);
                             $checkdata = mysqli_fetch_assoc($checklist);
                             $status = $checkdata['ENROLL'];
                             if($status == NULL){


                        
                                 $sql = "SELECT industry.COMPANY_NAME,jobs.Job_ID, jobs.Job_Title, jobs.Location, jobs.Qualification, jobs.Category, jobs.Position, jobs.REGIS_NO FROM JOBS INNER JOIN industry ON jobs.REGIS_NO = industry.REGIS_NO where Job_ID IN (select Job_ID from applicants WHERE STUDENT_ID = $id and confirmation is null)";
                                $result = $conn->query($sql);

                                $sql2 = "SELECT applicants.appID, jobs.Job_Title, industry.REGIS_NO, industry.COMPANY_NAME, industry.WEBSITE, industry.email from 
                                            applicants
                                            inner join student on student.STUDENT_ID = applicants.STUDENT_ID
                                            inner join jobs on jobs.Job_ID = applicants.Job_ID
                                            inner join industry on industry.REGIS_NO=jobs.REGIS_NO
                                            where applicants.STUDENT_ID =$id and applicants.confirmation is not null";
                                $listing = $conn ->query($sql2);



                                  
                                if(isset($_POST['Enroll'])) {

                                    $f_ID = $_POST['Enroll'];  // approve

                                     $_SESSION['appID'] = $f_ID;

                                    header("Location: student_submission.php");
    
                                  }



                        ?>







    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-address-book me-1"></i>CHMSU</div>
            <div class="list-group list-group-flush my-3">
                <a href="student_internshiplisting.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Internship listing</a>
                  <a href="student_companylist.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Company listing</a>                   
                <a href="student_dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-paperclip me-2"></i>Student Dashboard</a>        
                <a href="student_logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Student Dashboard</h2>
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
                                <li><a class="dropdown-item" href="student_profile.php">Profile</a></li>
                            </ul>

                        </li>
                    </ul>
                </div>
            </nav>

           <div class="container-fluid px-4">
                <div class="row my-5">
                    <div class="col">
                    <h3 class="fs-4 mb-3">Internship Status </h3>
                      <div class="progress" style="height:50px; font-size:1em;">
                          <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated " role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" >20% | Enrolling phase</div>
                        </div>
                        <br>
                    </div> 
                    <h3 class="fs-4 mb-3">List of Applied jobs</h3>

                    <div class="col">
                       
                    <!--fething data module-->
                    <div class="card">
                        <div class="card-body">

                        <form method="POST">
                            <table id="datatableid" class="table table-bordered">
                             <thead>
                                <tr>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Qualification</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">More Details</th>
                               </tr>
                             </thead>
                             
                             <tbody> 
                            <?php while( $row = $result->fetch_object() ): ?>
                                <tr>
                                    <td><?php echo $row->COMPANY_NAME?></td>
                                    <td><?php echo $row->Job_Title?></td>
                                    <td><?php echo $row->Location?></td>
                                    <td><?php echo $row->Qualification?></td>
                                    <td><?php echo $row->Category?></td>
                                    <td><?php echo $row->Position?></td>
                                    <td><?php echo "<div class = 'text-center'><button class='btn btn-primary editbtn'><a href='jobs/profile".$row -> REGIS_NO.".pdf' style='color:white;' download>Download</a></button></div>"?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                            </table>

                        </form>
                    </div>
                    </div>


                 </div>
                </div>
            </div>

               
            <!--table for industry approved list-->
           <div class="container-fluid px-4">
                <div class="row my-5">
                    <h3 class="fs-4 mb-3">List of Jobs accepted</h3>
                    <div class="col">

                        <h3 class="fs-4 mb-3">Waiting for Interview list</h3>

                                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                 <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                  </symbol>
                                                 </svg>

                                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                                                  <div>
                                                    Please only press enroll button after you have contacted the companies and taken interviews from them. You will have to provide a proof of being selected such as a offer letter pdf

                                                  </div>
                                                </div>



                    
                    <!--fething data module-->
                    <div class="card">
                        <div class="card-body">

                        <form method="POST">
                            <table id="datatableid1" class="table table-bordered">
                             <thead>
                                <tr>
                                 <th scope="col">Company Name</th>
                                 <th scope="col">Job Title</th>
                                 <th scope="col">Website</th>
                                 <th scope="col">Email</th>
                                 <th scope="col">More Details</th>
                                 <th scope="col">Select</th>
                               </tr>
                             </thead>
                             
                             <tbody> 
                            <?php while( $row = $listing->fetch_object() ): ?>
                                <tr>
                                 <td><?php echo $row->COMPANY_NAME?></td>
                                 <td><?php echo $row->Job_Title?></td>
                                 <td><?php echo $row->WEBSITE?></td>
                                 <td><?php echo $row->email?></td>
                                 <td><?php echo "<div class = 'text-center'><button class='btn btn-primary editbtn'><a href='jobs/profile".$row -> REGIS_NO.".pdf' style='color:white;' download>Download</a></button></div>"?></td>
                                 <td><button type="submit" class="btn btn-success editbtn" name = "Enroll" value ='<?php echo $job = $row->appID?>'>Enroll</button></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                            </table>

                        </form>
                    </div>
                    </div>


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
                             <!-- Script links for functions and datatable -->
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
                            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

                            <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
                            <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

                            <script>
                                $(document).ready(function () {

                                    $('.viewbtn').on('click', function () {
                                        $('#viewmodal').modal('show');
                                        $.ajax({ //create an ajax request to display.php
                                            type: "GET",
                                            url: "display.php",
                                            dataType: "html", //expect html to be returned                
                                            success: function (response) {
                                                $("#responsecontainer").html(response);
                                                //alert(response);
                                            }
                                        });
                                    });

                                });
                            </script>

                             <!-- Table controller  -->
                            <script>
                                $(document).ready(function () {

                                    $('#datatableid').DataTable({
                                        "pagingType": "full_numbers",
                                        "lengthMenu": [
                                            [10, 25, 50, -1],
                                            [10, 25, 50, "All"]
                                        ],
                                        responsive: true,
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search Your Data",
                                        }
                                    });

                                    $('#datatableid1').DataTable(
                                         {
                                        "pagingType": "full_numbers",
                                        "lengthMenu": [
                                            [10, 25, 50, -1],
                                            [10, 25, 50, "All"]
                                        ],
                                        responsive: true,
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search Your Data",
                                        }
                                        }      
                                    );

                                });
                            </script>

                            <!-- Function to display delete popup -->
                              <script>
                                $(document).ready(function () {

                                    $('.deletebtn').on('click', function () {

                                        $('#deletemodal').modal('show');

                                        $tr = $(this).closest('tr');

                                        var data = $tr.children("td").map(function () {
                                            return $(this).text();
                                        }).get();

                                        console.log(data);

                                        $('#delete_id').val(data[0]);

                                    });
                                });
                            </script>





</html>
<?php 
    }
    elseif($status == "pending"){

            include 'student_status1.php';

         }

        elseif($status == "Confirmed"){

                include 'student_status2.php';

             }

            elseif($status == "Ended") {
                    include 'student_feedback.php';
                }
                 else{
                    if($status == "Completed") {
                    include 'student_status3.php';
                }
            }
}else {
   header("Location: login_access.php");
}
 ?>

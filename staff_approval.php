

<?php 
  session_start();

  if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) { 

    $id = $_SESSION['user_id'];

    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection, 'ims');


?>

<?php


                                // This is the code which brings out pending list for approval
                                    $query = "SELECT applicants.appID, student.STUDENT_ID, student.NAME, student.COURSE, jobs.Job_Title, industry.COMPANY_NAME, jobs.Category, jobs.Vacancy, applicants.Proof, industry.CONTACT_NO
                                        from applicants
                                        inner join student on student.STUDENT_ID = applicants.STUDENT_ID
                                        inner join jobs on jobs.Job_ID = applicants.Job_ID
                                        inner join industry on industry.REGIS_NO=jobs.REGIS_NO
                                        where applicants.Status = 'pending'";
                                    $query_run = mysqli_query($connection, $query);
                                   




                                     if(isset($_POST['Apply'])) {
                                         $f_ID = $_POST['Apply'];  // approve

                                        $apply = " UPDATE applicants
                                                SET Status='Confirmed'
                                                WHERE appID ='$f_ID'";       // updating confirmation status

                                                mysqli_query($connection, $apply);    //Excecute query

                                        //updating the status in student table

                                        $que = "SELECT * from applicants where appID='$f_ID'";
                                        $que_run = mysqli_query($connection, $que);
                                        $info = mysqli_fetch_assoc($que_run);
                                        $stu_info = $info['STUDENT_ID'];

                                         $enroll = " UPDATE student
                                                SET ENROLL='Confirmed'
                                                WHERE STUDENT_ID ='$stu_info'"; 
   
                                                $trial =  mysqli_query($connection, $enroll);    //Excecute query


                                                 header("Location:staff_approval.php");
                                              
                                             }else{

                                                 if(isset($_POST['Cancel'])) {
                                                   $f_ID = $_POST['Cancel'];  // approve

                                                    //update application table
                                                    $apply = " UPDATE applicants
                                                        SET Status=null;
                                                        WHERE appID ='$f_ID'";       // updating confirmation status
           
                                                         mysqli_query($connection, $apply);    //Excecute query

                                                    //update student table

                                                 $que = "SELECT * from applicants where appID='$f_ID'";
                                                $que_run = mysqli_query($connection, $que);
                                                $info = mysqli_fetch_assoc($que_run);
                                                $stu_info = $info['STUDENT_ID'];

                                                        $apply = " UPDATE student
                                                                    SET ENROLL=null
                                                                     WHERE STUDENT_ID ='$stu_info'";       // updating confirmation status
           
                                                         mysqli_query($connection, $apply);    //Excecute query

                                                
                                                       header("Location:staff_approval.php");
                                                        
                                                          
                                                        }
                                                     
                                            }

                                             include 'staff_completelist.php';


                                                                      
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
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
                <a href="staff_approval.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-project-diagram me-2"></i>Student Approval</a> 
                <a href="staff_infographics.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-chart-line me-2"></i>Analytics</a>
                <a href="staff_student_feedbacklist.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-paperclip me-2"></i>Student Feedback</a>
                <a href="staff_industry_feedback.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-paperclip me-2"></i>Industry Feedback</a>
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
                    <h2 class="fs-2 m-0">Student Waiting List</h2>
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
                                <i class="fas fa-user me-2"></i><?=$_SESSION['user_full_name']?></a>
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
                    <h3 class="fs-4 mb-3">List of students Accepted By Companies</h3>

                         <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                               <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </symbol>
                        </svg>

                       <div class="alert alert-danger d-flex align-items-center" role="alert">
                           <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                              <div>
                                   Note: These are the students that have finished interviews and received offer letter from companies they want to join. Please verifry then approve or Reject

                                </div>
                        </div>

                       <!-- Fetching data module  -->
                                <div class="card">
                                    <div class="card-body">
                                      <form method="POST">
                                        <table id="datatableid" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Application ID</th>
                                                    <th scope="col">Student ID</th>
                                                    <th scope="col">Student Name</th>
                                                    <th scope="col">Course</th>
                                                    <th scope="col">Job Title</th>
                                                    <th scope="col">Company Name </th>
                                                    <th scope="col">Category </th>
                                                    <th scope="col">Vacancy </th>
                                                    <th scope="col">Offer Document</th>
                                                    <th scope="col">Company Contact No</th>
                                                   
                                                    <th scope="col"> ACCEPT </th>
                                                    <th scope="col"> REJECT </th>
                                                </tr>
                                            </thead>
                                  
                                            <tbody>
                                                    <?php
                                                    if($query_run)
                                                    {
                                                        foreach($query_run as $row)
                                                        {
                                                           $r = $row['appID'];
                                                           $t = $row['Proof'];
                                                          
                                                    ?>
                                                <tr>
                                                    <td> <?php echo $row['appID']; ?></td>
                                                    <td> <?php echo $row['STUDENT_ID']; ?></td>
                                                    <td> <?php echo $row['NAME']; ?></td>
                                                    <td> <?php echo $row['COURSE']; ?></td>
                                                    <td> <?php echo $row['Job_Title']; ?></td>
                                                    <td> <?php echo $row['COMPANY_NAME'];?> </td>
                                                    <td> <?php echo $row['Category'];?></td>
                                                    <td> <?php echo $row['Vacancy'];?></td>
                                                    <td><?php echo "<a href='documents/".$row['Proof']."' download>See Letter</a>"?></td>
                                                    <td> <?php echo $row['CONTACT_NO'];?> </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-success editbtn" name = "Apply" value ='<?php echo $r?>'>APPROVE</button>
                                                    </td>

                                                    <td>
                                                        <button type="submit" class="btn btn-danger deletebtn" name = "Cancel" value ='<?php echo $r?>'>CANCEL</button>
                                                    </td>
                                                </tr>
                                                 <?php           
                                                    }
                                                }
                                                else 
                                                {
                                                    echo "No Record Found";
                                                }
                                                 ?>
                                            </tbody>
                                   
                                        </table>
                                    </form>
                                    </div>
                                </div>


           <!--list of students that are completing internship-->

        
            <div class="container-fluid px-4">
                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Please Confirm Student Internship Completion</h3>

                         <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                               <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </symbol>
                        </svg>

                       <div class="alert alert-danger d-flex align-items-center" role="alert">
                           <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                              <div>
                                   Note: These are the students that have finished their internship and waiting for verification of their internship. After approving they will get feedback form.

                                </div>
                        </div>


                       <!-- Fetching data module  -->
                                <div class="card">
                                    <div class="card-body">
                                      <form method="POST">
                                        <table id="datatableid1" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Application ID</th>
                                                    <th scope="col">Student ID</th>
                                                    <th scope="col">Student Name</th>
                                                    <th scope="col">Course</th>
                                                    <th scope="col">Job Title</th>
                                                    <th scope="col">Company Name </th>
                                                    <th scope="col">Category </th>

                                                    <th scope="col">Company Contact No</th>
                                                   
                                                    <th scope="col"> ACCEPT </th>
                                                    <th scope="col"> REJECT </th>
                                                </tr>
                                            </thead>
                                  
                                            <tbody>
                                                    <?php
                                                    if($query_run)
                                                    {
                                                        foreach($query_run2 as $x)
                                                        {
                                                        
                                                           $r = $x['appID'];
                                                           $t = $x['Proof'];
                                                          
                                                    ?>
                                                <tr>
                                                    <td> <?php echo $x['appID']; ?></td>
                                                    <td> <?php echo $x['STUDENT_ID']; ?></td>
                                                    <td> <?php echo $x['NAME']; ?></td>
                                                    <td> <?php echo $x['COURSE']; ?></td>
                                                    <td> <?php echo $x['Job_Title']; ?></td>
                                                    <td> <?php echo $x['COMPANY_NAME'];?> </td>
                                                    <td> <?php echo $x['Category'];?></td>

                                                    <td> <?php echo $x['CONTACT_NO'];?> </td>
                                                    <td>
                                                        
                                                        <button type="submit" class="btn btn-success editbtn" name = "Apply2" value ='<?php echo $r?>'>APPROVE</button>
                                                    </td>

                                                    <td>
                                                        <button type="submit" class="btn btn-danger deletebtn" name = "Cancel2" value ='<?php echo $r?>'>CANCEL</button>
                                                    </td>
                                                </tr>
                                                 <?php           
                                                    }
                                                }
                                                else 
                                                {
                                                    echo "No Record Found";
                                                }
                                                 ?>
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
}else {
   header("Location:login_access.php");
}
 ?>



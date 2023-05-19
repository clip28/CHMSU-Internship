<?php 
  session_start();

if (isset($_SESSION['company_id']) && isset($_SESSION['user_email'])) { 

    $id = $_SESSION['company_id'];

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


       <?php 
                                //A query which summons all the list
                                 $conn = new mysqli('localhost', 'root', '', 'ims');
                           
                                 $sql = "SELECT * FROM `jobs` WHERE REGIS_NO = $id";
                                $result = $conn->query($sql);
                                

                                //dont want to mess up code so i am just keeping it here
                                if(isset($_POST['Apply'])) {

                                    $f_ID = $_POST['Apply'];  // approve
                                   


                                     $apply = " UPDATE applicants
                                                SET confirmation='YES'
                                                WHERE Job_iD=1 AND STUDENT_ID = $f_ID;";      
   
                                     mysqli_query($conn, $apply);    //Excecute query

                                    header("Location: in_applicants.php");
    
                                  }

                        ?>


        <?php

            if (isset($_POST['updatedata'])) {


                         function test_input($data) {
                          $data = trim($data);
                          $data = stripslashes($data);
                          $data = htmlspecialchars($data);
                          return $data;
                        }

                        $id = $_POST['update_id'];
                        
                        $Job_Title = test_input($_POST['title']);
                         $location = test_input($_POST['location']);

                        $Category = test_input($_POST['category']);

                        $detail = test_input($_POST['detail']);

                        $position = test_input($_POST['position']);
                 

                        $query = "UPDATE jobs SET Job_Title='$Job_Title', Location='$location', Category='$Category', Extra_Details='$detail', Position=' $position' WHERE Job_iD='$id'";

                      
                        $query_run = mysqli_query($conn, $query);

                        if($query_run)
                        {
                            echo '<script> alert("Data Updated"); </script>';

                            header("Location:in_joblist.php");
                        }
                        else
                        {
                            echo '<script> alert("Data Not Updated"); </script>';
                        }
    }
?>
   







    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-address-book me-1"></i>CHMSU</div>
            <div class="list-group list-group-flush my-3">
            
                  <a href="in_joblist.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-project-diagram me-2"></i>Dashboard</a>                   
                <a href="Jobs.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-paperclip me-2"></i>Post a Job</a>
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
                    <h2 class="fs-2 m-0">All Jobs Posted</h2>
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
                                <li><a class="dropdown-item" href="industry_profile.php">Profile</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4">
                <div class="row my-5">

                    <?php
                    $connection = mysqli_connect("localhost","root","");
                    $db = mysqli_select_db($connection, 'ims');
                    $queryalert = "SELECT * from applicants inner join jobs on applicants.Job_ID = jobs.Job_ID where jobs.REGIS_NO = '$id' and applicants.confirmation is null" ;
                    $queryalert_run = mysqli_query($connection, $queryalert);

                     
                    if($stud_alert = mysqli_num_rows($queryalert_run))
                        {
                           
                            echo '
                            <div class="col">
                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                 <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                  </symbol>
                                </svg>
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                  <div>
                                    You have '.$stud_alert.' applications currently awaiting approval! 
                                  </div>
                                </div>
                             </div>   
                            ';
                        }
                    else 
                        {
                            echo '
                            <div class="col">
                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                  </symbol>
                                  </svg>
                                                            
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                  <div>
                                    You have no outstanding approvals to make!
                                      </div>
                                    </div>
                            </div>        

                            ';
                        }              

                    ?>

                    <h3 class="fs-4 mb-3">List Of Jobs posted</h3>
                    
                    <div class="col">




                                    <!-- Hidden edit module that will pop up -->
                                    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Edit Company Data </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="in_joblist.php" method="POST">

                                                    <div class="modal-body">

                                                        <input type="hidden" name="update_id" id="update_id">

                                                        <div class="form-group">
                                                            <label>Job Title</label>
                                                            <input type="text" name="title" id="title" class="form-control"
                                                                placeholder="Enter Last Name">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Location</label>
                                                            <input type="text" name="location" id="location" class="form-control"
                                                                placeholder="Enter company name">
                                                        </div>
                                                         <div class="form-group">
                                                            <label>Category</label>
                                                            <select class="form-select" name="category" id="category">

                                                                <option value="Car Industry" >Car Industry</option>
                                                                <option value="Telecom Industry" >Telecom Industry</option>
                                                                <option value="ICT Industry" >ICT Industry</option>
                                                                <option value="Food Industry" >Food Industry</option>
                                                                <option value="Oil Industry">Oil Industry</option>
                                                            </select>

                                                        </div>
                                                        <div class="form-group">
                                                            <label>More Category Details</label>
                                                            <input type="text" name="detail" id="detail" class="form-control"
                                                                placeholder="Enter website link">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Position</label>
                                                            <input type="text" name="position" id="position" class="form-control"
                                                                placeholder="Enter Phone Number">
                                                        </div>
                                                       

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>







                                           <!-- Hidden delete module that will pop up  -->
                                    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Delete Company data </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="industry_delete_jobs.php" method="POST">

                                                    <div class="modal-body">

                                                        <input type="hidden" name="delete_id" id="delete_id">

                                                        <h4> Do you want to Delete this Data ??</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                                                        <button type="submit" name="deletedata" class="btn btn-primary"> YES </button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>























        <!--fething data module-->
                                            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                 <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                  </symbol>
                                                 </svg>

                                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                                                  <div>
                                                    Please click on the buttons to check the interns list 

                                                  </div>
                                                </div>
                    <div class="card">
                        <div class="card-body">

                        <form method="POST">
                            <table id="datatableid" class="table table-bordered">
                             <thead>
                                <tr>
                                 <th scope="col">Job ID</th>
                                 <th scope="col">Job Title</th>
                                 <th scope="col">Location</th>
                                 <th scope="col">Category</th>
                                 <th scope="col">More Category Details</th>
                                 <th scope="col">Position</th>
                                 <th scope="col">Date Posted</th>
                                 <th scope="col">Offer End Date</th>
                                 <th scope="col">Job Details</th>
                                 <th scope="col">Edit</th>
                                 <th scope="col">Delete</th>
                                 <th scope="col">View Applicants</th>
                                 <th scope="col">Confirmed</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php while( $row = $result->fetch_object() ): ?>
                              <tr>
                               
                                <?php $Jid = $row->Job_ID;

                                $sdate = date("d-m-Y", strtotime($row -> Date_Posted)); //starting date changing format
                                $edate = date("d-m-Y", strtotime($row -> Date_End));  //end date changing format

                                ?>
                                 <td> <?php echo $row->Job_ID?></td>   
                                 <td> <?php echo $row->Job_Title?></td>
                                 <td><?php echo $row->Location?></td>
                                 
                                 <td><?php echo $row->Category?></td>
                                 <td><?php echo $row->Extra_Details?></td>
                                 <td><?php echo $row->Position?></td>
                                 <td><?php echo $sdate?></td>
                                 <td><?php echo $edate?></td>
                          
                                 <td><?php echo "<a href='jobs/profile".$row -> REGIS_NO.".pdf' download><div class='text-center'><button type='button' class='btn btn-primary'>Download</button></div></a>"?></td>
                                 <td>
                                 <button type="button" class="btn btn-success editbtn"> EDIT </button>
                                 </td>
                                 <td>
                                    <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
                                </td>
                                  <td>
                                         <?php echo "<a href ='in_applicants.php?data=$Jid' style='color: white;'><div class='text-center'><button style = 'margin-'type='button' class='btn btn-success'> View </button></div></a>"?>
                                 </td>
                                 
                                  <td>
                                         <?php echo "<a href ='industry_confirmed.php?data=$Jid' style='color: white;'><div class='text-center'><button type='button' class='btn btn-secondary'> Interning </button></div></a>"?>
                                 </td>
                                 
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


                              <!-- Function to display edit popup -->
                            <script>
                                $(document).ready(function () {

                                    $('.editbtn').on('click', function () {

                                        $('#editmodal').modal('show');

                                        $tr = $(this).closest('tr');

                                        var data =$tr.children("td").map(function () {
                                            return $(this).text();
                                        }).get();

                                        console.log(data);
                                    
                                        $('#update_id').val(data[0]);
                                        $('#title').val(data[1]);
                                        $('#location').val(data[2]);
                                        $('#category').val(data[3]);
                                        $('#detail').val(data[4]);
                                        $('#position').val(data[5]);
                                    });
                                });
                            </script>


</html>

<?php 
}else {
   header("Location:  industry_login.php");
}
 ?>

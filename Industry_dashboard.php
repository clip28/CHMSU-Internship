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







    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-address-book me-1"></i>CHMSU</div>
            <div class="list-group list-group-flush my-3">
            
                  <a href="in_joblist.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Posted Job listing</a>                   
                <a href="Jobs.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-paperclip me-2"></i>Post a Job</a>

        <a href="industry_dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-project-diagram me-2"></i>Dashboard</a>


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
                    <h3 class="fs-4 mb-3">List of Jobs</h3>
                    <div class="col">


        <!--fething data module-->
        <p>Please Click on the Job Titles to check the list of interns already working</p>
                    <div class="card">
                        <div class="card-body">

                        <form method="POST">
                            <table id="datatableid" class="table table-bordered">
                             <thead>
                                <tr>
                                 <th scope="col">Job Title</th>
                                 <th scope="col">Location</th>
                                 <th scope="col">Category</th>
                                 <th scope="col">More Category Details</th>
                                 <th scope="col">Position</th>
                                 <th scope="col">Date Posted</th>
                                 <th scope="col">Offer End Date</th>
                                 <th scope="col">Requirements</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php while( $row = $result->fetch_object() ): ?>
                              <tr>
                               
                                <?php $Jid = $row->Job_ID;

                                $sdate = date("d-m-Y", strtotime($row -> Date_Posted)); //starting date changing format
                                $edate = date("d-m-Y", strtotime($row -> Date_End));  //end date changing format

                                ?>
                                    
                                 <td> <?php echo "<a href ='industry_confirmed.php?data=$Jid'>$row->Job_Title</a>"?></td>
                                 <td><?php echo $row->Location?></td>
                                 
                                 <td><?php echo $row->Category?></td>
                                 <td><?php echo $row->Extra_Details?></td>
                                 <td><?php echo $row->Position?></td>
                                 <td><?php echo $sdate?></td>
                                 <td><?php echo $edate?></td>
                                 
                                 <td><?php echo "<a href='jobs/profile".$row -> REGIS_NO.".pdf' download>Download</a>"?></td>
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





</html>

<?php 
}else {
   header("Location:  industry_login.php");
}
 ?>

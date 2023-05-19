

<?php 
  session_start();

  $id = $_SESSION['user_id'];

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <title>Student Job Lists</title>
</head>




<body>


       <?php 
                                //
                                 $conn = new mysqli('localhost', 'root', '', 'ims');

                                 //find all the job available which the student didnt apply 
                                 $sql = "SELECT industry.COMPANY_NAME,jobs.Job_ID, jobs.Job_Title, jobs.Location, jobs.Qualification, jobs.Category, jobs.Position, jobs.REGIS_NO, jobs.Date_Posted, jobs.Date_End, jobs.Extra_Details FROM JOBS INNER JOIN industry ON jobs.REGIS_NO = industry.REGIS_NO where Job_ID NOT IN (select Job_ID from applicants WHERE STUDENT_ID = $id);";
                                     $result = $conn->query($sql);



                                //the way the student will be able to apply for jobs  
                                if(isset($_POST['Apply'])) {

                                     $f_ID = $_POST['Apply'];  // Job ID
                                     $id = $_SESSION['user_id'];   //Student ID

                                     $apply = "INSERT INTO applicants (STUDENT_ID, Job_ID) VALUES ('$id', '$f_ID');";       // add friend from user's side
    
                                     mysqli_query($conn, $apply);    //Excecute query

                                     header("Location: student_internshiplisting.php");
    
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
                  <a href="student_companylist.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-project-diagram me-2"></i>Company listing</a>                   
                <a href="student_dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
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
                    <h2 class="fs-2 m-0">Company List</h2>
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

   <!-- Content wrapper -->
            <div class="container-fluid px-4">
                <div class="row my-5">
            <div class="col">
                <h3 class="fs-4 mb-3">List of Companies</h3>

                                          <!-- Fetching data module  -->
                                <div class="card">
                                    <div class="card-body">

                                     <?php
                                                $connection = mysqli_connect("localhost","root","");
                                                $db = mysqli_select_db($connection, 'ims');

                                                $query = "SELECT * FROM industry";
                                                $query_run = mysqli_query($connection, $query);
                                      ?>
                                        <table id="datatableid" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Companay Name</th>
                                                    <th scope="col">Company Address</th>
                                                    <th scope="col">Website</th>
                                                    <th scope="col"> Contact </th>
                                                    <th scope="col"> Email </th>
                                                    <th scope="col"> View Jobs </th>


                                                   
                                                   
                                                </tr>
                                            </thead>
                                  
                                            <tbody>
                                                    <?php
                                                    if($query_run)
                                                    {
                                                        foreach($query_run as $row)
                                                        {

                                                            $rid = $row['REGIS_NO'];
                                                         

                                                    ?>
                                                <tr>
                                                    <td> <?php echo $row['COMPANY_NAME']; ?> </td>
                                                    <td> <?php echo $row['COMPANY_ADDRESS']; ?> </td>
                                                    <td> <?php echo $row['WEBSITE']; ?> </td>
                                                    <td> <?php echo $row['CONTACT_NO']; ?> </td>
                                                    <td> <?php echo $row['Email']; ?> </td>
                                                    <td>
                                                      <?php echo "<a href ='student_internshiplisting.php?data=$rid' style='color: white;'><div class='text-center'><button type='button' class='btn btn-secondary'> View </button></div></a>"?>
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
                                    </div>
                                </div>

                    </div>
                </div>

            </div>
        </div>
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
  header("Location:  student_login.php");
}
 ?>


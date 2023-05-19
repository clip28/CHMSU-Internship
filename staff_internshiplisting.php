

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="styles.css" />
    <title>IMS</title>
</head>



<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-address-book me-1"></i>CHMSU</div>
            <div class="list-group list-group-flush my-3">
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-project-diagram me-2"></i>Internship listing</a>
                <a href="staff_studentlist.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Student listing</a>
                <a href="staff_companylist.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Company listing</a>
                        <a href="staff_approval.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Student Approval</a>        
                <a href="staff_infographics.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
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
                    <h2 class="fs-2 m-0">Internship listing</h2>
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

            <div class="container-fluid px-4">
                <!--Setting the alert to dissappear-->

                <div class="row my-5">
                    <h3 class="fs-4 mb-3">List of Jobs posted</h3>
                    <div class="col">
                                    

                          <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                 <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                  </symbol>
                                                 </svg>

                                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                                                  <div>
                                                  Note: This will just show the List of Jobs posted in this Application, only companies can modify this

                                                  </div>
                                            </div>

                                            <?php
                                                $connection = mysqli_connect("localhost", "root", "", "ims"); 

                                                $query = "SELECT * from jobs";
                                                $result = mysqli_query($connection, $query);
                                            ?>
                        
                                 <!-- Fetching data modules  -->
                                <div class="card">
                                    <div class="card-body">
                                        <table id="datatableid" class="table table-bordered">
                                             <thead>
                                                  <tr>
                                                     <th>Job ID</th>
                                                     <th>Job Title</th>
                                                     <th>Location</th>
                                                     <th>Qualification</th>
                                                     <th>Category</th>
                                                     <th>Position</th>
                                           
                                                  </tr>
                                                </thead>
                                                <tbody>  
                                                  <?php while( $row = $result->fetch_object() ): ?>
                                                  <tr>
                                                     <td><?php echo $row->Job_ID ?></td>
                                                     <td><?php echo $row->Job_Title ?></td>
                                                     <td><?php echo $row->Location ?></td>
                                                     <td><?php echo $row->Qualification ?></td>
                                                     <td><?php echo $row->Category ?></td>
                                                     <td><?php echo $row->Position ?></td>
                                                  </tr>
                                                  <?php endwhile; ?>
                                            </tbody>
                                    </table>



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
                                        $('#cname').val(data[1]);
                                        $('#address').val(data[2]);
                                        $('#website').val(data[3]);
                                        $('#contact').val(data[4]);
                                        $('#email').val(data[5]);
                                    });
                                });
                            </script>


                             <script>function htmlToCSV(html, filename) {
                                    var data = [];
                                    var rows = document.querySelectorAll("table tr");
                                            
                                    for (var i = 0; i < rows.length; i++) {
                                        var row = [], cols = rows[i].querySelectorAll("td, th");
                                                
                                        for (var j = 0; j < cols.length; j++) {

                                                row.push(cols[j].innerText);
                                        }
                                                
                                        data.push(row.join(","));       
                                    }

                                    downloadCSVFile(data.join("\n"), filename);
                                    }
                            </script>



                             <script>
                                    function downloadCSVFile(csv, filename) {
                                    var csv_file, download_link;

                                    csv_file = new Blob([csv], {type: "text/csv"});

                                    download_link = document.createElement("a");

                                    download_link.download = filename;

                                    download_link.href = window.URL.createObjectURL(csv_file);

                                    download_link.style.display = "none";

                                    document.body.appendChild(download_link);

                                    download_link.click();
                            }</script>

                             <script>document.getElementById("download-button").addEventListener("click", function () {
                                    var html = document.querySelector("table").outerHTML;
                                    htmlToCSV(html, "CompanyList.csv");
                                });
                            </script>





</html>

<?php 
}else {
   header("Location:staff_login.php");
}
 ?>



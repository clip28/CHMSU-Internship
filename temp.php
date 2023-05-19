

<?php 
  session_start();

  if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) { 

    $msg = "";


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
                  <a href="staff_companylist.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-project-diagram me-2"></i>Company listing</a> 
                <a href="staff_approval.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Student Approval</a>                  
                <a href="staff_infographics.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-chart-line me-2"></i>Analytics</a>
                <a href="staff_feedbacklist.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-paperclip me-2"></i>Feedback list</a>
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
                    <h2 class="fs-2 m-0">Company listings</h2>
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

                 <!--Setting the alert to dissappear-->
                <div>  
                     
                                <script>
                                    var fade_out = function() {
                                            $("#mydiv").fadeOut();
                                            }

                                            setTimeout(fade_out, 5000);
                                </script>

                                <?php
                                    if ($_GET['msg'] = '1') {

                                        echo '<div id="mydiv">Cannot delete company, it has students applied</div>';

                                        unset($_GET['msg']);
                                    }
                                 ?>
                       </div>
                       <!--end alert-->
                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Define your search</h3>
                    <div class="col">
                                    
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

                                                <form action="staff_delete_company.php" method="POST">

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

                                                <form action="staff_edit_company.php" method="POST">

                                                    <div class="modal-body">

                                                        <input type="hidden" name="update_id" id="update_id">

                                                        <div class="form-group">
                                                            <label>Company name</label>
                                                            <input type="text" name="cname" id="cname" class="form-control"
                                                                placeholder="Enter Last Name">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Company Address</label>
                                                            <input type="text" name="address" id="address" class="form-control"
                                                                placeholder="Enter company name">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Website</label>
                                                            <input type="text" name="website" id="website" class="form-control"
                                                                placeholder="Enter website link">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Contact No</label>
                                                            <input type="text" name="contact" id="contact" class="form-control"
                                                                placeholder="Enter Phone Number">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="text" name="email" id="email" class="form-control"
                                                                placeholder="Enter Email">
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
                                                    <th scope="col">Register ID</th>
                                                    <th scope="col">Companay Name</th>
                                                    <th scope="col">Company Address</th>
                                                    <th scope="col">Website</th>
                                                    <th scope="col"> Contact </th>
                                                    <th scope="col"> Email </th>
                                                   
                                                    <th scope="col"> EDIT </th>
                                                    <th scope="col"> DELETE </th>
                                                    <th scope="col"> REPORT </th>
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
                                                    <td> <?php echo $row['REGIS_NO']; ?> </td>
                                                    <td> <?php echo $row['COMPANY_NAME']; ?> </td>
                                                    <td> <?php echo $row['COMPANY_ADDRESS']; ?> </td>
                                                    <td> <?php echo $row['WEBSITE']; ?> </td>
                                                    <td> <?php echo $row['CONTACT_NO']; ?> </td>
                                                    <td> <?php echo $row['Email']; ?> </td>
                                                    <td>
                                                        <button type="button" class="btn btn-success editbtn"> EDIT </button>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
                                                    </td>
                                                    <td>
                                                        <?php echo "<a href ='industry_report.php?data=$rid' style='color: white;'><button type='button' class='btn btn-primary'> REPORT </button></a>"?>
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

                                <br>
                                <br>
                             <button class="btn btn-danger" name="download-button" id="download-button">Download Table</button>
                       



    
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



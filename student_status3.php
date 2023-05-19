<?php

$_SESSION['user_id'] = $id;

$ufn = $_SESSION['user_full_name'];

$conn = new mysqli('localhost', 'root', '', 'ims');

                           
                                    $appid2 = "SELECT s.STUDENT_ID, a.appID, j.Job_ID, i.REGIS_NO, a.Status, s.ENROLL from student s
                                            inner join applicants a on s.STUDENT_ID = a.STUDENT_ID
                                            inner join jobs j on a.Job_ID = j.Job_ID
                                            inner join industry i on j.REGIS_NO = i.REGIS_NO
                                             where  (a.Status = 'Ending' OR a.Status = 'Confirmed') AND s.STUDENT_ID = '$id'";

                                    $app_run2 = mysqli_query($conn, $appid2);

                                    if($app_run2){
                                        foreach ($app_run2 as $x) {

                                           
                                            $app = $x['appID'];
                                            $stat = $x['ENROLL'];
                                            $jobstate = $x['Status'];
                                            
                                        }
                                    }
                                    else{
                                        print_r("Didnt work");
                                    }

                              



echo "<body>";

   echo "<div class='d-flex' id='wrapper'>";
     // Sidebar 
      echo  "<div class='bg-white' id='sidebar-wrapper'>";
      echo   "<div class='sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom'><i
                    class='fas fa-address-book me-1'></i>CHMSU</div>";
        echo    "<div class='list-group list-group-flush my-3'>";
          echo   "<a href='student_internshiplisting.php' class='list-group-item list-group-item-action bg-transparent second-text fw-bold'><i
                        class='fas fa-project-diagram me-2'></i>Internship listing</a>";
            echo    "<a href='student_companylist.php' class='list-group-item list-group-item-action bg-transparent second-text fw-bold'><i
                        class='fas fa-project-diagram me-2'></i>Company listing</a>";                   
               echo "<a href='student_dashboard.php' class='list-group-item list-group-item-action bg-transparent second-text active'><i
                        class='fas fa-paperclip me-2'></i>Student Dashboard</a>";
               echo     "<a href='student_logout.php' class='list-group-item list-group-item-action bg-transparent text-danger fw-bold'><i
                        class='fas fa-power-off me-2'></i>Logout</a>";
        echo "</div>";
       echo "</div>";
        //#sidebar-wrapper -->

       //Page Content -->
        echo "<div id='page-content-wrapper'>";
            echo "<nav class='nvbar navbar-expand-lg navbar-light bg-transparent py-4 px-4'>";
              echo "<div class='d-flex align-items-center'>";
                echo   "<i class='fas fa-align-left primary-text fs-4 me-3' id='menu-toggle'></i>";
                   echo "<h2 class='fs-2 m-0'>Student Dashboard</h2>";
                echo "</div>";

                echo "<button class='navbar-toggler' type='button' data-bs-toggle='collapse'
                    data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent'
                    aria-expanded='false' aria-label='Toggle navigation'>";
               echo  "<span class='navbar-toggler-icon'></span>";
                echo "</button>";

                echo "<div class='collapse navbar-collapse' id='navbarSupportedContent'>";
                echo    "<ul class='navbar-nav ms-auto mb-2 mb-lg-0'>";
                echo       "<li class='nav-item dropdown'>";
                echo            "<a class='nav-link dropdown-toggle second-text fw-bold' href='#' id='navbarDropdown'
                                role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                <i class='fas fa-user me-2'></i>$ufn
                                </a>";
                echo            " <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                echo                 "<li><a class='dropdown-item' href='#'>Profile</a></li>";
                echo             "</ul>";
                echo         "</li>";
                echo     "</ul>";
                echo "</div>";
            echo "</nav>";

            

          
 ?>

                                <!-- Content wrapper -->
                                           
                <div class="container-fluid px-4">   
                    <div class="row my-5">

                         <div class="col">
                            <h3 class="fs-4 mb-3">Internship Status </h3>
                            <div class="progress" style="height:50px; font-size:1em;">
                                  <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated " role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" >100% | Internship Completed! </div>
                                </div>
                                <br>
                                  <br>
                                    <br>
                                <div class="jumbotron text-center">
                                  <h1 class="display-3">Thank You! <?php echo $ufn; ?> </h1>
                                  <p class="lead"><strong>Please check your email</strong> for further instructions. Our staff will email you a copy of your report in a few working days!</p>
                                  <hr>
                                  <p>
                                    Having trouble? <a href="https://www.CHMSU.edu.my">Contact us</a>
                                  </p>
                                
                                </div>


                                </div>
                            </div>
                        </div>


   


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




<?php
                
                   
              
        echo "</div>";
        echo "</div>";
  
 //#page-content-wrapper -->
    echo "</div>";

    echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js'></script>";
    echo "<script>
         var el = document.getElementById('wrapper');
         var toggleButton = document.getElementById('menu-toggle');

        toggleButton.onclick = function () {
             el.classList.toggle('toggled');
         };";
    echo "</script>";
echo "</body>";
        


echo "</html>";

?>
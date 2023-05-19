<?php

$_SESSION['user_id'] = $id;

$ufn = $_SESSION['user_full_name'];

$_SESSION['entry'] = 1;


                                 $conn = new mysqli('localhost', 'root', '', 'ims');
                           
                                 $sql = "SELECT j.Job_ID, i.COMPANY_NAME, i.CONTACT_NO, i.WEBSITE, i.Email from applicants a
                                        inner join jobs j on a.Job_ID = j.Job_ID
                                        inner join industry i on j.REGIS_NO = i.REGIS_NO
                                    where a.confirmation = 'YES' and a.STUDENT_ID = '$id'";
                                    $query_run = mysqli_query($conn, $sql);
                                    



                                    $appid = "SELECT s.STUDENT_ID, a.appID, j.Job_ID, i.REGIS_NO, a.Status, s.ENROLL from student s
                                            inner join applicants a on s.STUDENT_ID = a.STUDENT_ID
                                            inner join jobs j on a.Job_ID = j.Job_ID
                                            inner join industry i on j.REGIS_NO = i.REGIS_NO
                                             where  (a.Status = 'Ending' OR a.Status = 'Confirmed') AND s.STUDENT_ID = '$id'";

                                    $app_run = mysqli_query($conn, $appid);

                                    if($app_run){
                                        foreach ($app_run as $x) {

                                           
                                            $app = $x['appID'];
                                            $stat = $x['ENROLL'];
                                            $jobstate = $x['Status'];
                                            
                                        }
                                    }
                                    else{
                                        print_r("Didnt work");
                                    }



                                 if(isset($_POST['Email'])) {

                                     $f_ID = $_POST['Email'];  // approve

                                     $_SESSION['job_email'] = $f_ID;

                                    header("Location: student_email.php");
    
                                  }


                                if (isset($_POST['Ending'])) {
                                   $e = $_POST["Ending"];

                                   $change = " UPDATE applicants
                                               SET Status = 'Ending'
                                                WHERE STUDENT_ID ='$id' and appID = '$app'";       // updating confirmation status

   
                                    $check = mysqli_query($conn, $change);    //Excecute query

                                    if ($check) {
                                        echo "done";
                                    }
                                    else{
                                        echo "not done";
                                    }
                                    header("Location: student_dashboard.php");
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
                <?php 

                if ($jobstate == "Confirmed") {
                  echo'  
                  <div class="row my-5">

                         <div class="col">
                            <h3 class="fs-4 mb-3">Internship Status </h3>
                              <div class="progress" style="height:50px; font-size:1em;">
                                  <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated " role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" >60% | Internship started </div>
                                </div>
                                <br>
                            </div> 
                    </div>
                    ';
                }
                 elseif ($jobstate == "Ending" ){

                    echo'  
                  <div class="row my-5">

                         <div class="col">
                            <h3 class="fs-4 mb-3">Internship Status </h3>
                              <div class="progress" style="height:50px; font-size:1em;">
                                  <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated " role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" >80% | Awaiting staff completion </div>
                                </div>
                                <br>
                            </div> 
                    </div>
                    ';


                 }
                   
                

                ?>
                                           
                                          




                <div class="row my-5">
                    <h3 class="fs-4 mb-3">List of Company waiting for Email</h3>
                        <div class="col">
                                                


                                   
                                                      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                 <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                  </symbol>
                                                 </svg>

                                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                                                  <div>
                                                    Use this module to email any companies that you have not decided to enroll for.

                                                  </div>
                                                </div>
                                          


                       <!-- Fetching data module  -->
                                <div class="card">
                                    <div class="card-body">
                                      <form method="POST">
                                        <table id="datatableid" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Company Name</th>
                                                    <th scope="col">Contact number</th>
                                                    <th scope="col">Website</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Send Email</th>

                                                </tr>
                                            </thead>
                                  
                                            <tbody>
                                                    <?php
                                                    if($query_run)
                                                    {
                                                        
                                                        foreach($query_run as $row)
                                                        {

                                                            $r = $row['Job_ID'];
                                                          
                                                    ?>
                                                <tr>
                                                    <td> <?php echo $row['COMPANY_NAME']; ?></td>
                                                    <td> <?php echo $row['CONTACT_NO']; ?></td>
                                                    <td> <?php echo $row['WEBSITE']; ?></td>
                                                    <td> <?php echo $row['Email']; ?></td>
                                                    <td>
                                                        <button type="submit" class="btn btn-success editbtn" name = "Email" value ='<?php echo $r?>'>SEND</button>
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

                        <!--If the application status is confirmed then a button will appear, if the button is already pressed before a message will appear-->
                       
                            <?php if ($jobstate == "Confirmed") {
                                

                                echo '

                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                     <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                      </symbol>
                                     </svg>


                                    <div class="row my-5">
                                            <div class="col">
                                                      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                 <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                  </symbol>
                                                 </svg>

                                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                                                  <div>
                                                    Please press the button only if you are done with your Internship! 

                                                  </div>
                                                </div>
                                            </div>
                                        </div>        



                                    <form method="POST">
                                       <button type="submit" class="btn btn-danger" name="Ending" value="Ending"> Complete Internship </button>
                                    </form>
                                    ';
                             }elseif ($jobstate == "Ending" )

                             {
                                echo'
                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                     <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                      </symbol>
                                     </svg>


                                    <div class="row my-5">
                                            <div class="col">
                                                      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                 <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                  </symbol>
                                                 </svg>

                                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                                                  <div>
                                                    Please wait for the staff to confirm your completion! 

                                                  </div>
                                                </div>
                                            </div>
                                        </div>        

                                        ';
                            }?>

    
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
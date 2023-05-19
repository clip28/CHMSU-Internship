
 <?php
    

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) { 

    $id = $_SESSION['user_id'];
    //test
?>



<?php 



$ufn = $_SESSION['user_full_name'];

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

                echo "<button class='navbar-toggler' type='button' data-bs-toggle='collapse';
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

                echo '
             <div class="container-fluid px-4">   
                    <div class="row my-5">

                         <div class="col">
                            <h3 class="fs-4 mb-3">Internship Status </h3>
                              <div class="progress" style="height:50px; font-size:1em;">
                                  <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated " role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" >40% | Awaiting staff approval </div>
                                </div>
                                <br>
                            </div> 
                        </div>
                   


                   <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                     <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                      </symbol>
                     </svg>


                
                        <div class="col">
                                  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                             <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                              </symbol>
                             </svg>

                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                              <div>
                                Congratulations on applying to a company! Please sit tight while our staff go through your application. It should be sorted within 1-2 days. In the meantime, feel free to do further research on your chosen company and if you have any enquiries, do email them for further information .

                              </div>
                        </div>
                    </div>

            </div>


                    ';




                

                   
              
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

<?php
}else {
   header("Location: login_access.php");
}
 ?>
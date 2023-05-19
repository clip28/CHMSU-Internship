<?php




session_start();


$idustryID = $_SESSION['company_id'];


$server = "localhost";
        $username = "root";
        $password = "";
        $database = "ims";

        $conn = mysqli_connect($server, $username, $password, $database);


if(isset($_SESSION['company_id']))
	{



		$r=mysqli_query($conn,"SELECT * FROM industry where REGIS_NO = $idustryID ");

                 $row=mysqli_fetch_assoc($r);


?>

<!DOCTYPE html>
 <html>
 <head>
 	  <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
 	  <title>Industry Profile</title>

 </head>
 <body>
 	 <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
            <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-address-book me-1"></i>CHMSU</div>
            <div class="list-group list-group-flush my-3">
            
                  <a href="in_joblist.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
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
                    <h2 class="fs-2 m-0">Profile Page</h2>
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
                <!-- Content wrapper -->


                 <div class="container-fluid px-4">      
              <div class="card">
                <div class="card-body">
              <div class="card mb-3">
                <h2 style="text-align: center;">Industry Profile</h2>

                    <h4 style="text-align: center;"><?php echo $_SESSION['company_id']; ?></h4>
                <div class="card-body">
                <hr>
                    
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                      echo $row['COMPANY_NAME'];
                      ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Adress</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                      echo $row['COMPANY_ADDRESS'];
                      ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Contact No</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                      echo $row['CONTACT_NO'];

                      ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Website Link</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                      echo $row['WEBSITE'];
                      ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                      echo $row['Password'];
                      ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                      echo $row['USERNAME'];
                      ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php
                      echo $row['Email'];
                      ?>
                    </div>
                  </div>
                  



                  <div class="row">
                    <div class="col-sm-12">
                      
                      <form action="" method="post">
                                <button class="btn btn-info" style="float: right; width: 70px;" name="submit1">Edit</button>
                            </form>
                                <div class="wrapper">
                                <?php

                                    if(isset($_POST['submit1']))
                                    {
                                        ?>
                                            <script type="text/javascript">
                                                window.location="industry_edit.php"
                                            </script>
                                        <?php
                                    }
                                    
                                ?>
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

</html>

 <?php
 }else {
  header("Location:  login_access.php");
}
 ?>



 	
<?php

session_start();




$server = "localhost";
        $username = "root";
        $password = "";
        $database = "ims";

        $conn = mysqli_connect($server, $username, $password, $database);



$idustryID = $_SESSION['company_id'];
 				

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
    <title>Industry Edit</title>
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
                    <h2 class="fs-2 m-0">Profile Page </h2>
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
                <div class="row my-5">
                    
                    <div class="col">
                        
			    <?php
					
					$sql = "SELECT * FROM industry WHERE REGIS_NO='$_SESSION[company_id]'";
					$result = mysqli_query($conn,$sql) or die (mysql_error());

					while ($row = mysqli_fetch_assoc($result)) 
					{
						$COMPANY_NAME=$row['COMPANY_NAME'];
						$COMPANY_ADDRESS=$row['COMPANY_ADDRESS'];
						$CONTACT_NO=$row['CONTACT_NO'];
						$WEBSITE=$row['WEBSITE'];
						$Password=$row['Password'];
						$USERNAME=$row['USERNAME'];
						$Email=$row['Email'];
					}

				?>

    
    <div class="card">
    <div class="card-body">
    <div class="card mb-3">
    <div class="card-body">
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
         
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
            <h2 style="text-align: center;color: #black;">Edit Information</h2>
            <hr>  
                
                
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-6"><label class="labels">Name</label><input class="form-control" type="text" name="COMPANY_NAME" value="<?php echo $COMPANY_NAME; ?>"></div>
                    
                
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Student Email</label><input class="form-control" type="text" name="COMPANY_ADDRESS" value="<?php echo $COMPANY_ADDRESS; ?>"></div>
                    <div class="col-md-12"><label class="labels">Contact No</label><input class="form-control" type="text" name="CONTACT_NO" value="<?php echo $CONTACT_NO; ?>"></div>
                    
                    <div class="col-md-12"><label class="labels">Website</label><input class="form-control" type="text" name="WEBSITE" value="<?php echo $WEBSITE; ?>"></div>
                    <div class="col-md-12"><label class="labels">Password</label><input class="form-control" type="text" name="Password" value="<?php echo $Password; ?>"></div>
                    <div class="col-md-12"><label class="labels">Username</label><input class="form-control" type="text" name="USERNAME" value="<?php echo $USERNAME; ?>"></div>
                    <div class="col-md-12"><label class="labels">Email</label><input class="form-control" type="text" name="Email" value="<?php echo $Email; ?>">
                    </div>
                   

                <div class="mt-5 text-center"><button class="btn btn-info" type="submit" name="submit">Save Profile</button></div>
                <div class="mt-5 text-center"><button class="btn btn-info" ><a href="industry_profile.php"> BACK</a></button></div>
                </form>

            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                
            </div>
        </div>
    </div>
</div>
</div>
</div>
                   

        <?php 

		if(isset($_POST['submit']))
		{

			$COMPANY_NAME=$_POST['COMPANY_NAME'];
			
			$COMPANY_ADDRESS=$_POST['COMPANY_ADDRESS'];
			
			$CONTACT_NO=$_POST['CONTACT_NO'];
		
			$WEBSITE=$_POST['WEBSITE'];
			
			$Password=$_POST['Password'];

			$USERNAME=$_POST['USERNAME'];
			
			$Email=$_POST['Email'];
			

		

			$sql1= "UPDATE industry SET COMPANY_NAME='$COMPANY_NAME', COMPANY_ADDRESS='$COMPANY_ADDRESS', CONTACT_NO='$CONTACT_NO', WEBSITE='$WEBSITE', Password='$Password', USERNAME='$USERNAME',Email='$Email' WHERE REGIS_NO = $idustryID";
			

			if(mysqli_query($conn,$sql1))
			{
				?>
					<script type="text/javascript">
						alert("Saved Successfully.");
						window.location="industry_profile.php";
					</script>
				<?php
			}
		}
 	?>
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

</html>


            













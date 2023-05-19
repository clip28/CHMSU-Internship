<?php

session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) { //if there is no session then the page ont load

//taking session variables

 $id = $_SESSION['user_id'];

 $apID = $_SESSION['appID'];

        //establishing connection
 	    $server = "localhost";
        $username = "root";
        $password = "";
        $database = "ims";

        $conn = mysqli_connect($server, $username, $password, $database);

        $cvErr = "";

                //query to get application id and student info based on those id

          			$sql = "SELECT * from applicants where appID =$apID";
          			$result = $conn->query($sql);
          			$row = mysqli_fetch_assoc($result);

          			$date = date('Y-m-d');
          			$StudentID = $row['STUDENT_ID'];
          			$docID = $row['appID'];

        //submitting documents
        if (isset($_POST['submit'])) {
    
       	 	if (isset($_FILES["file"])) {

       		 	$fileName = $_FILES['file']['name'];
        		$fileTmpName = $_FILES['file']['tmp_name'];
        		$fileSize = $_FILES['file']['size'];
        		$fileError = $_FILES['file']['error'];
        		$fileType = $_FILES['file']['type'];

       		 	$fileExt = explode('.', $fileName);
        		$fileActualExt = strtolower(end($fileExt)); //just keeping the extension part of the name

        		//only allow pdfs
        		$allowed = array('pdf');

        		//creating folder to upload files if it does not exist

        		if (!file_exists('documents')) //create directory if not there
        		{
          			mkdir('documents', 0777, true);
    
        		}else{
         			echo "folder exists";
        		}

          		if (in_array($fileActualExt, $allowed)) {

           			if ($fileError === 0) {

              			if ($fileSize < 20000000) {
        
                			$fileNameNew = $docID."_".$StudentID."_".$date.".".$fileActualExt;


                			$fileDestination = 'documents/'.$fileNameNew;
              
                   			move_uploaded_file($fileTmpName, $fileDestination);
           

            	

              			           $cv = $fileNameNew;


              		                //updating application table
                                		$apply = "UPDATE applicants
                                                SET Status ='pending'
                                                WHERE appID='$apID'";

                                                   // updating confirmation status
   
                                     	mysqli_query($conn, $apply);    //Excecute query


                                    //updating the document name
              						 $apply = " UPDATE applicants
                                                SET Proof ='$cv'
                                                WHERE appID='$docID'";       // updating the file name in database
   
                                     	mysqli_query($conn, $apply);    //Excecute query

                                    //updating enrolling status in student table 
                                      $apply = " UPDATE student
                                                SET ENROLL ='pending'
                                                WHERE STUDENT_ID='$id'";       // updating the file name in database
   
                                        $trial = mysqli_query($conn, $apply);    //Excecute query   

               	

                                 	header("Location: student_dashboard.php");

            			}else{
              				echo "you file is too big";
            			}
      
          			}else{
              				echo "there was an error while uploading your file";
          			}
    
        	} else{
          			echo "You cannot upload files of this type only pdf are allowed!";
        	}

      	}
      }
      else{
      	$cvErr = "<span style='color:red;'>Must upload a Document!</span>";
      }
   


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
                <a href="student_companylist.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Company listing</a>        
                <a href="student_dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-chart-line me-2"></i>User Dashboard</a>
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
                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Please submit documents</h3>
                    <div class="col">

					<form action = "student_submission.php" method = "POST" enctype="multipart/form-data" >
						
						<label>Insert Your Documents: <input type="file" name="file" value = "<?php if(isset($_POST["file"])) echo $_POST["file"]; ?>">
      					<span class="error"> <?php echo $cvErr;?></span> </label>
      					 <input type="submit" value="submit" name="submit">
     					 <input type="reset" value="Clear" name="clear_button">

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

</html>
<?php 
}else {
  header("Location:  student_login.php");
}
 ?>
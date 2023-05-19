<?php
//function test input
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$StudentID = $uname = $Course = $ContactNo = $Cresidence = $email = $Gender = $pname = $pwd = $Enrolled = $Supervisor = $yof = $cv = NULl;

// define variable and set to empty VALUES
$msgErr = $emailErr = $pnameErr = $pwdErr = $StudentErr = $cpwdErr = $pwdErr = $cpwdErr = $CourseErr = $GenderErr = $CresErr = $Contact_noErr = $cvErr = $yofErr = $unameErr = "";

if(isset($_POST["register_button"])){
  $success = 1;
  $StudentID = $_POST["Student_ID"];
  $uname = $_POST["uname"];
  $Course = $_POST["Course"];
  $ContactNo = $_POST["Contact_no"];
  $Gender = $_POST["Gender"];
  $Cresidence = $_POST["Cresidence"];
  $email = $_POST["email"];
  $pname = $_POST["pname"];
  $pwd = $_POST["pwd"];
  $cpwd = $_POST["cpwd"];
  $Enrolled = null;
  $yof = $_POST["yof"];
  $cv = $_FILES["file"];
 
  //$date_started = date("Y/m/d");
  //  Check Student ID process
    if (empty($_POST["Student_ID"])) {
        $StudentErr = "<span style='color:red;'>Student ID is required.</span>";
        $success = 0;
      }
      //else {
       // $StudentID = test_input($_POST["Student_ID"]);
        //if (!preg_match("/^[a-zA-Z]101\d{6}$/",$StudentID)) {    // check if it matches pattern
         // $StudentErr = "<span style='color:red;'>Only numbers are allowed, use CHMSU student ID.</span>";
         // $success = 0;
        //}
    // }

  // Email validation process
      if (empty($_POST["email"])) {
        $emailErr = "<span style='color:red;'>Email is required.</span>";
        $success = 0;
      }
      else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {     // check if e-mail address is well-formed
          $emailErr = "<span style='color:red;'>Invalid email format.</span>";
          $success = 0;
        }
      }

   // Username name validation process
      if (empty($_POST["uname"])) {
        $unameErr = "<span style='color:red;'>Username is required.</span>";
        $success = 0;
      }
      else {
        $pname = test_input($_POST["uname"]);
        if (!preg_match("/^[a-zA-Z]*$/",$uname)) {    // check if name only contains letters
          $unameErr = "<span style='color:red;'>Only letters are allowed with maximum 10 characters, no blanks.</span>";
          $success = 0;
        }
            elseif(strlen($uname) >= 10){
                $unameErr = "<span style='color:red;'>Only 10 characters are allowed.</span>";
                $success = 0;
          }
      }    

  // Profile name validation process
      if (empty($_POST["pname"])) {
        $pnameErr = "<span style='color:red;'>Full name is required.</span>";
        $success = 0;
      }
      else {
        $pname = test_input($_POST["pname"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$pname)) {    // check if name only contains letters
          $pnameErr = "<span style='color:red;'>Only letters are allowed with maximum 25 characters.</span>";
          $success = 0;
        }
    elseif(strlen($pname) >= 40){
      $pnameErr = "<span style='color:red;'>Only 40 characters are allowed.</span>";
      $success = 0;
    }
      }


  // Profile Course validation process
      if (empty($_POST["Course"])) {
        $CourseErr = "<span style='color:red;'>Course is required.</span>";
        $success = 0;
      }

// Year of study validation process
      if (empty($_POST["yof"])) {
        $yofErr = "<span style='color:red;'>Year of Study is required.</span>";
        $success = 0;
      }

  // Gender validation process
      if (empty($_POST["Gender"])) {
        $GenderErr = "<span style='color:red;'>Gender is required.</span>";
        $success = 0;
      }


  // Resident validation process
      if (empty($_POST["Cresidence"])) {
        $CresErr = "<span style='color:red;'>Current Residence Address is Required.</span>";
        $success = 0;
      }

   //  Check Contact Number process
    if (empty($_POST["Contact_no"])) {
        $Contact_noErr = "<span style='color:red;'>Contact Number is required.</span>";
        $success = 0;
      } 
    //  else {
    //    $ContactNo = test_input($_POST["Contact_no"]);
    //    if (!preg_match("/^(\+\d{1,3}[- ]?)?\d{10}$/",$ContactNo)) {    // check if it matches pattern
    //      $Contact_noErr = "<span style='color:red;'>Please Use Valid number.</span>";
   //       $success = 0;
    //    }
      
   // }

  // Password validation process
    if(empty($_POST["pwd"])){   // check if both password does match
        $pwdErr = "<span style='color:red;'>Password is required.</span>";
        $success = 0;
      }
    //check if length is 8
    //elseif (strlen($pwd) < 8){
    //  $pwdErr = "<span style='color:red;'>Your Password Must Contain At least 8 characters!.</span>";
    //  $success = 0;
    //}
    // check if atleast has one letter
   // elseif (!preg_match("/[A-Z]/",$pwd)){
   //   $pwdErr = "<span style='color:red;'>Your Password Must Contain At Least 1 Capital Letter!</span>";
   //   $success = 0;
   // }
    // check if atleast has one number
   // elseif (!preg_match("/[1-9]/",$pwd)){
   //   $pwdErr = "<span style='color:red;'>Your Password Must Contain At Least 1 Number!</span>";
   //   $success = 0;
  //  }
    //check if atleast has one small letter
   ///  elseif (!preg_match("/[a-z]/",$pwd)){
   //   $pwdErr = "<span style='color:red;'>Your Password Must Contain At Least 1 lower case letter!</span>";
    //  $success = 0;
  //  } 
      elseif(empty($cpwd)){   // check if confirm password isnt empty
        $cpwdErr = "<span style='color:red;'>Password is required.</span>";
        $success = 0;
      }
    
      else
      //check if both password is matching
    {
        if($pwd != $cpwd) {
          $cpwdErr = "<span style='color:red;'>Both password does not match. Please try again.</span>";
          $success = 0;
        }
      }

      if ($success == 1) {

        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "ims";

        $conn = mysqli_connect($server, $username, $password, $database);



            //checking if empty or not

        if (empty($_FILES["file"])) {

          $cvErr = "<span style='color:red;'>Must upload a CV!</span>";


       }else{
        // uploading file function
        //seperating all the types in the array

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

        if (!file_exists('uploads')) //create directory if not there
        {
          mkdir('uploads', 0777, true);
    
        }else{
         echo "couldnt make folder";
        }

          if (in_array($fileActualExt, $allowed)) {

            if ($fileError === 0) {

              if ($fileSize < 20000000) {
        
                $fileNameNew = "profile".$StudentID.".".$fileActualExt;


                $fileDestination = 'uploads/'.$fileNameNew;
              
                   move_uploaded_file($fileTmpName, $fileDestination);
           

            // header("location: index.php?uploadsuccess");

              $cv = $fileNameNew;

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


        if(!$conn){
          die("Connection failed: " . mysqli_connect_error());
        }

        else{
             mysqli_query($conn,"ALTER TABLE student AUTO_INCREMENT = 1");
            $getEmail = "SELECT * from student where STUDENT_EMAIL = ?";         //Validation if same email were used
            $stmt = mysqli_stmt_init($conn); //initialize statement with connection
            mysqli_stmt_prepare($stmt,$getEmail); //prepare statement
            mysqli_stmt_bind_param($stmt, "s", $email); //binding variable into string
            mysqli_stmt_execute($stmt); //execute statement
            mysqli_stmt_store_result($stmt); //storing the result
            $row = mysqli_stmt_num_rows($stmt); //fetching rows number

              mysqli_query($conn,"ALTER TABLE student AUTO_INCREMENT = 1");
            $getID = "SELECT * from student where STUDENT_ID = ?";         //Validation if same email were used
            $stmt = mysqli_stmt_init($conn); //initialize statement with connection
            mysqli_stmt_prepare($stmt,$getID); //prepare statement
            mysqli_stmt_bind_param($stmt, "s", $StudentID); //binding variable into string
            mysqli_stmt_execute($stmt); //execute statement
            mysqli_stmt_store_result($stmt); //storing the result
            $idrow = mysqli_stmt_num_rows($stmt); //fetching rows number

            if($idrow != 0){
              $msgErr = "<p style='color:red;'> Registration failed!<br> An account with the same UserID already exist</p>";
            }

            elseif($row != 0){
              $msgErr = "<p style='color:red;'> Registration failed!<br> An account with the same email already exist</p>";
            }

            else{           //else create query with all the correct validation and write into tables
              $create ="INSERT INTO student (STUDENT_ID, NAME, STUDENT_EMAIL, COURSE, ENROLL, GENDER, CURRENT_RESIDENCE, CONTACT_NO, YEAR_OF_STUDY, PASSWORD, CV, USERNAME) VALUES(?,?,?,?,?,?,?,?,?,?,?,?);";

                mysqli_stmt_prepare($stmt,$create);
                mysqli_stmt_bind_param($stmt, "ssssssssssss",$StudentID, $pname, $email, $Course, $Enrolled, $Gender, $Cresidence, $ContactNo, $yof, $pwd, $cv, $uname);
                mysqli_stmt_execute($stmt);
                session_start();

               header("Location:student_login.php");       //direct to friendadd.php
              }

              mysqli_stmt_close($stmt);

              }

              mysqli_close($conn);
            }
          }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">

  

<!-- Forms -->
<div class="form-group">
  
      <form class="p-5 rounded shadow" action = "signup.php" method = "POST" enctype="multipart/form-data" >
        <div class="mb-3">
          <h1 class="text-center pb-5 display-4">CHMSU IMS Student Sign up</h1>
            <label class="form-label">Student ID:</label>
            <span class="error"> <?php echo $StudentErr;?></span>
            <input type="text"  class="form-control" name="Student_ID" value = "<?php if(isset($_POST["Student_ID"])) echo $_POST["Student_ID"]; ?>">
            

            <label class="form-label">Email address: </label>
            <span class="error"> <?php echo $emailErr;?></span>
            <input type="text"  class="form-control" name="email" value = "<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>">
            

             <label class="form-label">Password: </label>
             <span class="error"> <?php echo $pwdErr;?></span> 
            <input type="password" class="form-control" name="pwd">
            

             <label class="form-label">Confirm password: </label>
             <span class="error"> <?php echo $cpwdErr;?></span> 
            <input type="password"  class="form-control" name="cpwd">
            

             <label class="form-label">Username: </label>
             <span class="error"> <?php echo $unameErr;?></span> 
            <input type="text"  class="form-control" name="uname" value = "<?php if(isset($_POST["uname"])) echo $_POST["uname"]; ?>">
            

             <label class="form-label">Name: </label>
             <span class="error"> <?php echo $pnameErr;?></span> 
            <input type="text"  class="form-control" name="pname" value = "<?php if(isset($_POST["pname"])) echo $_POST["pname"]; ?>">
            

            <p> 
                <label for="Course class="form-label"">Choose a course:</label>
                <span class="error"> <?php echo $CourseErr;?></span>
                <select class="form-select" name="Course" id="Course">
                  <option value="" selected="selected">---</option>
                  <option value="Bachelors of Science in Information System">Bachelors of Science in Information System</option>
                  <option value="Bachelors of Science in Entrepreneurship">Bachelors of Science in Entrepreneurship</option>
                  <option value="Bachelors of Science in Management Accounting">Bachelors of Science in Management Accounting</option>
                  <option value="Bachelor of Science in Business Administration">Bachelor of Science in Business Administration</option>
                  <option value="Bachelor of Science in Office Administration">Bachelor of Science in Office Administration</option>
                  <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy</option>
                </select>
                
             </p>

          
          <p> 
                <label for="yof" class="form-label">Year of Study:</label>
                 <span class="error"> <?php echo $yofErr;?></span> </p>
                <select class="form-select" name="yof" id="yof">
                  <option value="" selected="selected">---</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
                <br>
           
           

            <p>Gender:
              <br>
               <input type="radio" id="Gender" name="Gender" value="Male" placeholder="Male">
               <label for="Male">Male</label>
               <input type="radio" id="Female" name="Gender" value="Female" placeholder="Female">
               <label for="Female">Female</label><br>
           
            
              <span class="error"> <?php echo $GenderErr;?></span> </p>

            <label class="form-label">Current Residence: </label>
            <span class="error"> <?php echo $CresErr;?></span> 
            <input type="text" class="form-control" name="Cresidence" value = "<?php if(isset($_POST["Cresidence"])) echo $_POST["Cresidence"]; ?>">
            

            <label class="form-label"> Contact Number:</label> 
            <span class="error"> <?php echo $Contact_noErr;?></span> 
            <input type="text" class="form-control" name="Contact_no" value = "<?php if(isset($_POST["Contact_no"])) echo $_POST["Contact_no"]; ?>">
            

            <label class="form-label"> Insert Your CV: </label>
            <span class="error"> <?php echo $cvErr;?></span> 
            <input type="file" class="form-control" name="file" value = "<?php if(isset($_POST["file"])) echo $_POST["file"]; ?>">
            
            <br>
            <br>

            <input type="submit" value="Register" name="register_button">
            <input type="reset" value="Clear" name="clear_button">

            <span class="error"> <?php echo $msgErr;?></span>
            <br>
            <br>
            <p> Have an account ? <a href="student_login.php"> Login</a> </p>
          </div>
          </form>
      </div>
    </div>
  

<!-- Footer -->


   


</body>
</html>

<?php 
  session_start();

  $id = $_SESSION['user_id'];
  

    if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) { 

    if($_SESSION['entry'] = 1){

        $uemail = $_SESSION['user_email'];
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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <title>IMS</title>
</head>




<body>


       <?php 

                                 $conn = new mysqli('localhost', 'root', '', 'ims');

                                  $jid = $_SESSION['job_email'];
                                    
  


                            
                                $sql = "SELECT i.Email, i.COMPANY_NAME  from jobs j inner join industry i on j.REGIS_NO = i.REGIS_NO where j.Job_ID = '$jid'";
                                    $result = mysqli_query($conn, $sql);
                                   $row = mysqli_fetch_assoc($result);

                                   $cname = $row['COMPANY_NAME'];
                                   $cweb = $row['Email'];
                        

                                

                                if(isset($_POST['send'])){

                                
                                $to = $cweb;
                                $subject = $_POST['subject'];
                                $from = $uemail;
                                 
                                // To send HTML mail, the Content-type header must be set
                                $headers  = 'MIME-Version: 1.0' . "\r\n";
                                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                                 
                                // Create email headers
                                $headers .= 'From: '.$from."\r\n".
                                    'Reply-To: '.$from."\r\n" .
                                    'X-Mailer: PHP/' . phpversion();
                                 
                                // Compose a simple HTML email message
                                $message = $_POST['message'];
                            // Sending email
                            $work = mail($to, $subject, $message, $headers);


                        switch( $result ){
                            case true:
                                $msg='Thank you for contacting us! All information received will always remain confidential. We will contact you as soon as we review your message.';
                            break;
                            case false:
                                $msg='failed to send the mail';
                            break;
                        }

                        echo "<script type='text/javascript'>alert('{$msg}');</script>";
                    }

                                     $apply = " UPDATE applicants
                                                SET confirmation='NO'
                                                WHERE Job_iD=$jid AND Status = null;";       // updating confirmation status
   
                                     mysqli_query($conn, $apply);    //Excecute query

                                    //header("Location: in_applicants.php?data=$Jid");
    
                                  



                        ?>







<div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-address-book me-1"></i>CHMSU</div>
            <div class="list-group list-group-flush my-3">
                <a href="student_internshiplisting.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Internship listing</a>
                  <a href="student_companylist.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Company listing</a>                   
                <a href="student_dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
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
                    <h2 class="fs-2 m-0">Email rejection </h2>
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
                    <h3 class="fs-4 mb-3">Please Send Rejection Email</h3>
                    <div class="col">



          <form action="student_email.php" method="post">
                

            <p>Company Name: <span><?php echo "$cname" ?></span></p>
            <p>Company Email Address: <span><?php echo "$cweb" ?></span></p>
            <div>
               <input name="subject" type="text" placeholder="Subject" class="form-control">
            </div>
            <div>
                <textarea name="message"  class="form-control" placeholder="Message" rows="20"></textarea>
            </div>
            <br>
            <br>
            <div>
                <input type="submit" name="send" value="submit" />
            </div>
            <output id='msgs'></output>
        </form>

        <a href="student_dashboard.php"> Back </a>    
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

                                    $('#datatableid1').DataTable(
                                         {
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
                                        }      
                                    );

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
 }else{
    header("Location:  login_acess.php");
 } 
}else {
   header("Location:  login_acess.php");
}


 ?>

<?php 
  session_start();

if (isset($_SESSION['company_id']) && isset($_SESSION['user_email'])) { 

    $id = $_SESSION['company_id'];

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
            
                  <a href="in_joblist.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
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
                    <h2 class="fs-2 m-0">Industry feedback</h2>
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

            <div class="container-fluid px-4">
                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Feedback form</h3>
                    <div class="col">


        <!--fething data module-->
        <p>Please provide feedback to the student</p>
                    <div class="card">
                        <div class="card-body">

                                    <div class="row">
                    
                                    
                                        <div class="modal-header">
                                            <h5 class="modal-title">Feedback</h5>
                                            <h4 style="color: black;"><?php echo $_SESSION['user_full_name']; ?></h4>
                                        </div>
                                             
                                            

                                        <form action = "industry_submit_rating.php" method = "POST">
                                        <div class="modal-body">

                                            <h4 class="text-center mt-2 mb-4">
                                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                                            </h4>
                                                <input type="hidden" id="star1" name="star1" value="asdas">


                                             
                                            <div class="form-group">
                                                                    <div>
                                                    <p>Were you satisfied with the performance of the intern?</p>
                                                    <div class="rating_question1">
                                                        <input type="radio" name="question1" id="radio1" value="Yes">
                                                        <label for="radio1">Yes</label>
                                                        <input type="radio" name="question1" id="radio2" value="No">
                                                        <label for="radio2">No</label>
                                                    </div>
                                                    
                                                    <p>Is the intern up to industry standard?</p>
                                                   
                                                        <div class="rating_question2" >
                                                            <input type="radio" name="question2" id="radio3" value="Yes">
                                                            <label for="radio3">Yes</label>
                                                            <input type="radio" name="question2" id="radio4" value="No">
                                                            <label for="radio4">No</label>      
                                                        </div>      
                                                                
                                                    </div>
                                               
                                                <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                                            </div>
                                            <div class="form-group text-center mt-4">
                                            
                                                <input type="submit" class="btn btn-primary" value="submit" name="submit" id="save_review">
                                                </div>
                                          
                                        </div>
                                      </form>
                                    </div>

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
                            <script>
    
        var rating_data = 0;

    $('#add_review').click(function(){

        $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function(){

        var rating = $(this).data('rating');

        reset_background();

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');


        document.getElementById("star1").value = rating_data;



    });

  $('#save_review').click(function(){

      var user_name = $('#user_name').val();
       

        var user_review = $('#user_review').val();
       

     
       var user_rating2 = document.getElementsByName('question2');

        if(user_name == '' || user_review == '' || rating_data =='')
        {
            alert("Please Fill all Field");
            return false;
        }
        else
        {
            $.ajax({
               url:"submit_rating.php",
                type:"POST",
                data:{rating_data:rating_data},
                success:function(data)
                {
                    $('#review_modal').modal('hide');

                    load_rating_data();

                    alert(data);
                }
            });
        }

 });
    const setStep = step => {
    document.querySelectorAll(".step-content").forEach(element => element.style.display = "none");
    document.querySelector("[data-step='" + step + "']").style.display = "block";
    document.querySelectorAll(".steps .step").forEach((element, index) => {
        index < step-1 ? element.classList.add("complete") : element.classList.remove("complete");
        index == step-1 ? element.classList.add("current") : element.classList.remove("current");
    });
};
document.querySelectorAll("[data-set-step]").forEach(element => {
    element.onclick = event => {
        event.preventDefault();
        setStep(parseInt(element.dataset.setStep));
    };
});
<?php if (!empty($_POST)): ?>
setStep(4);
<?php endif; ?>

   

</script>






</html>

<?php 
}else {
   header("Location:  industry_login.php");
}
 ?>

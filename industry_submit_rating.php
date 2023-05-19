
<?php

 session_start();

		$server = "localhost";
        $username = "root";
        $password = "";
        $database = "ims";

        $conn = mysqli_connect($server, $username, $password, $database);
        



        $aid = $_SESSION['app'];
        $uname = $_SESSION['user_full_name'];




            $query1  = "SELECT a.STUDENT_ID, a.Job_ID from applicants a where a.appID = '$aid'";
            $app_run = mysqli_query($conn, $query1);
      
                   foreach ($app_run as $x) {

                                	
                                            $sid = $x['STUDENT_ID'];
                                        
                                            $jid = $x['Job_ID'];
                                          

                               }


        

if(!$conn){
	echo "connection failed";
}
else{


	$rating1 = $_POST['star1'];

if (isset($_POST['submit'])){


	
		$user_review =	$_POST["user_review"];
	
	
		$que1 = $_POST['question1'];
	
		$que2 = $_POST['question2'];

		$date = date("Y/m/d");


	$stmt = mysqli_stmt_init($conn); //initialize connection to statement

	$query = "INSERT INTO industry_review_table (user_name, rating_question1, rating_question2, user_rating, user_review, datetime, STUDENT_ID, Job_ID) 
	VALUES (?, ?, ?, ?, ?,?,?,?)";

	mysqli_stmt_prepare($stmt, $query);
	mysqli_stmt_bind_param($stmt, 'ssssssss', $uname, $que1, $que2, $rating1, $user_review, $date, $sid, $jid);
	$insert = mysqli_stmt_execute($stmt);



	if(!$insert){
		echo "couldnt insert";
	}else{
		echo "works fine";
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);
		

}

  header("Location: in_joblist.php");

}



?>
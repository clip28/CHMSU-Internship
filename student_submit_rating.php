
<?php
session_start();

    $conn = new mysqli('localhost', 'root', '', 'ims');
        

           	 $id = $_SESSION['user_id'];
           	 print_r($id);
    		 $user_name = $_SESSION['user_full_name'];

if(!$conn){
	echo "connection failed";
}
else{


	$rating1 = $_POST['star1'];
	print_r($rating1);




		$appid = "SELECT s.STUDENT_ID, a.appID, j.Job_ID, i.REGIS_NO, a.Status, s.ENROLL from student s
          inner join applicants a on s.STUDENT_ID = a.STUDENT_ID
          inner join jobs j on a.Job_ID = j.Job_ID
           inner join industry i on j.REGIS_NO = i.REGIS_NO
            where  a.Status = 'Ended' AND s.STUDENT_ID = '$id'";

                    $app_run = mysqli_query($conn, $appid);

                    if($app_run){
                                        foreach ($app_run as $x) {

                                            print_r($x);
                                            $app = $x['appID'];
                                            $stat = $x['ENROLL'];
                                            $jobstate = $x['Status'];
                                            print_r($jobstate);
                                            $stu_info2 = $x['STUDENT_ID'];
                                            $jobid = $x['Job_ID'];
                                        }
                                 }       
                             else{
                             	echo "not working";
                             }


if (isset($_POST['submit'])){


	
		$user_review		=	$_POST["user_review"];
		print_r($user_review);
	
	
		$que1 = $_POST['question1'];
		print_r($que1);
	
		$que2 = $_POST['question2'];
		print_r($que1);

		$date = date("Y/m/d");






                     	$apply2 = " UPDATE applicants
                     			SET Status='Completed'
                                 WHERE appID ='$app'";       // updating confirmation status

                           $o = mysqli_query($conn, $apply2);    //Excecute query

                           if ($o) {
                           	echo "works";
                           }
                           else{
                           	var_dump($o);
                           }

                         //updating the status in student table


                          $enroll = " UPDATE student
                           SET ENROLL='Completed'
                           WHERE STUDENT_ID ='$stu_info2'"; 
   
                          $trial =  mysqli_query($conn, $enroll);

                            if ($trial) {
                           	echo "works";
                           }
                           else{
                           	var_dump($trial);
                           }

	


	$stmt = mysqli_stmt_init($conn); //initialize connection to statement

	$query = "INSERT INTO student_review_table (STUDENT_ID, user_name, rating_question1, rating_question2, user_rating, user_review, datetime, Job_ID) 
	VALUES (?, ?, ?, ?, ?,?,?,?)";

	mysqli_stmt_prepare($stmt, $query);
	mysqli_stmt_bind_param($stmt, 'ssssssss', $id, $user_name, $que1, $que2, $rating1, $user_review, $date, $jobid);
	$insert = mysqli_stmt_execute($stmt);



	if(!$insert){
		echo "couldnt insert";
	}else{
		echo "works fine";
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);
		

}

 header("Location:student_dashboard.php");


}



?>
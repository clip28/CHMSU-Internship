<?php 
session_start();
  $server = "localhost";
        $username = "root";
        $password = "";
        $database = "ims";

        $conn = mysqli_connect($server, $username, $password, $database);

if (isset($_POST['email']) && isset($_POST['password'])) {
	
	$email = $_POST['email'];
	print_r($email);
	$password = $_POST['password'];
	print_r($password);

	if (empty($email)) {
		header("Location: student_login.php?error=Email is required");
	}else if (empty($password)){
		header("Location: student_login.php?error=Password is required&email=$email");
	}else {


			$result = mysqli_query($conn, "SELECT * FROM student WHERE STUDENT_EMAIL = '$email'");
			$data = mysqli_fetch_assoc($result);

			print_r($data);

			if(!empty($data)){


				$user_id = $data['STUDENT_ID'];
				$user_full_name = $data['NAME'];
				$user_email = $data['STUDENT_EMAIL'];
				$user_password = $data['PASSWORD'];
				$user_status = $data['ENROLL'];
			

			if ($email === $user_email) {
				if ($password == $user_password) {
					$_SESSION['user_id'] = $user_id;
					$_SESSION['user_email'] = $user_email;
					$_SESSION['user_full_name'] = $user_full_name;
					$_SESSION['status'] = $user_status;

					header("Location: student_dashboard.php");

				}else {
					header("Location: student_login.php?error=Incorect User name or password&email=$email");
				}
			}else {
				header("Location: student_login.php?error=Incorect User name or password&email=$email");
			}
		}else {
			header("Location: student_login.php?error=Incorect User name or password&email=$email");
		}
	}
}

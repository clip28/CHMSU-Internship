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
		header("Location: staff_login.php?error=Email is required");
	}else if (empty($password)){
		header("Location: staff_login.php?error=Password is required&email=$email");
	}else {


			$result = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'");
			$data = mysqli_fetch_assoc($result);

			print_r($data);

			if(!empty($data)){


				$user_id = $data['Admin_ID'];
				$user_full_name = $data['Name'];
				$user_email = $data['email'];
				$user_password = $data['Password'];
			

			if ($email === $user_email) {
				if ($password == $user_password) {
					$_SESSION['user_id'] = $user_id;
					$_SESSION['user_email'] = $user_email;
					$_SESSION['user_full_name'] = $user_full_name;
					header("Location: staff_internshiplisting.php");

				}else {
					header("Location: staff_login.php?error=Incorect User name or password&email=$email");
				}
			}else {
				header("Location: staff_login.php?error=Incorect User name or password&email=$email");
			}
		}else {
			header("Location: staff_login.php?error=Incorect User name or password&email=$email");
		}
	}
}

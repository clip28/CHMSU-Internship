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
		header("Location: Industry_login.php?error=Email is required");
	}else if (empty($password)){
		header("Location: Industry_login.php?error=Password is required&email=$email");
	}else {
	
			$result = mysqli_query($conn, "SELECT * FROM industry WHERE email = '$email'");
			$data = mysqli_fetch_assoc($result);

			print_r($data);

			if(!empty($data)){

				$user_id = $data['REGIS_NO'];
				$user_full_name = $data['COMPANY_NAME'];
				$user_email = $data['Email'];
				$user_password = $data['Password'];


			if ($email === $user_email) {
				if ($password == $user_password) {
					$_SESSION['company_id'] = $user_id;
					$_SESSION['user_email'] = $user_email;
					$_SESSION['user_full_name'] = $user_full_name;
					header("Location: in_joblist.php");

				}else {
					header("Location: Industry_login.php?error=Incorect User name or password&email=$email");
				}
			}else {
				header("Location: Industry_login.php?error=Incorect User name or password&email=$email");
			}
		}else {
			header("Location: Industry_login.php?error=Incorect User name or password&email=$email");
		}
	}
}

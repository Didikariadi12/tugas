<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   if ($pass == $cpass) {
		$select = "SELECT * FROM iotuser WHERE email='$email'";
		
      $result = mysqli_query($conn, $select);

		if (!$result->num_rows > 0) {
			$select = "INSERT INTO iotuser (name, email, password)
					VALUES ('$name', '$email', '$pass')";
			
         $result = mysqli_query($conn, $select);
			if ($result) {
				// echo "<script>alert('Wow! User Registration Completed.')</script>";
            header("Location: login.php");
				$name = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists')</script>";
		}

	} else {
		// $error[] ='Password Not Matched';
      echo "<script>alert('Password Not Matched')</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register</h3>
      <?php
      // if(isset($error)){
      //    foreach($error as $error){
      //       echo '<span class="error-msg">'.$error.'</span>';
      //    };
      // };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <input type="submit" name="submit" value="register" class="form-btn">
      <p>already have an account? <a href="login.php">login</a></p>
   </form>

</div>

</body>
</html>
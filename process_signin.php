<?php 

session_start();

	include("connection.php");
	include("functions.php");
	
	

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$email = $_POST['email'];
		$password = $_POST['password'];

		
		
		if(!empty($email) && !empty($password) && !is_numeric($email))
		{

			//read from database
			$query = "select * from accounts where email = '$email' limit 1";
			$result = mysqli_query($con, $query);

			while ($record = mysqli_fetch_assoc($result)) {
			
		
	if($record["account_level"] == "0"){
		header("Location: account_unverified.php"); // if userlevel admin
	}elseif($record['account_level']=="1"){
		header("Location: admin.php"); // if user level is member
	}elseif($record["account_level"]=="2"){
		header("Location: user.php");
	}
}
			
			echo "wrong email or password!";
		}else
		{
			echo "wrong email or password!";
		}
	
		

	
}
	
     

?>
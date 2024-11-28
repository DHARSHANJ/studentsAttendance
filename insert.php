<?php 
  include("config.php");
  session_start();

if (isset($_POST['reg']))
{
	  $email = $_POST['emailid'];
	  $pass = $_POST['pass'];
	  
	 
	
	  $query="INSERT INTO TIH_login (email,pass) VALUES ('$email', '$pass')";

			  
		if ($db->query($query) === TRUE) 
		{	
			echo "<script>alert('Registration Successful');window.location.href='index.php';</script>";
		}

	
	else 
	{
			echo "<script>alert('Already Registered');window.location.href='index.php';</script>";		  
	}
}
<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['pass']); 
      
      $sql = "SELECT * FROM TIH_login WHERE id = '$myusername' and pass = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        // session_register("myusername");
		 $_SESSION['loggedin'] = TRUE;
         $_SESSION['login_user'] = $myusername;
         
?>
			<script>

  swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Login Successful'
            }).then(function() {
    window.location = "index.html";
});
   </script>
   <?php
	}
	  else
	  {
        ?>
        <script>

        swal.fire({
                      icon: 'failure',
                      title: 'Failure',
                      text: 'Login Failure'
                  }).then(function() {
          window.location = "index.html";
        });
        </script>	
   <?php		 
      exit();
      }
   }	


?>
 
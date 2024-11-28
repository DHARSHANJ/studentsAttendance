<html>
<head>
  <script src="jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <style>
        body, html {
            height: 100%;
        }
        .bg {
            background-image: url("https://images5.alphacoders.com/130/1308151.jpeg");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
  .centered {
  background-image: url("");
  
}
  </style>
</head>
  
</html>
<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['emailid']);
      $mypassword = mysqli_real_escape_string($db,$_POST['pass']); 
      
      $sql = "SELECT * FROM TIH_login WHERE email = '$myusername' and pass = '$mypassword'";
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
           window.location = "index.php";
       });
          </script>	
        <?php  
        }
	  else
	  {
        ?>
        <script>

swal.fire({
              icon: 'error',
              title: 'Failure',
              text: 'Login Failed'
          }).then(function() {
  window.location = "index.php";
});
 </script>	
        <?php
		 exit();
      }
   }	

?>
<html>
   <body>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>

    <body class=".bg">
      <div class="container">
        <div class="row">
         <!--div class="col">
        <h1 class="text-center"> Login</h1>
         <form action="#" method="post">
            <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="emailid"id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <label for="inputPassword5" class="form-label">Password</label>
            <input type="password" name="pass"id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
            <div id="passwordHelpBlock" class="form-text">
               Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
         </div-->
         <div class="col">
         <h1 class="text-center"> Register Form</h1>
        <form action="insert.php"  name="reg" method="post">
            <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="emailid"id="exampleInputEmail1" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <label for="inputPassword5" class="form-label">Password</label>
            <input type="password" name="pass"id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" required>
            <div id="passwordHelpBlock" class="form-text">
               Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
            </div>


            <button type="submit"  name="reg" class="btn btn-primary">Register</button>

        </form>
         </div>
      </div>
      
      <table class="table">
        <thead>
        <tr>
          <th scope="col">#S.NO</th>
          <th scope="col">Email</th>
          <th scope="col">Password</th>
          <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
           <?php
										$query2 = "SELECT * FROM TIH_login";
										$query_run2 = mysqli_query($db, $query2);

										if(mysqli_num_rows($query_run2) > 0)
										{
											$sn=1;
											foreach($query_run2 as $student2)
											{
                                    ?>

                                            <tr>
                                                <td><?php echo $sn++;?></td>
												            <td><?= $student2['email'] ?></td> 
												            <td><?= $student2['pass'] ?></td>   
                                                            <td>
                                                                <form action="delete.php" method="POST">
                                                                    <input type="hidden" name="emailid" value="<?= $student2['email']; ?>">
                                                                    <input type="submit" class="btn btn-danger" name="submit" value="Delete">            
                                                                </form>
                                                            </td>                                           
                                            </tr>

                           <?php
											}
                            }
                            ?>
        </tbody>
   </body>
                           </body>
</html>




  
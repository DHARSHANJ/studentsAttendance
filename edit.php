<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
<h4>Old Data</h4>
<table class="table" id="user">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">User Name</th>
      <th scope="col">Password</th>
    </tr>
  </thead>
  <tbody>
  <?php
   include("config.php");
   $name=$_POST['uname'];
   $query2 = "SELECT * FROM login where uname='$name'";
										$query_run2 = mysqli_query($db, $query2);

										if(mysqli_num_rows($query_run2) > 0)
										{
											$sn=1;
											foreach($query_run2 as $student2)
											{
                                    ?>
											<tr>
											  <td><?php echo $sn++;?></td>
											  <td><?= $student2['uname'] ?></td>
											  <td><?= $student2['pass'] ?></td>
											</tr>
									 <?php
											
											}
                            }
                            ?>
  </tbody>
</table>
   </body>
                           </body>
                          
</html>
<html>
    
<div class="container">
  <div class="row">
    
	
	<div class="col">
      <h2 style="text-align:center;">EDIT</h2>
<form id="edit">
<div id="errorMessage" class="alert alert-warning d-none"></div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">New User Name</label>
    <input type="text" class="form-control" name="uname" id="exampleInputEmail1" aria-describedby="emailHelp" >  
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">New Password</label>
    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" >
  </div>
  <button name="edit" type="submit" class="btn btn-primary btn-sm">Edit</button>
</form>
    </div>
  </div>


  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).on('submit', '#edit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_edit", true);


            $.ajax({
                type: "POST",
                url: "insert1234.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#edit')[0].reset();

                        alertify.set('notifier','position', 'top-left');
                        alertify.success(res.message);

                        $('#user').load(location.href + " #user");

                    }else if(res.status == 500) {
						$('#errorMessage').addClass('d-none');
                        $('#edit')[0].reset();
                        alertify.set('notifier','position', 'top-left');
                        alertify.success(res.message);
                    }
                }
            });

        });	
</script>
</html>
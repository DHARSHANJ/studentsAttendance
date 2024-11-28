<html>
  <head>
  <script src="jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
  </head>
</html>
<?php
  include("config.php");
  $email = $_POST['uname'];
  $s="DELETE FROM login WHERE uname='$email' LIMIT 1";
  if($db->query($s)===True){
    ?>
 <script>

swal.fire({
              icon: 'success',
              title: 'Deleted',
              text: 'Deleted Successfully'
          }).then(function() {
  window.location = "index1234.php";
});
 </script>
 <?php
  }
  ?>
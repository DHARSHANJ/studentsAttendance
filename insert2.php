<?php 
include("config.php");

if(isset($_POST['save_reg']))
{
	$name = mysqli_real_escape_string($db, $_POST['uname']);
    $pass = mysqli_real_escape_string($db, $_POST['pass']);
	
    if($name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	
    $query = "INSERT INTO login (uname,pass) VALUES('$name','$pass')";
    $query_run = mysqli_query($db, $query);

       if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
	
}

	  
?>
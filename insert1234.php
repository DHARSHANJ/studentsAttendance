<?php 
include("config.php");

if(isset($_POST['save_register']))
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

if(isset($_POST['delete_user']))
{
    $student_id = mysqli_real_escape_string($db, $_POST['student_id3']);

    $query = "DELETE FROM login  WHERE uname='$student_id'";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['save_edit']))
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
	
    $query = "UPDATE login SET uname = '$name', pass= '$pass' WHERE uname='$name'";
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
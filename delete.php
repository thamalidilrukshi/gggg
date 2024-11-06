<?php
include("connection.php");

$name=$_GET['name'];


$query ="DELETE FROM   movies WHERE name ='$name'";

$data = mysqli_query($conn,$query);


if($data)
{echo "<script>alert('record delete')</script>";
    ?>
    <META HTTP-EQUIV="refresh" CONTENT="0; URL=http://localhost/web/insert%20data/display.php">
<?php
}
else
{
echo"<font color='red'>failed to delete record</font>";
}

/*if($data){
    echo"record deleted";
}
else{
    echo"failed to delete";
}*/
?>
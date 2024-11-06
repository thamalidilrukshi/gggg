<?php
include("connection.php");
error_reporting(0);
$query="select `name`,`about`,`image`from movies";
$data= mysqli_query($conn,$query);
$total=mysqli_num_rows($data);

if($total!=0)
{
    while($result=mysqli_fetch_assoc($data))
    {
        echo"
        
        ".$result['name']."
        ".$result['about']."
        <img src='".$result['image']."'>
        <button><a href='update.php?rn=$result[name]&ln=$result[about] '>Edit</button>

       
        ";
    }
}

else{
    echo"no record found";
}
?>


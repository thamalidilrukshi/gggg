<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="movieword";

    $conn=name mysqli($servername,$username,$password,$dbname);
    $sql="SELECT id,name,from movie";
    $result = $conn->query($sql);
    if($result-> num_rows>0){
        while($row=$result->fetch_assoc()){
            echo"<a href='nikan2.php?id=".$row
        }
    }
</body>
</html>
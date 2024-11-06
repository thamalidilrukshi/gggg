<?php
require "connection.php";


function dbconnect(){
    $mysqli = new mysqli(SERVER, USERNAME,PASSWORD,DATABASE);
    if($mysqli->connect_error !=0){
        return false;
    }else{
        return $mysqli;
    }
}

function getcata(){
    $mysqli = dbconnect();
    $result = $mysqli->query("SELECT DISTINCT movietype FROM movies");
    while($row = $result-> fetch_assoc()){
        $catego[] = $row;
    }
    return $catego;
}





// function getproduct($id){

//     $mysqli = dbconnect();

//     $stmt = $mysqli-> prepare("SELECT * FROM movies where id = ?");
//     $stmt->bind_param("s",$name);
//     $stmt->execute();
//     $result = $stmt-> get_result();
//     $data = $result-> fetch_all(mysqli_assoc);
//     return $data;
// }





//nikannnn

// function getproduct($id){
//     $mysqli = dbconnect();
//     $stmt = $mysqli->prepare("SELECT*FROM movies WHERE id = ?");
//     $stmt->bind_param("s",$id);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $data = $result->fetch_all(MYSQL_ASSOC);

//     return $id;
// }
?>
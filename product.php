<?php require "function.php" ?>
<?php
if(isset($_GET['name'])){
    $name= urldcode($_GET['name']);
    $product = getproduct($name);
}


?>
<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="description" content="we have a wide collection of electronics,phones,books">
	<meta name="keywords" content="phones,books,games,ele">
    <title>
<?php echo $title ?>
</title>
</head>
<body>




<img src="<?php echo"images/{$product[0]['image']}"?>">


<!--?php
$db=mysqli_connect("localhost","root","","movieworld");
$sql ="SELECT* FROM movies WHERE name =? ";
$result= mysqli_query($db,$sql);

while($row = mysqli_fetch_array($result)){
    echo"
	
	<div class=films>
	<div class=image>
	<img src='images/".$row[0]['image']."'>
	</div>
	".$row[0]['name']."
	</div>
	
	";
}
?-->

</body>
</html>

<?php require "function.php" ?>
<?php
if(isset($_GET['catego'])){

}
?>
<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="description" content="we have a wide collection of electronics,phones,books">
	<meta name="keywords" content="phones,books,games,ele">

<title>wacth movies</title>
<style>
	html.body{
		width:100%;
		height:100%;
		padding:0px;
		margin:0px;
		overflow-x:hidden;
	}
body{background-color:black;}

.bar a{color:white;
text-decoration:none;
padding:10px;
font-family:sans-serif;
letter-spacing: 1.5px;
font-weight:bold;
transition:background-color 0.3s, color o.3s;

}

a:hover,
a.actice{
	background:#4d9176;
	color:#fff;
	border-radius:3px;
}





*{margin:0;
padding:0;
box-sizing:border-box;
}

video{
	width:98vw;
	height:100%;
	position:absolute;
	object-fit:cover;
	transition:all 1.2s linear;
	z-index:-10;
	top:0px;}

.video1{
	opacity:1;
}

.video2{
opacity:0;
}

.video3{
opacity:0;
}

.container{
	width:100%;
	height:100vh;
	background:linear-gradient(0deg, transparent,rgba(0,0,0,50));}
	
    .films{
        position: relative;
      /*  top:600px;*/
        color:white;
        
    }
/*img{
	width: 20vw;

}*/



#title{
	color:white;
	position: relative;
    top: 600px;
	
	letter-spacing: 1.5px;
	/*font-size:120px;*/
	
}

#barimg{position:relative;
	width: 18vw;
	top:-2vw;
	
}



footer{
    position: relative;
 top:600px;
	color:white;
}

</style>

<link rel="stylesheet" href="style.css">
</head>
<body >


<div class="bar" align="right">
	
<a href="*">HOME</a>&nbsp;&nbsp;&nbsp;
<a href="*">MOVIES</a>&nbsp;&nbsp;&nbsp;
<a href="*">TV SERIES</a>




</div >
<img id=barimg src="20240118_200657.png">



<div class=""container>

	<video autoplay muted id="video1" class="video1">
		<source src="WWW.mp4" type="video/mp4">
	</video>

	<video  muted id="video2" class="video2">
		<source src="www1.mp4" type="video/mp4">
	</video>

	<video  muted id="video3" class="video3">
		<source src="www2.mp4" type="video/mp4">
	</video>


	



<!--?php
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
      <main>
        <div class=films>
        <div class=image>
        
        <img src='images/".$result['image']."'></div>

		<p class=name>".$result['name']."</p>
        </div>
		<main>
        ";
    }
}


?-->



<!--?php
include("connection.php");
error_reporting(0);
$query="SELECT `name`,`about`,`image`from movies";

$filename=$_FILES["uploadfile"]["name"];
$tempname=$_FILES["uploadfile"]["tmp_name"];
$folder='images/'.$filename;
echo $folder;
move_uploaded_file($tempname,$folder);
echo"<img src='$folder' height='100px' width='100px'>";
?-->












<!--video src="Avatar_ The Way of Water _ Official Trailer.mp4"-->
<script src="main.js"></script>

<div id="title">
	Family Movies 
</div>

<div>
	<main>
<?php
$db=mysqli_connect("localhost","root","","movieworld");
$sql ="SELECT* FROM movies ORDER BY rand() LIMIT 5";
$result= mysqli_query($db,$sql);

while($row = mysqli_fetch_array($result)){
    echo"
	
	<div class=films>
	<div class=image>
	<img src='images/".$row['image']."'>
	</div>
	".$row['name']."
	</div>
	
	";
}
?>
</main>
</div>





<div id="title">
	Comedy Movies
</div>

<div>
	<main>
<?php
$db=mysqli_connect("localhost","root","","movieworld");
$sql ="SELECT* FROM movies  WHERE movietype='family movie'";
$result= mysqli_query($db,$sql);

while($row = mysqli_fetch_array($result)){
    echo"
	
	<div class=films>
	<div class=image>
	<img src='images/".$row['image']."'>
	</div>
	".$row['name']."
	</div>
	
	";
}
?>


</main>
</div>





<div id="title">
	Action Movies
</div>

<div>
	<main>
<?php
$db=mysqli_connect("localhost","root","","movieworld");
$sql ="SELECT* FROM movies WHERE  movietype='family movie'";
$result= mysqli_query($db,$sql);

while($row = mysqli_fetch_array($result)){
    echo"
	
	<div class=films>
	<div class=image>
	<img src='images/".$row['image']."'>
	</div>
	".$row['name']."
	</div>
	
	
	";
}
?>


</main>
</div>

<a href="product.php?name=<?php echo $row['name'] ?>"> <?php echo $row['name']?> </a>



<?php include "include/footer.php"?> 

<script src="java script.js"></script>


</body>

</html>
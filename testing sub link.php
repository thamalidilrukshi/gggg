<?php
// Capture the movie details from the URL
$rn = $_GET['rn'];
$ln = $_GET['ln'];
$image = $_GET['image'];
$movietype = $_GET['movietype'];
$imdb = $_GET['imdb'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $rn; ?></title>
    <style>
        body { font-family: Arial, sans-serif; color: white; background-color: black; }
        .movie-details { text-align: center; margin-top: 50px; }
        img { width: 200px; height: 300px; }
    </style>
</head>
<body>

<div class="movie-details">
    <h1><?php echo $rn; ?></h1>
    <img src="images/<?php echo $image; ?>" alt="<?php echo $rn; ?>">
    <p><strong>About:</strong> <?php echo $ln; ?></p>
    <p><strong>Type:</strong> <?php echo $movietype; ?></p>
    <p><strong>IMDB Rating:</strong> <?php echo $imdb; ?></p>
</div>

</body>
</html>

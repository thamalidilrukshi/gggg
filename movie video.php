<!-- <?php
// Include the database connection file
include("connection.php");
error_reporting(0);

// Get the video file name from the URL parameter
$video = isset($_GET['video']) ? $_GET['video'] : '';

// Sanitize the input to prevent directory traversal attacks
$video = basename($video);

// Define the path to the video directory
$videoPath = "images/video/" . $video;

// Check if the video file exists
if (!file_exists($videoPath)) {
    echo "Error: Video file does not exist.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Watch Video</title>
</head>
<body>
    <h1>Watch Video</h1>
    <video width="100%" height="auto" controls>
        <source src="<?php echo htmlspecialchars($videoPath); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <p>If the video does not play, check the file path and ensure the file exists.</p>
</body>
</html> -->


<?php
// Include the database connection file
include("connection.php");
error_reporting(0);

// Get the video file name from the URL parameter
$video = isset($_GET['video']) ? $_GET['video'] : '';

// Sanitize the input to prevent directory traversal attacks
$video = basename($video);

// Define the path to the video directory
$videoPath = "images/video/" . $video;

// Check if the video file exists
if (!file_exists($videoPath)) {
    echo "Error: Video file does not exist.";
    exit;
}

// Get the file extension to validate video type
$fileExtension = strtolower(pathinfo($video, PATHINFO_EXTENSION));

// Supported video formats
$supportedFormats = ['mp4', 'webm', 'ogg'];

// Check if the video format is supported
if (!in_array($fileExtension, $supportedFormats)) {
    echo "Error: Unsupported video format.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Watch Video</title>
</head>
<body>
    <h1>Watch Video</h1>
    <video width="100%" height="auto" controls>
        <!-- Dynamically generate multiple sources based on available formats -->
        <?php if ($fileExtension == 'mp4') : ?>
            <source src="<?php echo htmlspecialchars($videoPath); ?>" type="video/mp4">
        <?php elseif ($fileExtension == 'webm') : ?>
            <source src="<?php echo htmlspecialchars($videoPath); ?>" type="video/webm">
        <?php elseif ($fileExtension == 'ogg') : ?>
            <source src="<?php echo htmlspecialchars($videoPath); ?>" type="video/ogg">

         <!-- <?php elseif ($fileExtension == 'mkv') : ?>
            <source src="<?php echo htmlspecialchars($videoPath); ?>" type="video/mkv"> -->
        <?php endif; ?>
        Your browser does not support the video tag.
    </video>
  
</body>
</html>


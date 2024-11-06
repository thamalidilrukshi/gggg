<?php
include("connection.php");
error_reporting(0);

// Fetch parameters from URL, sanitize inputs
$rn = htmlspecialchars($_GET['rn']);
$ln = htmlspecialchars($_GET['ln']);
$image = htmlspecialchars($_GET['image']);
$movietype = htmlspecialchars($_GET['movietype']);
$imdb = htmlspecialchars($_GET['imdb']);
$video = htmlspecialchars($_GET['video']);
$movielink = htmlspecialchars($_GET['movielink']); // Sanitize URL

// Debugging: Output the raw movielink for checking
echo "Movielink received: " . $movielink . "<br>";

// Check if $movielink is set
if (empty($movielink)) {
    echo "No video link available in the database or URL.";
    exit; // Stop execution if movielink is empty
}

// Check if the link is already an embeddable YouTube link
if (strpos($movielink, 'youtube.com/embed') !== false) {
    // The link is already in the correct format, no need to change it
    $embed_link = $movielink;
} elseif (strpos($movielink, 'youtube.com/watch') !== false) {
    // Convert YouTube watch links to embeddable format
    parse_str(parse_url($movielink, PHP_URL_QUERY), $query_params);
    $video_id = $query_params['v'] ?? '';
    $embed_link = "https://www.youtube.com/embed/$video_id";
} elseif (strpos($movielink, 'youtu.be/') !== false) {
    // Handle short YouTube link format
    $video_id = substr(parse_url($movielink, PHP_URL_PATH), 1);
    $embed_link = "https://www.youtube.com/embed/$video_id";
} else {
    // If not a valid YouTube link, output error message
    echo "Invalid or unsupported video link.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Video Display</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        iframe {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div>
    <!-- Display iframe only if $embed_link is properly set -->
    <iframe width="560" height="315" src="<?php echo htmlspecialchars($embed_link); ?>" 
            title="YouTube video player" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen>
    </iframe>
</div>

</body>
</html>

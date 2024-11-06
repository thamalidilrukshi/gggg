<?php
require 'connection.php';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $about = $_POST["about"];
    $movietype = $_POST["movietype"];
    $imdb = $_POST["imdb"];
    $movielink = $_POST["movielink"];
    $year = $_POST["year"];
    $hours = $_POST["hours"];
    $min = $_POST["min"];

    // Ensure the images and video directories exist
    if (!is_dir('images')) {
        mkdir('images', 0777, true);
    }
    if (!is_dir('video')) {
        mkdir('video', 0777, true);
    }

    // Handling the movie image upload
    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = "images/" . $file_name;
    move_uploaded_file($tempname, $folder);

    // Handling the movie video file upload
    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $video_folder = 'video/' . $filename;
    move_uploaded_file($tempname, $video_folder);

    // Insert data into the movies table
    $query = "INSERT INTO movies (id, name, image, about, video, movietype, imdb, movielink, year) VALUES ('', '$name', '$file_name', '$about', '$filename', '$movietype', '$imdb', '$movielink','$year')";
    mysqli_query($conn, $query);

    // Insert data into the fime_time table
    $query1 = "INSERT INTO fime_time VALUES('', '$hours', '$min')";
    mysqli_query($conn, $query1);

    echo "
    <script>alert('Data inserted successfully');</script>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Insert Data</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 10px;
        }
        .form-container {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }
        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 15px;
            font-size: 1.5em;
        }
        label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
            font-size: 0.9em;
        }
        input[type="text"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9em;
        }
        textarea {
            resize: vertical;
        }
        button {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Insert Movie Data</h2>
        <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
            <label>Name</label>
            <input type="text" name="name" required>

            <label>Movie Image</label>
            <input type="file" name="image">

            <label>IMDB</label>
            <input type="text" name="imdb" required>

            <label>Year</label>
            <input type="text" name="year" required>

            <label>Hours</label>
            <input type="text" name="hours" required>

            <label>Minutes</label>
            <input type="text" name="min" required>

            <label>About</label>
            <textarea name="about" rows="4"></textarea>

            <label>Trailer Link (give embed link)</label>
            <textarea name="movielink" rows="2"></textarea>

            <label>Movie Type</label>
            <select name="movietype" required>
                <option value="" selected hidden>Select type</option>
                <option value="thrillers">Thrillers</option>
                <option value="comedy">Comedy</option>
                <option value="action">Action</option>
                <option value="Family movie">Family Movie</option>
                <option value="horror">Horror</option>
                <option value="children">Children</option>
            </select>

            <label>Movie Video</label>
            <input type="file" name="file" id="file">

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>

<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif; /* Improved font for readability */
            background-color: #f4f4f4; /* Light background color for better contrast */
            margin: 0;
            padding: 20px; /* Add padding around the body */
        }

        button {
            background-color: #4CAF50; /* A more inviting green */
            color: white; /* White text for better visibility */
            border: none; /* Remove border */
            padding: 15px 30px; /* Increase padding for larger button area */
            font-size: 24px; /* Smaller font size for buttons */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s ease; /* Smooth transition for hover effect */
            margin: 5px; /* Space between buttons */
        }

        button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        a {
            text-decoration: none; /* Remove underline from links */
            color: inherit; /* Inherit color from button */
        }

        table {
            width: 100%; /* Full width for better layout */
            margin-top: 20px; /* Space between button and table */
            border-collapse: collapse; /* Remove spacing between table cells */
            background-color: #fff; /* White background for table */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }

        th, td {
            padding: 15px; /* Increased padding for better spacing */
            text-align: center; /* Center align text in cells */
            border: 2px solid #ccc; /* Light gray border for clarity */
        }

        th {
            background-color: #4CAF50; /* Darker background for header */
            color: white; /* White text for contrast */
        }

        img {
            width: 50px; /* Increased image size for better visibility */
            height: auto; /* Maintain aspect ratio */
            border-radius: 5px; /* Slightly rounded corners for images */
        }
    </style>
</head>
<body>

    <button><a href="data insert.php"> Insert New Data </a></button>
    <table border="5" align="center" cellspacing="5">
        <tr align="center">
            <th>Name</th>
            <th>About</th>
            <th>Time</th>
            <th>Image</th>
            <th colspan="2">Operation</th>
        </tr>

        <?php
        include("connection.php");
        error_reporting(0);
        $query = "SELECT `name`, `about`, `image` FROM movies";
        $data = mysqli_query($conn, $query);

        $total = mysqli_num_rows($data);

        if ($total != 0) {
            while ($result = mysqli_fetch_assoc($data)) {
                echo "
                <tr>
                    <td>" . $result['name'] . "</td>
                    <td>" . $result['about'] . "</td>
                    <td>" . $result['time'] . "</td>
                    <td><img src='images/" . $result['image'] . "'></td>
                    <td><button><a href='update.php?rn=" . $result['name'] . "&ln=" . $result['about'] . "'>Edit</a></button></td>
                    <td><button><a href='delete.php?name=" . $result['name'] . "' onclick='return checkdelete()'>Delete</a></button></td>
                </tr>
                ";
            }
        } else {
            echo "<tr><td colspan='6'>No record found</td></tr>";
        }
        ?>

    </table>

    <script>
        function checkdelete() {
            return confirm('Are you sure you want to delete this record?');
        }
    </script>

    <div>
        <?php
        $db = mysqli_connect("localhost:3307", "root", "", "movieworld");
        $sql = "SELECT * FROM movies";
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_array($result)) {
            echo "<img src='images/" . $row['image'] . "'>";
        }
        ?>
    </div>
</body>
</html>

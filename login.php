<!-- <html>
    <head>
        <title>
         admin login</title>
</head>
<body>
<form action="#" method="post" autocomplete="off">
<div class="form">
    <input type="text" name="username" class="textfield" placeholder="user name">
    <input type="password" name="password"class="textfield" placeholder="password">

    <div class="forgetpass"><a href="#" class="link" onclick="message()">
    Forget password?</a></div>

    <input type="submit" name="login" value="login" class="btn">
</div>
</form>
<script>
    function message()
    { 
        alert("password hee");
    }
    </script>




ttttttt
</body>
</html>

<?php
    include("connection.php");

    if(isset($_POST['login'])){

       
        $username=$_POST['username'];
        $password=$_POST['password'];

        $query="SELECT * FROM `login` WHERE username ='$username' && password ='$password'";

        $data=mysqli_query($conn,$query);

        $total= mysqli_num_rows($data);
        

        if($total ==1){
           header('location:admin.php');
        }
        else{
            echo"loging failed";
        }
    }
?> -->



<?php
session_start();

// Define correct credentials
$correct_username = "admin";
$correct_password = "password123";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authenticate user
    if ($username === $correct_username && $password === $correct_password) {
        $_SESSION['loggedin'] = true;
        header("Location: admin.php"); // Redirect to admin panel after login
        exit;
    } else {
        $login_error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($login_error)) echo "<p style='color: red;'>$login_error</p>"; ?>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>
</body>
</html>



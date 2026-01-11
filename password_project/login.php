<?php

session_start();


$servername = "localhost";
$db_username = "root"; 
$db_password = "";
$dbname = "password_app_db"; 


$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    
    
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows == 1) {
        
        $stmt->bind_result($user_id, $db_username, $hashed_password);
        $stmt->fetch();
        
        
        if (password_verify($password, $hashed_password)) {
            
           
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $db_username;
            
            
            header("Location: dashboard.php");
            exit();
            
        } else {
           
            echo "<h2>Login Failed</h2><p>Invalid username or password.</p>";
            echo "<p><a href='login.html'>Try again</a></p>";
        }
        
    } else {
        echo "<h2>Login Failed</h2><p>Invalid username or password.</p>";
        echo "<p><a href='login.html'>Try again</a></p>";
    }
    
    $stmt->close();
    $conn->close();

} else {
    echo "Access Denied: Please use the Log In form.";
}
?>
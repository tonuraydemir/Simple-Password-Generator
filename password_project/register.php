<?php

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

  
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
       
        echo "<h2>Error: This username is already taken. Please choose another one.</h2>";
        $check_stmt->close();
    } else {
       
        $insert_stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $insert_stmt->bind_param("ss", $username, $hashed_password);

        if ($insert_stmt->execute()) {
            echo "<h2>Registration Successful!</h2>";
            echo "<p>Your account has been created. You can now <a href='login.html'>Log in</a>.</p>";
        } else {
            echo "Error during registration: " . $insert_stmt->error;
        }
        $insert_stmt->close();
    }

    $conn->close();

} else {
   
    echo "Access Denied: Please use the Sign Up form.";
}
?>
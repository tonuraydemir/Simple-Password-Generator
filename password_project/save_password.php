<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    echo "Error: User not logged in.";
    exit;
}


$servername = "localhost";
$db_username = "root"; 
$db_password = ""; 
$dbname = "password_app_db"; 

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  
    $site_name = $conn->real_escape_string($_POST['site_name']);
    $generated_password = $_POST['generated_password']; 
    $user_id = $_SESSION['user_id'];
    
  
    if(empty($site_name) || empty($generated_password)) {
        echo "Please provide both site name and password.";
        exit;
    }

    $sql = "INSERT INTO saved_passwords (user_id, site_name, encrypted_password) VALUES (?, ?, ?)";
    $insert_stmt = $conn->prepare($sql);
    $insert_stmt->bind_param("iss", $user_id, $site_name, $generated_password);
    
    if ($insert_stmt->execute()) {
        echo "Password saved successfully!";
    } else {
        echo "Error saving password: " . $insert_stmt->error;
    }
    
    $insert_stmt->close();
    $conn->close();

} else {
    echo "Invalid request.";
}
?>
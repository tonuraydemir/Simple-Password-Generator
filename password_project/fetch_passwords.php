<?php

session_start();


if (!isset($_SESSION['user_id'])) {
    exit("Unauthorized access.");
}


$servername = "localhost";
$db_username = "root"; 
$db_password = ""; 
$dbname = "password_app_db"; 

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];


$sql = "SELECT p_id, site_name, encrypted_password FROM saved_passwords WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '
        <div class="pass-item" style="display: flex; justify-content: space-between; align-items: center; padding: 15px; border-bottom: 1px solid #f1f1f1; transition: 0.3s;">
            <div style="flex: 1; min-width: 0;">
                <span class="site-tag" style="font-weight: 700; color: #333; font-size: 1.1rem; display: block;">' . htmlspecialchars($row['site_name']) . '</span>
                <span class="pass-hash" style="font-family: monospace; color: #0216ca; font-size: 0.95rem; word-break: break-all;">' . htmlspecialchars($row['encrypted_password']) . '</span>
            </div>
            <button class="btn btn-sm btn-outline-danger" style="margin-left: 10px; border-radius: 5px;" onclick="deletePassword(' . $row['p_id'] . ')">
                <i class="fa fa-trash"></i>
            </button>
        </div>';
    }
} else {
    echo '<div class="text-center mt-5">
            <i class="fa fa-lock-open fa-3x" style="color: #ddd;"></i>
            <p class="text-muted mt-2">Your vault is empty.<br>Generate and save your first password!</p>
          </div>';
}

$stmt->close();
$conn->close();
?>
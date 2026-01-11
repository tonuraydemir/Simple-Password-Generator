<?php
session_start();
include 'db_connection.php'; 

if (isset($_POST['id']) && isset($_SESSION['user_id'])) {
    $p_id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM saved_passwords WHERE p_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $p_id, $user_id);

    if ($stmt->execute()) {
        echo "Deleted";
    } else {
        echo "Error";
    }
}
?>
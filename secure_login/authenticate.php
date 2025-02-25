
<?php

session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user data from database
    $sql = "SELECT id, password_hash FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $password_hash);
    $stmt->fetch();

    // Verify password
    if (password_verify($password, $password_hash)) {
        $_SESSION['user_id'] = $id; // Start session
        header("Location: dashboard.php"); // Redirect to dashboard
    } else {
        echo "Invalid login credentials.";
    }
}
?>

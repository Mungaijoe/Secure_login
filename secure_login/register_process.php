<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
// Start session
session_start();

// Database connection
$mysqli = new mysqli("localhost", "root", "", "secure_login");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get user input safely
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];

// Prevent empty fields
if (empty($username) || empty($email) || empty($password)) {
    die("All fields are required.");
}

// Sanitize input to prevent XSS
$username = htmlspecialchars($username);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// 🔹 CHECK IF USERNAME EXISTS
$check_query = "SELECT id FROM users WHERE username = ?";
$stmt = $mysqli->prepare($check_query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("Error: Username already taken. Please choose another one.");
}

// 🔹 CHECK IF EMAIL EXISTS
$check_email_query = "SELECT id FROM users WHERE email = ?";
$stmt = $mysqli->prepare($check_email_query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("Error: Email already registered. Try logging in.");
}

// Hash the password securely
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Insert user into the database
$insert_query = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($insert_query);
$stmt->bind_param("sss", $username, $email, $hashed_password);

if ($stmt->execute()) {
    echo "✅ Registration successful! <a href='dashboard.php'>Login here</a>";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$mysqli->close();
?>


<!-- Handles the database connection using PDO (included in nearly every file). -->
<!--This link is for managing SQL database
    http://localhost/phpmyadmin -->


    <?php

// Database configuration parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentalDB";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  // Connection failed
  error_log($e->getMessage());
  exit('Database connection error'); // generic error message to the user
}
?>


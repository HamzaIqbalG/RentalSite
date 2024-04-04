<!-- Handles the database connection using PDO (this can be included in your other scripts). -->
<!--This link is for managing SQL database
    http://localhost/phpmyadmin -->


    <?php
// It's good to have PHP open tag at the top to prevent any unintended output before sending HTTP headers

// Database configuration parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentalDB";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // Connected successfully - For production, consider logging this internally or simply remove it.
} catch(PDOException $e) {
  // Connection failed - For production, consider logging this and giving a generic error message to the user.
  error_log($e->getMessage()); // Log error message to a file or error monitoring system
  exit('Database connection error'); // Provide a generic error message to the user
}
?>


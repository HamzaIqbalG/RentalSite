<!-- http://localhost/RentalSite/test.php -->

<?php
// Include your database connection script
include 'db_connection.php';

// Attempt to query the database
try {
  // Test query - selecting all information from a table
  $stmt = $conn->query("SELECT * FROM apartment");
  
  // Fetch the results
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Output the results (for testing purposes)
  echo "<pre>";
  print_r($results);
  echo "</pre>";
} catch (Exception $e) {
  // Handle any errors including query errors
  echo "An error occurred: " . $e->getMessage();
}

// Close the connection (optional, as PHP closes it at the end of the script)
$conn = null;
?>

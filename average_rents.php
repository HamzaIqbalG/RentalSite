<!-- Displays a table with the average monthly rent for houses, apartments, and rooms. -->
<!-- http://localhost/RentalSite/average_rents.php -->



<?php
include 'db_connection.php';

try {
    // Calculate the average rent for all properties
    $stmt = $conn->query("SELECT AVG(Cost) AS averageRent FROM property");
    $averageRent = $stmt->fetch(PDO::FETCH_ASSOC)['averageRent'];

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Average Rent</title>
    <!-- Include your stylesheet here -->
</head>
<body>

<?php include 'header.html'; ?>

<h2>Average Monthly Rent for All Properties</h2>
<p>The average monthly rent for all properties is: <?php echo number_format((float)$averageRent, 2, '.', ''); ?></p>

<?php include 'footer.html'; ?>

</body>
</html>


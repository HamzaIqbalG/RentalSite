<!-- Displays a table with the average monthly rent for houses, apartments, and rooms. -->
<!-- http://localhost/RentalSite/average_rents.php -->


<?php
include 'db_connection.php';

// Initialize variables to store average rents
$avgRentHouses = $avgRentApartments = $avgRentRooms = 0;

try {
    // Get the average rent for houses
    $stmt = $conn->query("SELECT AVG(Cost) AS AverageRent FROM Property JOIN House ON Property.ID = House.PropertyID");
    $avgRentHouses = $stmt->fetch(PDO::FETCH_ASSOC)['AverageRent'];

    // Get the average rent for apartments
    $stmt = $conn->query("SELECT AVG(Cost) AS AverageRent FROM Property JOIN Apartment ON Property.ID = Apartment.PropertyID");
    $avgRentApartments = $stmt->fetch(PDO::FETCH_ASSOC)['AverageRent'];

    // Get the average rent for rooms
    $stmt = $conn->query("SELECT AVG(Cost) AS AverageRent FROM Property JOIN Room ON Property.ID = Room.PropertyID");
    $avgRentRooms = $stmt->fetch(PDO::FETCH_ASSOC)['AverageRent'];

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Average Rents</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.html'; ?>

<section class="content-wrapper">
    <div class="container">
    <h2>Average Monthly Rents</h2>
<table>
    <thead>
        <tr>
            <th>Houses</th>
            <th>Apartments</th>
            <th>Rooms</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo number_format((float)$avgRentHouses, 2, '.', ''); ?></td>
            <td><?php echo number_format((float)$avgRentApartments, 2, '.', ''); ?></td>
            <td><?php echo number_format((float)$avgRentRooms, 2, '.', ''); ?></td>
        </tr>
    </tbody>
</table>
    </div>
</section>

<?php include 'footer.html'; ?>

</body>
</html>

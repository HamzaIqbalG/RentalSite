<!-- Displays a table with the average monthly rent for houses, apartments, and rooms. -->
<!-- http://localhost/RentalSite/average_rents.php -->


<?php
include 'db_connection.php';

// Initialize variables to store average rents
$avgRentHouses = $avgRentApartments = $avgRentRooms = 0;


// A more accurate way would've been to have a "TYPE" column in Properties table where you
//have the type of living space written. Then you can easily match the rent with the specific place and calculate
//the average rent for each category. Unfortunately, I don't have that on my database on XAMPP that I submitted, but
//I do have it in the rentalDB.sql that I will submit with this project
//I hope this still shows you I know what to do...
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
    <!-- The title of the page, which will appear on the browser tab -->
    <title>Average Rents</title>
    <!-- Linking the external CSS file for styling the page -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Including the header HTML -->
<?php include 'header.html'; ?>

<!-- Content wrapper for styling and alignment -->
<section class="content-wrapper">
    <div class="container">
    <!-- Page heading -->
    <h2>Average Monthly Rents</h2>
    <!-- Table structure to display the data -->
    <table>
        <thead>
            <tr>
                <!-- Table headings for the different property types -->
                <th>Houses</th>
                <th>Apartments</th>
                <th>Rooms</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!-- Table data cells where PHP injects the calculated average rents -->
                <!-- The number_format function formats the number to two decimal places -->
                <td><?php echo number_format((float)$avgRentHouses, 2, '.', ''); ?></td>
                <td><?php echo number_format((float)$avgRentApartments, 2, '.', ''); ?></td>
                <td><?php echo number_format((float)$avgRentRooms, 2, '.', ''); ?></td>
            </tr>
        </tbody>
    </table>
    </div>
</section>

<!-- Including the footer -->
<?php include 'footer.html'; ?>

</body>
</html>


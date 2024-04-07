<!-- Allows an existing rental group to update their preferences. -->
<!-- http://localhost/RentalSite/preferencesUpdate.php -->



<?php
include 'db_connection.php';

$message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $groupCode = $_POST['groupCode'];
    $parking = $_POST['parking'];
    $accessibility = $_POST['accessibility'];
    $cost = $_POST['cost'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $laundry = $_POST['laundry'];
    $typeAcc = $_POST['typeAcc'];

    // Prepare an update statement
    $sql = "UPDATE RentalGroup SET 
            Parking = :parking,
            Accessibility = :accessibility,
            Cost = :cost,
            Bedrooms = :bedrooms,
            Bathrooms = :bathrooms,
            Laundry = :laundry,
            typeAcc = :typeAcc
            WHERE Code = :groupCode";

    try {
        $stmt = $conn->prepare($sql);
        
        // Bind parameters to statement variables
        $stmt->bindParam(':groupCode', $groupCode);
        $stmt->bindParam(':parking', $parking);
        $stmt->bindParam(':accessibility', $accessibility);
        $stmt->bindParam(':cost', $cost);
        $stmt->bindParam(':bedrooms', $bedrooms);
        $stmt->bindParam(':bathrooms', $bathrooms);
        $stmt->bindParam(':laundry', $laundry);
        $stmt->bindParam(':typeAcc', $typeAcc);

        // Execute the prepared statement
        $stmt->execute();
        $message = 'Preferences updated successfully!';
    } catch(PDOException $e) {
        $message = "Error updating record: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Preferences</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

<?php include 'header.html'; ?>

<section class = 'content-wrapper'>
    <div class = 'container'>
    <h2>Update Rental Group Preferences</h2>

<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form action="update_preferences.php" method="post">
    <div>
        <label for="groupCode">Group Code:</label>
        <input type="text" id="groupCode" name="groupCode" required>
    </div>
    <div>
        <label for="parking">Parking:</label>
        <input type="text" id="parking" name="parking" required>
    </div>
    <div>
        <label for="accessibility">Accessibility Features:</label>
        <input type="text" id="accessibility" name="accessibility">
    </div>
    <div>
        <label for="cost">Cost:</label>
        <input type="number" id="cost" name="cost" step=".01" required>
    </div>
    <div>
        <label for="bedrooms">Bedrooms:</label>
        <input type="number" id="bedrooms" name="bedrooms" required>
    </div>
    <div>
        <label for="bathrooms">Bathrooms:</label>
        <input type="number" id="bathrooms" name="bathrooms" required>
    </div>
    <div>
        <label for="laundry">Laundry (Y/N):</label>
        <input type="text" id="laundry" name="laundry" required>
    </div>
    <div>
        <label for="typeAcc">Type of Accommodation:</label>
        <input type="text" id="typeAcc" name="typeAcc" required>
    </div>
    <div>
        <button type="submit">Update Preferences</button>
    </div>
</form>

</div>
</section>

<?php include 'footer.html'; ?>

</body>
</html>

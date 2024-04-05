<!--Lists all properties with IDs, owners, and managers. -->
<!-- http://localhost/RentalSite/properties.php -->

<?php
// Include the database connection file
include 'db_connection.php';

// Initialize an empty array to hold property data
$properties = [];

try {
    // Prepare SQL query to retrieve property information with owner and manager details
    $stmt = $conn->prepare(
        "SELECT 
            Property.ID AS PropertyID, 
            Person.FName AS OwnerFirstName, 
            Person.LName AS OwnerLastName, 
            ManagerPerson.FName AS ManagerFirstName, 
            ManagerPerson.LName AS ManagerLastName
        FROM 
            Property
        JOIN 
            PropertyOwner ON Property.ID = PropertyOwner.PropertyID
        JOIN 
            Person ON PropertyOwner.OwnerID = Person.ID
        JOIN 
            Manager ON Property.ManagerID = Manager.ID
        JOIN 
            Person AS ManagerPerson ON Manager.ID = ManagerPerson.ID"
    );

    // Execute the query
    $stmt->execute();

    // Fetch all the results
    $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle any potential database errors
    die("Database error: " . $e->getMessage());
}

// Close connection
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rental Properties</title>

    <!-- linking the css file to rental.php so that it automatically gets the header, footer, and other UI changes -->
    <link rel="stylesheet" href="styles.css">

    <!-- <style>
        /* Simple CSS to make the table look nicer */
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        tr:hover { background-color: #e8f4ff; }
    </style> -->
</head>
<body>
    <!-- including the header -->
    <?php include 'header.html'; ?>
    <h1>Rental Properties</h1>
    <table>
        <thead>
            <tr>
                <th>Property ID</th>
                <th>Owner Name</th>
                <th>Manager Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($properties as $property): ?>
            <tr>
                <td><?php echo htmlspecialchars($property['PropertyID']); ?></td>
                <td><?php echo htmlspecialchars($property['OwnerFirstName'] . " " . $property['OwnerLastName']); ?></td>
                <td><?php echo htmlspecialchars($property['ManagerFirstName'] . " " . $property['ManagerLastName']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- including the footnote -->
    <?php include 'footer.html'; ?>
</body>
</html>



<!--This link is for managing SQL database
    http://localhost/phpmyadmin -->


<!-- This link gives access to homepage
    http://localhost/RentalSite/rental.php -->

    
    
    
    <?php
include 'db_connection.php';

$properties = [];
$error_message = '';

try {
    $stmt = $conn->prepare(
        "SELECT 
            p.ID AS PropertyID, 
            CONCAT(o.FName, ' ', o.LName) AS OwnerName, 
            CONCAT(m.FName, ' ', m.LName) AS ManagerName
        FROM 
            Property p
        INNER JOIN 
            PropertyOwner po ON p.ID = po.PropertyID
        INNER JOIN 
            Person o ON po.OwnerID = o.ID
        INNER JOIN 
            Manager man ON p.ManagerID = man.ID
        INNER JOIN 
            Person m ON man.ID = m.ID"
    );
    
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $error_message = "Database error: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Properties Homepage</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome to Our Rental Properties Platform</h1>
        <nav>
            <ul>
                <li><a href="rental.php">Home</a></li>
                <li><a href="properties.php">Properties</a></li>
                <li><a href="update_preferences.php">Update Preferences</a></li>
                <li><a href="average_rents.php">Average Rents</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>List of Properties</h2>
            <?php if ($error_message): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php else: ?>
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
                            <td><?php echo htmlspecialchars($property['OwnerName']); ?></td>
                            <td><?php echo htmlspecialchars($property['ManagerName']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Rental Properties, Inc.</p>
    </footer>
</body>
</html>



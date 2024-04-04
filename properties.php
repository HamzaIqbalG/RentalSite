<!--Lists all properties with IDs, owners, and managers. -->
<!-- http://localhost/RentalSite/properties.php -->

<?php
include 'db_connection.php';

// The SQL query to fetch property IDs, owner names, and manager names, if they exist.
$sql = "SELECT p.ID as PropertyID, 
               CONCAT(o.FName, ' ', o.LName) as OwnerName, 
               CONCAT(m.FName, ' ', m.LName) as ManagerName 
        FROM Property p
        JOIN PropertyOwner po ON p.ID = po.PropertyID
        JOIN Owner ow ON po.OwnerID = ow.ID
        JOIN Person o ON ow.ID = o.ID
        LEFT JOIN Manager mg ON p.ManagerID = mg.ID
        LEFT JOIN Person m ON mg.ID = m.ID";

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Set the resulting array to associative
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Begin HTML output
    echo "<table>";
    echo "<tr><th>Property ID</th><th>Owner Name</th><th>Manager Name</th></tr>";

    // Loop through each row to create a table row
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['PropertyID']) . "</td>";
        echo "<td>" . htmlspecialchars($row['OwnerName']) . "</td>";
        // Check if ManagerName is not null before displaying
        echo "<td>" . (isset($row['ManagerName']) ? htmlspecialchars($row['ManagerName']) : 'N/A') . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} catch(PDOException $e) {
    // For production, you might want to handle this more gracefully
    echo "Error: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>


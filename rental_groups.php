<!--Shows all rental groups and allows users to select one to view details. -->

<!-- http://localhost/RentalSite/rental_groups.php -->

<?php
// Include the database connection script
include 'db_connection.php';

// Attempt to fetch all rental groups from the database
try {
    // Query to select rental group data
    $stmt = $conn->query("SELECT Code, Parking, Accessibility, Cost, Bedrooms, Bathrooms, Laundry, typeAcc FROM RentalGroup");
    // Fetch all the results into an array
    $rentalGroups = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // If an error occurs, output the error message and exit the script
    echo "Error: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Title for the rental groups page -->
    <title>Rental Groups</title>
    <!-- Link to the external CSS for styling -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Include the header HTML from an external file -->
<?php include 'header.html'; ?>

<!-- Content section for displaying rental groups -->
<section class='content-wrapper'>
    <div class='container'>
        <!-- Heading for the rental groups section -->
        <h2>Rental Groups</h2>
        <!-- Unordered list to display rental groups as clickable links -->
        <ul class="rental-groups-list">
            <!-- Loop through each rental group and display them in the list -->
            <?php foreach ($rentalGroups as $group): ?>
            <li>
                <!-- Create a link that passes the group's code as a parameter in the URL -->
                <a href="rental_groups.php?group_id=<?php echo htmlspecialchars($group['Code']); ?>">
                    <!-- Display the group's code with special characters converted to HTML entities to prevent XSS -->
                    Group <?php echo htmlspecialchars($group['Code']); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>

        <?php
        // Check if a specific group has been selected by looking for a 'group_id' parameter in the URL
        if (isset($_GET['group_id'])) {
            try {
                // Prepare a statement to select the detailed information for the specified rental group
                $stmt = $conn->prepare("SELECT * FROM RentalGroup WHERE Code = :code");
                // Bind the 'group_id' URL parameter to the prepared statement as an integer
                $stmt->bindParam(':code', $_GET['group_id'], PDO::PARAM_INT);
                // Execute the prepared statement
                $stmt->execute();
                // Fetch the detailed information for the selected group
                $groupDetails = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // If an error occurs while fetching details, output the error message and exit the script
                echo "Error: " . $e->getMessage();
                exit;
            }

            // If details for the group are found, display them in a table
            if ($groupDetails) {
                // Heading for the group details section
                echo "<h3>Preferences for Group - " . htmlspecialchars($_GET['group_id']) . "</h3>";
                
                // Fetch and display names of persons in the rental group
                $stmt = $conn->prepare("SELECT FName, LName FROM Person JOIN Renter ON Person.ID = Renter.ID WHERE RentalGroupCode = :code");
                $stmt->bindParam(':code', $_GET['group_id'], PDO::PARAM_INT);
                $stmt->execute();
                $persons = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if ($persons) {
                    echo "Persons in this group: ";
                    $names = [];
                    foreach ($persons as $person) {
                        $names[] = htmlspecialchars($person['FName']) . " " . htmlspecialchars($person['LName']);
                    }
                    echo implode(", ", $names);
                }

                // Table to display the detailed information for the group
                echo "<table class='group-details-table'>";
                // Table headers
                echo "<tr>
                        <th>Parking</th>
                        <th>Accessibility</th>
                        <th>Cost</th>
                        <th>Bedrooms</th>
                        <th>Bathrooms</th>
                        <th>Laundry</th>
                        <th>Type</th>
                      </tr>";
                // Table row displaying the information for the group
                echo "<tr>
                        <td>" . htmlspecialchars($groupDetails['Parking']) . "</td>
                        <td>" . htmlspecialchars($groupDetails['Accessibility']) . "</td>
                        <td>" . htmlspecialchars($groupDetails['Cost']) . "</td>
                        <td>" . htmlspecialchars($groupDetails['Bedrooms']) . "</td>
                        <td>" . htmlspecialchars($groupDetails['Bathrooms']) . "</td>
                        <td>" . htmlspecialchars($groupDetails['Laundry']) . "</td>
                        <td>" . htmlspecialchars($groupDetails['typeAcc']) . "</td>
                      </tr>";
                echo "</table>";
            } // End if statement for group details
        } // End if statement for checking 'group_id'
        ?>
    </div>
</section>

<!-- Include the footer HTML from an external  HTML file -->
<?php include 'footer.html'; ?>

</body>
</html>




<!--Shows all rental groups and allows users to select one to view details. -->

<!-- http://localhost/RentalSite/rental_groups.php -->

<?php
include 'db_connection.php';

// Fetch all rental groups
try {
    $stmt = $conn->query("SELECT Code, Parking, Accessibility, Cost, Bedrooms, Bathrooms, Laundry, typeAcc FROM RentalGroup");
    $rentalGroups = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

// HTML header and opening of the body tag
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rental Groups</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.html'; ?>

<section class='content-wrapper'>
    <div class='container'>
        <h2>Rental Groups</h2>
        <ul class="rental-groups-list">
            <?php foreach ($rentalGroups as $group): ?>
            <li>
                <a href="rental_groups.php?group_id=<?php echo htmlspecialchars($group['Code']); ?>">
                    Group <?php echo htmlspecialchars($group['Code']); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>

        <?php
        // If a specific rental group is selected, fetch its detailed information
        if (isset($_GET['group_id'])) {
            try {
                $stmt = $conn->prepare("SELECT * FROM RentalGroup WHERE Code = :code");
                $stmt->bindParam(':code', $_GET['group_id'], PDO::PARAM_INT);
                $stmt->execute();
                $groupDetails = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                exit;
            }

            // Display details if a group is selected
            if ($groupDetails): ?>
                <h3>Details for Group <?php echo htmlspecialchars($_GET['group_id']); ?></h3>
                <table class="group-details-table">
                    <tr>
                        <th>Parking</th>
                        <th>Accessibility</th>
                        <th>Cost</th>
                        <th>Bedrooms</th>
                        <th>Bathrooms</th>
                        <th>Laundry</th>
                        <th>Type</th>
                    </tr>
                    <tr>
                        <td><?php echo htmlspecialchars($groupDetails['Parking']); ?></td>
                        <td><?php echo htmlspecialchars($groupDetails['Accessibility']); ?></td>
                        <td><?php echo htmlspecialchars($groupDetails['Cost']); ?></td>
                        <td><?php echo htmlspecialchars($groupDetails['Bedrooms']); ?></td>
                        <td><?php echo htmlspecialchars($groupDetails['Bathrooms']); ?></td>
                        <td><?php echo htmlspecialchars($groupDetails['Laundry']); ?></td>
                        <td><?php echo htmlspecialchars($groupDetails['typeAcc']); ?></td>
                    </tr>
                </table>
            <?php endif;
        }
        ?>
    </div>
</section>

<?php include 'footer.html'; ?>

</body>
</html>



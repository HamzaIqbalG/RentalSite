<!--Lists all properties with IDs, owners, and managers. -->
<!-- http://localhost/RentalSite/properties.php -->

<!--Lists all properties with IDs, owners, and managers. -->
<!-- http://localhost/RentalSite/properties.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Ensures responsive design for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Properties</title>
    <!-- Link to the external CSS for styling -->
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <!-- Include the common header -->
    <?php include 'header.html'; ?>

    <!-- Main content section for the rental properties page -->
    <section class = 'content-wrapper'>
        <div class="container">
            <!-- Title for the page -->
            <h1>Rental Properties</h1>
            <!-- Table structure to display property data -->
            <table>
                <!-- Table head for defining column names -->
                <thead>
                    <tr>
                        <th>Property ID</th>
                        <th>Owner Name</th>
                        <th>Manager Name</th>
                    </tr>
                </thead>
                <!-- Table body for displaying the data -->
                <tbody>
                    <?php
                    // Including the database connection script
                    include 'db_connection.php';

                    // Attempt to fetch property data from the database
                    try {
                        // Preparing an SQL statement with JOINs to consolidate property, owner, and manager information
                        $stmt = $conn->prepare(
                            "SELECT 
                                Property.ID AS PropertyID, 
                                CONCAT(Person.FName, ' ', Person.LName) AS OwnerName, 
                                CONCAT(ManagerPerson.FName, ' ', ManagerPerson.LName) AS ManagerName
                            FROM 
                                Property
                            JOIN 
                                PropertyOwner ON Property.ID = PropertyOwner.PropertyID
                            JOIN 
                                Person ON PropertyOwner.OwnerID = Person.ID
                            LEFT JOIN 
                                Manager ON Property.ManagerID = Manager.ID
                            LEFT JOIN 
                                Person AS ManagerPerson ON Manager.ID = ManagerPerson.ID"
                        );

                        // Execute the above statements
                        $stmt->execute();
                        // Fetch all the results into an associative array
                        $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        // If an error occurs, terminate the script and display the error message
                        die("Database error: " . $e->getMessage());
                    }
                    ?>

                    <!-- Loop through each property and create a table row -->
                    <?php foreach ($properties as $property): ?>
                    <tr>
                        <!-- Output the property ID, escaping any special characters -->
                        <td><?= htmlspecialchars($property['PropertyID']) ?></td>
                        <!-- Output the owner's full name, escaping any special characters -->
                        <td><?= htmlspecialchars($property['OwnerName']) ?></td>
                        <!-- Output the manager's full name, escaping any special characters -->
                        <td><?= htmlspecialchars($property['ManagerName']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    
    <!-- Include the common footer from an external file -->
    <?php include 'footer.html'; ?>
</body>
</html>





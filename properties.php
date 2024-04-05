<!--Lists all properties with IDs, owners, and managers. -->
<!-- http://localhost/RentalSite/properties.php -->

<!--Lists all properties with IDs, owners, and managers. -->
<!-- http://localhost/RentalSite/properties.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Properties</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.html'; ?>

    <section class = 'content-wrapper'>
    <div class="container">
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
                <?php
                include 'db_connection.php';

                try {
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

                    $stmt->execute();
                    $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    die("Database error: " . $e->getMessage());
                }
                ?>

                <?php foreach ($properties as $property): ?>
                <tr>
                    <td><?= htmlspecialchars($property['PropertyID']) ?></td>
                    <td><?= htmlspecialchars($property['OwnerName']) ?></td>
                    <td><?= htmlspecialchars($property['ManagerName']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    </section>
    

    <?php include 'footer.html'; ?>
</body>
</html>





<!-- <style>
        /* Simple CSS to make the table look nicer */
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        tr:hover { background-color: #e8f4ff; }
    </style> -->



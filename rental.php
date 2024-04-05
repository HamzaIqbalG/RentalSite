<!--This link is for managing SQL database
    http://localhost/phpmyadmin -->


<!-- This link gives access to homepage
    http://localhost/RentalSite/rental.php -->

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Our Rental Property Listing</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you have a CSS file for styling -->
</head>
<body>
    <header>
        <img src="images/logo.png" alt="Property Rental Logo"> <!-- Place your logo here -->
        <nav>
            <ul>
                <li><a href="rental.php">Home</a></li>
                <li><a href="properties.php">Property Listings</a></li>
                <li><a href="rental_groups.php">Rental Groups</a></li>
                <li><a href="average_rents.php">Average Rents</a></li>
                <li><a href="update_preferences.php">Update Preferences</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section class="welcome-banner">
            <h1>Welcome to Your New Home!</h1>
            <p>Find the perfect rental property from our wide selection of houses, apartments, and rooms.</p>
            <!-- Optional: Search bar could be placed here if implemented -->
        </section>
        
        <section class="feature-properties">
            <!-- Optional: Show some featured properties -->
        </section>

        <section class="about-us">
            <h2>About Us</h2>
            <p>We are committed to helping you find the perfect rental. Learn more about our services and how we can help you.</p>
            <a href="#" class="btn">Learn More</a> <!-- Link to an about page if you have one -->
        </section>
    </main>
    
    <footer>
        <?php include 'footer.html'; ?>
    </footer>
</body>
</html>




<!--This link is for managing SQL database
    http://localhost/phpmyadmin -->


<!-- This link gives access to homepage
    http://localhost/RentalSite/rental.php -->

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Rental Management System</title>

    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1><span class="highlight">Rental</span> Management System</h1>
            </div>
            <nav>
                <ul>
                    <li class="current"><a href="rental.php">Home</a></li>
                    <li><a href="properties.php">Properties</a></li>
                    <li><a href="rental_groups.php">Rental Groups</a></li>
                    <li><a href="update_preferences.php">Update Preferences</a></li>
                    <li><a href="average_rents.php">Average Rents</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="showcase">
        <div class="container">
            <h1>Welcome to Your New Rental Experience</h1>
            <p>Find your perfect property today</p>
        </div>
    </section>

    <!-- space after the image and before footnote -->
    <section class="content-space">
    <div class="container">
        <!-- Add your text or any other content here -->
        <h2>Discover Your Ideal Home</h2>
        <p>Explore a diverse selection of properties tailored to fit your lifestyle. Whether you're looking for a cozy studio apartment 
            or a spacious family house, our Rental Management System simplifies your search. 
            Update your rental group preferences with ease, browse through detailed listings, and compare average rents to find the 
            best match. Start your journey towards a hassle-free rental experience with us today!</p>
    </div>
    </section>

    <!-- including the footnote -->
    <?php include 'footer.html'; ?>

</body>
</html>





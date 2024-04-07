<!--This link is for managing SQL database
    http://localhost/phpmyadmin -->


<!-- This link gives access to homepage
    http://localhost/RentalSite/rental.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- The viewport meta tag ensures the site is mobile responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title of the page shown in the browser tab -->
    <title>Rental</title>

    <!-- Linking the external CSS file for consistent styling across the website -->
    <link rel="stylesheet" href="main.css">
</head>
<body>
<!-- Including the header section from an external HTML file -->
<?php include 'header.html'; ?>

    <!-- Section for welcoming -->
    <section class="showcase">
        <div class="container">
            <!-- Main heading for the showcase area -->
            <h1>Welcome to Your New Rental Experience</h1>
            <!-- slogan -->
            <p>Find your perfect property today</p>
        </div>
    </section>

    <!-- Section for introduction -->
    <section class="content-space">
        <div class="container">
            <!-- Heading for the content section -->
            <h2>Discover Your Ideal Home</h2>
            <!-- Paragraph explaining the features of the site -->
            <p>Explore a diverse selection of properties tailored to fit your lifestyle. Whether you're looking for an apartment 
                or a cozy house, our Rental Management System simplifies your search. 
                Update your rental group preferences with ease, browse through detailed listings, and compare average rents to find the 
                best match. Start your journey towards a hassle-free rental experience with us today!</p>
        </div>
    </section>

    <!-- Including the footer section from an external HTML file -->
    <?php include 'footer.html'; ?>

</body>
</html>






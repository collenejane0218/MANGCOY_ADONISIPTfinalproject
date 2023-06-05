<!DOCTYPE html>
<html>
<head>    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourist Spot Guide in Torrijos and Gasan, Marinduque</title>
    <link rel="stylesheet" type="text/css" href="gasan.css">
</head>
<body>
    <header>
        <h1>Tourist Spot Guide in Torrijos and Gasan, Marinduque</h1>
    </header>

    <!-- Gasan button -->
    <button onclick="goToGasan()">Gasan</button>
  
    <!-- Torrijos button -->
    <button onclick="goToTorrijos()">Torrijos</button>

    <script>
        function goToGasan() {
            // Gasan button functionality goes here
            window.location.href = "gasan.php"; // Redirect to gasan.php
        }

        function goToTorrijos() {
            // Torrijos button functionality goes here
            window.location.href = "torrijos.php"; // Redirect to torrijos.php
        }
    </script>

    <a href="HOMEPAGE.php" class="previous">&laquo; Previous</a>

</body>
</html>

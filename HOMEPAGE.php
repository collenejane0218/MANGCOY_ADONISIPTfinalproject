<!DOCTYPE html>
<html>
<head>    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourist Spot Guide in Torrijos and Gasan, Marinduque</title>
    <link rel="stylesheet" type="text/css" href="homepage.css">

     
</head>
</head>
<body>
    <header>
        <h1>Tourist Spot Guide in Torrijos and Gasan, Marinduque</h1>
        <nav>
            <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact Us</a></li>
             <li><a href="location.php">LOCATION</a></li>

  </ul>
        </nav>
    </header>

    <main>
       
  
  <!-- User button -->
  <button onclick="userFunction()">User</button>
  
  <!-- Admin button -->
  <button onclick="adminFunction()">Admin</button>

  <script>
    function userFunction() {
      // User button functionality goes here
      alert("User functionality");
      window.location.href = "location.php"; // Redirect to location.php
    }

    function adminFunction() {
      // Admin button functionality goes here
      alert("Admin functionality");
      window.location.href = "admin.php"; // Redirect to admin.php
    }
  
</script>

</main>
</body>
</html>
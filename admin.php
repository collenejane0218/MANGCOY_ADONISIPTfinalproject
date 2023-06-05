<?php
function addTouristSpot($location, $touristSpot_Events, $description, $image)
{
    $xmlTouristSpot = simplexml_load_file('TOURISTSPOT.xml'); // Loading XML file containing tourist spots data

    if (!$xmlTouristSpot) {
        $xmlTouristSpot = new SimpleXMLElement('<TouristSpots></TouristSpots>'); // If the XML file doesn't exist, create a new root element
    }
     $newLocation = $xmlTouristSpot->addChild('TouristLocation'); // Adding a new location as a child element

    // Adding child elements to the new location
    $newLocation->addChild('Location', $location);
    $newLocation->addChild('TouristSpots_Events', $touristSpot_Events);
    $newLocation->addChild('Description', $description);

    $imageFileName = $image['name'];
    $imageFolderPath = 'uploads/' . $touristSpot_Events;
    if (!is_dir($imageFolderPath)) {
        mkdir($imageFolderPath, 0777, true); // Creating a new folder for the image if it doesn't exist
    }
    $imageFilePath = $imageFolderPath . '/' . $imageFileName;
    move_uploaded_file($image['tmp_name'], $imageFilePath); // Moving the uploaded image to the designated folder
    $newLocation->addChild('Image', $imageFilePath); // Adding the image path as a child element
    $xmlTouristSpot->asXML('TOURISTSPOT.xml'); // Saving the updated XML file
    
}

function deleteTouristSpot($location)
{
    $xmlTouristSpot = simplexml_load_file('TOURISTSPOT.xml'); // Loading XML file containing tourist spots data

    $deletedLocation = $xmlTouristSpot->xpath("//TouristLocation[Location = '{$location}']"); // Finding the location to be deleted

    if (!empty($deletedLocation)) {
        $deletedLocation = $deletedLocation [0];

        $imageFilePath = (string) $deletedLocation->Image;
        if (file_exists($imageFilePath)) {
            unlink($imageFilePath); // Deleting the associated image file
        }

        $imageFolderPath = dirname($imageFilePath);
        if (is_dir($imageFolderPath)) {
            $files = glob($imageFolderPath . '/*');
            foreach ($files as $file) {
                if (is_file($file))  {
                    unlink($file); // Deleting all files within the image folder
                }
            }
            rmdir($imageFolderPath); // Removing the image folder
        }

        unset($deletedLocation[0]); // Removing the location from the XML structure
        $xmlTouristSpot->asXML('TOURISTSPOT.xml'); // Saving the updated XML file
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['location']) && isset($_POST['touristSpotOrEvents']) && isset($_POST['location-description'])) {
    $location = $_POST['location'];
    $touristSpot_Events = $_POST['touristSpotOrEvents'];
    $description = $_POST['location-description'];
    $image = $_FILES['image'];

    addTouristSpot($location, $touristSpot_Events, $description, $image);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $location = $_GET['delete'];
    
    // Display confirmation dialog box
    echo "<script>
    if (confirm('Are you sure you want to delete this tourist spot?')) {
        window.location.href = 'admin.php?confirmedDelete=' + encodeURIComponent('$location');
    } else {
        // Redirect back to the admin page or any other action you want to perform
        window.location.href = 'admin.php';
    }
    </script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['confirmedDelete'])) {
    $location = $_GET['confirmedDelete'];
    deleteTouristSpot($location);
    header("Location: admin.php");
    exit();
}

$xmltouristSpot = simplexml_load_file('TOURISTSPOT.xml'); // Load XML file containing tourist spots data

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOURIST SPOT GUIDE</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
    <section>
        <div class="admin-main">
            <div class="content-container">
                <form action="admin.php" method="post" enctype="multipart/form-data">
                    <h1 class="banner">Admin Dashboard</h1>
                    <h3 class="label-add">Add Tourist Spots</h3>
                    <div class="input-container">
                        <label for="location">Enter Location<input type="text" name="location" required></label>
                        <label for="touristSpotOrEvents">Enter Tourist Spot<input type="text" name="touristSpotOrEvents" required></label>
                        <label for="location-description">Enter Location Description<input type="text" name="location-description" class="description-container" required></label>
                    </div>
                    <div class="submit-container">
                        <label for="image" id="label-upload">Upload Image here:</label>
                        <input type="file" name="image" accept="image/*" required>
                        <input type="submit" id="add-button" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section>
        <div class="data-container">
            <h3>Existing Data</h3>
            <table>
                <tr>
                    <th>Location</th>
                    <th>Tourist Spot or Events</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach ($xmltouristSpot->TouristLocation as $index1 => $location) {
                    echo '<tr>';
                    echo '<td>' . $location->Location . '</td>';
                    echo '<td>' . $location->TouristSpots_Events . '</td>';
                    echo '<td id="Description-data">' . $location->Description . '</td>';
                    echo '<td><img src="' . $location->Image . '" alt="Image"></td>';
                    echo '<td><a href="admin.php?delete=' . urlencode($location->Location) . '" id="delete-button">Delete</a></td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </div>
    </section>

</body>
<a href="HOMEPAGE.php" class="previous">&laquo; Previous</a>
</html>
<?php
/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chek";*/
$servername = "localhost";
$username = "sneakyco_dreamteamarena";
$password = "K=2oXF4Ft~Ce";
$dbname = "sneakyco_dreamteamarena";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $story_id = $_GET['id'];

    // Retrieve the story details for confirmation
    $sql = "SELECT * FROM story WHERE storyid = $story_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display a confirmation prompt
        echo "Are you sure you want to delete the following story?<br>";
        echo "Title: " . $row["title"] . "<br>";
        echo "Text: " . $row["text"] . "<br>";
        echo '<a href="delete_story.php?confirmed=true&id=' . $row["storyid"] . '" class="btn btn-danger w-45">Confirm Delete</a>';
        echo '<a href="Nosa@CheckAdmin/index.php" class="btn btn-primary w-45">Cancel</a>';
    } else {
        header("Location: Nosa@CheckAdmin/index.php");
        exit;
        //echo "Story not found.";
    }
}

if (isset($_GET['confirmed']) && $_GET['confirmed'] == 'true') {
    $story_id = $_GET['id'];

    // Prepare and bind the SQL statement to delete the story
    $stmt = $conn->prepare("DELETE FROM story WHERE storyid = ?");
    $stmt->bind_param("i", $story_id);

    // Execute the statement and check for errors
    if ($stmt->execute() === TRUE) {
        // Redirect back to the main page after deletion
        header("Location: Nosa@CheckAdmin/index.php");
        exit;
    } else {
        // Display an error message if the deletion fails
        echo "Error deleting record: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

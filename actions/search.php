<?php
// Establish connection to the database
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

// Collect data from the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_text = $_POST['search_text'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO searches (text) VALUES (?)");
    $stmt->bind_param("s", $search_text);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Error: " . $stmt . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

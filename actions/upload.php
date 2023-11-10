<?php
ini_set('memory_limit', '256M'); // Set the memory limit to 256 MB or higher
ini_set('max_execution_time', 500); // Set the execution time to 500 seconds or more

/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chek";*/
$servername = "localhost";
$username = "sneakyco_dreamteamarena";
$password = "K=2oXF4Ft~Ce";
$dbname = "sneakyco_dreamteamarena";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["upload"])){
    $phonenumber = $_POST['telnum'];
    $title = $_POST['title'];
    $text = $_POST['text'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if(isset($_POST["upload"])) {
        /*$check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        } else {
            list($width, $height) = $check;
            if ($width > 800 || $height > 800) {
                echo "Image dimensions should not exceed 800x800 pixels.";
                $uploadOk = 0;
            }
        }*/
        
        $target_size = 110000; // 110 KB in bytes
        $file_size = $_FILES["image"]["size"];

        if ($file_size > $target_size) {
            $image = imagecreatefromstring(file_get_contents($_FILES["image"]["tmp_name"]));
            $resized = imagescale($image, 800, 800); // Resizing the image to 800x800 pixels
            $new_target_file = $target_dir . basename($_FILES["image"]["name"]);
            imagejpeg($resized, $new_target_file, 80); // Saving the resized image with 80% quality
            imagedestroy($image);
            imagedestroy($resized);
        } else {
            /*if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "Sorry, there was an error uploading your file.";
                $uploadOk = 0;
            }*/
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $error = error_get_last();
                echo "Sorry, there was an error uploading your file. Error: " . $error['message'];
                $uploadOk = 0;
            }            
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            //echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
            echo "Your post has been uploaded.";
        }

        $stmt = $conn->prepare("INSERT INTO story (phonenumber, title, image, text) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $phonenumber, $title, $target_file, $text);

        if ($stmt->execute() === TRUE) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Error: " . $stmt . "<br>" . $conn->error;
            echo "Your post did not upload. Please try again.";
        }

        $stmt->close();
    }
}

$conn->close();
?>

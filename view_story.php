<?php
    /*$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chek";*/
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "check";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $story_id = $_GET['id'] ?? 0; // Assuming the storyid is passed as a query parameter

    $sql = "SELECT * FROM story WHERE storyid = $story_id";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Story</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="description" content="Check - Get paid for viral stories." />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $row["title"]; ?>" />
    <meta property="og:description" content="Check - Get paid for viral stories" />
    <meta property="og:image" content="https://www.dreamteamarena.com/actions/uploads/<?php echo $row["image"]; ?>" />
    <meta property="og:url" content="https://www.dreamteamarena.com/view_story.php?id=<?php echo $story_id; ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="Check - Get paid for viral stories" />
    <meta name="twitter:title" content="<?php echo $row["title"]; ?>" />
    <meta property="twitter:image" content="https://www.dreamteamarena.com/actions/uploads/<?php echo $row["image"]; ?>" />
    <link rel="icon" type="image/png" href="https://www.dreamteamarena.com/img/check icon.png">
    <style>
        .line-clamp{
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 5;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
    <div class="container-sm">
        <!-- Include your navigation bar or any other elements you want to display -->
        <nav class="navbar fixed-top bg-body-tertiary">
            <div class="container-fluid d-flex">
                <form class="d-flex w-50" role="search">
                    <input class="form-control me-2" type="search" placeholder="Type Here ..." aria-label="Search" list="datalistOptions" id="exampleDataList">
                    <datalist id="datalistOptions">
                        <option value="">
                        <option value="">
                        <option value="">
                        <option value="">
                        <option value="">
                    </datalist>
                    <button class="btn btn-success" type="submit">Go</button>
                </form>
            </div>
        </nav>
        <div class="position-relative d-flex flex-wrap justify-content-center" style="margin-top: 70px;">
            <div class="d-flex flex-wrap justify-content-center w-100" style="max-width: 1160px;">
                <!--col-lg-3 col-md-4 col-sm-6-->
                <div id="carouselExampleSlidesOnly" class="carousel slide mx-1 my-1 col-lg-12 col-md-14 col-sm-16 w-75" data-bs-ride="carousel" style="height: 100px;">
                    <div class="carousel-inner rounded-4" style="height: 100%;">
                        <div class="carousel-item active" style="height: 100%;">
                            <img src="img/annie-spratt-nWiS2rgtVts-unsplash.jpg" class="d-block w-100 h-100 object-fit-cover" alt="...">
                        </div>
                        <div class="carousel-item" style="height: 100%;">
                            <img src="img/1640723849895.jpg" class="d-block w-100 h-100 object-fit-cover" alt="...">
                        </div>
                        <div class="carousel-item" style="height: 100%;">
                            <img src="img/1500x500.jpg" class="d-block w-100 h-100 object-fit-cover" alt="...">
                        </div>
                    </div>
                </div>
            </div>
            <span class="position-relative">
            <div class="d-flex flex-wrap justify-content-center my-3" style="max-width: 1160px;">
            <?php
                /*$servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "chek";*/
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "check";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $story_id = $_GET['id'] ?? 0; // Assuming the storyid is passed as a query parameter

                $sql = "SELECT * FROM story WHERE storyid = $story_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Increment the number of views
                    $conn->query("UPDATE story SET numberofviews = numberofviews + 1 WHERE storyid = $story_id");
                    
                    // Output the story details
                    while ($row = $result->fetch_assoc()) {
                        // Display the title, upload date, number of reads, and the content of the story
                        echo '<h1 class="card-title w-100 justify-content-start my-2">' . $row["title"] . '</h1>';
                        echo '<p class="card-text w-50 justify-content-start fs-10"><small class="text-body-secondary">Uploaded ' . $row["uploaddate"] . '</small></p>';
                        echo '<p class="card-text w-50 text-end fs-10"><small class="text-body-secondary">' . $row["numberofviews"] . ' reads</small></p>';
                        echo '<img src="actions/' . $row["image"] . '" class="img-fluid rounded-0" alt="..." style="max-height: 500px; max-width: 75%; width: 100%;"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Image Tooltip" 
                            data-bs-original-title="Image Tooltip"
                            data-bs-container="body" 
                            data-bs-html="true" 
                            data-bs-template="tooltip" 
                            id="img-to-switch">';
                        echo '<p class="card-text my-3 fs-19 text-justify">' . $row["text"] . '</p>';
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
            ?>
            </div>
            </span>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="description" content="Check - Get paid for viral stories." />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Check - Read the latest stories" />
    <meta property="og:description" content="Check - Get paid for viral stories" />
    <meta property="og:url" content="https://www.dreamteamarena.com/" />
    <meta property="og:site_name" content="Check" />
    <meta property="og:image" content="https://www.dreamteamarena.com/img/check logo.png" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="Check - Get paid for viral stories" />
    <meta name="twitter:title" content="Check - Get paid for viral stories" />
    <link rel="icon" type="image/png" href="https://www.dreamteamarena.com/img/check icon.png">
    <style>
        .rounded-top-left {
            border-top-left-radius: 5px;
        }
        .line-clamp{
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .title-line-clamper{
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-sm">
        <nav class="navbar fixed-top bg-body-tertiary">
            <div class="container-fluid d-flex">
                <form class="d-flex w-50" role="search" action="index.php" method="post">
                    <input name="search_text" class="form-control me-2" type="search" placeholder="Type Here ..." aria-label="Search">
                    <input type="submit" class="btn btn-success" value="Go">
                </form>
                <a class="navbar-brand" href="upload.html">
                    <!--<img src="img/icons8-upload-color-32.png" class="rounded-0 w-auto h-auto" alt="user icon">-->
                    <button class="btn btn-success w-100 position-relative top-0 start-50 translate-middle-x" type="submit">Upload</button>
                </a>
            </div>
        </nav>
        <div class="position-relative" style="margin-top: 70px;">
            <div class="d-flex flex-wrap justify-content-center" style="max-width: 1160px;">
            <?php
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

                $search_text = $_POST['search_text'] ?? '';

                if (!empty($search_text)) {
                    $sql = "SELECT * FROM story WHERE text LIKE '%$search_text%' OR title LIKE '%$search_text%'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Display the card with the story details
                            echo '<div class="card mb-3 mx-2" style="max-width: 540px; cursor:pointer;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="actions/'.$row["image"].'" class="img-fluid rounded-top-left" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h6 class="card-title title-line-clamper"><a style="text-decoration: none; color:white;" href="view_story.php?id=' . $row["storyid"] . '">' . $row["title"] . '</a></h6>
                                                <p class="card-text"><div class="line-clamp" style="width: 100%;"><a class="text-body-secondary" href="view_story.php?id=' . $row["storyid"] . '" style="text-decoration: none;">' . $row["text"] . '</a></div></p>
                                                <p class="card-text"><small class="text-body-secondary">' . $row["numberofviews"] . ' reads</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                        //<p class="card-text"><small class="text-body-secondary">Uploaded today<br/>' . $row["numberofviews"] . ' reads</small></p>
                    } else {
                        echo "0 results";
                    }
                } else {
                    // If no search text is provided, display all the stories
                    //$sql = "SELECT * FROM story WHERE DATE(uploaddate) = CURDATE() ORDER BY RAND() LIMIT 16";
                    $sql = "SELECT * FROM story ORDER BY RAND() LIMIT 18";
                    $result = $conn->query($sql);

                    $counter = 0;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Display the card with the story details
                            echo '<div class="card mb-3 mx-2" style="max-width: 540px; cursor:pointer;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <a href="view_story.php?id=' . $row["storyid"] . '"><img src="actions/' . $row["image"] . '" class="img-fluid rounded-top-left" alt="..."></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h6 class="card-title title-line-clamper"><a style="text-decoration: none; color:white;" href="view_story.php?id=' . $row["storyid"] . '">' . $row["title"] . '</a></h6>
                                            <p class="card-text"><div class="line-clamp" style="width: 100%;"><a class="text-body-secondary" href="view_story.php?id=' . $row["storyid"] . '" style="text-decoration: none;">' . $row["text"] . '</a></div></p>
                                            <p class="card-text"><small class="text-body-secondary">' . $row["numberofviews"] . ' reads</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            //<p class="card-text"><small class="text-body-secondary">Uploaded 3 mins ago<br/>2k reads</small></p>
                            $counter++;
                            if ($counter % 4 === 0) {
                                echo '<div id="carouselExampleSlidesOnly" class="carousel slide mx-1 my-3 col-lg-10 col-md-12 col-sm-14" data-bs-ride="carousel" data-bs-interval="2000" style="height: 300px;">
                                            <div class="carousel-inner" style="height: 100%;">
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
                                        </div>';
                            }
                        }
                    }else{
                        echo "0 results";
                    }
                }

                $conn->close();
            ?>
        </div>
    </div>
    <script>
        // Refresh the page every 30 seconds (30000 milliseconds)
        setTimeout(function() {
            location.reload();
        }, 30000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
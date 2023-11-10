<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="description" content="Check - Read the latest stories" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Check - Read the latest stories" />
    <link rel="icon" type="image/png" href="../img/check icon.png">
    <style>
        .line-clamp{
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 4;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
    <div class="container-sm">
        <nav class="navbar fixed-top bg-body-tertiary justify-content-center">
            <div class="container-fluid d-flex">
            <form class="d-flex w-100 px-5" role="search" method="post">
                <input class="form-control me-2" type="search" name="search" placeholder="Search Here ..." aria-label="Search" list="datalistOptions" id="exampleDataList">
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
        <div class="position-relative start-50 top-50 translate-middle-x" style="margin-top: 75px;">
        <?php
                /*$servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "chek";*/
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "check";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT COUNT(*) as total_stories FROM story";
                $result = $conn->query($sql);
                $total_stories = 0;
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $total_stories = $row["total_stories"];
                }

                $conn->close();
            ?>
            <p class="card-text w-50 text-left fs-5 text-bold"><strong class="text-body-secondary"><?php echo $total_stories; ?> TOTAL STORIES</strong></p>
            <form method="post">
                <select name="filter" id="" class="form-control" onchange="this.form.submit()">
                    <option value="All" <?php if(isset($_POST['filter']) && $_POST['filter'] == 'All') echo 'selected'; ?>>All</option>
                    <option value="Today" <?php if(isset($_POST['filter']) && $_POST['filter'] == 'Today') echo 'selected'; ?>>Today</option>
                    <option value="Last Week" <?php if(isset($_POST['filter']) && $_POST['filter'] == 'Last Week') echo 'selected'; ?>>Last Week</option>
                    <option value="Last Month" <?php if(isset($_POST['filter']) && $_POST['filter'] == 'Last Month') echo 'selected'; ?>>Last Month</option>
                    <option value="Last Year" <?php if(isset($_POST['filter']) && $_POST['filter'] == 'Last Year') echo 'selected'; ?>>Last Year</option>
                </select>
            </form>
            <div class="table-responsive my-3">
                <table class="table table-striped table-hover text-left table-bordered">
                    <thead class="w-100">
                        <tr>
                            <th>ID</th>
                            <th>Phone N<u>o</u></th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Text</th>
                            <th>N<u>o</u> of views</th>
                            <th>Upload Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="w-100">
                    <?php
                    /*$servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "chek";*/
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "check";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $selected_option = $_POST['filter'] ?? 'All'; // Assuming the select field has the name "filter"
                    $sql = "SELECT * FROM story ORDER BY numberofviews DESC, uploaddate DESC LIMIT 50";

                    if ($selected_option === "Today") {
                        $sql = "SELECT * FROM story WHERE DATE(uploaddate) = CURDATE() ORDER BY numberofviews DESC, uploaddate DESC LIMIT 50";
                    } elseif ($selected_option === "Last Week") {
                        $sql = "SELECT * FROM story WHERE DATE(uploaddate) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ORDER BY numberofviews DESC, uploaddate DESC LIMIT 50";
                    } elseif ($selected_option === "Last Month") {
                        $sql = "SELECT * FROM story WHERE DATE(uploaddate) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY numberofviews DESC, uploaddate DESC LIMIT 50";
                    } elseif ($selected_option === "Last Year") {
                        $sql = "SELECT * FROM story WHERE DATE(uploaddate) >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) ORDER BY numberofviews DESC, uploaddate DESC LIMIT 50";
                    }
                    // Handle the search functionality
                    $search = $_POST['search'] ?? '';

                    if (!empty($search)) {
                        $sql = "SELECT * FROM story WHERE text LIKE '%$search%' OR title LIKE '%$search%' ORDER BY numberofviews DESC, uploaddate DESC LIMIT 50";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<th scope="row">' . $row["storyid"] . '</th>';
                            echo '<td>' . $row["phonenumber"] . '</td>';
                            echo '<td><div class="line-clamp" style="width: 100%;">' . $row["title"] . '</div></td>';
                            echo '<td>' . $row["image"] . '</td>';
                            echo '<td class="text-justify w-25"><div class="line-clamp" style="width: 100%;">' . $row["text"] . '</div></td>';
                            echo '<td>' . $row["numberofviews"] . '</td>';
                            echo '<td>' . $row["uploaddate"] . '</td>';
                            echo '<td style="width:15%; text-align:center;">
                            <a href="../view_story.php?id=' . $row["storyid"] . '" class="btn btn-success mx-2 my-1 w-45">View</a>
                            <a href="../delete_story.php?id=' . $row["storyid"] . '" class="btn btn-danger w-45">Delete</a>
                            </td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "0 results";
                    }
                    
                    $conn->close();
                    ?>
                    </tbody>
                </table>
            </div>
            <!--<nav>
                <ul class="pager list-unstyled">
                    <li class="previous"><a href="?page=<?php #echo max($page - 1, 1); ?>"><span aria-hidden="true">&larr;</span> Newer</a></li>
                    <li class="next"><a href="?page=<?php #echo $page + 1; ?>">Older <span aria-hidden="true">&rarr;</span></a></li>
                </ul>
            </nav>-->
        </div>
    </div>
</body>
</html>

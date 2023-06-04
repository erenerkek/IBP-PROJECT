<?php
session_start();
require 'dbconnection.php';

if ($_SESSION['usertype']) {
    header('Location: ../../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Movie List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #222;
            color: #fff;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        main {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .movie {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #333;
        }

        .movie h2 {
            margin-top: 0;
            color: #fff;
        }

        .movie p {
            margin: 0;
            color: #fff;
        }

        .movie-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
        }

        .movie-status-avail {
            background-color: green;
        }

        .movie-status-unavail {
            background-color: red;
        }

        /* Responsive styles */
        @media screen and (max-width: 600px) {
            main {
                padding: 10px;
            }

            .movie {
                margin: 10px;
            }
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 240px;
            background-color: #333;
            padding-top: 20px;
            outline: none;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu li {
            margin-bottom: 10px;
        }

        .menu li a {
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .menu li a i {
            margin-right: 10px;
        }

        .menu li a:hover {
            background-color: #555;
        }
        @media (max-width: 767px) {
            body {
                padding: 10px;
            }

            .sidebar {
                width: 100%;
                position: static;
                height: auto;
                padding-top: 0;
                margin-bottom: 20px;
            }

            .logo {
                margin-bottom: 20px;
            }

            .menu li {
                margin-bottom: 5px;
            }

            .menu li a {
                padding: 8px;
            }

            form {
                max-width: 100%;
                padding: 10px;
                margin-top: 20px;
            }

            input[type=submit],
            .button {
                width: 100%;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
<div class="sidebar">
    <div class="logo">
        <img src="../../resimler/logo.png" width="100" alt="Logo">
    </div>
    <ul class="menu">
        <li class="active"><a href="../userdashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="../useroperations/passwordchange.php"><i class="fas fa-key"></i> Password Operations</a></li>

        <li><a href="../movieoperations/viewmovie.php"><i class="fas fa-video"></i> View Movies</a></li>


        <li><a href="../movieoperations/searchmovie.php"><i class="fas fa-film"></i> Search Movies</a></li>


        <li><a href="../../mesaj/index.php"><i class="fas fa-envelope"></i>Messages</a></li>

        <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

    </ul>
</div>



    <main>
        <h1>List Movies</h1>


        <br>
        <br>


        <?php
        $sql = "SELECT name, director, summary, status FROM movie";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = $row['name'];
                $director = $row['director'];
                $summary = $row['summary'];
                $status = $row['status'];

                echo "<div class='movie'>";
                echo "<h2>{$name}</h2>";
                echo "<p><strong>Director:</strong> {$director}</p>";
                echo "<p><strong>Summary:</strong> {$summary}</p>";

                if ($status == 'available') {
                    echo "<p><span class='movie-status movie-status-avail'>{$status}</span></p>";
                } else {
                    echo "<p><span class='movie-status movie-status-unavail'>{$status}</span></p>";
                }

                echo "</div>";
            }
        } else {
            echo "No movies found.";
        }

        $connection->close();
        ?>
    </main>
</body>

</html>
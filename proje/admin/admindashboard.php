<?php
require 'dbconnection.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit();
}
if (!$_SESSION['usertype']) {
    header('Location: ../index.php');
    exit();
}

// Kullanıcı sayısını sayan kod
$result = mysqli_query($connection, "SELECT COUNT(*) FROM user;");
$row = mysqli_fetch_array($result);
$usercount = $row[0];

// Film sayısını sayan kod
$result = mysqli_query($connection, "SELECT COUNT(*) FROM movie;");
$row = mysqli_fetch_array($result);
$moviecount = $row[0];

// Veritabanındaki duyuruları gösteren kod
$sql = "SELECT * FROM announcement ORDER BY date DESC ";
$result = mysqli_query($connection, $sql);
?>


<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #111;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 240px;
            background-color: #222;
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
            background-color: #333;
        }

        .main-content {
            margin-left: 240px;
            padding: 30px;
        }

        .header {
            margin-bottom: 30px;
            color: rgba(255,255,255,0.63) ;
        }

        .info {
            background-color: #222;
            padding: 20px;
            border-radius: 5px;
            color: #fff;
        }

        .announcement {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #333;
            border-left: 4px solid #1c79d6;
            border-radius: 5px;
        }

        .announcement .title {
            font-size: 18px;
            font-weight: bold;
            color: #1c79d6;
            margin-bottom: 10px;
        }

        .announcement .content {
            margin-bottom: 10px;
        }

        .announcement .date {
            color: #888;
            font-size: 12px;
        }

        /* Responsive Stil */

        @media only screen and (max-width: 768px) {
            .sidebar {
                position: static;
                height: auto;
                width: 100%;
                padding-top: 0;
                margin-bottom: 20px;
            }

            .sidebar .logo {
                margin-bottom: 10px;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
<div class="sidebar">
    <div class="logo">
        <img src="../resimler/logo.png" width="100" alt="Logo">
    </div>
    <ul class="menu">
        <li class="active"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="./useroperations/userindex.php"><i class="fas fa-users"></i> User Operations</a></li>
        <li><a href="./movieoperations/movieindex.php"><i class="fas fa-video"></i> Movie Operations</a></li>
        <li><a href="announcement.php"><i class="fas fa-bullhorn"></i> Announcement</a></li>
        <li><a href="../mesaj/index.php"><i class="fas fa-envelope"></i> Messages</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>
<div class="main-content">
    <div class="header">
        <h1>Admin Panel</h1>
    </div>
    <div class="info">
        <h3>You can perform operations using this page.</h3>
    </div>

    <section>
        <br>
        <br>
        <div class="info">
            <div class="container">
                <h2><u><strong>Recent Announcements</strong></u></h2>
                <br>
                <br>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="announcement">';
                        echo '<div class="title">' . $row["title"] . '</div>';
                        echo '<div class="content">' . $row["content"] . '</div>';
                        echo '<div class="date">' . $row['date'] . '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No results</p>";
                }
                ?>
            </div>
        </div>
        <br>
        <br>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>

</html>


<?php
session_start();
require 'dbconnection.php';

if ($_SESSION['usertype']) {
    header('Location: ../../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: #fff;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            color: #fff;
        }

        form {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        input[type="text"] {
            width: 80%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #555;
            color: #fff;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        button[type="submit"]:hover {
            background-color: #3e8e41;
        }

        .results {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .results h2 {
            margin-top: 0;
            color: #fff;
        }

        .book {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #555;
        }

        .book h3 {
            margin-top: 0;
            margin-bottom: 5px;
            color: #fff;
        }

        .book p {
            margin: 0;
            color: #fff;
        }

        button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #3e8e41;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 240px;
            background-color: #111;
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
<h1>Movie Search</h1>
<form method="post" action="">
    <input type="text" name="search" placeholder="Search for movies">
    <button type="submit">Search</button>
</form>
<?php
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($connection, $_POST['search']);
    $sql = "SELECT * FROM movie WHERE name LIKE '%$search%' OR director LIKE '%$search%'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="results">';
        echo '<h2>Results:</h2>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="book">';
            echo '<h3>' . $row['name'] . '</h3>';
            echo '<p>By ' . $row['director'] . '</p>';
            echo '<p>Status: ' . $row['status'] . '</p>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="results">';
        echo '<p>No results found</p>';
        echo '</div>';
    }
}

// Close the connection
mysqli_close($connection);

?>

</body>

</html>

<?php

//anasayfa

session_start();

require 'dbconnection.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../../index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            background-color: #222;
            color: #fff;
        }

        a {
            text-decoration: none;
            text-decoration-color: white;
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

        .card-header {
            background-color: #333;
            color: #fff;
        }

        .card-body {
            background-color: #555;
            color: #fff;
        }

        .table {
            color: #fff;
        }

        .table thead th {
            color: #fff;
            background-color: #333;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #757575;
        }

        .btn-primary {
            background-color: #ffcc00;
            border-color: #ffcc00;
        }

        .btn-primary:hover {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #138496;
            border-color: #138496;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }

        h4 {
            color: #fff;
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

    <title>Movies</title>
</head>

<body>
<div class="sidebar">
    <div class="logo">
        <img src="../../resimler/logo.png" width="100" alt="Logo">
    </div>
    <ul class="menu">
        <li class="active"><a href="../admindashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="../useroperations/userindex.php"><i class="fas fa-users"></i> User Operations</a></li>
        <li><a href="../movieoperations/movieindex.php"><i class="fas fa-video"></i> Movie Operations</a></li>
        <li><a href="../announcement.php"><i class="fas fa-bullhorn"></i> Announcement</a></li>
        <li><a href="../../mesaj/index.php"><i class="fas fa-envelope"></i>Messages</a></li>
        <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>
<div class="container mt-4">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center">Movie Details
                        <a href="addmovie.php" class="btn btn-primary">Add Movie</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Director</th>
                                <th>Summary</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM movie";
                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $movieData) {
                                    ?>
                                    <tr>
                                        <td><?= $movieData['id']; ?></td>
                                        <td><?= $movieData['name']; ?></td>
                                        <td><?= $movieData['director']; ?></td>
                                        <td><?= $movieData['summary']; ?></td>
                                        <td><?= $movieData['status']; ?></td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                                <a href="movieview.php?id=<?= $movieData['id']; ?>" class="btn btn-info btn-sm me-md-2 mb-2">View</a>
                                                <a href="movieedit.php?id=<?= $movieData['id']; ?>" class="btn btn-success btn-sm me-md-2 mb-2">Edit</a>
                                                <form action="moviecode.php" method="POST">
                                                    <button type="submit" name="delete_movie" value="<?= $movieData['id']; ?>" class="btn btn-danger btn-sm mb-2">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<h4>No Record Found</h4>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>

</html>

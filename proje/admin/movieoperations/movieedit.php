<!-- dbdeki film bilgilerini editleme sayfası-->

<?php

session_start();

require 'dbconnection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie Edit</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">

        <?php include('message.php') ?>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="m-0">Movie Edit
                            <a href="movieindex.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if (isset($_GET['id'])) {

                            $movieID = mysqli_real_escape_string($connection, $_GET['id']);
                            $query = "SELECT * FROM movie WHERE id='$movieID'";

                            $query_run = mysqli_query($connection, $query);

                            // Check if record exists
                            if (mysqli_num_rows($query_run) > 0) {
                                $movie = mysqli_fetch_array($query_run);

                        ?>

                                <form action="moviecode.php" method="POST">

                                    <input type="hidden" name="movieID" value="<?= $movieID ?>">

                                    <div class="mb-3">
                                        <label for="">Name</label>
                                        <input type="name" name="name" value="<?= $movie['name']; ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="">Director</label>
                                        <input type="text" name="director" value="<?= $movie['director']; ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="">Summary</label>
                                        <textarea name="summary" rows="3" class="form-control"><?= $movie['summary']; ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="">--status--</option>
                                            <option value="available" <?= $movie['status'] == 'available' ? 'selected' : ''; ?>>available</option>
                                            <option value="unavailable" <?= $movie['status'] == 'unavailable' ? 'selected' : ''; ?>>unavailable</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" name="update_movie" class="btn btn-primary">Update Movie</button>
                                    </div>

                                </form>

                        <?php
                            } else {
                                echo "<h4>No ID Found!!</h4>";
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>

</body>

</html>
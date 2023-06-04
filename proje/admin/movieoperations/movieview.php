<!-- dbdeki film bilgilerini gösterme -->


<?php

require 'dbconnection.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie View Details</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="m-0">Movie View Details
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

                                <div class="mb-3">
                                    <label for="">Name</label>
                                    <p class="form-control"><?= $movie['name']; ?></p>
                                </div>

                                <div class="mb-3">
                                    <label for="">Director</label>
                                    <p class="form-control"><?= $movie['director']; ?></p>
                                </div>

                                <div class="mb-3">
                                    <label for="">Summary</label>
                                    <p class="form-control"><?= $movie['summary']; ?></p>
                                </div>

                                <div class="mb-3">
                                    <label for="">Status</label>
                                    <p class="form-control"><?= $movie['status']; ?></p>
                                </div>

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
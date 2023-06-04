
<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add User</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f1f1f1;
        }

        .container {
            max-width: 500px;
            margin-top: 50px;
        }

        .card-header {
            background-color: #1c79d6;
            color: #fff;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
    </style>
</head>

<body>

<div class="container">

    <?php include('message.php') ?>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 text-center">User Add
                        <a href="userindex.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="usercode.php" method="POST">

                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="text" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="">User Type</label>
                            <select name="usertype" class="form-control">
                                <option value="">--select user type--</option>
                                <option value="admin">admin</option>
                                <option value="user">user</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" name="save_user" class="btn btn-primary">Add User</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>

</html>

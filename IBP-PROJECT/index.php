<?php

session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "projedatabase";

$connection = mysqli_connect($hostname, $username, $password, $dbname);

if (!$connection) {
    die('connection failed' . mysqli_connect_error());
}

if (isset($_POST['email']) && isset($_POST['password'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = hash("sha256",$_POST['password']);

        $sql = " SELECT * FROM user WHERE email='$email' AND password='$password'";

        $query = mysqli_query($connection, $sql);
        if (mysqli_num_rows($query) > 0) {
            echo "user exist";
            $row = mysqli_fetch_array($query);

            $_SESSION['loggedin'] = true;


            if ($row['usertype'] == 'admin') {
                echo "admin";
                $_SESSION['usertype'] = true;
                header("Location: ./admin/admindashboard.php");
                exit();
            } else {
                echo "user";
                $_SESSION['usertype'] = false;
                header("Location: ./user/userdashboard.php");
            }
        }
        else {
            echo "<script>
		alert('Email or Password Wrong. Please Try Again.');
		window.location.href='index.php';
	</script>";
        }
    }
}



?>


<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0,
user-scalable=1">

    <style>
        *, *:after, *:before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            font-family: arial;
            font-size: 16px;
            margin: 0;
            line-height: 1.4;
            background: #26839b;
            color: #000;
        }

        .random-change {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: space-around;
            filter: blur(5px);
            z-index: -1;
            background-size: cover;
            background-position: center;
        }

        .log-box {
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/opacity/see-through */
            color: white;
            font-weight: bold;
            border: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            width: 80%;
            height: 70%;
            padding: 20px;
            text-align: center;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Full-width input fields */
        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Set a style for all buttons */
        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 70px;
        }

        button:hover {
            opacity: 0.8;
        }

        /* Extra styles for the cancel button */
        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        /* Center the image and position the close button */
        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
            position: relative;
        }

        img.avatar {
            width: 20%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
            color: #f1f1f1;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: rgba(0, 0, 0, 0.76);
            margin: 1% auto 5% auto; /* 5% from the top, 5% from the bottom and centered */
            border: 1px solid rgb(136, 136, 136);
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button (x) */
        .close {
            position: absolute;
            right: 25px;
            top: 0;
            color: #000;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: red;
            cursor: pointer;
        }

        /* Add Zoom Animation */
        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {
                -webkit-transform: scale(0)
            }
            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes animatezoom {
            from {
                transform: scale(0)
            }
            to {
                transform: scale(1)
            }
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }

    </style>

    <title>HOME</title>
</head>
<body>
<div class="random-change" id="randomChange">
</div>

<div class="log-box">
    <h1>Movie Rental Website</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <!-- Button to open the modal login form -->
    <button onclick="document.getElementById('id01').style.display='block'">Login</button>
    <!-- The Modal -->

</div>
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'"
        class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
    <form class="modal-content animate"  method="POST">
        <div class="imgcontainer">
            <img src="resimler/avatar.jpeg" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="email"><b>Username</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button type="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>


    </form>
</div>

<style>
    .modal-backdrop {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.5); /* overlay color */
        z-index: 999; /* make sure the backdrop is behind the modal */
        display: none; /* hide the backdrop by default */
    }
</style>


<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>
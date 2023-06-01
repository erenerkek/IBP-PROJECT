<?php


$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "projedatabase";
$input = $_POST['input'];

$connection = mysqli_connect($hostname, $username, $password, $dbname);

if (!$connection) {
    die('connection failed' . mysqli_connect_error());
}

$sql = "UPDATE `chat` SET `message`='$input' WHERE id='1'";



if ($connection->query($sql) === TRUE) {
    header("Location: chat.php");
} else {
    echo "Error:" . $sql . "<br>" . $connection->error;
}

$connection->close();

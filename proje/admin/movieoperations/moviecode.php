
<?php

session_start();

require 'dbconnection.php';


// kitap ekleme  

if (isset($_POST['save_movie'])) {

    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $director = mysqli_real_escape_string($connection, $_POST['director']);
    $summary = mysqli_real_escape_string($connection, $_POST['summary']);
    $status = $_POST['status'];

    $query = "INSERT INTO movie (name,director,summary,status) VALUES ('$name','$director','$summary','$status')";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {

        $_SESSION['message'] = 'Movie created succesfully';
        header("Location: movieindex.php");
        exit(0);
    } else {

        $_SESSION['message'] = 'Movie not created';
        header("Location: movieindex.php");
        exit(0);
    }
}

// film bilgi guncelle


if (isset($_POST['update_movie'])) {

    $movieID = mysqli_real_escape_string($connection, $_POST['movieID']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $director= mysqli_real_escape_string($connection, $_POST['director']);
    $summary = mysqli_real_escape_string($connection, $_POST['summary']);
    $status =  $_POST['status'];

    $query = "UPDATE movie SET  name='$name', director='$director', summary= '$summary', status='$status' WHERE id='$movieID' ";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {

        $_SESSION['message'] = 'Movie updated succesfully';
        header("Location: movieindex.php");
        exit(0);
    } else {
        $_SESSION['message'] = 'Movie not updated ';
        header("Location: movieindex.php");
        exit(0);
    }
}

// film silme


if (isset($_POST['delete_movie'])) {


    $movieID = mysqli_real_escape_string($connection, $_POST['delete_movie']);

    $query = "DELETE FROM movie WHERE id = '$movieID' ";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {


        $_SESSION['message'] = 'Movie deleted succesfully';
        header("Location: movieindex.php");
        exit(0);
    } else {


        $_SESSION['message'] = 'Movie not deleted ';
        header("Location: movieindex.php");
        exit(0);
    }
}


?>
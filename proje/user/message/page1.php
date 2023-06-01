<html>

<body>
    <?php

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projedatabase";

    $connection = mysqli_connect($hostname, $username, $password, $dbname);

    if (!$connection) {
        die('connection failed' . mysqli_connect_error());
    }

    $sql = "SELECT `message` FROM chat";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "" . $row["message"] . "<br> <br>";
        }
    } else {
        echo "no messages have been exchanged yet";
    }
    $connection->close();

    ?>

</body>

</html>
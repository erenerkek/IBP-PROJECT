<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>

    <style>
        input[type=textarea] {

            background-color: #0025b5;
            border: none;
            color: white;
            padding: 8px 10px;
            text-decoration: none;
            margin: 4px 1px;
        }

        input[type=submit] {
            background-color: #249a00;
            border: none;
            color: white;
            padding: 8px 10px;
            text-decoration: none;
            margin: 4px 1px;
            cursor: pointer;
            border-radius: 10%;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
        }
    </style>
</head>

<body>


    <form action="page2.php" method="post">
        send user a message: <input type="textarea" name="input" />

        <input type="submit" value="send" /> <br> <br>
    </form>

    <iframe src="page1.php" width="450" height="200" scrolling="yes"></iframe>


    <button>
        <a href="../admindashboard.php">Back</a>
    </button>

</body>

</html>
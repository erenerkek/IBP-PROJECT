<?php
session_start();

// Admin oturumunu kontrol et

// Duyuru eklemek için form gönderildiğinde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Veritabanı bağlantısı ve diğer ayarlar
    $host = 'localhost';
    $dbname = 'projedatabase';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Duyuru bilgilerini al ve güvenlik kontrolleri yap
        $title = $_POST['title'];
        $content = $_POST['content'];

        // XSS saldırılarına karşı girişleri temizle
        $title = htmlspecialchars($title);
        $content = htmlspecialchars($content);

        // SQL enjeksiyonu saldırılarına karşı sorguyu hazırla
        $sql = "INSERT INTO announcement (title, content, date) VALUES (:title, :content, :date)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);

        // Tarih alanını doğrudan kullanmayın, otomatik tarih ataması yapın
        $date = date('Y-m-d');
        $stmt->bindParam(':date', $date);

        // Duyuruyu veritabanına ekle
        $stmt->execute();

        // Başarılı bir şekilde eklendiğinde yönlendirme yap
        header("Location: admindashboard.php");
        exit;
    } catch (PDOException $e) {
        // Hata durumunda hata mesajını göster veya logla
        echo "Hata: " . $e->getMessage();
        exit;
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Announcement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: #fff;
            padding: 20px;
        }

        h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            border: 2px solid #333;
            background-color: #333;
            padding: 20px;
            margin-top: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #fff;
        }

        input[type=text],
        textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
            background-color: #555;
            color: #fff;
        }

        input[type=submit] {
            background-color: #ffcc00;
            color: #333;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        input[type=submit]:hover {
            background-color: #ffc107;
        }

        p.success {
            color: #4caf50;
            margin-top: 20px;
            text-align: center;
        }

        .button {
            background-color: #ffcc00;
            color: #333;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .button:hover {
            background-color: darkgreen;
        }

        a {
            text-decoration: none;
            text-decoration-color: white;
            color: #fff;
        }

        /* Sidebar styles */
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

        /* Responsive layout */
        @media (min-width: 992px) {
            /* Form styles */
            form {
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
            }
        }

        @media (max-width: 991px) {
            /* Form styles */
            form {
                max-width: 80%;
                margin-left: auto;
                margin-right: auto;
            }
        }

        @media (max-width: 768px) {
            /* Form styles */
            form {
                max-width: 95%;
                margin-left: auto;
                margin-right: auto;
            }
        }

        input[type=text],
        textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
            background-color: #555;
            color: #fff;
            resize: vertical;
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
        <img src="../resimler/logo.png" width="100" alt="Logo">
    </div>
    <ul class="menu">
        <li class="active"><a href="admindashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="./useroperations/userindex.php"><i class="fas fa-users"></i> User Operations</a></li>
        <li><a href="./movieoperations/movieindex.php"><i class="fas fa-video"></i> Movie Operations</a></li>
        <li><a href="announcement.php"><i class="fas fa-bullhorn"></i> Announcement</a></li>
        <li><a href="../mesaj/index.php"><i class="fas fa-envelope"></i> Messages</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>
<h2>Write your announcement</h2>

<!-- Duyuru ekleme formu -->
<form method="POST" action="">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" required>

    <label for="content">Content</label>
    <textarea id="content" name="content" required></textarea>

    <input type="submit" value="Add Announcement">
</form>

<?php
// Duyuru eklendikten sonra başarılı mesajını göster
if (isset($_GET['success']) && $_GET['success'] === '1') {
    echo "<p class='success'>Duyuru başarıyla eklendi.</p>";
}
?>



</body>

</html>

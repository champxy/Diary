<?php
session_start();
try {
    $conn = new PDO("mysql:host=localhost; dbname=diary; charset=utf8", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Failed : " . $e->getMessage();
}

// check if search date was submitted
if (isset($_GET['search-date'])) {
    // sanitize the search date input to prevent SQL injection
    $searchDate = htmlentities($_GET['search-date']);

    // modify the SQL query to filter by the search date
    $stmt = $conn->prepare("SELECT * FROM `diary_write` WHERE userID = :userID AND date_write = :searchDate");
    $stmt->bindParam(':userID', $_SESSION['id_user']);
    $stmt->bindParam(':searchDate', $searchDate);
    $stmt->execute(); // execute the prepared statement
    $diary_entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // if no search date was submitted, select all diary entries for the user
    $stmt = $conn->prepare("SELECT * FROM `diary_write` WHERE userID ='" . $_SESSION['id_user'] . "'");
    $stmt->execute(); // execute the prepared statement
    $diary_entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/selectdiary.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/fontawesome.min.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <div class="logo">
            <a href="#"><img src="img/logo.png" width="100" alt="Logo"></a>
        </div>
        <ul class="menu">
            <li><a href="mainboard.php">Home</a></li>
            <li class="dropdown">
                <a href="#"><i class="fa-solid fa-user">⠀</i><?php echo $_SESSION['username'] ?></a>
                <ul class="submenu">
                    <li><a href="yourdiary.php">ไดอารี่ของฉัน</a></li>
                    <li><a href="logout.php">ออกจากระบบ</a></li>

                </ul>
            </li>

        </ul>
    </nav>
    <form action="yourdiary.php" method="get" class="search-form" enctype="multipart/form-data">
        <label for="search-date" class="search-label">Search by Date:</label>
        <div class="search-container">
            <input type="date" id="search-date" name="search-date" required class="search-input">
            <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <div class="card-container">

        <?php foreach ($diary_entries as $entry) : ?>
            <div class="card">
                <h2 class="card-title">วันที่ <?php echo $entry['date_write']; ?></h2>
                <img class="card-image" width="120" src="download/<?php echo $entry['pic']; ?>" alt="">
                <p class="card-description"><?php echo $entry['data_write']; ?></p>
                <a class="card-link" href="editdiary.php?id=<?php echo $entry['diaryID']; ?>">Edit</a>
            </div>
        <?php endforeach; ?>

    </div>
</body>

</html>
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "23solutions";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$szkolenie = $_GET["szkolenie"];

$stmt_check_email = $conn->prepare("SELECT * FROM courses WHERE id = ?");
$stmt_check_email->bind_param("s", $szkolenie);
$stmt_check_email->execute();
$result = $stmt_check_email->get_result();

$row = $result->fetch_assoc();

    $title = $row['title'];
    $price = $row['price'];
    $users_amount = $row['users_amount'];
    $duration = $row['duration'];
    $p1 = $row['p1'];
    $p2 = $row['p2'];


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>23 Solutions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../static/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <script src="../static/script.js"></script>
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="../static/images/logo.jpeg" alt="Logo firmy 23 solutions">
        </div>
        <a href="javascript:void(0);" class="hamburger" onclick=showMenu(myTopnav)><i id="hamburger" class="fa fa-bars"></i></a>
        <nav class="topnav" id="myTopnav">
          <a href="../index.php" class="topnav_a">Home</a>
          <a href="onas.php" class="topnav_a">O nas</a>
          <a href="szkolenia.php" class="topnav_a">Szkolenia</a>
          <a href="kontakt.php" class="topnav_a">Kontakt</a>
          <a href="logowanie.php" class="topnav_a">Logowanie</a>
      </nav>
    </header>

    <section class="hero_short" style="background-image: url(<?php echo '../static/images/szkolenie'.$szkolenie.'.jpg'?>)">
        <h1><?php echo $title?></h1>
    </section>



    <div class="p1"><?php echo $p1?></div>

    <div class="course_info">
        <p>Czas trwania - <?php echo $duration?> h</p>
        <p>Cena - <?php echo $price?> PLN</p>
        <p>Zalecana liczba uczestników - <?php echo $users_amount?></p>
    </div>

    <div class="hero2" style="background-image: url(<?php echo '../static/images/szkoleniep'.$szkolenie.'.jpg'?>)"></div>


    <div class="p2">
        <div class="p2_text">
        <?php echo $p2?>
        </div>
        <button class="home_click_me" onclick="goto('rezerwacja.html')">Zarezerwuj</button>
    </div>

    <footer>
      <div class="top">
        <div class="pages">
          <ul>
            <h3>23 Solutions</h3>
            <li><a href="../index.php">Home</a></li>
            <li><a href="onas.php">O nas</a></li>
            <li><a href="szkolenia.php">Szkolenia</a></li>
            <li><a href="kontakt.php">Kontakt</a></li>
            <li><a href="logowanie.php">Logowanie</a></li>
          </ul>
          <ul>
            <h3>Najczęściej odwiedzane</h3>
            <li><a href="onas.php">Poznaj nasz zespół</a></li>
            <li><a href="szkolenie.php">Kalendarz dostępnych terminów</a></li>
            <li><a href="szkolenia.php">Dostępne szkolenia</a></li>
            <li><a href="kontakt.php">Kontakt</a></li>
          </ul>
        </div>
        <div class="newsletter">
          <h3>Zapisz się na newsletter</h3>
          <form action="sign_for_newsletter.php" method="POST" id="bottom">
              <input type="email" name="newsletter_email" id="newsletter_email" placeholder="E-mail" required aria-label="E-mail"/>
              <input type="submit" value="<?php echo isset($_GET['signed_successful']) ? 'Dziękujemy' : (isset($_GET['signed_error']) ? 'Błąd' : 'Wyślij');?>"/>
              <input type="hidden" name="return_url" value="<?php echo basename($_SERVER['PHP_SELF'])?>">
          </form>
        </div>
      </div>
        <hr class="footer_hr">
      <div class="social">
        <i class="fab fa-linkedin"></i>
        <i class="fab fa-facebook"></i>
        <i class="fab fa-instagram"></i>
        <i class="fab fa-twitter"></i>
      </div>
      <div class="info">
        <div class="legal">
          <a href="../regulamin.txt" target="_blank">Regulamin</a><a href="../polityka.txt" target="_blank">Polityka prywatności</a>
        </div>
        <div class="copyright">2024 Copyright &copy; 23 Solutions</div>
      </div>
    </footer>

</body>
</html>
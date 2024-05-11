<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $tel = $_POST['tel'] ?? '';
    $email = $_POST['email'] ?? '';
    $company_name = $_POST['company_name'] ?? '';
    $date = $_POST['date'] ?? '';
    $title = $_POST['title'] ?? '';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "23solutions";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT price, duration FROM courses WHERE title = '$title'";
    $result = $conn->query($sql);

    $price = "";
    $duration = "";

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $price = $row['price'];
        $duration = $row['duration'];
    }

}
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
          <?php
            if(isset($_SESSION['user_id'])){
                echo "<a href='dashboard.php' class='topnav_a'>Panel</a>";
            } else {
               echo "<a href='logowanie.php' class='topnav_a'>Logowanie</a>";
            }
            ?>
      </nav>
    </header>

    <section class="hero_short" style="background-image: url(<?php echo '../static/images/hero_rezerwacja.jpg'?>)">
        <h1>Potwierdź rezerwacje</h1>
    </section>


    <form action="szkolenia.php" method="post" onsubmit=goto('szkolenia.php')" name="confirmation_form" class="confirmation_form">
        <div class="user_info">
            <h2>Dane osobowe</h2>

            <label><span>Imię</span></label>
            <input type="text" name="name" value="<?php echo $name?>" disabled aria-label="name">

            <label><span>Nazwisko</span></label>
            <input type="text" name="surname" value="<?php echo $surname?>" disabled aria-label="surname">

            <label><span>Firma</span></label>
            <input type="text" name="company_name" value="<?php echo $company_name?>" disabled aria-label="company_name">

            <label><span>E-mail</span></label>
            <input type="text" name="email" value="<?php echo $email?>" disabled aria-label="email">

            <label><span>Telefon kontaktowy</span></label>
            <input type="text" name="tel" value="<?php echo $tel?>" disabled aria-label="tel">
        </div>

        <div class="szkolenie_info">
            <h2>Wybrane szkolenie</h2>

            <label><span>Tytuł</span></label>
            <input type="text" name="title" value="<?php echo $title?>" disabled aria-label="title">

            <label><span>Cena</span></label>
            <input type="text" name="price" value="<?php echo $price?> PLN" disabled aria-label="price">

            <label><span>Czas trwania</span></label>
            <input type="text" name="duration" value="<?php echo $duration?> h" disabled aria-label="duration">

            <label><span>Data</span></label>
            <input type="text" name="date" value="<?php echo $date?>" disabled aria-label="date">

            <label></label>
            <input type="submit" name="confirm" value="Rezerwuj">
        </div>
    </form>




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
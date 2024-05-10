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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $email = $_POST['email'] ?? '';
    $tel = $_POST['tel'] ?? '';
    $mes = $_POST['message'] ?? '';


    $stmt = $conn->prepare("INSERT INTO messages (name, surname, email, tel, message_text) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $surname, $email, $tel, $mes);

    if ($stmt->execute()) {
        header("Location: kontakt.php?message_send=1");
        $stmt->close();
        exit();
    } else {
        header("Location: kontakt.php?sending_error=1");
        $stmt->close();
        exit();
    }


    
  }

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
            <?php
            if(isset($_SESSION['user_id'])){
                echo "<a href='dashboard.php' class='topnav_a'>Panel</a>";
            } else {
               echo "<a href='logowanie.php' class='topnav_a'>Logowanie</a>";
            }

            ?>
      </nav>
    </header>

    <section class="hero_short" style="background-image: url('../static/images/hero_kontakt.jpg')">
        <h1>Masz pytania?</h1>
    </section>

    <?php
    if(isset($_GET['message_send']) && $_GET['message_send'] == 1) {
        echo "<div class='p1' style='margin-top: 10px; margin-bottom: 10px; font-size: 30px'>Wiadomość została wysłana</div>";
    }

    if(isset($_GET['sending_error']) && $_GET['sending_error'] == 1) {
      echo "<div class='p1' style='margin-top: 10px; margin-bottom: 10px; font-size: 30px'>Wystąpił błąd podczas wysyłania wiadomości</div>";
    }

    ?>

    <section class="form">
        <h2>Skontaktuj się z nami</h2>
        <form action="" method="POST">
            <input type="text" id="name" name="name" required placeholder="Imię" aria-label="name">

            <input type="text" id="surname" name="surname" required placeholder="Nazwisko" aria-label="surname">

            <input type="email" id="email" name="email" required placeholder="E-mail" aria-label="E-mail">

            <input type="tel" id="tel" name="tel" required placeholder="Telefon" pattern="[0-9]{9}" aria-label="tel">

            <input type="file" id="attachment" name="attachment">

            <textarea id="message" name="message" rows="4" required placeholder="Wiadomość" maxlength="600" aria-label="message_text"></textarea>

            <div class="accept-regulations">
                <input type="checkbox" id="accept" name="accept" required aria-label="checkbox">
                <label>Akceptuję <a class="regulamin" href="../regulamin.txt" target="_blank">regulamin</a></label>
            </div>

            <button type="submit">Wyślij</button>

        </form>
    </section>


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
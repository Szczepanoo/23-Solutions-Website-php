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
        exit();
    } else {
        header("Location: kontakt.php?sending_error=1");
        exit();
    }

    $stmt->close();
    
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
    <link rel="stylesheet" href="static/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="static/images/logo.jpeg" alt="Logo firmy 23 solutions" width="100px" height="100px">
        </div>
        <a href="javascript:void(0);" class="hamburger" onclick=showMenu(myTopnav)><i id="hamburger" class="fa fa-bars"></i></a>
        <nav class="topnav" id="myTopnav">
            <a href="index.php" class="topnav_a">Home</a>
            <a href="onas.html" class="topnav_a">O nas</a>
            <a href="szkolenia.html" class="topnav_a">Szkolenia</a>
            <a href="kontakt.php" class="topnav_a">Kontakt</a>
            <a href="logowanie.php" class="topnav_a">Logowanie</a>
      </nav>
    </header>

    <section class="hero_short" style="background-image: url('static/images/hero_kontakt.jpg')">
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
            <input type="text" id="name" name="name" required placeholder="Imię">

            <input type="text" id="surname" name="surname" required placeholder="Nazwisko">

            <input type="email" id="email" name="email" required placeholder="E-mail">

            <input type="tel" id="tel" name="tel" required placeholder="Telefon" pattern="[0-9]{9}">

            <input type="file" id="attachment" name="attachment">

            <textarea id="message" name="message" rows="4" required placeholder="Wiadomość" maxlength="600"></textarea>

            <div class="accept-regulations">
                <input type="checkbox" id="accept" name="accept" required>
                <label>Akceptuję <a class="regulamin" href="#regulamin">regulamin</a></label>
            </div>

            <button type="submit">Wyślij</button>

        </form>
    </section>


    <footer>
      <div class="top">
        <div class="pages">
          <ul>
            <h3>23 Solutions</h3>
            <li><a href="{{ url_for('render_index') }}">Home</a></li>
            <li><a href="{{ url_for('render_onas') }}">O nas</a></li>
            <li><a href="{{ url_for('render_szkolenia') }}">Szkolenia</a></li>
            <li><a href="{{ url_for('render_kontakt') }}">Kontakt</a></li>
            <li><a href="{{ url_for('render_logowanie') }}">Logowanie</a></li>
          </ul>
          <ul>
            <h3>Najczęściej odwiedzane</h3>
            <li><a href="{{ url_for('render_onas') }}">Poznaj nasz zespół</a></li>
            <li><a href="{{ url_for('render_szkolenie') }}">Kalendarz dostępnych terminów</a></li>
            <li><a href="{{ url_for('render_szkolenia') }}">Dostępne szkolenia</a></li>
            <li><a href="{{ url_for('render_kontakt') }}">Kontakt</a></li>
          </ul>
        </div>
        <div class="newsletter">
          <h3>Zapisz się na newsletter</h3>
          <form>
            <input type="email" name="newsletter_email" id="newsletter_email" placeholder="E-mail" required/>
            <input type="submit" value="Wyślij"/>
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
          <a href="#regulamin">Regulamin</a><a href="#polityka">Polityka prywatności</a>
        </div>
        <div class="copyright">2024 Copyright &copy; 23 Solutions</div>
      </div>
    </footer>


    <script src="static/script.js"></script>

</body>
</html>
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
    $email = $_POST['email'] ?? '';
    $pas = $_POST['pas'] ?? '';

    $stmt_check_user = $conn->prepare("SELECT * FROM users WHERE mail = ?");
    $stmt_check_user->bind_param("s", $email);
    $stmt_check_user->execute();
    $result = $stmt_check_user->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pas, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: dashboard.php");
            exit();
        }
    }

    header("Location: logowanie.php?login_error=1");
    exit();

    $stmt_check_user->close();
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
            <a href="onas.php" class="topnav_a">O nas</a>
            <a href="szkolenia.php" class="topnav_a">Szkolenia</a>
            <a href="kontakt.php" class="topnav_a">Kontakt</a>
            <a href="logowanie.php" class="topnav_a">Logowanie</a>
        </nav>
    </header>

    <section class="hero_short" style="background-image: url('static/images/hero_logowanie.jpg')">
        <h1>Logowanie</h1>
    </section>
    <?php
    if(isset($_GET['account_created']) && $_GET['account_created'] == 1) {
        echo "<div class='p1' style='margin-top: 10px; margin-bottom: 10px; font-size: 30px'>Konto zostało utworzone</div>";
    }

    if(isset($_GET['creation_error']) && $_GET['creation_error'] == 1) {
      echo "<div class='p1' style='margin-top: 10px; margin-bottom: 10px; font-size: 30px'>Wystąpił błąd podczas tworzenia konta</div>";
    }

    if(isset($_GET['login_error']) && $_GET['login_error'] == 1) {
      echo "<div class='p1' style='margin-top: 10px; margin-bottom: 10px; font-size: 30px'>Nieprawidłowe dane logowania</div>";
    }
    ?>
    

    <section class="login_form">
        <h2>Zaloguj się</h2>
        <form action="" method="POST">
            <input type="text" id="email" name="email" required placeholder="E-mail">

            <input type="password" id="pas" name="pas" required placeholder="Hasło">


            <button type="submit">Wejdź</button>


            <a class="link1" href="#nie_pamietasz_hasla">Nie pamiętasz hasła?</a>
            <a class="link2" href="rejestracja.php">Nie masz konta?</a>

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
          <form action="sign_for_newsletter.php" method="POST" id="bottom">
              <input type="email" name="newsletter_email" id="newsletter_email" placeholder="E-mail" required/>
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
          <a href="#regulamin">Regulamin</a><a href="#polityka">Polityka prywatności</a>
        </div>
        <div class="copyright">2024 Copyright &copy; 23 Solutions</div>
      </div>
    </footer>


    <script src="static/script.js"></script>

</body>
</html>
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: logowanie.php?niezalogowano=1");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "23solutions";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$select_user = "SELECT * FROM users WHERE id = $user_id";
$select_user_result = $conn->query($select_user);

$name = "";
$surname = "";
$email = "";
$tel = "";
$isNewsletter = "";

if ($select_user_result->num_rows > 0) {
    $row = $select_user_result->fetch_assoc();

    $name = "'" . $row['name'] . "'";
    $name = str_replace("'", "", $name);

    $surname = "'" . $row['surname'] . "'";
    $surname = str_replace("'", "", $surname);

    $email = $row['email'];
    $tel = $row['tel'];
    $isNewsletter = $row['newsletter'];

    $_SESSION['name'] = $name;
    $_SESSION['surname'] = $surname;
    $_SESSION['email'] = $email;
    $_SESSION['tel'] = $tel;


}

$select_courses = "SELECT reservations.company_name as company_name, reservations.date as date, courses.title AS title FROM reservations JOIN courses ON reservations.course_id = courses.id WHERE reservations.user_id = $user_id";
$select_courses_result = $conn->query($select_courses);

$courses_amount = $select_courses_result->num_rows;
$titles = array();
$dates = array();
$companies = array();

if ($select_courses_result->num_rows > 0) {
    $i = 0;
    while ($row = $select_courses_result->fetch_assoc()) {
        $titles[$i] = $row['title'];
        $dates[$i] = $row['date'];
        $companies[$i] = $row['company_name'];
        $i++;
    }
}


$isupdated = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $tel = $_POST['tel'] ?? '';
    $email = $_POST['email'] ?? '';
    $pas = $_POST['password'] ?? '';
    $h_pas = password_hash($pas, PASSWORD_DEFAULT);

    $sign_for_newsletter = isset($_POST['sign_for_newsletter']) ? 1 : 0;

    $update =  "UPDATE users SET name = '$name', surname = '$surname', email = $email,tel = $tel, password = '$h_pas', newsletter = $sign_for_newsletter  WHERE id = $user_id";

    $isupdated = $conn->query($update);


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

    <section class="hero_short" style="background-image: url('../static/images/hero_dashboard.jpg')">
        <h1>Witaj, <?php echo $name; ?></h1>
    </section>

    <?php

    if ($isupdated){
        echo "<div class='p1' style='margin-top: 10px; margin-bottom: 10px; font-size: 30px'>Zaktualizowano dane</div>";
         echo "<div class='message' id='message'>Zaktualizowano dane</div>";
    }

    ?>


    <div class="user_aktywne_szkolenia">
         <h2>Twoje szkolenia</h2>
        <?php
        if ($courses_amount > 0) {
            echo "<table class='szkolenia_table'>";
            echo "<tr><th>Tytuł</th><th>Uczestnik</th><th>Data</th></tr>";
            for ($i = 0; $i < $courses_amount; $i++) {

                echo "<tr><td>" . $titles[$i] . "</td><td>". $companies[$i] ."</td><td>" . $dates[$i] . "</td></tr>";

            }
            echo "</table>";
        } else {
            echo "<div class='p1' style='margin-bottom: 0; width: 100%'>Tutaj będą widoczne szkolenia w których uczestniczysz.<br>Przejdź do strony szkoleń i wybierz kurs dla siebie.</div>";
            echo "<button class='dashboard_link' onclick=goto('szkolenia.php')>Szkolenia</button>";
        }

        ?>
    </div>


    <section class="dashboard_panel">
        <h2>Zmień swoje dane</h2>
        <form action="" method="POST" onsubmit="return submitForm(event)" id="dashboard_panel">

            <input type="text" id="name" name="name" aria-label="name" required placeholder="Imię" value="<?php echo $name; ?>">

            <input type="text" id="surname" name="surname" aria-label="surname" required placeholder="Nazwisko" value="<?php echo $surname; ?>">

            <input type="tel" id="tel" name="tel" aria-label="tel" required placeholder="Telefon" pattern="[0-9]{9}" value=<?php echo $tel; ?>>

            <input type="email" id="email" name="email" aria-label="email" required placeholder="E-mail" value=<?php echo $email; ?>>

            <input type="password" id="password" name="password" required placeholder="Hasło" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_])[A-Za-z\d@$!%*?&_]{8,}$"
           title="Hasło musi zawierać co najmniej 8 znaków, w tym co najmniej jedną małą i jedną wielką literę, jedną cyfrę oraz jeden znak specjalny.">

            <input type="password" id="repas" name="repas" aria-label="repas" required placeholder="Powtórz hasło">
            
            <label class="error_label" id="error_label">Hasła nie są indentyczne</label>
            
            <div class="acc_newsletter">
                <input type="checkbox" id="sign_for_newsletter" aria-label="checkbox" name="sign_for_newsletter" <?php echo ($isNewsletter == 1) ? "checked" : ""; ?>>
                <label>Zapisz się na newsletter</label>
              </div>

              
            <button type="submit" class="submit">Zatwierdź</button>

            <button type="button" onclick="goto('logout.php')" class="logout">Wyloguj</button>
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

<script>
    setTimeout(function() {
        var message = document.getElementById('message');
        var opacity = 1;
        var fadeEffect = setInterval(function () {
            if (opacity <= 0.1){
                clearInterval(fadeEffect);
                message.style.display = 'none';
            } else {
                message.style.opacity = opacity;
                opacity -= 0.08;
            }
        }, 50);
    }, 3000);
</script>
</body>
</html>
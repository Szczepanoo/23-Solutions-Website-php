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
    <script src="static/script.js"></script>
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="static/images/logo.jpeg" alt="Logo firmy 23 solutions">
        </div>
        <a href="javascript:void(0);" class="hamburger" onclick=showMenu(myTopnav)><i id="hamburger" class="fa fa-bars"></i></a>
        <nav class="topnav" id="myTopnav">
          <a href="index.php" class="topnav_a">Home</a>
          <a href="templates/onas.php" class="topnav_a">O nas</a>
          <a href="templates/szkolenia.php" class="topnav_a">Szkolenia</a>
          <a href="templates/kontakt.php" class="topnav_a">Kontakt</a>
          <a href="templates/logowanie.php" class="topnav_a">Logowanie</a>
      </nav>
    </header>

    <section class="hero_long">
        <h1>Przyszłość zaczyna się dzisiaj</h1>
        <div class="scroll_down_btn" id="scroll_down_btn" onclick="scrollToDiv('scroll_down_btn')"></div>
    </section>

    <div class="p1">
        23 Solutions to wiodąca firmą edukacyjna z obszaru Environmental, Social, and Governance (ESG), działająca na rzecz transformacji organizacji w kierunku odpowiedzialności społecznej i zrównoważonego rozwoju. Nasze szkolenia są dedykowane korporacjom, instytucjom finansowym i sektorowi publicznemu, wspierając ich w osiąganiu celów zrównoważonego rozwoju oraz tworzeniu pozytywnego wpływu na otaczający nas świat.
    </div>


    <div class="home_container">
        <div class="left_arrow" onclick="moveItem('left')"></div>
        <div class="home_container_item" id="item_1" style="background-image: url('static/images/szkolenie2.jpg')">
            <h3>ESG w praktyce</h3>
            <button class="home_wiecej">Więcej</button>
        </div>

        <div class="home_container_item visible" id="item_2" style="background-image: url('static/images/szkolenie3.jpg')">
            <h3>Zarządzanie Ryzykiem</h3>
            <button class="home_wiecej">Więcej</button>
        </div>

        <div class="home_container_item" id="item_3" style="background-image: url('static/images/szkolenie5.jpg')">
            <h3>Zielone Strategie</h3>
            <button class="home_wiecej">Więcej</button>
        </div>
        <div class="right_arrow" onclick="moveItem('right')"></div>
    </div>

    <div class="p2">
        <div class="p2_text">
        Dołącz do naszej społeczności i rozpocznij swoją podróż w kierunku bardziej zrównoważonej przyszłości już dziś! Kliknij w przycisk obok, aby dowiedzieć się więcej o naszych szkoleniach i jak możemy wspólnie wprowadzić pozytywne zmiany w Twojej organizacji.</div>
        <button class="home_click_me" onclick="goto('szkolenia.html')">Zacznij już teraz</button>
    </div>

<footer>
      <div class="top">
        <div class="pages">
          <ul>
            <h3>23 Solutions</h3>
            <li><a href="index.php">Home</a></li>
            <li><a href="templates/onas.php">O nas</a></li>
            <li><a href="templates/szkolenia.php">Szkolenia</a></li>
            <li><a href="templates/kontakt.php">Kontakt</a></li>
            <li><a href="templates/logowanie.php">Logowanie</a></li>
          </ul>
          <ul>
            <h3>Najczęściej odwiedzane</h3>
            <li><a href="templates/onas.php">Poznaj nasz zespół</a></li>
            <li><a href="templates/szkolenie.php">Kalendarz dostępnych terminów</a></li>
            <li><a href="templates/szkolenia.php">Dostępne szkolenia</a></li>
            <li><a href="templates/kontakt.php">Kontakt</a></li>
          </ul>
        </div>
        <div class="newsletter">
          <h3>Zapisz się na newsletter</h3>
          <form action="templates/sign_for_newsletter.php" method="POST" id="bottom">
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
          <a href="regulamin.txt" target="_blank">Regulamin</a><a href="polityka.txt" target="_blank">Polityka prywatności</a>
        </div>
        <div class="copyright">2024 Copyright &copy; 23 Solutions</div>
      </div>
    </footer>

</body>
</html>
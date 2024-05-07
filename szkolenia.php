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

    <section class="hero_short" style="background-image: url('static/images/hero_szkolenia.jpg')">
        <h1>Odkryj nowe możliwości</h1>
    </section>

    <div class="p1">
        Dołącz do naszej społeczności, gdzie razem możemy rozpocząć podróż w kierunku lepszej przyszłości już dzisiaj! Wspólnie możemy eksplorować możliwości, uczyć się i rozwijać, aby wprowadzać pozytywne zmiany w naszych organizacjach i społecznościach.</div>


    <div class="szkolenia">

        <div class="szkolenie" style="background-image: url('static/images/szkolenie1.jpg')" onclick="goto('szkolenie.php')">
            <h3>Szkolenie 1</h3>
        </div>

        <div class="szkolenie" style="background-image: url('static/images/szkolenie2.jpg')" onclick="goto('szkolenie.php')">
            <h3>Szkolenie 2</h3>
        </div>

        <div class="szkolenie" style="background-image: url('static/images/szkolenie3.jpg')" onclick="goto('szkolenie.php')">
            <h3>Szkolenie 3</h3>
        </div>

        <div class="szkolenie" style="background-image: url('static/images/szkolenie4.jpg')" onclick="goto('szkolenie.php')">
            <h3>Szkolenie 4</h3>
        </div>

        <div class="szkolenie" style="background-image: url('static/images/szkolenie5.jpg')" onclick="goto('szkolenie.html')">
            <h3>Szkolenie 5</h3>
        </div>
    </div>

    <div class="p2">
        <div class="p2_text">
        Jeśli nie widzisz niczego odpowiedniego dla siebie, nie martw się! Skontaktuj się z nami, a razem opracujemy spersonalizowaną ofertę dostosowaną do Twoich unikalnych potrzeb i celów. Dzięki naszej współpracy znajdziemy idealne rozwiązanie, które pomoże Ci osiągnąć sukces i zrealizować swoje cele.
        </div>
        <button class="home_click_me" onclick="goto('kontakt.html')">Napisz do nas</button>
    </div>


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
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

    <section class="hero_short" style="background-image: url('static/images/hero_onas.jpg')">
        <h1>Poznaj nas lepiej</h1>

    </section>

    <div class="p1">
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
    </div>


    <div class="osoby">
        <div class="osoba">
            <div class="osoba_img" style="background-image: url('static/images/pracownik1.jpg')">

            </div>
            <h3>Akshara Banerjee</h3>
            <div class="osoba_opis">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </div>

        </div>

        <div class="osoba">
            <div class="osoba_img" style="background-image: url('static/images/pracownik2.jpg')">
            </div>
            <h3>Jakub Szczepański</h3>
            <div class="osoba_opis">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </div>

        </div>

        <div class="osoba">
            <div class="osoba_img" style="background-image: url('static/images/pracownik3.jpg')">

            </div>
            <h3>Anastazja Kołowrotek</h3>
            <div class="osoba_opis">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </div>
        </div>

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
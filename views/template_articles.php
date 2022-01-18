<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./views/css/style_site.css">
    <link rel="stylesheet" href="./views/css/style_site_responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&family=Quattrocento&display=swap" rel="stylesheet">
    <title>Articles</title>
</head>
<body>
    <header>
        <div class="logomenu">
            <div class="logoheader">
                <img src="img/logo.png" alt="logo">
            </div>
            
            <nav class="menuheader">
                <ul>
                    <li class="accueil"><a href="accueil.php">Accueil</a></li>
                    <li class="article en-cours"><a href="articles.php">Articles</a></li>
                    <li class="categorie"><a href="categories.php">Catégories</a></li>
                </ul>
            </nav>
        </div>
            
        <div class="imageheader">
            <img src="img/header.jpg" alt="map world">
        </div>
    </header>
    
    <section>
        <h1 class="titreArticle">Articles :</h1>
        
        <?= $content ?>
        
    </section>

    <footer class="footerArticle">
        <div class="footerpack">
            <div class="footerpack1">
                <img src="./img/logo.png" alt="logo" />
        </div>

        <div class="footerpack2">
            <p>
            Plan du site - Mentions légales et crédits - Information sur les
            cookies - Politique de confidentialité
            <br />
            Made with ♥ by <strong>Warrengers</strong>
            <br />
            Ce site est protégé par reCAPTCHA. Les règles de confidentialité et
            les conditions d'utilisation de Google s'appliquent.
            </p>
        </div>

        <div class="footerpack3">
            <nav class="menufooter">
                <ul>
                    <li><a href="accueil.php">Accueil</a></li>
                    <li><a href="articles.php">Articles</a></li>
                    <li><a href="categories.php">Catégories</a></li>
                    <li><a href="login.php">Log In</a></li>
                </ul>
            </nav>
        </div>
    </footer>
</body>
</html>
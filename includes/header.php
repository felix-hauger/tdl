<header>
    <h1>TODO List</h1>
    <nav>
        <a href="index.php">Accueil</a>

        <?php if (isset($_SESSION['user'])): ?>
            <a href="logout.php">Déconnexion</a>
        <?php else: ?>
            <button id="login">Connexion</button>
            <button id="register">Inscription</button>
        <?php endif ?>
    </nav>
</header>
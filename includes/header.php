<header>
    <h1>TODO List</h1>
    <nav>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="logout.php">Déconnexion</a>
        <?php else: ?>
            <button id="login">Connexion</button>
            <button id="register">Inscription</button>
        <?php endif ?>
    </nav>
</header>
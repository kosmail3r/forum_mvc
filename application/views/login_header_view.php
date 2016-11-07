<ul class="nav navbar-nav navbar-right">
    <?php
    if (!isset($_SESSION['isAuthenticated'])) {
        echo "<li><a href=\"../../account/login\">Войти</a></li>";
        echo "<li><a href=\"../../account/Registration\">Заригистрироватся</a></li>";
    }
    else {
        echo "<li><a>Вы авторизовались как </a></li>";
        echo "<li><a href=\"../../account/index\"><strong>" . $_SESSION ['login'] .  "</strong></a></li>";
        echo "<li><a href=\"../../account/logout\">Выйти</a></li>";}

    ?>
</ul>
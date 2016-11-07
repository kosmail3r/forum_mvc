<ul class="nav navbar-nav navbar-right">
    <?php
    if (!isset($_SESSION['isRoot'])) {
        echo "<li><a href=\"../../admin/signin\">Войти</a></li>";

    }
    else {
        echo "<li><a>Вы авторизовались как </a></li>";
        echo "<li><a><strong>" . $_SESSION ['login'] .  "</strong></a></li>";
        echo "<li><a href=\"../../admin/logout\">Выйти</a></li>";}

    ?>
</ul>
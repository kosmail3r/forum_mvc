<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../../section/index">Вернутся на главную</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <?php
            echo "<li class='active'><a href='../../topic/index/" . $data['sectionId'] . "'>Назад</a></li>"
            ?>
            <li class=\'active\'><a href='../../section/index/'>К списку разделов</a></li>
        </ul>
        <?php include 'application/views/login_header_view.php'; ?>
    </div><!-- /.navbar-collapse -->
</nav>
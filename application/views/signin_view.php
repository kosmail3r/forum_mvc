<div class="text-center">
    <form action="../../admin/signin" method="POST" role="form" style="margin:0 auto; width:400px">
        <legend>Login</legend>
        <?php


        if ($data !== null) {
            echo "<div class=\"alert-danger\">Неверный логин / пароль </div>";
        }
        ?>


        <div class="form-group">
            <input type="text" class="form-control" name="login" id="login" placeholder="login">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="password">
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</div>
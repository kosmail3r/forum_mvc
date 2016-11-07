<?php
$userData = $data;
?>
<div class="jumbotron">
    <form method="post">
        <label for="field">
            <p>Редактирование данных пользователя <?php
                echo $userData['login'];
                ?></p>
        </label>
        <p>Логин</p>
        <p><input type="text" name="login" value='<?php
            echo $userData['login'];
            ?>'></p>
        <p>Имя</p>
        <p><input type="text" name="name" value='<?php
            echo $userData['name'];
            ?>'></p>
        <p>Адрес email</p>
        <p><input type="text" name="email" value='<?php
            echo $userData['email'];
            ?>'></p>
        <p>Пароль</p>
        <p><input type="text" name="password"></p>
        <p>Удалить пользователя</p>
        <p><input type="checkbox" name="delete"></p>


        <input type="submit" value="Обновить данные">
    </form>
</div>
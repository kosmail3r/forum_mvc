<div class="jumbotron">
    <table border="1">
        <caption>Таблица зарегистрированых пользователей</caption>
        <tr>
            <th>Имя пользователя </th>
            <th>Логин пользователя</th>
            <th>Email пользователя</th>
            <th>нажмите для редактирования</th>
        </tr>
        <?php
        Account_Model::getAllUser();
        ?>
    </table>

    <div align="down" >
        <p>Создание нового пользователя</p>
        <?php
        if (!empty($_POST)) {
            $result = Account_Model::newUser($_POST);
            if ($result) {
                echo "Пользователь успешно создан.";
            }

        }
        ?>
        <form method="POST">
            <p>Желаемое имя:</p>
            <p><input name='name' type='text'/></p>
            <p>Логин:</p>
            <p><input name='login' type='text'/></p>
            <p>Еmail:</p>
            <p><input name='email' type='text'/></p>
            <p>Пароль:</p>
            <p><input name='password' type='password'/></p>

            <input type="submit" value="Создать"/>
            <input type="reset" value="Очистить"/>
    </div>

</div>
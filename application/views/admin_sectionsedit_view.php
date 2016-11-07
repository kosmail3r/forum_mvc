<div class="jumbotron">
    <a href="../../admin/section"><h4>Список разделов форума</h4></a>
</div>

<?php
$sectionData = $data;
?>
<div class="jumbotron">
    <form method="post">
        <label for="field">
            <p>Редактирование данных раздела <?php
                echo $sectionData['name'];
                ?></p>
        </label>
        <p>Название раздела</p>
        <p><input type="text" name="name" value='<?php
            echo $sectionData['name'];
            ?>'></p>
        <p>Имя пользователя</p>
        <p><input type="text" name="user_id" value='<?php
            echo $sectionData['user_id'];
            ?>'></p>
        <p>Удалить раздел</p>
        <p><input type="checkbox" name="delete"></p>
        <input type="submit" value="Обновить данные">
    </form>
</div>


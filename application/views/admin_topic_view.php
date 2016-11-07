<?php
$topicData = $data;
?>
<div class="jumbotron">
    <a href="../../admin/topics"><h4>Список тем форума</h4></a>
</div>
<div class="jumbotron">
    <form method="post">
        <label for="field">
            <p>Редактирование темы <?php
                echo $topicData['name'];
                ?></p>
        </label>
        <p>Название темы</p>
        <p><input type="text" name="name" value='<?php
            echo $topicData['name'];
            ?>'></p>
        <p>Кем содана</p>
        <p><input type="text" name="user_id" value='<?php
            echo $topicData['user_id'];
            ?>'></p>
        <p>Раздел темы</p>
        <p><input type="text" name="section_id" value='<?php
            echo $topicData['section_id'];
            ?>'></p>
        <p>Удалить тему</p>
        <p><input type="checkbox" name="delete"></p>


        <input type="submit" value="Обновить данные">
    </form>
</div>

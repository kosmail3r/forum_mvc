<div class="jumbotron"><h4>Список тем форума</h4>
</div>
<div class="jumbotron">
    <table border="1">
        <caption>Таблица тем</caption>
        <tr>
            <th>Название темы</th>
            <th>Имя автора</th>
            <th>Раздел</th>
            <th>нажмите для редактирования</th>
        </tr>
        <?php
        Topic_Model::showAllTopics();
        ?>
    </table>
</div>

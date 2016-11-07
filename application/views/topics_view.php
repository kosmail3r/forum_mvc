<?php
foreach ($data['rows'] as $row) {
    echo "<div  class=\"col-sm-12 col-lg-12 col-md-12\"><div class='thumbnail'>";
    echo "<a href='../../message/index/" . $row['id'] . "'>" . $row['name'] . "</a>";
    echo "</div></div>";
}

echo "<form action='../create' method='post' role='form' class='col-sm-12 col-lg-12 col-md-12'>
        <legend>Для создания новой темы, Вам достаточно указать желаемое название будущей темы.</legend>


<input type='hidden' value='{$row['section_id']}' name='id' id='id'>
        <div class='form-group'>
            <p>Название темы:</p>
           <p><input name='name' type='text'/></p>
        </div>


        <button type=\"submit\" class=\"btn btn-primary\">Добавить</button>
    </form>";
?>
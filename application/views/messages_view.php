<?php

foreach ($data['rows'] as $row) {
    $text = $row['text'];
    $name = $row['name'];
    $created_at = $row['created_at'];
    echo " <div class=\"col-sm-12 col-lg-12 col-md-12\">
                        <div class=\"thumbnail\">
                                 <legend>Автор сообщения <strong>" . $name . "</strong>
                                 Дата сообщения <strong>" . $created_at . "</strong></legend>
                                 <div class=\"caption\">" . $text . "
                                 </div>
                               </div>
                    </div>";
}

echo "<form action='../create' method='post' role='form' class='col-sm-12 col-lg-12 col-md-12'>
        <legend>Добавить новое сообщение</legend>


<input type='hidden' value='{$data['id']}' name='id' id='id'>
        <div class='form-group'>
            <textarea class='form-control' name='text' id='text' placeholder='Введите сообщение здесь'></textarea>
        </div>


        <button type=\"submit\" class=\"btn btn-primary\">Добавить</button>
    </form>";
?>

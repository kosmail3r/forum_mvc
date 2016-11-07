<div class="jumbotron"><h4>Список разделов форума</h4>
</div>

    <?php
    $rows = $data;
    foreach ($rows as $row) {
        echo "<div  class=\"col-sm-12 col-lg-12 col-md-12\"><div class='thumbnail'>";
        echo "<a href='../../admin/sections/" . $row['id'] . "'>" . $row['name'] . "</a>";
        echo "</div></div>";
    }
    ?>
<?php
$title = "Грузовой транспорт";
include "./layouts/header.php"
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1>Грузовой транспорт</h1>
        </div>

        <form method="post" action="."/index.php?action=save">
            <input type="hidden" name="type" value="weight" />

            <div class="form-group">
                <label>Грузоподъемность, т.</label>
                <input type="text" class="form-control" name="carrying"/>
            </div>


            <div class="form-group">
                <label>Потребление топлива, л/100км.</label>
                <input type="text" class="form-control" name="fuel_consump"/>
            </div>

            <div class="form-group">
                <label>Максимальная скорость, км/ч</label>
                <input type="text" class="form-control" name="max_speed"/>
            </div>

            <div class="form-group">
                <label>Расстояние, км.</label>
                <input type="text" class="form-control" name="range"/>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Отправить</button>
                <a href="./index.php" class="btn btn-default">Отмена</a>
            </div>
        </form>
        </div>
    </div>
</div>
</body>
</html>
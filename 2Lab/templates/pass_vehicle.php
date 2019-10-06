<?php
$title = "Пассажирский транспорт";
include "./layouts/header.php"
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1>Пассажирский транспорт</h1>
        </div>

            <form method="post" action="./index.php?action=save">
                <input type="hidden" name="type" value="pass" />

                <div class="form-group">
                    <label>Стоимость проезда, грн.</label>
                    <input type="text" class="form-control" name="price"/>
                </div>

                <div class="form-group">
                    <label>Количество мест, шт.</label>
                    <input type="text" class="form-control" name="quantity"/>
                </div>

                <div class="form-group">
                    <label>Максимальная скорость, км/ч.</label>
                    <input type="text" class="form-control" name="max_speed"/>
                </div>

                <div class="form-group">
                    <label>Потребление топлива, л/100км.</label>
                    <input type="text" class="form-control" name="fuel_consump"/>
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
<?php
include "./layouts/footer.php"
?>
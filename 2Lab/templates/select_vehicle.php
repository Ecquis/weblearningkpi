<?php
$title = "Выберите транспорт";
include "./layouts/header.php"
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1>Выберите транспортное средство</h1>
        </div>

          <div class="col-sm-12 text-center">
            <form method="post" action="./index.php?action=form">
                <div class="form-group">
                    <select name="select">
                        <option value="weight">Грузовое авто</option>
                        <option value="pass">Пассажирское авто</option>
                    </select>
                </div>

                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                    <a href="./index.php" class="btn btn-default">Отмена</a>
                </div>
            </form>
          </div>
        </div>
    </div>
</div>
<?php
include "./layouts/footer.php"
?>
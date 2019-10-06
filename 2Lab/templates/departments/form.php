<?php
$title = "Новый отдел";
include "./layouts/header.php"
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1>Новый отдел</h1>
        </div>

        <div class="col-sm-8 col-sm-offset-2">
            <?php if (isset($errors['general'])) { ?>
                <span class="help-block"><?= $errors['general'] ?></span>
            <?php } ?>
            
            <form method="post">
                <div class="form-group <?= isset($errors['name']) ? 'has-error' : '' ?>">
                    <label>Название</label>
                    <input type="text" class="form-control" name="department[name]" value="<?= isset($department->name) ? $department->name : '' ?>" />
                    <?php if (isset($errors['name'])) { ?>
                        <span class="help-block"><?= $errors['name'] ?></span>
                    <?php } ?>
                </div>

                <div class="form-group <?= isset($errors['city']) ? 'has-error' : '' ?>">
                    <label>Город</label>
                    <input type="text" class="form-control" name="department[city]" value="<?= isset($department->city) ? $department->city : '' ?>" />
                    <?php if (isset($errors['city'])) { ?>
                        <span class="help-block"><?= $errors['city'] ?></span>
                    <?php } ?>
                </div>

                <div class="form-group <?= isset($errors['address']) ? 'has-error' : '' ?>">
                    <label>Адрес</label>
                    <input type="text" class="form-control" name="department[address]" value="<?= isset($department->address) ? $department->address : '' ?>" />
                    <?php if (isset($errors['address'])) { ?>
                        <span class="help-block"><?= $errors['address'] ?></span>
                    <?php } ?>
                </div>

                <div class="form-group <?= isset($errors['phone']) ? 'has-error' : '' ?>">
                    <label>Телефон</label>
                    <input type="text" class="form-control" name="department[phone]" value="<?= isset($department->phone) ? $department->phone : '' ?>" />
                    <?php if (isset($errors['phone'])) { ?>
                        <span class="help-block"><?= $errors['phone'] ?></span>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a href="./departments.php" class="btn btn-default">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include "./layouts/footer.php"
?>
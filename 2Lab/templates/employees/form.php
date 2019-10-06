<?php
$title = "Добавление контакта";
include "./layouts/header.php"
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1>Новый сотрудник</h1>
        </div>

        <div class="col-sm-8 col-sm-offset-2">
            <?php if (isset($errors['general'])) { ?>
                <span class="error"><?= $errors['general'] ?></span>
            <?php } ?>

            <form method="post">
                <div class="form-group <?= isset($errors['firstname']) ? 'has-error' : '' ?>">
                    <label>Имя</label>
                    <input type="text" class="form-control" name="employee[firstname]" value="<?= isset($employee->firstname) ? $employee->firstname : '' ?>" />
                    <?php if (isset($errors['firstname'])) { ?>
                        <span class="help-block"><?= $errors['firstname'] ?></span>
                    <?php } ?>
                </div>

                <div class="form-group <?= isset($errors['lastname']) ? 'has-error' : '' ?>">
                    <label>Фамилия</label>
                    <input type="text" class="form-control" name="employee[lastname]" value="<?= isset($employee->lastname) ? $employee->lastname : '' ?>" />
                    <?php if (isset($errors['lastname'])) { ?>
                        <span class="help-block"><?= $errors['lastname'] ?></span>
                    <?php } ?>
                </div>

                <div class="form-group <?= isset($errors['birth']) ? 'has-error' : '' ?>">
                    <label>Дата рождения</label>
                    <input type="date" class="form-control" name="employee[birth]" value="<?= isset($employee->birth) ? $employee->birth : '' ?>" />
                    <?php if (isset($errors['birth'])) { ?>
                        <span class="help-block"><?= $errors['birth'] ?></span>
                    <?php } ?>
                </div>

                <div class="form-group <?= isset($errors['employed']) ? 'has-error' : '' ?>">
                    <label>Дата приема на работу</label>
                    <input type="date" class="form-control" name="employee[employed]" value="<?= isset($employee->employed) ? $employee->employed : '' ?>" />
                    <?php if (isset($errors['employed'])) { ?>
                        <span class="help-block"><?= $errors['employed'] ?></span>
                    <?php } ?>
                </div>

                <div class="form-group <?= isset($errors['phone']) ? 'has-error' : '' ?>">
                    <label>Телефон</label>
                    <input type="text" class="form-control" name="employee[phone]" value="<?= isset($employee->phone) ? $employee->phone : '' ?>"/>
                    <?php if (isset($errors['phone'])) { ?>
                        <span class="help-block"><?= $errors['phone'] ?></span>
                    <?php } ?>
                </div>

                <div class="form-group <?= isset($errors['postId']) ? 'has-error' : '' ?>">
                    <label>Должность</label>
                    <select class="form-control" name="employee[postId]">
                        <option>Выберите должность...</option>

                        <?php foreach ($posts as $post) { ?>
                            <?php if ($post->id == $employee->postId) { ?>
                                <option value="<?= $post->id ?>" selected><?= "{$post->name}" ?></option>
                            <?php } else { ?>
                                <option value="<?= $post->id ?>"><?= "{$post->name}" ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <?php if (isset($errors['postId'])) { ?>
                        <span class="help-block"><?= $errors['postId'] ?></span>
                    <?php } ?>
                </div>

                <div class="form-group <?= isset($errors['departmentId']) ? 'has-error' : '' ?>">
                    <label>Отдел</label>
                    <select class="form-control" name="employee[departmentId]">
                        <option>Выберите отдел...</option>

                        <?php foreach ($departments as $department) { ?>
                            <?php if ($department->id == $employee->departmentId) { ?>
                                <option value="<?= $department->id ?>" selected><?= "{$department->name} ({$department->city}, {$department->address})" ?></option>
                            <?php } else { ?>
                                <option value="<?= $department->id ?>"><?= "{$department->name} ({$department->city}, {$department->address})" ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <?php if ($has_errors && isset($errors['departmentId'])) { ?>
                        <span class="help-block"><?= $errors['departmentId'] ?></span>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a href="./employees.php" class="btn btn-default">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include "./layouts/footer.php"
?>
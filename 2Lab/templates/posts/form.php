<?php
 $title = "Новая должность";
 include "./layouts/header.php"
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1>Новая должность</h1>
        </div>

        <div class="col-sm-8 col-sm-offset-2">
            <?php if (isset($errors['general'])) { ?>
                <span class="error"><?= $errors['general'] ?></span>
            <?php } ?>

            <form method="post">
                <div class="form-group <?= isset($errors['name']) ? 'has-error' : '' ?>">
                    <label>Название должности</label>
                    <input type="text" class="form-control"  name="post[name]" value="<?= isset($post->name) ? $post->name : '' ?>" />
                    <?php if (isset($errors['name'])) { ?>
                        <span class="help-block"><?= $errors['name'] ?></span>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a href="./posts.php" class="btn btn-default">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include "./layouts/footer.php"
?>
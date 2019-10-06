<?php
$title = "Список должностей";
include "./layouts/header.php"
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1>Список должностей</h1>
            <p><a href="./posts.php?action=new" class="pull-right"><i class="glyphicon glyphicon-plus"></i>Добавить должность</a></p>
        </div>

        <div class="col-sm-12">
            <form action="./posts.php">
                <?php if (!empty($formOrderParams)) { ?>
                    <?php foreach ($formOrderParams as $field => $dir) { ?>
                        <input type="hidden" name="order[<?= $field ?>]" value="<?= $dir ?>" />
                    <?php } ?>
                <?php } ?>

                <table class="table">
                    <thead>
                    <tr>
                        <th><a href="./posts.php?<?= empty($directions['id']) ? '' : 'order[id]=' . $directions['id'] ?>&<?= $filterGetParams ?>">№</a></th>
                        <th><a href="./posts.php?<?= empty($directions['name']) ? '' : 'order[name]=' . $directions['name'] ?>&<?= $filterGetParams ?>">Название</a></th>
                        <th></th>
                        <th></th>
                    </tr>

                    <tr class="table-filter">
                        <td><input type="text" class="form-control input-sm" name="filter[id]"
                                   value="<?= isset($filter['id']) ? $filter['id'] : '' ?>" /></td>
                        <td><input type="text" class="form-control input-sm" name="filter[name]"
                                   value="<?= isset($filter['name']) ? $filter['name'] : '' ?>" /></td>
                        <td></td>
                        <td></td>
                    </tr>

                    </thead>



                    <tbody>
                        <?php foreach ($posts as $post) { ?>
                            <tr>
                                <td><?= $post->id ?></td>
                                <td><?= $post->name ?></td>
                                <td><a href="./posts.php?action=edit&id=<?= $post->id ?>"><i class="glyphicon glyphicon-pencil"></i></a></td>
                                <td><a href="./posts.php?action=delete&id=<?= $post->id ?>"><i class="glyphicon glyphicon-remove"></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>

        <?php if ($pages_count > 1) { ?>
            <div class="col-sm-12">
                <ul class="pagination">
                    <li><a href="./posts.php?<?= $orderGetParams ?>&<?= $filterGetParams ?>">1</a></li>

                    <?php for ($p = 2; $p <= $pages_count; $p++) { ?>
                        <li><a href="./posts.php?page=<?= $p ?>&<?= $orderGetParams ?>&<?= $filterGetParams ?>"><?= $p ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>


<?php
include "./layouts/footer.php"
?>
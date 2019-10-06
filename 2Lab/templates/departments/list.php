<?php
$title = "Список департаментов";
include "./layouts/header.php"
?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h1>Список отделов</h1>
                <p><a href="./departments.php?action=new" class="pull-right"><i class="glyphicon glyphicon-plus"></i>Добавить
                        отдел</a></p>
            </div>

            <div class="col-sm-12">
                <form action="./departments.php">
                    <?php if (!empty($formOrderParams)) { ?>
                        <?php foreach ($formOrderParams as $field => $dir) { ?>
                            <input type="hidden" name="order[<?= $field ?>]" value="<?= $dir ?>">
                        <?php } ?>
                    <?php } ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>
                                <a href="./departments.php?<?= empty($directions['id']) ? '' : 'order[id]=' . $directions['id'] ?>&<?= $filterGetParams ?>">№</a>
                            </th>
                            <th>
                                <a href="./departments.php?<?= empty($directions['name']) ? '' : 'order[name]=' . $directions['name'] ?>&<?= $filterGetParams ?>">Название</a>
                            </th>
                            <th>
                                <a href="./departments.php?<?= empty($directions['city']) ? '' : 'order[city]=' . $directions['city'] ?>&<?= $filterGetParams ?>">Город</a>
                            </th>
                            <th>
                                <a href="./departments.php?<?= empty($directions['address']) ? '' : 'order[address]=' . $directions['address'] ?>&<?= $filterGetParams ?>">Адрес</a>
                            </th>
                            <th>
                                <a href="./departments.php?<?= empty($directions['phone']) ? '' : 'order[phone]=' . $directions['phone'] ?>&<?= $filterGetParams ?>">Телефон</a>
                            </th>
                            <th></th>
                            <th></th>
                        </tr>

                        <tr class="table-filter">
                            <td><input type="text" class="form-control input-sm" name="filter[id]"
                                       value="<?= isset($filter['id']) ? $filter['id'] : '' ?>"/></td>
                            <td><input type="text" class="form-control input-sm" name="filter[name]"
                                       value="<?= isset($filter['name']) ? $filter['name'] : '' ?>"/></td>
                            <td><input type="text" class="form-control input-sm" name="filter[city]"
                                       value="<?= isset($filter['city']) ? $filter['city'] : '' ?>"/></td>
                            <td><input type="text" class="form-control input-sm" name="filter[address]"
                                       value="<?= isset($filter['address']) ? $filter['address'] : '' ?>"/></td>
                            <td><input type="text" class="form-control input-sm" name="filter[phone]"
                                       value="<?= isset($filter['phone']) ? $filter['phone'] : '' ?>"/></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($departments as $department) { ?>
                            <tr>
                                <th><?= $department->id ?></th>
                                <td><?= $department->name ?></td>
                                <td><?= $department->city ?></td>
                                <td><?= $department->address ?></td>
                                <td><?= $department->phone ?></td>
                                <td><a href="./departments.php?action=edit&id=<?= $department->id ?>"><i
                                                class="glyphicon glyphicon-pencil"></i></a></td>
                                <td><a href="./departments.php?action=delete&id=<?= $department->id ?>"><i
                                                class="glyphicon glyphicon-remove"></i></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>

            <?php if ($pages_count > 1) { ?>
                <div class="col-sm-12">
                    <ul class="pagination">
                        <li><a href="./departments.php?<?= $pages_params ?>">1</a></li>

                        <?php for ($p = 2; $p <= $pages_count; $p++) { ?>
                            <li><a href="./departments.php?page=<?= $p ?>&<?= $pages_params ?>"><?= $p ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>

<?php
include "./layouts/footer.php"
?>
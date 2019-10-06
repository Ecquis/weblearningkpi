<?php
$title = "Список контактов";
include "./layouts/header.php"
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1>Список сотрудников</h1>
            <p><a href="./employees.php?action=new" class="pull-right"><i class="glyphicon glyphicon-plus"></i>Добавить сотрудника</a></p>
        </div>

        <div class="col-sm-12">
            <form action="./employees.php">
                <table class="table">
                    <thead>
                    <tr>
                        <th><a href="./employees.php?<?= empty($directions['id']) ? '' : 'order[id]=' . $directions['id'] ?>&<?= $filterGetParams ?>">№</a></th>
                        <th><a href="./employees.php?<?= empty($directions['firstname']) ? '' : 'order[firstname]=' . $directions['firstname'] ?>&<?= $filterGetParams ?>">Имя</a></th>
                        <th><a href="./employees.php?<?= empty($directions['lastname']) ? '' : 'order[lastname]=' . $directions['lastname'] ?>&<?= $filterGetParams ?>">Фамилия</a></th>
                        <th><a href="./employees.php?<?= empty($directions['birth']) ? '' : 'order[birth]=' . $directions['birth'] ?>&<?= $filterGetParams ?>">Дата рождения</a></th>
                        <th><a href="./employees.php?<?= empty($directions['employed']) ? '' : 'order[employed]=' . $directions['employed'] ?>&<?= $filterGetParams ?>">Дата приема на работу</a></th>
                        <th><a href="./employees.php?<?= empty($directions['phone']) ? '' : 'order[phone]=' . $directions['phone'] ?>&<?= $filterGetParams ?>">Телефон</a></th>
                        <th><a href="./employees.php?<?= empty($directions['post']) ? '' : 'order[post]=' . $directions['post'] ?>&<?= $filterGetParams ?>">Должность</a></th>
                        <th><a href="./employees.php?<?= empty($directions['department']) ? '' : 'order[department]=' . $directions['department'] ?>&<?= $filterGetParams ?>">Отдел</a></th>
                        <th></th>
                        <th></th>
                    </tr>

                    <tr class="table-filter">
                        <th><input type="text" class="form-control input-sm" name="filter[id]"
                                   value="<?= isset($filter['id']) ? $filter['id'] : '' ?>" /></th>
                        <th><input type="text" class="form-control input-sm" name="filter[firstname]"
                                   value="<?= isset($filter['firstname']) ? $filter['firstname'] : '' ?>" /></th>
                        <th><input type="text" class="form-control input-sm" name="filter[lastname]"
                                   value="<?= isset($filter['lastname']) ? $filter['lastname'] : '' ?>" /></th>
                        <th><input type="text" class="form-control input-sm" name="filter[birth]"
                                   value="<?= isset($filter['birth']) ? $filter['birth'] : '' ?>" /></th>
                        <th><input type="text" class="form-control input-sm" name="filter[employed]"
                                   value="<?= isset($filter['employed']) ? $filter['employed'] : '' ?>" /></th>
                        <th><input type="text" class="form-control input-sm" name="filter[phone]"
                                   value="<?= isset($filter['phone']) ? $filter['phone'] : '' ?>" /></th>
                        <th>
                            <select class="form-control input-sm" name="filter[postId]">
                                <option value=""></option>

                                <?php foreach ($posts as $post) { ?>
                                    <?php if (!empty($filter['postId']) && $filter['postId'] == $post->id) { ?>
                                        <option value="<?= $post->id ?>" selected><?= $post->name ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $post->id ?>"><?= $post->name ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </th>
                        <th>
                            <select class="form-control input-sm" name="filter[departmentId]">
                                <option value=""></option>

                                <?php foreach ($departments as $department) { ?>
                                    <option value="<?= $department->id ?>"><?= $department->name ?> (<?= $department->city ?>, <?= $department->address ?>)</option>
                                <?php } ?>
                            </select>
                        </th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($employees as $employee) { ?>
                        <tr>
                            <th><?= $employee->id ?></th>
                            <td><?= $employee->firstname ?></td>
                            <td><?= $employee->lastname ?></td>
                            <td><?= $employee->birth ?></td>
                            <td><?= $employee->employed ?></td>
                            <td><?= $employee->phone ?></td>
                            <td><?= $employee->postName ?></td>
                            <td><?= $employee->departmentName ?></td>

                            <td><a href="./employees.php?action=edit&id=<?= $employee->id ?>"><i class="glyphicon glyphicon-pencil"></i></a></td>
                            <td><a href="./employees.php?action=delete&id=<?= $employee->id ?>"><i class="glyphicon glyphicon-remove"></i></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
        <?php if ($pages_count > 1) { ?>
            <div class="col-sm-6">
                <ul class="pagination">
                    <li><a href="./employees.php?<?= $pages_params ?>">1</a></li>
                    
                    <?php for ($p = 2; $p <= $pages_count; $p++) { ?>
                        <li><a href="./employees.php?page=<?= $p ?>&<?= $pages_params ?>"><?= $p ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>

<!--        <div class="col-sm-6">-->
<!--            <div class="pull-right">-->
<!--                <a href="/index.php?action=export&--><?//= $pages_params ?><!--" class="btn btn-default">Export</a>-->
<!--                <a href="/index.php?action=import&--><?//= $pages_params ?><!--" class="btn btn-default">Import</a>-->
<!--            </div>-->
<!--        </div>-->

    </div>
</div>

<?php
include "./layouts/footer.php"
?>
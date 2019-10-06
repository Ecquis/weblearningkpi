<?php

function render_template($name, $params = []) {
    $tpl_path = __DIR__ . '/../templates/' . $name . '.php';

    if (file_exists($tpl_path)) {
        ob_start();
        extract($params);
        include $tpl_path;
        return ob_get_clean();
    }
}

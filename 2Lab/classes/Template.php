<?php

class Template {
    private $_templateVars = [];
    public $name;

    public function __set($name, $value) {
        $this->_templateVars[$name] = $value;
    }

    public function __get($name) {
        if (isset($this->_templateVars[$name])) {
            return $this->_templateVars[$name];
        }

        return null;
    }

    public function render() {
        $fileName = __DIR__ . "/../templates/{$this->name}.php";

        if (!file_exists($fileName)) {
            throw new Exception("Template $this->name not found");
        }

        extract($this->_templateVars);

        ob_start();
        include $fileName;
        return ob_get_clean();
    }
}
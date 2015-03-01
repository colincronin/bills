<?php
# Autoload Required Objects
function __autoload($class_name) {
    require $class_name.'.class.php';
}
?>

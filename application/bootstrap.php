<?php
function __autoload($className) {
    if (file_exists('application/core/' . $className . '.php')) {
        include_once ('application/core/' . $className . '.php');
    } else if (file_exists('application/controllers/' . $className . '.php')) {
        include_once ('application/controllers/' . $className . '.php');
    } else if (file_exists('application/models/' . $className . '.php')) {
        include_once ('application/models/' . $className . '.php');
    } else if (file_exists('common' . $className . '.php')) {
        include_once('common/' . $className . '.php');
    }
}
//Route::start(); // запускаем маршрутизатор
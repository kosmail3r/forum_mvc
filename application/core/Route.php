<?php

class Route {
    public static function start()
    {
        // контроллер и действие по умолчанию
        $controllerName = 'section';
        $actionName = 'index';
        $id = null;

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // получаем имя контроллера
        if (!empty($routes[1])) {
            $controllerName = ucfirst($routes[1]);
        }

        // получаем имя экшена
        if (!empty($routes[2])) {
            if (is_int($routes[2])) {
                $id = intval($routes[2]);
            } else {
                $actionName = $routes[2];
            }
        }

        // get id value
        if(!empty($routes[3])) {
            $id = intval($routes[3]);
        }

        // добавляем префиксы
        $modelName = $controllerName . '_Model';
        $controllerName = $controllerName . '_Controller';
        $actionName = $actionName . '_action';

        // подцепляем файл с классом модели (файла модели может и не быть)

        $modelFile = $modelName . '.php';
        $modelPath = "application/models/" . $modelFile;

        if (file_exists($modelPath)) {
            include $modelPath;
        }

        // подцепляем файл с классом контроллера
        $controllerFile = $controllerName . '.php';
        $controllerPath = "application/controllers/" . $controllerFile;

        if (file_exists($controllerPath)) {
            include $controllerPath;
        } else {
            echo 'asdasda';
            //Route::ErrorPage404();
        }

        // создаем контроллер
        $controller = new $controllerName;
        $action = $actionName;

        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
           // if ($param != null) {
                $controller->$action($id);
            /*} else {
                $controller->$action();
            }*/
        } else {
            echo $controllerPath ."  " . $action;
         //   Route::ErrorPage404();
        }

    }

    function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}
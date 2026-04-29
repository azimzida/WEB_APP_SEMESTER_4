<?php

namespace App\Core;

class Controller
{
    protected function model($model)
    {
        $modelClass = 'App\\Models\\' . $model;
        if (class_exists($modelClass)) {
            return new $modelClass;
        }
        throw new \Exception("Model {$model} not found");
    }

    protected function view($view, $data = [])
    {
        extract($data);

        $viewFile = __DIR__ . '/../Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            echo "View not found: $viewFile";
            return;
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/main.php';
    }
}

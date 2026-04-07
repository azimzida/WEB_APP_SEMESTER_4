<?php

class Controller
{
    protected function model($model)
    {
        require_once __DIR__ . '/../Models/' . $model . '.php';
        return new $model;
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

<?php

class Model
{
    protected $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../config/config.php';
    }
}

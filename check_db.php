<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
use Illuminate\Support\Facades\DB;
echo "COURSES:\n";
echo json_encode(DB::table('course')->get());
echo "\nUSERS:\n";
echo json_encode(DB::table('users')->get());
echo "\nMATERI:\n";
echo json_encode(DB::table('materi')->get());

<?php
require_once '../app/autoload.php';

use App\Core\Application;

if (!session_id()) session_start();

$app = new Application;

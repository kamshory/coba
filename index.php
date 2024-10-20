<?php

// This script is generated automatically by AppBuilder
// Visit https://github.com/Planetbiru/MagicAppBuilder

use MagicApp\PicoModule;
use MagicObject\Request\InputGet;
use MagicObject\Request\InputPost;

require_once __DIR__ . "/inc.app/auth-supervisor.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$baseAssetsUrl = $appConfig->getSite()->getBaseUrl();
$moduleName = "Home";
$currentModule = new PicoModule($appConfig, $database, null, "/", "index", "Halaman Depan");

require_once __DIR__ . "/inc.app/header-supervisor.php";
?>



<?php
require_once __DIR__ . "/inc.app/footer-supervisor.php";

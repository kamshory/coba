<?php
$theme = "sb-admin-2";
$theme = "core-ui";
$pathHeader = dirname(__DIR__)."/lib.themes/$theme/inc.backend/header-supervisor.php";
$themePath = "lib.themes/$theme/";
if(file_exists($pathHeader))
{
    require_once $pathHeader;
}

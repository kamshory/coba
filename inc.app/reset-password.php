<?php
$theme = "sb-admin-2";
$theme = "core-ui";
$pathResetPassword = dirname(__DIR__)."/lib.themes/$theme/inc.backend/reset-password.php";
$themePath = "lib.themes/$theme/";
if(file_exists($pathResetPassword))
{
    require_once $pathResetPassword;
}

<?php

use MagicObject\Database\PicoDatabase;
use MagicObject\SecretObject;

require_once dirname(__DIR__)."/inc.lib/vendor/autoload.php";

$appConfig = new SecretObject();


$languageDir = dirname(__DIR__)."/inc.lang";
$appConfig->setBaseDirectoryLanguage($languageDir);

$appConfig->loadYamlFile(dirname(__DIR__)."/inc.cfg/application.yml", false, true, true);

$entityInfo = $appConfig->getEntityInfo();
$entityApvInfo = $appConfig->getEntityApvInfo();

$database = new PicoDatabase($appConfig->getDatabase(), null, function($sql){
    //echo $sql."<br><br>\r\n";
    error_log($sql);
});
try
{
    $database->connect();
}
catch(Exception $e)
{
    error_log($e->getMessage());
}

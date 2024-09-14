<?php

use MagicApp\AppLanguage;
use MagicApp\AppUser;
use MagicObject\Database\PicoPageData;
use MagicObject\SetterGetter;
use MagicObject\Util\PicoIniUtil;
use MagicObject\Util\PicoStringUtil;
use Sipro\Entity\App\AppModuleImpl;
use Sipro\Entity\App\AppUserImpl;
use Sipro\Entity\App\AppUserRoleImpl;

require_once __DIR__."/app.php";
require_once __DIR__."/session.php";

$appUserImpl = new AppUserImpl(null, $database);

if(isset($sessions->adminUsername) && isset($sessions->adminPassword))
{
    $appUserImpl = new AppUserImpl(null, $database);
    try
    {
        $appUserImpl->findOneByUsernameAndPasswordAndActiveAndBlocked($sessions->adminUsername, sha1($sessions->adminPassword), true, false);
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        require_once __DIR__ . "/default.php";
        require_once __DIR__ . "/login-form.php";
        exit();
    }

    $appUserRoles = new PicoPageData(array(), 0);

    $currentUser = new AppUser($appUserImpl);

    $appLanguage = new AppLanguage(
        $appConfig,
        $currentUser->getLanguageId(),
        function($var, $value)
        {
            $inputSource = dirname(__DIR__) . "/inc.lang/source/app.ini";

            if(!file_exists(dirname($inputSource)))
            {
                mkdir(dirname($inputSource), 0755, true);
            }
            $sourceData = null;
            if(file_exists($inputSource) && filesize($inputSource) > 3)
            {
                $sourceData = PicoIniUtil::parseIniFile($inputSource);
            }
            if($sourceData == null || $sourceData === false)
            {
                $sourceData = array();
            }   
            $output = array_merge($sourceData, array(PicoStringUtil::snakeize($var) => $value));
            PicoIniUtil::writeIniFile($output, $inputSource);
        }
    );

    $currentAction = new SetterGetter();
    $currentAction->setTime(date('Y-m-d H:i:s'));
    $currentAction->setIp($_SERVER['REMOTE_ADDR']);
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $currentAction->setRequestViaAjax(true);
    } 
    else
    {
        $currentAction->setRequestViaAjax(false);
    }

    $appUserRole = new AppUserRoleImpl(null, $database);
    $appModule = new AppModuleImpl(null, $database);
    $appUserRoleImpl = new AppUserRoleImpl(null, $database);
}
else
{
    require_once __DIR__ . "/default.php";
    require_once __DIR__ . "/login-form.php";
    exit();
}
<?php

use MagicObject\Request\InputPost;
use Sipro\Entity\App\AppUserImpl;

require_once __DIR__ . "/inc.app/app.php";
require_once __DIR__ . "/inc.app/session.php";
require_once __DIR__ . "/inc.app/default.php";

$inputPost = new InputPost();

$appIserImpl = null;
if($inputPost->getPassword() != null && $inputPost->getUsername() != null)
{
    try
    {
        $password1 = sha1(trim($inputPost->getPassword()));
        $password2 = sha1($password1);
        $username = trim($inputPost->getUsername());

        $appIserImpl = new AppUserImpl(null, $database);
        $appIserImpl->findOneByUsernameAndPasswordAndActiveAndBlocked($username, $password2, true, false);

        $sessions->adminPassword = $password1;
        $sessions->adminUsername = $username;
        header("Location: ./");
        exit();
        
    }
    catch(Exception $e)
    {
        // do nothing
        $appIserImpl = null;
    }
}

if($appIserImpl == null)
{
    require_once __DIR__ . "/inc.app/reset-password.php";
    exit();
}
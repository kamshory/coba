<?php
use MagicObject\Session\PicoSession;

require_once __DIR__."/app.php";
$sessions = new PicoSession($appConfig->getSession());
$sessions->setSessionCookieParams($appConfig->getMaxLifeTime(), $appConfig->isCookieSecure(), $appConfig->isCookieHttpOnly());

$sessions->startSession();
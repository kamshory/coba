<?php

use Sipro\Entity\Data\LokasiKehadiran;

require_once __DIR__ . "/inc.app/app.php";

$lokasiKehadiran = new LokasiKehadiran(null, $database);
$lokasiKehadiran->setLokasiKehadiranId('aaaa');
$lokasiKehadiran->setNama('TEST');

try
{
    echo $lokasiKehadiran."\r\n";
    $lokasiKehadiran->insert();
    echo $lokasiKehadiran."\r\n";
    $newId = $lokasiKehadiran->getLokasiKehadiranId();
}
catch(Exception $e)
{
    $currentModule->redirectToItself();
}

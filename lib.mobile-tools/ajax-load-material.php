<?php

use MagicObject\Database\PicoSortable;
use MagicObject\Database\PicoSpecification;
use Sipro\Entity\Data\Material;

require_once dirname(__DIR__) . "/inc.app/auth-supervisor.php";

$resourse_material = array();

$specs4 = PicoSpecification::getInstance()->add(array('aktif', true));
$sorts4 = PicoSortable::getInstance()->add(array('nama', 'asc'));
echo '<option value=""></option>'."\r\n";
try
{
    $material = new Material(null, $database);
    $pageData4 = $material->findAll($specs4, null, $sorts4);
    foreach($pageData4->getResult() as $row)
    {
        $nama = $row->getNama();
        if($row->hasValueSatuan())
        {
            $nama .= " [".$row->getSatuan()."]";
        }
        echo '<option value="'.$row->getMaterialId().'">'.$nama.'</option>'."\r\n";
        $resourse_material[] = array($row->getMaterialId(), $nama);
    }
}
catch(Exception $e)
{
    // do nothing
}
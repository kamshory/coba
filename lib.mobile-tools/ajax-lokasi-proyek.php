<?php

use MagicObject\Request\InputGet;
use Sipro\Entity\Data\LokasiProyekMin;

require_once dirname(__DIR__) . "/inc.app/auth-supervisor.php";

$inputGet = new InputGet();

$lokasiProyekAll = new LokasiProyekMin(null, $database);	
$json = array();
try
{
	$res = $lokasiProyekAll->findByProyekIdAndAktif($inputGet->getProyekId(), true);		
	foreach($res->getResult() as $data)
	{
		$json[] = array('v'=>$data->getLokasiProyekId(), 'l'=>$data->getNama());
	}
}
catch(Exception $e)
{
	// do nothing
}
header('Content-type: application/json');
echo json_encode($json);

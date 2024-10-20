<?php

use MagicApp\UserAction;
use MagicApp\WaitingFor;
use MagicObject\Database\PicoPredicate;
use MagicObject\Database\PicoSpecification;
use MagicObject\Exceptions\InvalidInputFormatException;
use MagicObject\Request\InputPost;
use MagicObject\Request\PicoFilterConstant;
use MagicObject\Util\PicoPasswordUtil;
use Sipro\Entity\Data\Supervisor;

require_once __DIR__ . "/inc.app/default.php";
require_once __DIR__ . "/inc.app/session.php";

$inputPost = new InputPost();

if($inputPost->getUserAction() == UserAction::CREATE)
{
	if($inputPost->getCaptcha() == $sessions->captcha)
	{
		$now = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];

		$email = $inputPost->getEmail(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true);

		$specs = PicoSpecification::getInstance()->addAnd(PicoPredicate::getInstance()->equals(PicoPredicate::functionLower('email'), strtolower($email)));

		$supervisorCheck = new Supervisor(null, $database);
		
		$exists = false;
		try
		{
			$existing = $supervisorCheck->findAll($specs);
			$exists = true;
		}
		catch(Exception $e)
		{
			// do nothing
		}

		if(!$exists)
		{
			$supervisor = new Supervisor(null, $database);
			$supervisor->setNip($inputPost->getNip(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
			$supervisor->setNamaDepan($inputPost->getNamaDepan(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
			$supervisor->setNamaBelakang($inputPost->getNamaBelakang(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
			$supervisor->setNama(trim($supervisor->getNamaDepan().' '.$supervisor->getNamaBelakang()));
			$supervisor->setKoordinator($inputPost->getKoordinator(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
			$supervisor->setJabatanId($inputPost->getJabatanId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
			$supervisor->setJenisKelamin($inputPost->getJenisKelamin(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
			$supervisor->setTempatLahir($inputPost->getTempatLahir(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
			$supervisor->setTanggalLahir($inputPost->getTanggalLahir(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
			$supervisor->setEmail($inputPost->getEmail(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
			$supervisor->setTelepon($inputPost->getTelepon(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
			$supervisor->setUkuranBaju($inputPost->getUkuranBaju(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
			$supervisor->setUkuranSepatu($inputPost->getUkuranSepatu(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
			$supervisor->setIpTerakhirAktif($ip);
			$supervisor->setBlokir(false);
			$supervisor->setAktif(true);
			$supervisor->setDraft(true);
			$supervisor->setWaitingFor(WaitingFor::CREATE);
			$supervisor->setWaktuBuat($now);
			$supervisor->setIpBuat($ip);
			$supervisor->setWaktuUbah($now);
			$supervisor->setIpUbah($ip);

			$util = new PicoPasswordUtil(PicoPasswordUtil::ALG_SHA1);
			try
			{
				$password = $inputPost->getPassword(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true);
				$passwordHash = $util->getHash($password, false, true);
				$passwordHash = $util->getHash($passwordHash, false, false);
				$supervisor->setPassword($passwordHash);

				$supervisor->insert();
			
				$newId = $supervisor->getSupervisorId();
				header("Location: ".basename($_SERVER['PHP_SELF'])."?success=true");
				exit();
			}
			catch(InvalidInputFormatException $e)
			{
				$sessions->message = $e->getMessage();
			}
			catch(Exception $e)
			{
				// do nothing
				$sessions->message = "Terjadi kesalahan";
			}
		}
		else
		{
			$sessions->message = "Email sudah terdaftar";
		}
	}
	else
	{
		$sessions->message = "Captcha salah";
	}
	require_once __DIR__ . "/inc.app/registration.php";
	exit();
}
else
{
	$appIserImpl = null;
	require_once __DIR__ . "/inc.app/registration.php";
	exit();
}

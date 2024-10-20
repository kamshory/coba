<?php

// This script is generated automatically by AppBuilder
// Visit https://github.com/Planetbiru/MagicAppBuilder

use MagicObject\MagicObject;
use MagicObject\Database\PicoPage;
use MagicObject\Database\PicoPageable;
use MagicObject\Database\PicoPredicate;
use MagicObject\Database\PicoSort;
use MagicObject\Database\PicoSortable;
use MagicObject\Database\PicoSpecification;
use MagicObject\Request\PicoFilterConstant;
use MagicObject\Request\InputGet;
use MagicObject\Request\InputPost;
use MagicApp\AppEntityLanguage;
use MagicApp\AppFormBuilder;
use MagicApp\Field;
use MagicApp\PicoModule;
use MagicApp\UserAction;
use Sipro\Entity\Data\Kehadiran;
use Sipro\Entity\Data\UserMin;
use Sipro\Entity\Data\SupervisorMin;
use Sipro\Entity\Data\PeriodeMin;
use Sipro\Entity\Data\LokasiKehadiranMin;
use MagicApp\XLSX\DocumentWriter;
use MagicApp\XLSX\XLSXDataFormat;

require_once __DIR__ . "/inc.app/auth-supervisor.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$baseAssetsUrl = $appConfig->getSite()->getBaseUrl();
$moduleName = "Kehadiran";
$currentModule = new PicoModule($appConfig, $database, null, "/", "kehadiran", "Kehadiran");

require_once __DIR__ . "/inc.app/header-supervisor.php";

if($inputPost->getUserAction() == UserAction::CREATE)
{
	$kehadiran = new Kehadiran(null, $database);
	$kehadiran->setGrupPengguna($inputPost->getGrupPengguna(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setUserId($inputPost->getUserId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$kehadiran->setSupervisorId($inputPost->getSupervisorId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$kehadiran->setTanggal($inputPost->getTanggal(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setPeriodeId($inputPost->getPeriodeId(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setWaktuMasuk($inputPost->getWaktuMasuk(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setLokasiMasukId($inputPost->getLokasiMasukId(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setFotoMasuk($inputPost->getFotoMasuk(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setAlamatMasuk($inputPost->getAlamatMasuk(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setLatitudeMasuk($inputPost->getLatitudeMasuk(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$kehadiran->setLongitudeMasuk($inputPost->getLongitudeMasuk(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$kehadiran->setIpMasuk($inputPost->getIpMasuk(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setWaktuPulang($inputPost->getWaktuPulang(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setLokasiPulangId($inputPost->getLokasiPulangId(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setFotoPulang($inputPost->getFotoPulang(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setAlamatPulang($inputPost->getAlamatPulang(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setLatitudePulang($inputPost->getLatitudePulang(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$kehadiran->setLongitudePulang($inputPost->getLongitudePulang(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$kehadiran->setIpPulang($inputPost->getIpPulang(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setAktivitas($inputPost->getAktivitas(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$kehadiran->setAdminBuat($currentAction->getUserId());
	$kehadiran->setWaktuBuat($currentAction->getTime());
	$kehadiran->setIpBuat($currentAction->getIp());
	$kehadiran->setAdminUbah($currentAction->getUserId());
	$kehadiran->setWaktuUbah($currentAction->getTime());
	$kehadiran->setIpUbah($currentAction->getIp());
	try
	{
		$kehadiran->insert();
		$newId = $kehadiran->getKehadiranId();
		$currentModule->redirectTo(UserAction::DETAIL, Field::of()->kehadiran_id, $newId);
	}
	catch(Exception $e)
	{
		$currentModule->redirectToItself();
	}
}
else if($inputPost->getUserAction() == UserAction::UPDATE)
{
	$kehadiran = new Kehadiran(null, $database);
	$kehadiran->setGrupPengguna($inputPost->getGrupPengguna(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setUserId($inputPost->getUserId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$kehadiran->setSupervisorId($inputPost->getSupervisorId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$kehadiran->setTanggal($inputPost->getTanggal(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setPeriodeId($inputPost->getPeriodeId(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setWaktuMasuk($inputPost->getWaktuMasuk(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setLokasiMasukId($inputPost->getLokasiMasukId(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setFotoMasuk($inputPost->getFotoMasuk(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setAlamatMasuk($inputPost->getAlamatMasuk(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setLatitudeMasuk($inputPost->getLatitudeMasuk(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$kehadiran->setLongitudeMasuk($inputPost->getLongitudeMasuk(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$kehadiran->setIpMasuk($inputPost->getIpMasuk(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setWaktuPulang($inputPost->getWaktuPulang(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setLokasiPulangId($inputPost->getLokasiPulangId(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setFotoPulang($inputPost->getFotoPulang(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setAlamatPulang($inputPost->getAlamatPulang(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setLatitudePulang($inputPost->getLatitudePulang(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$kehadiran->setLongitudePulang($inputPost->getLongitudePulang(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$kehadiran->setIpPulang($inputPost->getIpPulang(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setAktivitas($inputPost->getAktivitas(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$kehadiran->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$kehadiran->setAdminUbah($currentAction->getUserId());
	$kehadiran->setWaktuUbah($currentAction->getTime());
	$kehadiran->setIpUbah($currentAction->getIp());
	$kehadiran->setKehadiranId($inputPost->getKehadiranId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	try
	{
		$kehadiran->update();
		$newId = $kehadiran->getKehadiranId();
		$currentModule->redirectTo(UserAction::DETAIL, Field::of()->kehadiran_id, $newId);
	}
	catch(Exception $e)
	{
		$currentModule->redirectToItself();
	}
}
else if($inputPost->getUserAction() == UserAction::ACTIVATE)
{
	if($inputPost->countableCheckedRowId())
	{
		foreach($inputPost->getCheckedRowId() as $rowId)
		{
			$kehadiran = new Kehadiran(null, $database);
			try
			{
				$kehadiran->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->kehadiranId, $rowId))
					->addAnd(PicoPredicate::getInstance()->notEquals(Field::of()->aktif, true))
				)
				->setAdminUbah($currentAction->getUserId())
				->setWaktuUbah($currentAction->getTime())
				->setIpUbah($currentAction->getIp())
				->setAktif(true)
				->update();
			}
			catch(Exception $e)
			{
				// Do something here to handle exception
			}
		}
	}
	$currentModule->redirectToItself();
}
else if($inputPost->getUserAction() == UserAction::DEACTIVATE)
{
	if($inputPost->countableCheckedRowId())
	{
		foreach($inputPost->getCheckedRowId() as $rowId)
		{
			$kehadiran = new Kehadiran(null, $database);
			try
			{
				$kehadiran->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->kehadiranId, $rowId))
					->addAnd(PicoPredicate::getInstance()->notEquals(Field::of()->aktif, false))
				)
				->setAdminUbah($currentAction->getUserId())
				->setWaktuUbah($currentAction->getTime())
				->setIpUbah($currentAction->getIp())
				->setAktif(false)
				->update();
			}
			catch(Exception $e)
			{
				// Do something here to handle exception
			}
		}
	}
	$currentModule->redirectToItself();
}
else if($inputPost->getUserAction() == UserAction::DELETE)
{
	if($inputPost->countableCheckedRowId())
	{
		foreach($inputPost->getCheckedRowId() as $rowId)
		{
			try
			{
				$kehadiran = new Kehadiran(null, $database);
				$kehadiran->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->kehadiran_id, $rowId))
				)
				->delete();
			}
			catch(Exception $e)
			{
				// Do something here to handle exception
			}
		}
	}
	$currentModule->redirectToItself();
}
if($inputGet->getUserAction() == UserAction::CREATE)
{
$appEntityLanguage = new AppEntityLanguage(new Kehadiran(), $appConfig, $currentUser->getLanguageId());
require_once __DIR__ . "/inc.app/header-supervisor.php";
?>
<div class="page page-jambi page-insert">
	<div class="jambi-wrapper">
		<form name="createform" id="createform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getGrupPengguna();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="grup_pengguna" id="grup_pengguna"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getUser();?></td>
						<td>
							<select class="form-control" name="user_id" id="user_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new UserMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->userId, Field::of()->nama)
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSupervisor();?></td>
						<td>
							<select class="form-control" name="supervisor_id" id="supervisor_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new SupervisorMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->supervisorId, Field::of()->nama)
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTanggal();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="date" name="tanggal" id="tanggal"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getPeriode();?></td>
						<td>
							<select class="form-control" name="periode_id" id="periode_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new PeriodeMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->periodeId, Field::of()->nama)
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuMasuk();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="datetime-local" name="waktu_masuk" id="waktu_masuk"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiMasuk();?></td>
						<td>
							<select class="form-control" name="lokasi_masuk_id" id="lokasi_masuk_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new LokasiKehadiranMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->lokasiKehadiranId, Field::of()->nama)
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getFotoMasuk();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="foto_masuk" id="foto_masuk"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAlamatMasuk();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="alamat_masuk" id="alamat_masuk"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLatitudeMasuk();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="any" name="latitude_masuk" id="latitude_masuk"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLongitudeMasuk();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="any" name="longitude_masuk" id="longitude_masuk"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpMasuk();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="ip_masuk" id="ip_masuk"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuPulang();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="datetime-local" name="waktu_pulang" id="waktu_pulang"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiPulang();?></td>
						<td>
							<select class="form-control" name="lokasi_pulang_id" id="lokasi_pulang_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new LokasiKehadiranMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->lokasiKehadiranId, Field::of()->nama)
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getFotoPulang();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="foto_pulang" id="foto_pulang"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAlamatPulang();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="alamat_pulang" id="alamat_pulang"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLatitudePulang();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="any" name="latitude_pulang" id="latitude_pulang"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLongitudePulang();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="any" name="longitude_pulang" id="longitude_pulang"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpPulang();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="ip_pulang" id="ip_pulang"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktivitas();?></td>
						<td>
							<textarea class="form-control" name="aktivitas" id="aktivitas" spellcheck="false"></textarea>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="aktif" id="aktif" value="1"/> <?php echo $appEntityLanguage->getAktif();?></label>
						</td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<button type="submit" class="btn btn-success" name="user_action" value="create"><?php echo $appLanguage->getButtonSave();?></button>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonCancel();?></button>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
<?php 
require_once __DIR__ . "/inc.app/header-supervisor.php";
}
else if($inputGet->getUserAction() == UserAction::UPDATE)
{
	$kehadiran = new Kehadiran(null, $database);
	try{
		$kehadiran->findOneByKehadiranId($inputGet->getKehadiranId());
		if($kehadiran->issetKehadiranId())
		{
$appEntityLanguage = new AppEntityLanguage(new Kehadiran(), $appConfig, $currentUser->getLanguageId());
require_once __DIR__ . "/inc.app/header-supervisor.php";
?>
<div class="page page-jambi page-update">
	<div class="jambi-wrapper">
		<form name="updateform" id="updateform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getGrupPengguna();?></td>
						<td>
							<input class="form-control" type="text" name="grup_pengguna" id="grup_pengguna" value="<?php echo $kehadiran->getGrupPengguna();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getUser();?></td>
						<td>
							<select class="form-control" name="user_id" id="user_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new UserMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->userId, Field::of()->nama, $kehadiran->getUserId())
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSupervisor();?></td>
						<td>
							<select class="form-control" name="supervisor_id" id="supervisor_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new SupervisorMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->supervisorId, Field::of()->nama, $kehadiran->getSupervisorId())
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTanggal();?></td>
						<td>
							<input class="form-control" type="date" name="tanggal" id="tanggal" value="<?php echo $kehadiran->getTanggal();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getPeriode();?></td>
						<td>
							<select class="form-control" name="periode_id" id="periode_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new PeriodeMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->periodeId, Field::of()->nama, $kehadiran->getPeriodeId())
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuMasuk();?></td>
						<td>
							<input class="form-control" type="datetime-local" name="waktu_masuk" id="waktu_masuk" value="<?php echo $kehadiran->getWaktuMasuk();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiMasuk();?></td>
						<td>
							<select class="form-control" name="lokasi_masuk_id" id="lokasi_masuk_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new LokasiKehadiranMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->lokasiKehadiranId, Field::of()->nama, $kehadiran->getLokasiMasukId())
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getFotoMasuk();?></td>
						<td>
							<input class="form-control" type="text" name="foto_masuk" id="foto_masuk" value="<?php echo $kehadiran->getFotoMasuk();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAlamatMasuk();?></td>
						<td>
							<input class="form-control" type="text" name="alamat_masuk" id="alamat_masuk" value="<?php echo $kehadiran->getAlamatMasuk();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLatitudeMasuk();?></td>
						<td>
							<input class="form-control" type="number" step="any" name="latitude_masuk" id="latitude_masuk" value="<?php echo $kehadiran->getLatitudeMasuk();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLongitudeMasuk();?></td>
						<td>
							<input class="form-control" type="number" step="any" name="longitude_masuk" id="longitude_masuk" value="<?php echo $kehadiran->getLongitudeMasuk();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpMasuk();?></td>
						<td>
							<input class="form-control" type="text" name="ip_masuk" id="ip_masuk" value="<?php echo $kehadiran->getIpMasuk();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuPulang();?></td>
						<td>
							<input class="form-control" type="datetime-local" name="waktu_pulang" id="waktu_pulang" value="<?php echo $kehadiran->getWaktuPulang();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiPulang();?></td>
						<td>
							<select class="form-control" name="lokasi_pulang_id" id="lokasi_pulang_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new LokasiKehadiranMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->lokasiKehadiranId, Field::of()->nama, $kehadiran->getLokasiPulangId())
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getFotoPulang();?></td>
						<td>
							<input class="form-control" type="text" name="foto_pulang" id="foto_pulang" value="<?php echo $kehadiran->getFotoPulang();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAlamatPulang();?></td>
						<td>
							<input class="form-control" type="text" name="alamat_pulang" id="alamat_pulang" value="<?php echo $kehadiran->getAlamatPulang();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLatitudePulang();?></td>
						<td>
							<input class="form-control" type="number" step="any" name="latitude_pulang" id="latitude_pulang" value="<?php echo $kehadiran->getLatitudePulang();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLongitudePulang();?></td>
						<td>
							<input class="form-control" type="number" step="any" name="longitude_pulang" id="longitude_pulang" value="<?php echo $kehadiran->getLongitudePulang();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpPulang();?></td>
						<td>
							<input class="form-control" type="text" name="ip_pulang" id="ip_pulang" value="<?php echo $kehadiran->getIpPulang();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktivitas();?></td>
						<td>
							<textarea class="form-control" name="aktivitas" id="aktivitas" spellcheck="false"><?php echo $kehadiran->getAktivitas();?></textarea>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="aktif" id="aktif" value="1" <?php echo $kehadiran->createCheckedAktif();?>/> <?php echo $appEntityLanguage->getAktif();?></label>
						</td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<button type="submit" class="btn btn-success" name="user_action" value="update"><?php echo $appLanguage->getButtonSave();?></button>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonCancel();?></button>
							<input type="hidden" name="kehadiran_id" value="<?php echo $kehadiran->getKehadiranId();?>"/>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
<?php 
		}
		else
		{
			// Do somtething here when data is not found
			?>
			<div class="alert alert-warning"><?php echo $appLanguage->getMessageDataNotFound();?></div>
			<?php
		}
require_once __DIR__ . "/inc.app/header-supervisor.php";
	}
	catch(Exception $e)
	{
require_once __DIR__ . "/inc.app/header-supervisor.php";
		// Do somtething here when exception
		?>
		<div class="alert alert-danger"><?php echo $e->getMessage();?></div>
		<?php
require_once __DIR__ . "/inc.app/header-supervisor.php";
	}
}
else if($inputGet->getUserAction() == UserAction::DETAIL)
{
	$kehadiran = new Kehadiran(null, $database);
	try{
		$subqueryMap = array(
		"userId" => array(
			"columnName" => "user_id",
			"entityName" => "UserMin",
			"tableName" => "user",
			"primaryKey" => "user_id",
			"objectName" => "user",
			"propertyName" => "first_name"
		), 
		"supervisorId" => array(
			"columnName" => "supervisor_id",
			"entityName" => "SupervisorMin",
			"tableName" => "supervisor",
			"primaryKey" => "supervisor_id",
			"objectName" => "supervisor",
			"propertyName" => "nama"
		), 
		"periodeId" => array(
			"columnName" => "periode_id",
			"entityName" => "PeriodeMin",
			"tableName" => "periode",
			"primaryKey" => "periode_id",
			"objectName" => "periode",
			"propertyName" => "nama"
		), 
		"lokasiMasukId" => array(
			"columnName" => "lokasi_masuk_id",
			"entityName" => "LokasiKehadiranMin",
			"tableName" => "lokasi_kehadiran",
			"primaryKey" => "lokasi_kehadiran_id",
			"objectName" => "lokasiMasuk",
			"propertyName" => "nama"
		), 
		"lokasiPulangId" => array(
			"columnName" => "lokasi_pulang_id",
			"entityName" => "LokasiKehadiranMin",
			"tableName" => "lokasi_kehadiran",
			"primaryKey" => "lokasi_kehadiran_id",
			"objectName" => "lokasiPulang",
			"propertyName" => "nama"
		)
		);
		$kehadiran->findOneWithPrimaryKeyValue($inputGet->getKehadiranId(), $subqueryMap);
		if($kehadiran->issetKehadiranId())
		{
$appEntityLanguage = new AppEntityLanguage(new Kehadiran(), $appConfig, $currentUser->getLanguageId());
require_once __DIR__ . "/inc.app/header-supervisor.php";
			// define map here
			
?>
<div class="page page-jambi page-detail">
	<div class="jambi-wrapper">
		<?php
		if(UserAction::isRequireNextAction($inputGet) && UserAction::isRequireApproval($kehadiran->getWaitingFor()))
		{
				?>
				<div class="alert alert-info"><?php echo UserAction::getWaitingForMessage($appLanguage, $kehadiran->getWaitingFor());?></div>
				<?php
		}
		?>
		
		<form name="detailform" id="detailform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getGrupPengguna();?></td>
						<td><?php echo $kehadiran->getGrupPengguna();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getUser();?></td>
						<td><?php echo $kehadiran->issetUser() ? $kehadiran->getUser()->getFirstName() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSupervisor();?></td>
						<td><?php echo $kehadiran->issetSupervisor() ? $kehadiran->getSupervisor()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTanggal();?></td>
						<td><?php echo $kehadiran->getTanggal();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getPeriode();?></td>
						<td><?php echo $kehadiran->issetPeriode() ? $kehadiran->getPeriode()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuMasuk();?></td>
						<td><?php echo $kehadiran->getWaktuMasuk();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiMasuk();?></td>
						<td><?php echo $kehadiran->issetLokasiMasuk() ? $kehadiran->getLokasiMasuk()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getFotoMasuk();?></td>
						<td><?php echo $kehadiran->getFotoMasuk();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAlamatMasuk();?></td>
						<td><?php echo $kehadiran->getAlamatMasuk();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLatitudeMasuk();?></td>
						<td><?php echo $kehadiran->getLatitudeMasuk();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLongitudeMasuk();?></td>
						<td><?php echo $kehadiran->getLongitudeMasuk();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpMasuk();?></td>
						<td><?php echo $kehadiran->getIpMasuk();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuPulang();?></td>
						<td><?php echo $kehadiran->getWaktuPulang();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiPulang();?></td>
						<td><?php echo $kehadiran->issetLokasiPulang() ? $kehadiran->getLokasiPulang()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getFotoPulang();?></td>
						<td><?php echo $kehadiran->getFotoPulang();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAlamatPulang();?></td>
						<td><?php echo $kehadiran->getAlamatPulang();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLatitudePulang();?></td>
						<td><?php echo $kehadiran->getLatitudePulang();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLongitudePulang();?></td>
						<td><?php echo $kehadiran->getLongitudePulang();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpPulang();?></td>
						<td><?php echo $kehadiran->getIpPulang();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktivitas();?></td>
						<td><?php echo $kehadiran->getAktivitas();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td><?php echo $kehadiran->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<?php if($userPermission->isAllowedUpdate()){ ?>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->kehadiran_id, $kehadiran->getKehadiranId());?>';"><?php echo $appLanguage->getButtonUpdate();?></button>
							<?php } ?>
		
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonBackToList();?></button>
							<input type="hidden" name="kehadiran_id" value="<?php echo $kehadiran->getKehadiranId();?>"/>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
<?php 
require_once __DIR__ . "/inc.app/header-supervisor.php";
		}
		else
		{
			// Do somtething here when data is not found
			?>
			<div class="alert alert-warning"><?php echo $appLanguage->getMessageDataNotFound();?></div>
			<?php
		}
	}
	catch(Exception $e)
	{
require_once __DIR__ . "/inc.app/header-supervisor.php";
		// Do somtething here when exception
		?>
		<div class="alert alert-danger"><?php echo $e->getMessage();?></div>
		<?php
require_once __DIR__ . "/inc.app/header-supervisor.php";
	}
}
else 
{
$appEntityLanguage = new AppEntityLanguage(new Kehadiran(), $appConfig, $currentUser->getLanguageId());

$specMap = array(
	"userId" => PicoSpecification::filter("userId", "number"),
	"supervisorId" => PicoSpecification::filter("supervisorId", "number"),
	"periodeId" => PicoSpecification::filter("periodeId", "fulltext"),
	"lokasiMasukId" => PicoSpecification::filter("lokasiMasukId", "fulltext"),
	"lokasiPulangId" => PicoSpecification::filter("lokasiPulangId", "fulltext")
);
$sortOrderMap = array(
	"grupPengguna" => "grupPengguna",
	"userId" => "userId",
	"supervisorId" => "supervisorId",
	"tanggal" => "tanggal",
	"periodeId" => "periodeId",
	"waktuMasuk" => "waktuMasuk",
	"lokasiMasukId" => "lokasiMasukId",
	"fotoMasuk" => "fotoMasuk",
	"alamatMasuk" => "alamatMasuk",
	"latitudeMasuk" => "latitudeMasuk",
	"longitudeMasuk" => "longitudeMasuk",
	"ipMasuk" => "ipMasuk",
	"waktuPulang" => "waktuPulang",
	"lokasiPulangId" => "lokasiPulangId",
	"fotoPulang" => "fotoPulang",
	"alamatPulang" => "alamatPulang",
	"latitudePulang" => "latitudePulang",
	"longitudePulang" => "longitudePulang",
	"ipPulang" => "ipPulang",
	"aktivitas" => "aktivitas",
	"aktif" => "aktif"
);

// You can define your own specifications
// Pay attention to security issues
$specification = PicoSpecification::fromUserInput($inputGet, $specMap);

// Additional filter here
$specification->addAnd(PicoPredicate::getInstance()->equals('grupPengguna', 'supervisor'));

// You can define your own sortable
// Pay attention to security issues
$sortable = PicoSortable::fromUserInput($inputGet, $sortOrderMap, array(
	array(
		"sortBy" => "tanggal", 
		"sortType" => PicoSort::ORDER_TYPE_DESC
	),
	array(
		"sortBy" => "waktuBuat", 
		"sortType" => PicoSort::ORDER_TYPE_DESC
	)
));

$pageable = new PicoPageable(new PicoPage($inputGet->getPage(), $appConfig->getData()->getPageSize()), $sortable);
$dataLoader = new Kehadiran(null, $database);

$subqueryMap = array(
"userId" => array(
	"columnName" => "user_id",
	"entityName" => "UserMin",
	"tableName" => "user",
	"primaryKey" => "user_id",
	"objectName" => "user",
	"propertyName" => "first_name"
), 
"supervisorId" => array(
	"columnName" => "supervisor_id",
	"entityName" => "SupervisorMin",
	"tableName" => "supervisor",
	"primaryKey" => "supervisor_id",
	"objectName" => "supervisor",
	"propertyName" => "nama"
), 
"periodeId" => array(
	"columnName" => "periode_id",
	"entityName" => "PeriodeMin",
	"tableName" => "periode",
	"primaryKey" => "periode_id",
	"objectName" => "periode",
	"propertyName" => "nama"
), 
"lokasiMasukId" => array(
	"columnName" => "lokasi_masuk_id",
	"entityName" => "LokasiKehadiranMin",
	"tableName" => "lokasi_kehadiran",
	"primaryKey" => "lokasi_kehadiran_id",
	"objectName" => "lokasiMasuk",
	"propertyName" => "nama"
), 
"lokasiPulangId" => array(
	"columnName" => "lokasi_pulang_id",
	"entityName" => "LokasiKehadiranMin",
	"tableName" => "lokasi_kehadiran",
	"primaryKey" => "lokasi_kehadiran_id",
	"objectName" => "lokasiPulang",
	"propertyName" => "nama"
)
);

if($inputGet->getUserAction() == UserAction::EXPORT)
{
	$exporter = DocumentWriter::getXLSXDocumentWriter($appLanguage);
	$fileName = $currentModule->getModuleName()."-".date("Y-m-d-H-i-s").".xlsx";
	$sheetName = "Sheet 1";

	$headerFormat = new XLSXDataFormat($dataLoader, 3);
	$pageData = $dataLoader->findAll($specification, null, $sortable, true, $subqueryMap, MagicObject::FIND_OPTION_NO_COUNT_DATA | MagicObject::FIND_OPTION_NO_FETCH_DATA);
	$exporter->write($pageData, $fileName, $sheetName, array(
		$appLanguage->getNumero() => $headerFormat->asNumber(),
		$appEntityLanguage->getGrupPengguna() => $headerFormat->getGrupPengguna(),
		$appEntityLanguage->getUser() => $headerFormat->asString(),
		$appEntityLanguage->getSupervisor() => $headerFormat->asString(),
		$appEntityLanguage->getTanggal() => $headerFormat->getTanggal(),
		$appEntityLanguage->getPeriode() => $headerFormat->asString(),
		$appEntityLanguage->getWaktuMasuk() => $headerFormat->getWaktuMasuk(),
		$appEntityLanguage->getLokasiMasuk() => $headerFormat->asString(),
		$appEntityLanguage->getFotoMasuk() => $headerFormat->getFotoMasuk(),
		$appEntityLanguage->getAlamatMasuk() => $headerFormat->getAlamatMasuk(),
		$appEntityLanguage->getLatitudeMasuk() => $headerFormat->getLatitudeMasuk(),
		$appEntityLanguage->getLongitudeMasuk() => $headerFormat->getLongitudeMasuk(),
		$appEntityLanguage->getIpMasuk() => $headerFormat->getIpMasuk(),
		$appEntityLanguage->getWaktuPulang() => $headerFormat->getWaktuPulang(),
		$appEntityLanguage->getLokasiPulang() => $headerFormat->asString(),
		$appEntityLanguage->getFotoPulang() => $headerFormat->getFotoPulang(),
		$appEntityLanguage->getAlamatPulang() => $headerFormat->getAlamatPulang(),
		$appEntityLanguage->getLatitudePulang() => $headerFormat->getLatitudePulang(),
		$appEntityLanguage->getLongitudePulang() => $headerFormat->getLongitudePulang(),
		$appEntityLanguage->getIpPulang() => $headerFormat->getIpPulang(),
		$appEntityLanguage->getAktivitas() => $headerFormat->asString(),
		$appEntityLanguage->getAktif() => $headerFormat->asString()
	), 
	function($index, $row, $appLanguage){
		
		return array(
			sprintf("%d", $index + 1),
			$row->getGrupPengguna(),
			$row->issetUser() ? $row->getUser()->getFirstName() : "",
			$row->issetSupervisor() ? $row->getSupervisor()->getNama() : "",
			$row->getTanggal(),
			$row->issetPeriode() ? $row->getPeriode()->getNama() : "",
			$row->getWaktuMasuk(),
			$row->issetLokasiMasuk() ? $row->getLokasiMasuk()->getNama() : "",
			$row->getFotoMasuk(),
			$row->getAlamatMasuk(),
			$row->getLatitudeMasuk(),
			$row->getLongitudeMasuk(),
			$row->getIpMasuk(),
			$row->getWaktuPulang(),
			$row->issetLokasiPulang() ? $row->getLokasiPulang()->getNama() : "",
			$row->getFotoPulang(),
			$row->getAlamatPulang(),
			$row->getLatitudePulang(),
			$row->getLongitudePulang(),
			$row->getIpPulang(),
			$row->getAktivitas(),
			$row->optionAktif($appLanguage->getYes(), $appLanguage->getNo())
		);
	});
	exit();
}
/*ajaxSupport*/
if(!$currentAction->isRequestViaAjax()){
require_once __DIR__ . "/inc.app/header-supervisor.php";
?>
<div class="page page-jambi page-list">
	<div class="jambi-wrapper">
		<div class="filter-section">
			<form action="" method="get" class="filter-form">
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getUser();?></span>
					<span class="filter-control">
							<select class="form-control" name="user_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new UserMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->userId, Field::of()->firstName, $inputGet->getUserId())
								; ?>
							</select>
					</span>
				</span>
				
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getSupervisor();?></span>
					<span class="filter-control">
							<select class="form-control" name="supervisor_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new SupervisorMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->supervisorId, Field::of()->nama, $inputGet->getSupervisorId())
								; ?>
							</select>
					</span>
				</span>
				
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getPeriode();?></span>
					<span class="filter-control">
							<select class="form-control" name="periode_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new PeriodeMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->periodeId, Field::of()->nama, $inputGet->getPeriodeId())
								; ?>
							</select>
					</span>
				</span>
				
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getLokasiMasuk();?></span>
					<span class="filter-control">
							<select class="form-control" name="lokasi_masuk_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new LokasiKehadiranMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->lokasiKehadiranId, Field::of()->nama, $inputGet->getLokasiMasukId())
								; ?>
							</select>
					</span>
				</span>
				
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getLokasiPulang();?></span>
					<span class="filter-control">
							<select class="form-control" name="lokasi_pulang_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new LokasiKehadiranMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->lokasiKehadiranId, Field::of()->nama, $inputGet->getLokasiPulangId())
								; ?>
							</select>
					</span>
				</span>
				
				<span class="filter-group">
					<button type="submit" class="btn btn-success"><?php echo $appLanguage->getButtonSearch();?></button>
				</span>
				<?php if($userPermission->isAllowedDetail()){ ?>
		
				<span class="filter-group">
					<button type="submit" name="user_action" value="export" class="btn btn-success"><?php echo $appLanguage->getButtonExport();?></button>
				</span>
				<?php } ?>
				<?php if($userPermission->isAllowedCreate()){ ?>
		
				<span class="filter-group">
					<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl(UserAction::CREATE);?>'"><?php echo $appLanguage->getButtonAdd();?></button>
				</span>
				<?php } ?>
			</form>
		</div>
		<div class="data-section" data-ajax-support="true" data-ajax-name="main-data">
			<?php } /*ajaxSupport*/ ?>
			<?php try{
				$pageData = $dataLoader->findAll($specification, $pageable, $sortable, true, $subqueryMap, MagicObject::FIND_OPTION_NO_FETCH_DATA);
				if($pageData->getTotalResult() > 0)
				{		
				    $pageControl = $pageData->getPageControl("page", $currentModule->getSelf())
				    ->setNavigation(
				    '<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>',
				    '<i class="fa-solid fa-angles-left"></i>', '<i class="fa-solid fa-angles-right"></i>'
				    )
				    ->setMargin($appConfig->getData()->getPageMargin())
				    ;
			?>
			<div class="pagination pagination-top">
			    <div class="pagination-number">
			    <?php echo $pageControl; ?>
			    </div>
			</div>
			<form action="" method="post" class="data-form">
				<div class="data-wrapper">
					<table class="table table-row table-sort-by-column">
						<thead>
							<tr>
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-controll data-selector" data-key="kehadiran_id">
									<input type="checkbox" class="checkbox check-master" data-selector=".checkbox-kehadiran-id"/>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedUpdate()){ ?>
								<td class="data-controll data-editor">
									<span class="fa fa-edit"></span>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedDetail()){ ?>
								<td class="data-controll data-viewer">
									<span class="fa fa-folder"></span>
								</td>
								<?php } ?>
								<td class="data-controll data-number"><?php echo $appLanguage->getNumero();?></td>
								<td data-col-name="grup_pengguna" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getGrupPengguna();?></a></td>
								<td data-col-name="user_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getUser();?></a></td>
								<td data-col-name="supervisor_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getSupervisor();?></a></td>
								<td data-col-name="tanggal" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getTanggal();?></a></td>
								<td data-col-name="periode_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getPeriode();?></a></td>
								<td data-col-name="waktu_masuk" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getWaktuMasuk();?></a></td>
								<td data-col-name="lokasi_masuk_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getLokasiMasuk();?></a></td>
								<td data-col-name="foto_masuk" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getFotoMasuk();?></a></td>
								<td data-col-name="alamat_masuk" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getAlamatMasuk();?></a></td>
								<td data-col-name="latitude_masuk" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getLatitudeMasuk();?></a></td>
								<td data-col-name="longitude_masuk" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getLongitudeMasuk();?></a></td>
								<td data-col-name="ip_masuk" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getIpMasuk();?></a></td>
								<td data-col-name="waktu_pulang" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getWaktuPulang();?></a></td>
								<td data-col-name="lokasi_pulang_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getLokasiPulang();?></a></td>
								<td data-col-name="foto_pulang" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getFotoPulang();?></a></td>
								<td data-col-name="alamat_pulang" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getAlamatPulang();?></a></td>
								<td data-col-name="latitude_pulang" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getLatitudePulang();?></a></td>
								<td data-col-name="longitude_pulang" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getLongitudePulang();?></a></td>
								<td data-col-name="ip_pulang" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getIpPulang();?></a></td>
								<td data-col-name="aktivitas" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getAktivitas();?></a></td>
								<td data-col-name="aktif" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getAktif();?></a></td>
							</tr>
						</thead>
					
						<tbody data-offset="<?php echo $pageData->getDataOffset();?>">
							<?php 
							$dataIndex = 0;
							while($kehadiran = $pageData->fetch())
							{
								$dataIndex++;
							?>
		
							<tr data-number="<?php echo $pageData->getDataOffset() + $dataIndex;?>">
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-selector" data-key="kehadiran_id">
									<input type="checkbox" class="checkbox check-slave checkbox-kehadiran-id" name="checked_row_id[]" value="<?php echo $kehadiran->getKehadiranId();?>"/>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedUpdate()){ ?>
								<td>
									<a class="edit-control" href="<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->kehadiran_id, $kehadiran->getKehadiranId());?>"><span class="fa fa-edit"></span></a>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedDetail()){ ?>
								<td>
									<a class="detail-control field-master" href="<?php echo $currentModule->getRedirectUrl(UserAction::DETAIL, Field::of()->kehadiran_id, $kehadiran->getKehadiranId());?>"><span class="fa fa-folder"></span></a>
								</td>
								<?php } ?>
								<td class="data-number"><?php echo $pageData->getDataOffset() + $dataIndex;?></td>
								<td data-col-name="grup_pengguna"><?php echo $kehadiran->getGrupPengguna();?></td>
								<td data-col-name="user_id"><?php echo $kehadiran->issetUser() ? $kehadiran->getUser()->getFirstName() : "";?></td>
								<td data-col-name="supervisor_id"><?php echo $kehadiran->issetSupervisor() ? $kehadiran->getSupervisor()->getNama() : "";?></td>
								<td data-col-name="tanggal"><?php echo $kehadiran->getTanggal();?></td>
								<td data-col-name="periode_id"><?php echo $kehadiran->issetPeriode() ? $kehadiran->getPeriode()->getNama() : "";?></td>
								<td data-col-name="waktu_masuk"><?php echo $kehadiran->getWaktuMasuk();?></td>
								<td data-col-name="lokasi_masuk_id"><?php echo $kehadiran->issetLokasiMasuk() ? $kehadiran->getLokasiMasuk()->getNama() : "";?></td>
								<td data-col-name="foto_masuk"><?php echo $kehadiran->getFotoMasuk();?></td>
								<td data-col-name="alamat_masuk"><?php echo $kehadiran->getAlamatMasuk();?></td>
								<td data-col-name="latitude_masuk"><?php echo $kehadiran->getLatitudeMasuk();?></td>
								<td data-col-name="longitude_masuk"><?php echo $kehadiran->getLongitudeMasuk();?></td>
								<td data-col-name="ip_masuk"><?php echo $kehadiran->getIpMasuk();?></td>
								<td data-col-name="waktu_pulang"><?php echo $kehadiran->getWaktuPulang();?></td>
								<td data-col-name="lokasi_pulang_id"><?php echo $kehadiran->issetLokasiPulang() ? $kehadiran->getLokasiPulang()->getNama() : "";?></td>
								<td data-col-name="foto_pulang"><?php echo $kehadiran->getFotoPulang();?></td>
								<td data-col-name="alamat_pulang"><?php echo $kehadiran->getAlamatPulang();?></td>
								<td data-col-name="latitude_pulang"><?php echo $kehadiran->getLatitudePulang();?></td>
								<td data-col-name="longitude_pulang"><?php echo $kehadiran->getLongitudePulang();?></td>
								<td data-col-name="ip_pulang"><?php echo $kehadiran->getIpPulang();?></td>
								<td data-col-name="aktivitas"><?php echo $kehadiran->getAktivitas();?></td>
								<td data-col-name="aktif"><?php echo $kehadiran->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
							</tr>
							<?php 
							}
							?>
		
						</tbody>
					</table>
				</div>
				<div class="button-wrapper">
					<div class="button-area">
						<?php if($userPermission->isAllowedUpdate()){ ?>
						<button type="submit" class="btn btn-success" name="user_action" value="activate"><?php echo $appLanguage->getButtonActivate();?></button>
						<button type="submit" class="btn btn-warning" name="user_action" value="deactivate"><?php echo $appLanguage->getButtonDeactivate();?></button>
						<?php } ?>
						<?php if($userPermission->isAllowedDelete()){ ?>
						<button type="submit" class="btn btn-danger" name="user_action" value="delete" data-onclik-message="<?php echo htmlspecialchars($appLanguage->getWarningDeleteConfirmation());?>"><?php echo $appLanguage->getButtonDelete();?></button>
						<?php } ?>
					</div>
				</div>
			</form>
			<div class="pagination pagination-bottom">
			    <div class="pagination-number">
			    <?php echo $pageControl; ?>
			    </div>
			</div>
			
			<?php 
			}
			else
			{
			    ?>
			    <div class="alert alert-info"><?php echo $appLanguage->getMessageDataNotFound();?></div>
			    <?php
			}
			?>
			
			<?php
			}
			catch(Exception $e)
			{
			    ?>
			    <div class="alert alert-danger"><?php echo $appInclude->printException($e);?></div>
			    <?php
			} 
			?>
			<?php /*ajaxSupport*/ if(!$currentAction->isRequestViaAjax()){ ?>
		</div>
	</div>
</div>
<?php 
require_once __DIR__ . "/inc.app/header-supervisor.php";
}
/*ajaxSupport*/
}


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
use MagicApp\AppUserPermission;
use Sipro\Entity\Data\GaleriProyek;
use Sipro\AppIncludeImpl;
use Sipro\Entity\Data\ProyekMin;
use Sipro\Entity\Data\LokasiProyekMin;
use Sipro\Entity\Data\BukuHarianMin;
use Sipro\Entity\Data\GaleriProyekList;
use Sipro\Entity\Data\PekerjaanMin;
use Sipro\Entity\Data\SupervisorMin;

require_once __DIR__ . "/inc.app/auth.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$currentModule = new PicoModule($appConfig, $database, $appModule, "/", "galeri-proyek", "Galeri Proyek");
$userPermission = new AppUserPermission($appConfig, $database, $appUserRole, $currentModule, $currentUser);
$appInclude = new AppIncludeImpl($appConfig, $currentModule);

if(!$userPermission->allowedAccess($inputGet, $inputPost))
{
	require_once $appInclude->appForbiddenPage(__DIR__);
	exit();
}

if($inputPost->getUserAction() == UserAction::CREATE)
{
	$galeriProyek = new GaleriProyek(null, $database);
	$galeriProyek->setProyekId($inputPost->getProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$galeriProyek->setLokasiProyekId($inputPost->getLokasiProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$galeriProyek->setBukuHarianId($inputPost->getBukuHarianId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$galeriProyek->setPekerjaanId($inputPost->getPekerjaanId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$galeriProyek->setNama($inputPost->getNama(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$galeriProyek->setFile($inputPost->getFile(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$galeriProyek->setMd5($inputPost->getMd5(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$galeriProyek->setDeskripsi($inputPost->getDeskripsi(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$galeriProyek->setWidth($inputPost->getWidth(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$galeriProyek->setHeight($inputPost->getHeight(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$galeriProyek->setExif($inputPost->getExif(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$galeriProyek->setLatitude($inputPost->getLatitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$galeriProyek->setLongitude($inputPost->getLongitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$galeriProyek->setAltitude($inputPost->getAltitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$galeriProyek->setWaktuFoto($inputPost->getWaktuFoto(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$galeriProyek->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$galeriProyek->setAdminBuat($currentUser->getUserId());
	$galeriProyek->setWaktuBuat($currentAction->getTime());
	$galeriProyek->setIpBuat($currentAction->getIp());
	$galeriProyek->setAdminUbah($currentUser->getUserId());
	$galeriProyek->setWaktuUbah($currentAction->getTime());
	$galeriProyek->setIpUbah($currentAction->getIp());
	$galeriProyek->insert();
	$newId = $galeriProyek->getGaleriProyekId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->galeri_proyek_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::UPDATE)
{
	$galeriProyek = new GaleriProyek(null, $database);
	$galeriProyek->setProyekId($inputPost->getProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$galeriProyek->setLokasiProyekId($inputPost->getLokasiProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$galeriProyek->setBukuHarianId($inputPost->getBukuHarianId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$galeriProyek->setPekerjaanId($inputPost->getPekerjaanId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$galeriProyek->setNama($inputPost->getNama(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$galeriProyek->setFile($inputPost->getFile(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$galeriProyek->setMd5($inputPost->getMd5(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$galeriProyek->setDeskripsi($inputPost->getDeskripsi(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$galeriProyek->setWidth($inputPost->getWidth(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$galeriProyek->setHeight($inputPost->getHeight(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$galeriProyek->setExif($inputPost->getExif(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$galeriProyek->setLatitude($inputPost->getLatitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$galeriProyek->setLongitude($inputPost->getLongitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$galeriProyek->setAltitude($inputPost->getAltitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$galeriProyek->setWaktuFoto($inputPost->getWaktuFoto(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$galeriProyek->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$galeriProyek->setAdminUbah($currentUser->getUserId());
	$galeriProyek->setWaktuUbah($currentAction->getTime());
	$galeriProyek->setIpUbah($currentAction->getIp());
	$galeriProyek->setGaleriProyekId($inputPost->getGaleriProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$galeriProyek->update();
	$newId = $galeriProyek->getGaleriProyekId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->galeri_proyek_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::ACTIVATE)
{
	if($inputPost->countableCheckedRowId())
	{
		foreach($inputPost->getCheckedRowId() as $rowId)
		{
			$galeriProyek = new GaleriProyek(null, $database);
			try
			{
				$galeriProyek->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->galeri_proyek_id, $rowId))
					->addAnd(PicoPredicate::getInstance()->notEquals(Field::of()->aktif, true))
				)
				->setAktif(true)
				->update();
			}
			catch(Exception $e)
			{
				// Do something here when record is not found
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
			$galeriProyek = new GaleriProyek(null, $database);
			try
			{
				$galeriProyek->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->galeri_proyek_id, $rowId))
					->addAnd(PicoPredicate::getInstance()->notEquals(Field::of()->aktif, false))
				)
				->setAktif(false)
				->update();
			}
			catch(Exception $e)
			{
				// Do something here when record is not found
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
			$galeriProyek = new GaleriProyek(null, $database);
			$galeriProyek->deleteOneByGaleriProyekId($rowId);
		}
	}
	$currentModule->redirectToItself();
}
if($inputGet->getUserAction() == UserAction::CREATE)
{
$appEntityLanguage = new AppEntityLanguage(new GaleriProyek(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-insert">
	<div class="jambi-wrapper">
		<form name="createform" id="createform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getProyek();?></td>
						<td>
							<select class="form-control" name="proyek_id" id="proyek_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new ProyekMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->proyekId, Field::of()->nama)
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiProyek();?></td>
						<td>
							<select class="form-control" name="lokasi_proyek_id" id="lokasi_proyek_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new LokasiProyekMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true))
									->addAnd(new PicoPredicate(Field::of()->proyekId, $inputGet->getpProyekId())), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->lokasiProyekId, Field::of()->nama)
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getBukuHarian();?></td>
						<td>
							<select class="form-control" name="buku_harian_id" id="buku_harian_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new BukuHarianMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->tanggal, PicoSort::ORDER_TYPE_DESC)), 
								Field::of()->bukuHarianId, Field::of()->tanggal)
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getPekerjaan();?></td>
						<td>
							<select class="form-control" name="pekerjaan_id" id="pekerjaan_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new PekerjaanMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->pekerjaanId, Field::of()->kegiatan)
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="nama" id="nama"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getFile();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="file" id="file"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getMd5();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="md5" id="md5"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getDeskripsi();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="deskripsi" id="deskripsi"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWidth();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="1" name="width" id="width"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getHeight();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="1" name="height" id="height"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getExif();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="exif" id="exif"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLatitude();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="any" name="latitude" id="latitude"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLongitude();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="any" name="longitude" id="longitude"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAltitude();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="any" name="altitude" id="altitude"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuFoto();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="datetime-local" name="waktu_foto" id="waktu_foto"/>
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
require_once $appInclude->mainAppFooter(__DIR__);
}
else if($inputGet->getUserAction() == UserAction::UPDATE)
{
	$galeriProyek = new GaleriProyek(null, $database);
	try{
		$galeriProyek->findOneByGaleriProyekId($inputGet->getGaleriProyekId());
		if($galeriProyek->hasValueGaleriProyekId())
		{
$appEntityLanguage = new AppEntityLanguage(new GaleriProyek(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-update">
	<div class="jambi-wrapper">
		<form name="updateform" id="updateform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getProyek();?></td>
						<td>
							<select class="form-control" name="proyek_id" id="proyek_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new ProyekMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->proyekId, Field::of()->nama, $galeriProyek->getProyekId())
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiProyek();?></td>
						<td>
							<select class="form-control" name="lokasi_proyek_id" id="lokasi_proyek_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new LokasiProyekMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true))
									->addAnd(new PicoPredicate(Field::of()->proyekId, $inputGet->getpProyekId())), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->lokasiProyekId, Field::of()->nama, $galeriProyek->getLokasiProyekId())
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getBukuHarian();?></td>
						<td>
							<select class="form-control" name="buku_harian_id" id="buku_harian_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new BukuHarianMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->tanggal, PicoSort::ORDER_TYPE_DESC)), 
								Field::of()->bukuHarianId, Field::of()->tanggal, $galeriProyek->getBukuHarianId())
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getPekerjaan();?></td>
						<td>
							<select class="form-control" name="pekerjaan_id" id="pekerjaan_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new PekerjaanMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->pekerjaanId, Field::of()->kegiatan, $galeriProyek->getPekerjaanId())
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td>
							<input class="form-control" type="text" name="nama" id="nama" value="<?php echo $galeriProyek->getNama();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getFile();?></td>
						<td>
							<input class="form-control" type="text" name="file" id="file" value="<?php echo $galeriProyek->getFile();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getMd5();?></td>
						<td>
							<input class="form-control" type="text" name="md5" id="md5" value="<?php echo $galeriProyek->getMd5();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getDeskripsi();?></td>
						<td>
							<input class="form-control" type="text" name="deskripsi" id="deskripsi" value="<?php echo $galeriProyek->getDeskripsi();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWidth();?></td>
						<td>
							<input class="form-control" type="number" step="1" name="width" id="width" value="<?php echo $galeriProyek->getWidth();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getHeight();?></td>
						<td>
							<input class="form-control" type="number" step="1" name="height" id="height" value="<?php echo $galeriProyek->getHeight();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getExif();?></td>
						<td>
							<input class="form-control" type="text" name="exif" id="exif" value="<?php echo $galeriProyek->getExif();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLatitude();?></td>
						<td>
							<input class="form-control" type="number" step="any" name="latitude" id="latitude" value="<?php echo $galeriProyek->getLatitude();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLongitude();?></td>
						<td>
							<input class="form-control" type="number" step="any" name="longitude" id="longitude" value="<?php echo $galeriProyek->getLongitude();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAltitude();?></td>
						<td>
							<input class="form-control" type="number" step="any" name="altitude" id="altitude" value="<?php echo $galeriProyek->getAltitude();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuFoto();?></td>
						<td>
							<input class="form-control" type="datetime-local" name="waktu_foto" id="waktu_foto" value="<?php echo $galeriProyek->getWaktuFoto();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="aktif" id="aktif" value="1" <?php echo $galeriProyek->createCheckedAktif();?>/> <?php echo $appEntityLanguage->getAktif();?></label>
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
							<input type="hidden" name="galeri_proyek_id" value="<?php echo $galeriProyek->getGaleriProyekId();?>"/>
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
require_once $appInclude->mainAppFooter(__DIR__);
	}
	catch(Exception $e)
	{
require_once $appInclude->mainAppHeader(__DIR__);
		// Do somtething here when exception
		?>
		<div class="alert alert-danger"><?php echo $e->getMessage();?></div>
		<?php
require_once $appInclude->mainAppFooter(__DIR__);
	}
}
else if($inputGet->getUserAction() == UserAction::DETAIL)
{
	$galeriProyek = new GaleriProyek(null, $database);
	try{
		$subqueryMap = array(
		"proyekId" => array(
			"columnName" => "proyek_id",
			"entityName" => "ProyekMin",
			"tableName" => "proyek",
			"primaryKey" => "proyek_id",
			"objectName" => "proyek",
			"propertyName" => "nama"
		), 
		"lokasiProyekId" => array(
			"columnName" => "lokasi_proyek_id",
			"entityName" => "LokasiProyekMin",
			"tableName" => "lokasi_proyek",
			"primaryKey" => "lokasi_proyek_id",
			"objectName" => "lokasi_proyek",
			"propertyName" => "nama"
		), 
		"bukuHarianId" => array(
			"columnName" => "buku_harian_id",
			"entityName" => "BukuHarianMin",
			"tableName" => "buku_harian",
			"primaryKey" => "buku_harian_id",
			"objectName" => "buku_harian",
			"propertyName" => "tanggal"
		), 
		"pekerjaanId" => array(
			"columnName" => "pekerjaan_id",
			"entityName" => "PekerjaanMin",
			"tableName" => "pekerjaan",
			"primaryKey" => "pekerjaan_id",
			"objectName" => "pekerjaan",
			"propertyName" => "kegiatan"
		), 
		"supervisorId" => array(
			"columnName" => "supervisor_id",
			"entityName" => "SupervisorMin",
			"tableName" => "supervisor",
			"primaryKey" => "supervisor_id",
			"objectName" => "supervisor",
			"propertyName" => "nama"
		),
		"pembuat" => array(
			"columnName" => "admin_buat",
			"entityName" => "User",
			"tableName" => "user",
			"primaryKey" => "user_id",
			"objectName" => "pembuat",
			"propertyName" => "first_name"
		), 
		"pengubah" => array(
			"columnName" => "admin_ubah",
			"entityName" => "User",
			"tableName" => "user",
			"primaryKey" => "user_id",
			"objectName" => "pengubah",
			"propertyName" => "first_name"
		)
		);
		$galeriProyek->findOneWithPrimaryKeyValue($inputGet->getGaleriProyekId(), $subqueryMap);
		if($galeriProyek->hasValueGaleriProyekId())
		{
$appEntityLanguage = new AppEntityLanguage(new GaleriProyek(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
			// define map here
			
?>
<div class="page page-jambi page-detail">
	<div class="jambi-wrapper">
		<?php
		if(UserAction::isRequireNextAction($inputGet) && UserAction::isRequireApproval($galeriProyek->getWaitingFor()))
		{
				?>
				<div class="alert alert-info"><?php echo UserAction::getWaitingForMessage($appLanguage, $galeriProyek->getWaitingFor());?></div>
				<?php
		}
		?>
		
		<form name="detailform" id="detailform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getProyek();?></td>
						<td><?php echo $galeriProyek->hasValueProyek() ? $galeriProyek->getProyek()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiProyek();?></td>
						<td><?php echo $galeriProyek->hasValueLokasiProyek() ? $galeriProyek->getLokasiProyek()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getBukuHarian();?></td>
						<td><?php echo $galeriProyek->hasValueBukuHarian() ? $galeriProyek->getBukuHarian()->getTanggal() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getPekerjaan();?></td>
						<td><?php echo $galeriProyek->hasValuePekerjaan() ? $galeriProyek->getPekerjaan()->getKegiatan() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSupervisor();?></td>
						<td><?php echo $galeriProyek->hasValueSupervisor() ? $galeriProyek->getSupervisor()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td><?php echo $galeriProyek->getNama();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getFile();?></td>
						<td><?php echo $galeriProyek->getFile();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getMd5();?></td>
						<td><?php echo $galeriProyek->getMd5();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getDeskripsi();?></td>
						<td><?php echo $galeriProyek->getDeskripsi();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWidth();?></td>
						<td><?php echo $galeriProyek->getWidth();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getHeight();?></td>
						<td><?php echo $galeriProyek->getHeight();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getExif();?></td>
						<td><?php echo $galeriProyek->getExif();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLatitude();?></td>
						<td><?php echo $galeriProyek->getLatitude();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLongitude();?></td>
						<td><?php echo $galeriProyek->getLongitude();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAltitude();?></td>
						<td><?php echo $galeriProyek->getAltitude();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuBuat();?></td>
						<td><?php echo $galeriProyek->getWaktuBuat();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuUbah();?></td>
						<td><?php echo $galeriProyek->getWaktuUbah();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuFoto();?></td>
						<td><?php echo $galeriProyek->getWaktuFoto();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpBuat();?></td>
						<td><?php echo $galeriProyek->getIpBuat();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpUbah();?></td>
						<td><?php echo $galeriProyek->getIpUbah();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getPembuat();?></td>
						<td><?php echo $supervisor->hasValuePembuat() ? $supervisor->getPembuat()->getFirstName() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getPengubah();?></td>
						<td><?php echo $supervisor->hasValuePengubah() ? $supervisor->getPengubah()->getFirstName() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td><?php echo $galeriProyek->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<?php if($inputGet->getNextAction() == UserAction::APPROVE && UserAction::isRequireApproval($galeriProyek->getWaitingFor()) && $userPermission->isAllowedApprove()){ ?>
							<button type="submit" class="btn btn-success" name="user_action" value="<?php echo UserAction::APPROVE;?>"><?php echo $appLanguage->getButtonApprove();?></button>
							<?php } else if($inputGet->getNextAction() == UserAction::REJECT && UserAction::isRequireApproval($galeriProyek->getWaitingFor()) && $userPermission->isAllowedApprove()){ ?>
							<button type="submit" class="btn btn-warning" name="user_action" value="<?php echo UserAction::REJECT;?>"><?php echo $appLanguage->getButtonReject();?></button>
							<?php } else if($userPermission->isAllowedUpdate()){ ?>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->galeri_proyek_id, $galeriProyek->getGaleriProyekId());?>';"><?php echo $appLanguage->getButtonUpdate();?></button>
							<?php } ?>
		
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonBackToList();?></button>
							<input type="hidden" name="galeri_proyek_id" value="<?php echo $galeriProyek->getGaleriProyekId();?>"/>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
<?php 
require_once $appInclude->mainAppFooter(__DIR__);
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
require_once $appInclude->mainAppHeader(__DIR__);
		// Do somtething here when exception
		?>
		<div class="alert alert-danger"><?php echo $e->getMessage();?></div>
		<?php
require_once $appInclude->mainAppFooter(__DIR__);
	}
}
else 
{
$appEntityLanguage = new AppEntityLanguage(new GaleriProyek(), $appConfig, $currentUser->getLanguageId());
/*ajaxSupport*/

$specMap = array(
	"proyekId" => PicoSpecification::filter("proyekId", "number"),
	"lokasiProyekId" => PicoSpecification::filter("lokasiProyekId", "number"),
	"supervisorId" => PicoSpecification::filter("supervisorId", "number")
);
$sortOrderMap = array(
	"proyekId" => "proyekId",
	"pekerjaanId" => "pekerjaanId",
	"nama" => "nama",
	"waktuFoto" => "waktuFoto",
	"aktif" => "aktif"
);

// You can define your own specifications
// Pay attention to security issues
$specification = PicoSpecification::fromUserInput($inputGet, $specMap);


// You can define your own sortable
// Pay attention to security issues
$sortable = PicoSortable::fromUserInput($inputGet, $sortOrderMap, array(
	array(
		"sortBy" => "waktuBuat", 
		"sortType" => PicoSort::ORDER_TYPE_ASC
	)
));

$pageable = new PicoPageable(new PicoPage($inputGet->getPage(), $appConfig->getData()->getPageSize()), $sortable);
$dataLoader = new GaleriProyekList(null, $database);

$subqueryMap = array(
"proyekId" => array(
	"columnName" => "proyek_id",
	"entityName" => "ProyekMin",
	"tableName" => "proyek",
	"primaryKey" => "proyek_id",
	"objectName" => "proyek",
	"propertyName" => "nama"
), 
"pekerjaanId" => array(
	"columnName" => "pekerjaan_id",
	"entityName" => "PekerjaanMin",
	"tableName" => "pekerjaan",
	"primaryKey" => "pekerjaan_id",
	"objectName" => "pekerjaan",
	"propertyName" => "kegiatan"
)
);
if(!$currentAction->isRequestViaAjax()){
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-list">
	<div class="jambi-wrapper">
		<div class="filter-section">
			<form action="" method="get" class="filter-form">
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getProyek();?></span>
					<span class="filter-control">
							<select name="proyek_id" class="form-control">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new ProyekMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true))
									, 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->proyekId, Field::of()->nama, $inputGet->getProyekId())
								; ?>
							</select>
					</span>
				</span>
				
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getLokasiProyek();?></span>
					<span class="filter-control">
							<select name="lokasi_proyek_id" class="form-control">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new LokasiProyekMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->proyekId, $inputGet->getProyekId())), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->lokasiProyekId, Field::of()->nama, $inputGet->getLokasiProyekId())
								; ?>
							</select>
					</span>
				</span>
				
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getSupervisor();?></span>
					<span class="filter-control">
							<select name="supervisor_id" class="form-control">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new SupervisorMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->supervisorId, Field::of()->nama, $inputGet->getSupervisorId())
								->setTextNodeFormat('"%s (%s)", nama, jabatan.nama')
								; ?>
							</select>
					</span>
				</span>
				
				<span class="filter-group">
					<button type="submit" class="btn btn-success"><?php echo $appLanguage->getButtonSearch();?></button>
				</span>
				<?php if($userPermission->isAllowedCreate()){ ?>
		
				<span class="filter-group">
					<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl(UserAction::CREATE);?>'"><?php echo $appLanguage->getButtonAdd();?></button>
				</span>
				<?php } ?>
			</form>
		</div>
		<div class="data-section" data-ajax-support="true" data-ajax-name="main-data">
		<?php } /*ajaxSupport*/ ?>
			<?php	
			
			try{
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
								<td class="data-controll data-selector" data-key="galeri_proyek_id">
									<input type="checkbox" class="checkbox check-master" data-selector=".checkbox-galeri-proyek-id"/>
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
								<td data-col-name="proyek_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getProyek();?></a></td>
								<td data-col-name="pekerjaan_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getPekerjaan();?></a></td>
								<td data-col-name="nama" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getNama();?></a></td>
								<td data-col-name="waktu_foto" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getWaktuBuat();?></a></td>
								<td data-col-name="aktif" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getAktif();?></a></td>
							</tr>
						</thead>
					
						<tbody data-offset="<?php echo $pageData->getDataOffset();?>">
							<?php 
							$dataIndex = 0;
							while($galeriProyek = $pageData->fetch())
							{
								$dataIndex++;
							?>
		
							<tr data-number="<?php echo $pageData->getDataOffset() + $dataIndex;?>">
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-selector" data-key="galeri_proyek_id">
									<input type="checkbox" class="checkbox check-slave checkbox-galeri-proyek-id" name="checked_row_id[]" value="<?php echo $galeriProyek->getGaleriProyekId();?>"/>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedUpdate()){ ?>
								<td>
									<a class="edit-control" href="<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->galeri_proyek_id, $galeriProyek->getGaleriProyekId());?>"><span class="fa fa-edit"></span></a>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedDetail()){ ?>
								<td>
									<a class="detail-control field-master" href="<?php echo $currentModule->getRedirectUrl(UserAction::DETAIL, Field::of()->galeri_proyek_id, $galeriProyek->getGaleriProyekId());?>"><span class="fa fa-folder"></span></a>
								</td>
								<?php } ?>
								<td class="data-number"><?php echo $pageData->getDataOffset() + $dataIndex;?></td>
								<td data-col-name="proyek_id"><?php echo $galeriProyek->hasValueProyek() ? $galeriProyek->getProyek()->getNama() : "";?></td>
								<td data-col-name="pekerjaan_id"><?php echo $galeriProyek->hasValuePekerjaan() ? $galeriProyek->getPekerjaan()->getKegiatan() : "";?></td>
								<td data-col-name="nama"><?php echo $galeriProyek->getNama();?></td>
								<td data-col-name="waktu_foto"><?php echo $galeriProyek->getWaktuBuat();?></td>
								<td data-col-name="aktif"><?php echo $galeriProyek->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
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
require_once $appInclude->mainAppFooter(__DIR__);
}
/*ajaxSupport*/
}

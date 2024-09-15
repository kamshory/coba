<?php

// This script is generated automatically by AppBuilder
// Visit https://github.com/Planetbiru/MagicAppBuilder

use MagicObject\MagicObject;
use MagicObject\SetterGetter;
use MagicObject\Database\PicoPage;
use MagicObject\Database\PicoPageable;
use MagicObject\Database\PicoPredicate;
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
use Sipro\Entity\Data\JenisPekerjaan;
use Sipro\AppIncludeImpl;

require_once dirname(__DIR__) . "/inc.app/auth.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$currentModule = new PicoModule($appConfig, $database, $appModule, "/admin", "jenis-pekerjaan", "Jenis Pekerjaan");
$userPermission = new AppUserPermission($appConfig, $database, $appUserRole, $currentModule, $currentUser);
$appInclude = new AppIncludeImpl($appConfig, $currentModule);

if(!$userPermission->allowedAccess($inputGet, $inputPost))
{
	require_once $appInclude->appForbiddenPage(__DIR__);
	exit();
}

if($inputPost->getUserAction() == UserAction::CREATE)
{
	$jenisPekerjaan = new JenisPekerjaan(null, $database);
	$jenisPekerjaan->setJenisPekerjaanId($inputPost->getJenisPekerjaanId(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$jenisPekerjaan->setNama($inputPost->getNama(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$jenisPekerjaan->setTipePondasiId($inputPost->getTipePondasiId(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$jenisPekerjaan->setKelasTowerId($inputPost->getKelasTowerId(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$jenisPekerjaan->setLokasiProyekId($inputPost->getLokasiProyekId(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$jenisPekerjaan->setKegiatan($inputPost->getKegiatan(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$jenisPekerjaan->setSortOrder($inputPost->getSortOrder(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$jenisPekerjaan->setDefaultData($inputPost->getDefaultData(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$jenisPekerjaan->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$jenisPekerjaan->setAdminBuat($currentAction->getUserId());
	$jenisPekerjaan->setWaktuBuat($currentAction->getTime());
	$jenisPekerjaan->setIpBuat($currentAction->getIp());
	$jenisPekerjaan->setAdminUbah($currentAction->getUserId());
	$jenisPekerjaan->setWaktuUbah($currentAction->getTime());
	$jenisPekerjaan->setIpUbah($currentAction->getIp());
	$jenisPekerjaan->insert();
	$newId = $jenisPekerjaan->getJenisPekerjaanId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->jenis_pekerjaan_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::UPDATE)
{
	$jenisPekerjaan = new JenisPekerjaan(null, $database);
	$jenisPekerjaan->setJenisPekerjaanId($inputPost->getJenisPekerjaanId(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$jenisPekerjaan->setNama($inputPost->getNama(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$jenisPekerjaan->setTipePondasiId($inputPost->getTipePondasiId(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$jenisPekerjaan->setKelasTowerId($inputPost->getKelasTowerId(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$jenisPekerjaan->setLokasiProyekId($inputPost->getLokasiProyekId(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$jenisPekerjaan->setKegiatan($inputPost->getKegiatan(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$jenisPekerjaan->setSortOrder($inputPost->getSortOrder(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$jenisPekerjaan->setDefaultData($inputPost->getDefaultData(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$jenisPekerjaan->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$jenisPekerjaan->setAdminUbah($currentAction->getUserId());
	$jenisPekerjaan->setWaktuUbah($currentAction->getTime());
	$jenisPekerjaan->setIpUbah($currentAction->getIp());
	$jenisPekerjaan->update();

	// update primary key value
	$specification = PicoSpecification::getInstance()->addAnd(new PicoPredicate(Field::of()->jenisPekerjaanId, $inputPost->getJenisPekerjaanId()));
	$jenisPekerjaan = new JenisPekerjaan(null, $database);
	$jenisPekerjaan->where($specification)->setJenisPekerjaanId($inputPost->getAppBuilderNewPkJenisPekerjaanId())->update();
	$newId = $inputPost->getAppBuilderNewPkJenisPekerjaanId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->jenis_pekerjaan_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::ACTIVATE)
{
	if($inputPost->countableCheckedRowId())
	{
		foreach($inputPost->getCheckedRowId() as $rowId)
		{
			$jenisPekerjaan = new JenisPekerjaan(null, $database);
			try
			{
				$jenisPekerjaan->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->jenisPekerjaanId, $rowId))
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
			$jenisPekerjaan = new JenisPekerjaan(null, $database);
			try
			{
				$jenisPekerjaan->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->jenisPekerjaanId, $rowId))
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
				$jenisPekerjaan = new JenisPekerjaan(null, $database);
				$jenisPekerjaan->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->jenis_pekerjaan_id, $rowId))
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
else if($inputPost->getUserAction() == UserAction::SORT_ORDER)
{
	$jenisPekerjaan = new JenisPekerjaan(null, $database);
	if($inputPost->getNewOrder() != null && $inputPost->countableNewOrder())
	{
		foreach($inputPost->getNewOrder() as $dataItem)
		{
			if(is_string($dataItem))
			{
				$dataItem = new SetterGetter(json_decode($dataItem));
			}
			$primaryKeyValue = $dataItem->getPrimaryKey();
			$sortOrder = $dataItem->getSortOrder();
			$jenisPekerjaan->where(PicoSpecification::getInstance()
				->addAnd(new PicoPredicate(Field::of()->jenisPekerjaanId, $primaryKeyValue))
			)
			->setSortOrder($sortOrder)
			->update();
		}
	}
	$currentModule->redirectToItself();
}
if($inputGet->getUserAction() == UserAction::CREATE)
{
$appEntityLanguage = new AppEntityLanguage(new JenisPekerjaan(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-insert">
	<div class="jambi-wrapper">
		<form name="createform" id="createform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getJenisPekerjaanId();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="jenis_pekerjaan_id" id="jenis_pekerjaan_id"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="nama" id="nama"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTipePondasiId();?></td>
						<td>
							<select class="form-control" name="tipe_pondasi_id" id="tipe_pondasi_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="1">Tampilkan</option>
								<option value="0">Tidak</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getKelasTowerId();?></td>
						<td>
							<select class="form-control" name="kelas_tower_id" id="kelas_tower_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="1">Tampilkan</option>
								<option value="0">Tidak</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiProyekId();?></td>
						<td>
							<select class="form-control" name="lokasi_proyek_id" id="lokasi_proyek_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="1">Tampilkan</option>
								<option value="0">Tidak</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getKegiatan();?></td>
						<td>
							<select class="form-control" name="kegiatan" id="kegiatan">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="1">Tampilkan</option>
								<option value="0">Tidak</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSortOrder();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="1" name="sort_order" id="sort_order"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getDefaultData();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="default_data" id="default_data" value="1"/> <?php echo $appEntityLanguage->getDefaultData();?></label>
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
	$jenisPekerjaan = new JenisPekerjaan(null, $database);
	try{
		$jenisPekerjaan->findOneByJenisPekerjaanId($inputGet->getJenisPekerjaanId());
		if($jenisPekerjaan->issetJenisPekerjaanId())
		{
$appEntityLanguage = new AppEntityLanguage(new JenisPekerjaan(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-update">
	<div class="jambi-wrapper">
		<form name="updateform" id="updateform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getJenisPekerjaanId();?></td>
						<td>
							<input class="form-control" type="text" name="app_builder_new_pk_jenis_pekerjaan_id" id="jenis_pekerjaan_id" value="<?php echo $jenisPekerjaan->getJenisPekerjaanId();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td>
							<input class="form-control" type="text" name="nama" id="nama" value="<?php echo $jenisPekerjaan->getNama();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTipePondasiId();?></td>
						<td>
							<select class="form-control" name="tipe_pondasi_id" id="tipe_pondasi_id" data-value="<?php echo $jenisPekerjaan->getTipePondasiId();?>">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="1" <?php echo AppFormBuilder::selected($jenisPekerjaan->getTipePondasiId(), '1');?>>Tampilkan</option>
								<option value="0" <?php echo AppFormBuilder::selected($jenisPekerjaan->getTipePondasiId(), '0');?>>Tidak</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getKelasTowerId();?></td>
						<td>
							<select class="form-control" name="kelas_tower_id" id="kelas_tower_id" data-value="<?php echo $jenisPekerjaan->getKelasTowerId();?>">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="1" <?php echo AppFormBuilder::selected($jenisPekerjaan->getKelasTowerId(), '1');?>>Tampilkan</option>
								<option value="0" <?php echo AppFormBuilder::selected($jenisPekerjaan->getKelasTowerId(), '0');?>>Tidak</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiProyekId();?></td>
						<td>
							<select class="form-control" name="lokasi_proyek_id" id="lokasi_proyek_id" data-value="<?php echo $jenisPekerjaan->getLokasiProyekId();?>">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="1" <?php echo AppFormBuilder::selected($jenisPekerjaan->getLokasiProyekId(), '1');?>>Tampilkan</option>
								<option value="0" <?php echo AppFormBuilder::selected($jenisPekerjaan->getLokasiProyekId(), '0');?>>Tidak</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getKegiatan();?></td>
						<td>
							<select class="form-control" name="kegiatan" id="kegiatan" data-value="<?php echo $jenisPekerjaan->getKegiatan();?>">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="1" <?php echo AppFormBuilder::selected($jenisPekerjaan->getKegiatan(), '1');?>>Tampilkan</option>
								<option value="0" <?php echo AppFormBuilder::selected($jenisPekerjaan->getKegiatan(), '0');?>>Tidak</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSortOrder();?></td>
						<td>
							<input class="form-control" type="number" step="1" name="sort_order" id="sort_order" value="<?php echo $jenisPekerjaan->getSortOrder();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getDefaultData();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="default_data" id="default_data" value="1" <?php echo $jenisPekerjaan->createCheckedDefaultData();?>/> <?php echo $appEntityLanguage->getDefaultData();?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="aktif" id="aktif" value="1" <?php echo $jenisPekerjaan->createCheckedAktif();?>/> <?php echo $appEntityLanguage->getAktif();?></label>
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
							<input type="hidden" name="jenis_pekerjaan_id" value="<?php echo $jenisPekerjaan->getJenisPekerjaanId();?>"/>
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
	$jenisPekerjaan = new JenisPekerjaan(null, $database);
	try{
		$subqueryMap = null;
		$jenisPekerjaan->findOneWithPrimaryKeyValue($inputGet->getJenisPekerjaanId(), $subqueryMap);
		if($jenisPekerjaan->issetJenisPekerjaanId())
		{
$appEntityLanguage = new AppEntityLanguage(new JenisPekerjaan(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
			// define map here
			$mapForTipePondasiId = array(
				"1" => array("value" => "1", "label" => "Tampilkan", "default" => "false"),
				"0" => array("value" => "0", "label" => "Tidak", "default" => "false")
			);
			$mapForKelasTowerId = array(
				"1" => array("value" => "1", "label" => "Tampilkan", "default" => "false"),
				"0" => array("value" => "0", "label" => "Tidak", "default" => "false")
			);
			$mapForLokasiProyekId = array(
				"1" => array("value" => "1", "label" => "Tampilkan", "default" => "false"),
				"0" => array("value" => "0", "label" => "Tidak", "default" => "false")
			);
			$mapForKegiatan = array(
				"1" => array("value" => "1", "label" => "Tampilkan", "default" => "false"),
				"0" => array("value" => "0", "label" => "Tidak", "default" => "false")
			);
?>
<div class="page page-jambi page-detail">
	<div class="jambi-wrapper">
		<?php
		if(UserAction::isRequireNextAction($inputGet) && UserAction::isRequireApproval($jenisPekerjaan->getWaitingFor()))
		{
				?>
				<div class="alert alert-info"><?php echo UserAction::getWaitingForMessage($appLanguage, $jenisPekerjaan->getWaitingFor());?></div>
				<?php
		}
		?>
		
		<form name="detailform" id="detailform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getJenisPekerjaanId();?></td>
						<td><?php echo $jenisPekerjaan->getJenisPekerjaanId();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td><?php echo $jenisPekerjaan->getNama();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTipePondasiId();?></td>
						<td><?php echo isset($mapForTipePondasiId) && isset($mapForTipePondasiId[$jenisPekerjaan->getTipePondasiId()]) && isset($mapForTipePondasiId[$jenisPekerjaan->getTipePondasiId()]["label"]) ? $mapForTipePondasiId[$jenisPekerjaan->getTipePondasiId()]["label"] : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getKelasTowerId();?></td>
						<td><?php echo isset($mapForKelasTowerId) && isset($mapForKelasTowerId[$jenisPekerjaan->getKelasTowerId()]) && isset($mapForKelasTowerId[$jenisPekerjaan->getKelasTowerId()]["label"]) ? $mapForKelasTowerId[$jenisPekerjaan->getKelasTowerId()]["label"] : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiProyekId();?></td>
						<td><?php echo isset($mapForLokasiProyekId) && isset($mapForLokasiProyekId[$jenisPekerjaan->getLokasiProyekId()]) && isset($mapForLokasiProyekId[$jenisPekerjaan->getLokasiProyekId()]["label"]) ? $mapForLokasiProyekId[$jenisPekerjaan->getLokasiProyekId()]["label"] : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getKegiatan();?></td>
						<td><?php echo isset($mapForKegiatan) && isset($mapForKegiatan[$jenisPekerjaan->getKegiatan()]) && isset($mapForKegiatan[$jenisPekerjaan->getKegiatan()]["label"]) ? $mapForKegiatan[$jenisPekerjaan->getKegiatan()]["label"] : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSortOrder();?></td>
						<td><?php echo $jenisPekerjaan->getSortOrder();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getDefaultData();?></td>
						<td><?php echo $jenisPekerjaan->optionDefaultData($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td><?php echo $jenisPekerjaan->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<?php if($userPermission->isAllowedUpdate()){ ?>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->jenis_pekerjaan_id, $jenisPekerjaan->getJenisPekerjaanId());?>';"><?php echo $appLanguage->getButtonUpdate();?></button>
							<?php } ?>
		
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonBackToList();?></button>
							<input type="hidden" name="jenis_pekerjaan_id" value="<?php echo $jenisPekerjaan->getJenisPekerjaanId();?>"/>
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
$appEntityLanguage = new AppEntityLanguage(new JenisPekerjaan(), $appConfig, $currentUser->getLanguageId());
$mapForTipePondasiId = array(
	"1" => array("value" => "1", "label" => "Tampilkan", "default" => "false"),
	"0" => array("value" => "0", "label" => "Tidak", "default" => "false")
);
$mapForKelasTowerId = array(
	"1" => array("value" => "1", "label" => "Tampilkan", "default" => "false"),
	"0" => array("value" => "0", "label" => "Tidak", "default" => "false")
);
$mapForLokasiProyekId = array(
	"1" => array("value" => "1", "label" => "Tampilkan", "default" => "false"),
	"0" => array("value" => "0", "label" => "Tidak", "default" => "false")
);
$mapForKegiatan = array(
	"1" => array("value" => "1", "label" => "Tampilkan", "default" => "false"),
	"0" => array("value" => "0", "label" => "Tidak", "default" => "false")
);
$specMap = array(
	"jenisPekerjaanId" => PicoSpecification::filter("jenisPekerjaanId", "fulltext"),
	"nama" => PicoSpecification::filter("nama", "fulltext"),
	"aktif" => PicoSpecification::filter("aktif", "boolean")
);
$sortOrderMap = array(
	"jenisPekerjaanId" => "jenisPekerjaanId",
	"nama" => "nama",
	"tipePondasiId" => "tipePondasiId",
	"kelasTowerId" => "kelasTowerId",
	"lokasiProyekId" => "lokasiProyekId",
	"kegiatan" => "kegiatan",
	"sortOrder" => "sortOrder",
	"defaultData" => "defaultData",
	"aktif" => "aktif"
);

// You can define your own specifications
// Pay attention to security issues
$specification = PicoSpecification::fromUserInput($inputGet, $specMap);


// You can define your own sortable
// Pay attention to security issues
$sortable = PicoSortable::fromUserInput($inputGet, $sortOrderMap, null);

$pageable = new PicoPageable(new PicoPage($inputGet->getPage(), $appConfig->getData()->getPageSize()), $sortable);
$dataLoader = new JenisPekerjaan(null, $database);

$subqueryMap = null;

/*ajaxSupport*/
if(!$currentAction->isRequestViaAjax()){
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-list">
	<div class="jambi-wrapper">
		<div class="filter-section">
			<form action="" method="get" class="filter-form">
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getJenisPekerjaanId();?></span>
					<span class="filter-control">
						<input type="text" name="jenis_pekerjaan_id" class="form-control" value="<?php echo $inputGet->getJenisPekerjaanId();?>" autocomplete="off"/>
					</span>
				</span>
				
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getNama();?></span>
					<span class="filter-control">
						<input type="text" name="nama" class="form-control" value="<?php echo $inputGet->getNama();?>" autocomplete="off"/>
					</span>
				</span>
				
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getAktif();?></span>
					<span class="filter-control">
							<select name="aktif" class="form-control" data-value="<?php echo $inputGet->getAktif();?>">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="yes" <?php echo AppFormBuilder::selected($inputGet->getAktif(), 'yes');?>><?php echo $appLanguage->getOptionLabelYes();?></option>
								<option value="no" <?php echo AppFormBuilder::selected($inputGet->getAktif(), 'no');?>><?php echo $appLanguage->getOptionLabelNo();?></option>
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
								<?php if($userPermission->isAllowedSortOrder()){ ?>
								<td class="data-sort data-sort-header"></td>
								<?php } ?>
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-controll data-selector" data-key="jenis_pekerjaan_id">
									<input type="checkbox" class="checkbox check-master" data-selector=".checkbox-jenis-pekerjaan-id"/>
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
								<td data-col-name="jenis_pekerjaan_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getJenisPekerjaanId();?></a></td>
								<td data-col-name="nama" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getNama();?></a></td>
								<td data-col-name="tipe_pondasi_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getTipePondasiId();?></a></td>
								<td data-col-name="kelas_tower_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getKelasTowerId();?></a></td>
								<td data-col-name="lokasi_proyek_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getLokasiProyekId();?></a></td>
								<td data-col-name="kegiatan" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getKegiatan();?></a></td>
								<td data-col-name="sort_order" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getSortOrder();?></a></td>
								<td data-col-name="default_data" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getDefaultData();?></a></td>
								<td data-col-name="aktif" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getAktif();?></a></td>
							</tr>
						</thead>
					
						<tbody class="data-table-manual-sort" data-offset="<?php echo $pageData->getDataOffset();?>">
							<?php 
							$dataIndex = 0;
							while($jenisPekerjaan = $pageData->fetch())
							{
								$dataIndex++;
							?>
		
							<tr data-primary-key="<?php echo $jenisPekerjaan->getJenisPekerjaanId();?>" data-sort-order="<?php echo $jenisPekerjaan->getSortOrder();?>" data-number="<?php echo $pageData->getDataOffset() + $dataIndex;?>">
								<?php if($userPermission->isAllowedSortOrder()){ ?>
								<td class="data-sort data-sort-body data-sort-handler"></td>
								<?php } ?>
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-selector" data-key="jenis_pekerjaan_id">
									<input type="checkbox" class="checkbox check-slave checkbox-jenis-pekerjaan-id" name="checked_row_id[]" value="<?php echo $jenisPekerjaan->getJenisPekerjaanId();?>"/>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedUpdate()){ ?>
								<td>
									<a class="edit-control" href="<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->jenis_pekerjaan_id, $jenisPekerjaan->getJenisPekerjaanId());?>"><span class="fa fa-edit"></span></a>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedDetail()){ ?>
								<td>
									<a class="detail-control field-master" href="<?php echo $currentModule->getRedirectUrl(UserAction::DETAIL, Field::of()->jenis_pekerjaan_id, $jenisPekerjaan->getJenisPekerjaanId());?>"><span class="fa fa-folder"></span></a>
								</td>
								<?php } ?>
								<td class="data-number"><?php echo $pageData->getDataOffset() + $dataIndex;?></td>
								<td data-col-name="jenis_pekerjaan_id"><?php echo $jenisPekerjaan->getJenisPekerjaanId();?></td>
								<td data-col-name="nama"><?php echo $jenisPekerjaan->getNama();?></td>
								<td data-col-name="tipe_pondasi_id"><?php echo isset($mapForTipePondasiId) && isset($mapForTipePondasiId[$jenisPekerjaan->getTipePondasiId()]) && isset($mapForTipePondasiId[$jenisPekerjaan->getTipePondasiId()]["label"]) ? $mapForTipePondasiId[$jenisPekerjaan->getTipePondasiId()]["label"] : "";?></td>
								<td data-col-name="kelas_tower_id"><?php echo isset($mapForKelasTowerId) && isset($mapForKelasTowerId[$jenisPekerjaan->getKelasTowerId()]) && isset($mapForKelasTowerId[$jenisPekerjaan->getKelasTowerId()]["label"]) ? $mapForKelasTowerId[$jenisPekerjaan->getKelasTowerId()]["label"] : "";?></td>
								<td data-col-name="lokasi_proyek_id"><?php echo isset($mapForLokasiProyekId) && isset($mapForLokasiProyekId[$jenisPekerjaan->getLokasiProyekId()]) && isset($mapForLokasiProyekId[$jenisPekerjaan->getLokasiProyekId()]["label"]) ? $mapForLokasiProyekId[$jenisPekerjaan->getLokasiProyekId()]["label"] : "";?></td>
								<td data-col-name="kegiatan"><?php echo isset($mapForKegiatan) && isset($mapForKegiatan[$jenisPekerjaan->getKegiatan()]) && isset($mapForKegiatan[$jenisPekerjaan->getKegiatan()]["label"]) ? $mapForKegiatan[$jenisPekerjaan->getKegiatan()]["label"] : "";?></td>
								<td data-col-name="sort_order" class="data-sort-order-column"><?php echo $jenisPekerjaan->getSortOrder();?></td>
								<td data-col-name="default_data"><?php echo $jenisPekerjaan->optionDefaultData($appLanguage->getYes(), $appLanguage->getNo());?></td>
								<td data-col-name="aktif"><?php echo $jenisPekerjaan->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
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
						<?php if($userPermission->isAllowedSortOrder()){ ?>
						<button type="submit" class="btn btn-primary" name="user_action" value="sort_order" disabled="disabled"><?php echo $appLanguage->getSaveCurrentOrder();?></button>
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


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
use Sipro\Entity\Data\SupervisorProyek;
use Sipro\AppIncludeImpl;
use Sipro\Entity\Data\ProyekMin;
use Sipro\Entity\Data\SupervisorMin;

require_once dirname(__DIR__) . "/inc.app/auth.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$currentModule = new PicoModule($appConfig, $database, $appModule, "/admin", "supervisor-proyek", "Supervisor Proyek");
$userPermission = new AppUserPermission($appConfig, $database, $appUserRole, $currentModule, $currentUser);
$appInclude = new AppIncludeImpl($appConfig, $currentModule);

if(!$userPermission->allowedAccess($inputGet, $inputPost))
{
	require_once $appInclude->appForbiddenPage(__DIR__);
	exit();
}

if($inputPost->getUserAction() == UserAction::CREATE)
{
	$supervisorProyek = new SupervisorProyek(null, $database);
	$supervisorProyek->setProyekId($inputPost->getProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisorProyek->setSupervisorId($inputPost->getSupervisorId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisorProyek->setKoordinator($inputPost->getKoordinator(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisorProyek->setBerjalan($inputPost->getBerjalan(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisorProyek->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$supervisorProyek->setAdminBuat($currentUser->getUserId());
	$supervisorProyek->setWaktuBuat($currentAction->getTime());
	$supervisorProyek->setIpBuat($currentAction->getIp());
	$supervisorProyek->setAdminUbah($currentUser->getUserId());
	$supervisorProyek->setWaktuUbah($currentAction->getTime());
	$supervisorProyek->setIpUbah($currentAction->getIp());
	$supervisorProyek->insert();
	$newId = $supervisorProyek->getSupervisorProyekId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->supervisor_proyek_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::UPDATE)
{
	$supervisorProyek = new SupervisorProyek(null, $database);
	$supervisorProyek->setProyekId($inputPost->getProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisorProyek->setSupervisorId($inputPost->getSupervisorId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisorProyek->setKoordinator($inputPost->getKoordinator(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisorProyek->setBerjalan($inputPost->getBerjalan(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisorProyek->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$supervisorProyek->setAdminUbah($currentUser->getUserId());
	$supervisorProyek->setWaktuUbah($currentAction->getTime());
	$supervisorProyek->setIpUbah($currentAction->getIp());
	$supervisorProyek->setSupervisorProyekId($inputPost->getSupervisorProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisorProyek->update();
	$newId = $supervisorProyek->getSupervisorProyekId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->supervisor_proyek_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::ACTIVATE)
{
	if($inputPost->countableCheckedRowId())
	{
		foreach($inputPost->getCheckedRowId() as $rowId)
		{
			$supervisorProyek = new SupervisorProyek(null, $database);
			try
			{
				$supervisorProyek->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->supervisorProyekId, $rowId))
					->addAnd(PicoPredicate::getInstance()->notEquals(Field::of()->aktif, true))
				)
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
			$supervisorProyek = new SupervisorProyek(null, $database);
			try
			{
				$supervisorProyek->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->supervisorProyekId, $rowId))
					->addAnd(PicoPredicate::getInstance()->notEquals(Field::of()->aktif, false))
				)
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
				$supervisorProyek = new SupervisorProyek(null, $database);
				$supervisorProyek->deleteOneBySupervisorProyekId($rowId);
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
$appEntityLanguage = new AppEntityLanguage(new SupervisorProyek(), $appConfig, $currentUser->getLanguageId());
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
							<select class="form-control" name="proyek_id" id="proyek_id" required="required">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new ProyekMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true))
									->addAnd(new PicoPredicate(Field::of()->ktskId, $currentUser->getKtskId())), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->proyekId, Field::of()->nama)
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSupervisor();?></td>
						<td>
							<select class="form-control" name="supervisor_id" id="supervisor_id" required="required">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new SupervisorMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->supervisorId, Field::of()->nama)
								->setTextNodeFormat('"%s (%s)", nama, jabatan.nama')
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getKoordinator();?></td>
						<td>
							<select class="form-control" name="koordinator" id="koordinator">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="1">Ya</option>
								<option value="0">Bukan</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getBerjalan();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="berjalan" id="berjalan" value="1"/> <?php echo $appEntityLanguage->getBerjalan();?></label>
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
	$supervisorProyek = new SupervisorProyek(null, $database);
	try{
		$supervisorProyek->findOneBySupervisorProyekId($inputGet->getSupervisorProyekId());
		if($supervisorProyek->hasValueSupervisorProyekId())
		{
$appEntityLanguage = new AppEntityLanguage(new SupervisorProyek(), $appConfig, $currentUser->getLanguageId());
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
							<select class="form-control" name="proyek_id" id="proyek_id" required="required">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new ProyekMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true))
									->addAnd(new PicoPredicate(Field::of()->ktskId, $currentUser->getKtskId())), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->proyekId, Field::of()->nama, $supervisorProyek->getProyekId())
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSupervisor();?></td>
						<td>
							<select class="form-control" name="supervisor_id" id="supervisor_id" required="required">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new SupervisorMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->supervisorId, Field::of()->nama, $supervisorProyek->getSupervisorId())
								->setTextNodeFormat('"%s (%s)", nama, jabatan.nama')
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getKoordinator();?></td>
						<td>
							<select class="form-control" name="koordinator" id="koordinator" data-value="<?php echo $supervisorProyek->getKoordinator();?>">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="1" <?php echo AppFormBuilder::selected($supervisorProyek->getKoordinator(), '1');?>>Ya</option>
								<option value="0" <?php echo AppFormBuilder::selected($supervisorProyek->getKoordinator(), '0');?>>Bukan</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getBerjalan();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="berjalan" id="berjalan" value="1" <?php echo $supervisorProyek->createCheckedBerjalan();?>/> <?php echo $appEntityLanguage->getBerjalan();?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="aktif" id="aktif" value="1" <?php echo $supervisorProyek->createCheckedAktif();?>/> <?php echo $appEntityLanguage->getAktif();?></label>
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
							<input type="hidden" name="supervisor_proyek_id" value="<?php echo $supervisorProyek->getSupervisorProyekId();?>"/>
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
	$supervisorProyek = new SupervisorProyek(null, $database);
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
		"supervisorId" => array(
			"columnName" => "supervisor_id",
			"entityName" => "SupervisorMin",
			"tableName" => "supervisor",
			"primaryKey" => "supervisor_id",
			"objectName" => "supervisor",
			"propertyName" => "nama"
		), 
		"adminBuat" => array(
			"columnName" => "admin_buat",
			"entityName" => "User",
			"tableName" => "user",
			"primaryKey" => "user_id",
			"objectName" => "pembuat",
			"propertyName" => "first_name"
		), 
		"adminUbah" => array(
			"columnName" => "admin_ubah",
			"entityName" => "User",
			"tableName" => "user",
			"primaryKey" => "user_id",
			"objectName" => "pengubah",
			"propertyName" => "first_name"
		)
		);
		$supervisorProyek->findOneWithPrimaryKeyValue($inputGet->getSupervisorProyekId(), $subqueryMap);
		if($supervisorProyek->hasValueSupervisorProyekId())
		{
$appEntityLanguage = new AppEntityLanguage(new SupervisorProyek(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
			// define map here
			$mapForKoordinator = array(
				"1" => array("value" => "1", "label" => "Ya", "default" => "false"),
				"0" => array("value" => "0", "label" => "Bukan", "default" => "false")
			);
?>
<div class="page page-jambi page-detail">
	<div class="jambi-wrapper">
		<?php
		if(UserAction::isRequireNextAction($inputGet) && UserAction::isRequireApproval($supervisorProyek->getWaitingFor()))
		{
				?>
				<div class="alert alert-info"><?php echo UserAction::getWaitingForMessage($appLanguage, $supervisorProyek->getWaitingFor());?></div>
				<?php
		}
		?>
		
		<form name="detailform" id="detailform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getProyek();?></td>
						<td><?php echo $supervisorProyek->hasValueProyek() ? $supervisorProyek->getProyek()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSupervisor();?></td>
						<td><?php echo $supervisorProyek->hasValueSupervisor() ? $supervisorProyek->getSupervisor()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getKoordinator();?></td>
						<td><?php echo isset($mapForKoordinator) && isset($mapForKoordinator[$supervisorProyek->getKoordinator()]) && isset($mapForKoordinator[$supervisorProyek->getKoordinator()]["label"]) ? $mapForKoordinator[$supervisorProyek->getKoordinator()]["label"] : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getBerjalan();?></td>
						<td><?php echo $supervisorProyek->optionBerjalan($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuBuat();?></td>
						<td><?php echo $supervisorProyek->getWaktuBuat();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuUbah();?></td>
						<td><?php echo $supervisorProyek->getWaktuUbah();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpBuat();?></td>
						<td><?php echo $supervisorProyek->getIpBuat();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpUbah();?></td>
						<td><?php echo $supervisorProyek->getIpUbah();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAdminBuat();?></td>
						<td><?php echo $supervisorProyek->hasValuePembuat() ? $supervisorProyek->getPembuat()->getFirstName() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAdminUbah();?></td>
						<td><?php echo $supervisorProyek->hasValuePengubah() ? $supervisorProyek->getPengubah()->getFirstName() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td><?php echo $supervisorProyek->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<?php if($inputGet->getNextAction() == UserAction::APPROVAL && UserAction::isRequireApproval($supervisorProyek->getWaitingFor()) && $userPermission->isAllowedApprove()){ ?>
							<button type="submit" class="btn btn-success" name="user_action" value="<?php echo UserAction::APPROVE;?>"><?php echo $appLanguage->getButtonApprove();?></button>
							<button type="submit" class="btn btn-warning" name="user_action" value="<?php echo UserAction::REJECT;?>"><?php echo $appLanguage->getButtonReject();?></button>
							<?php } else if($inputGet->getNextAction() == UserAction::APPROVE && UserAction::isRequireApproval($supervisorProyek->getWaitingFor()) && $userPermission->isAllowedApprove()){ ?>
							<button type="submit" class="btn btn-success" name="user_action" value="<?php echo UserAction::APPROVE;?>"><?php echo $appLanguage->getButtonApprove();?></button>
							<?php } else if($inputGet->getNextAction() == UserAction::REJECT && UserAction::isRequireApproval($supervisorProyek->getWaitingFor()) && $userPermission->isAllowedApprove()){ ?>
							<button type="submit" class="btn btn-warning" name="user_action" value="<?php echo UserAction::REJECT;?>"><?php echo $appLanguage->getButtonReject();?></button>
							<?php } else if($userPermission->isAllowedUpdate()){ ?>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->supervisor_proyek_id, $supervisorProyek->getSupervisorProyekId());?>';"><?php echo $appLanguage->getButtonUpdate();?></button>
							<?php } ?>
		
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonBackToList();?></button>
							<input type="hidden" name="supervisor_proyek_id" value="<?php echo $supervisorProyek->getSupervisorProyekId();?>"/>
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
$appEntityLanguage = new AppEntityLanguage(new SupervisorProyek(), $appConfig, $currentUser->getLanguageId());
$mapForKoordinator = array(
	"1" => array("value" => "1", "label" => "Ya", "default" => "false"),
	"0" => array("value" => "0", "label" => "Bukan", "default" => "false")
);
$specMap = array(
	"proyekId" => PicoSpecification::filter("proyekId", "number"),
	"supervisorId" => PicoSpecification::filter("supervisorId", "number"),
	"koordinator" => PicoSpecification::filter("koordinator", "number"),
	"berjalan" => PicoSpecification::filter("berjalan", "boolean"),
	"aktif" => PicoSpecification::filter("aktif", "boolean")
);
$sortOrderMap = array(
	"proyekId" => "proyekId",
	"supervisorId" => "supervisorId",
	"koordinator" => "koordinator",
	"berjalan" => "berjalan",
	"aktif" => "aktif"
);

// You can define your own specifications
// Pay attention to security issues
$specification = PicoSpecification::fromUserInput($inputGet, $specMap);


// You can define your own sortable
// Pay attention to security issues
$sortable = PicoSortable::fromUserInput($inputGet, $sortOrderMap, array(
	array(
		"sortBy" => "proyekId", 
		"sortType" => PicoSort::ORDER_TYPE_DESC
	)
));

$pageable = new PicoPageable(new PicoPage($inputGet->getPage(), $appConfig->getData()->getPageSize()), $sortable);
$dataLoader = new SupervisorProyek(null, $database);

$subqueryMap = array(
"proyekId" => array(
	"columnName" => "proyek_id",
	"entityName" => "ProyekMin",
	"tableName" => "proyek",
	"primaryKey" => "proyek_id",
	"objectName" => "proyek",
	"propertyName" => "nama"
), 
"supervisorId" => array(
	"columnName" => "supervisor_id",
	"entityName" => "SupervisorMin",
	"tableName" => "supervisor",
	"primaryKey" => "supervisor_id",
	"objectName" => "supervisor",
	"propertyName" => "nama"
), 
"adminBuat" => array(
	"columnName" => "admin_buat",
	"entityName" => "User",
	"tableName" => "user",
	"primaryKey" => "user_id",
	"objectName" => "pembuat",
	"propertyName" => "first_name"
), 
"adminUbah" => array(
	"columnName" => "admin_ubah",
	"entityName" => "User",
	"tableName" => "user",
	"primaryKey" => "user_id",
	"objectName" => "pengubah",
	"propertyName" => "first_name"
)
);

/*ajaxSupport*/
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
									->addAnd(new PicoPredicate(Field::of()->ktskId, $currentUser->getKtskId())), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->proyekId, Field::of()->nama, $inputGet->getProyekId())
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
								->setIndent(8)
								; ?>
							</select>
					</span>
				</span>
				
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getKoordinator();?></span>
					<span class="filter-control">
							<select name="koordinator" class="form-control" data-value="<?php echo $inputGet->getKoordinator();?>">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="1" <?php echo AppFormBuilder::selected($inputGet->getKoordinator(), '1');?>>Ya</option>
								<option value="0" <?php echo AppFormBuilder::selected($inputGet->getKoordinator(), '0');?>>Bukan</option>
							</select>
					</span>
				</span>
				
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getBerjalan();?></span>
					<span class="filter-control">
							<select name="berjalan" class="form-control" data-value="<?php echo $inputGet->getBerjalan();?>">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="yes" <?php echo AppFormBuilder::selected($inputGet->getBerjalan(), 'yes');?>><?php echo $appLanguage->getOptionLabelYes();?></option>
								<option value="no" <?php echo AppFormBuilder::selected($inputGet->getBerjalan(), 'no');?>><?php echo $appLanguage->getOptionLabelNo();?></option>
							</select>
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
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-controll data-selector" data-key="supervisor_proyek_id">
									<input type="checkbox" class="checkbox check-master" data-selector=".checkbox-supervisor-proyek-id"/>
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
								<td data-col-name="supervisor_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getSupervisor();?></a></td>
								<td data-col-name="koordinator" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getKoordinator();?></a></td>
								<td data-col-name="berjalan" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getBerjalan();?></a></td>
								<td data-col-name="aktif" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getAktif();?></a></td>
							</tr>
						</thead>
					
						<tbody data-offset="<?php echo $pageData->getDataOffset();?>">
							<?php 
							$dataIndex = 0;
							while($supervisorProyek = $pageData->fetch())
							{
								$dataIndex++;
							?>
		
							<tr data-number="<?php echo $pageData->getDataOffset() + $dataIndex;?>">
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-selector" data-key="supervisor_proyek_id">
									<input type="checkbox" class="checkbox check-slave checkbox-supervisor-proyek-id" name="checked_row_id[]" value="<?php echo $supervisorProyek->getSupervisorProyekId();?>"/>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedUpdate()){ ?>
								<td>
									<a class="edit-control" href="<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->supervisor_proyek_id, $supervisorProyek->getSupervisorProyekId());?>"><span class="fa fa-edit"></span></a>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedDetail()){ ?>
								<td>
									<a class="detail-control field-master" href="<?php echo $currentModule->getRedirectUrl(UserAction::DETAIL, Field::of()->supervisor_proyek_id, $supervisorProyek->getSupervisorProyekId());?>"><span class="fa fa-folder"></span></a>
								</td>
								<?php } ?>
								<td class="data-number"><?php echo $pageData->getDataOffset() + $dataIndex;?></td>
								<td data-col-name="proyek_id"><?php echo $supervisorProyek->hasValueProyek() ? $supervisorProyek->getProyek()->getNama() : "";?></td>
								<td data-col-name="supervisor_id"><?php echo $supervisorProyek->hasValueSupervisor() ? $supervisorProyek->getSupervisor()->getNama() : "";?></td>
								<td data-col-name="koordinator"><?php echo isset($mapForKoordinator) && isset($mapForKoordinator[$supervisorProyek->getKoordinator()]) && isset($mapForKoordinator[$supervisorProyek->getKoordinator()]["label"]) ? $mapForKoordinator[$supervisorProyek->getKoordinator()]["label"] : "";?></td>
								<td data-col-name="berjalan"><?php echo $supervisorProyek->optionBerjalan($appLanguage->getYes(), $appLanguage->getNo());?></td>
								<td data-col-name="aktif"><?php echo $supervisorProyek->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
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


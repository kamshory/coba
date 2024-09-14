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
use Sipro\Entity\Data\CutiSupervisor;
use Sipro\AppIncludeImpl;
use Sipro\Entity\Data\Cuti;
use Sipro\Entity\Data\Supervisor;
use Sipro\Entity\Data\JenisCuti;
use MagicApp\XLSX\DocumentWriter;
use MagicApp\XLSX\XLSXDataFormat;

require_once dirname(__DIR__) . "/inc.app/auth.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$currentModule = new PicoModule($appConfig, $database, $appModule, "/admin", "cuti-supervisor", "Cuti Supervisor");
$userPermission = new AppUserPermission($appConfig, $database, $appUserRole, $currentModule, $currentUser);
$appInclude = new AppIncludeImpl($appConfig, $currentModule);

if(!$userPermission->allowedAccess($inputGet, $inputPost))
{
	require_once $appInclude->appForbiddenPage(__DIR__);
	exit();
}

if($inputPost->getUserAction() == UserAction::CREATE)
{
	$cutiSupervisor = new CutiSupervisor(null, $database);
	$cutiSupervisor->setCutiId($inputPost->getCutiId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$cutiSupervisor->setSupervisorId($inputPost->getSupervisorId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$cutiSupervisor->setJenisCutiId($inputPost->getJenisCutiId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$cutiSupervisor->setDibayar($inputPost->getDibayar(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$cutiSupervisor->setTanggal($inputPost->getTanggal(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$cutiSupervisor->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$cutiSupervisor->setAdminBuat($currentAction->getUserId());
	$cutiSupervisor->setWaktuBuat($currentAction->getTime());
	$cutiSupervisor->setIpBuat($currentAction->getIp());
	$cutiSupervisor->setAdminUbah($currentAction->getUserId());
	$cutiSupervisor->setWaktuUbah($currentAction->getTime());
	$cutiSupervisor->setIpUbah($currentAction->getIp());
	$cutiSupervisor->insert();
	$newId = $cutiSupervisor->getCutiSupervisorId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->cuti_supervisor_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::UPDATE)
{
	$cutiSupervisor = new CutiSupervisor(null, $database);
	$cutiSupervisor->setCutiId($inputPost->getCutiId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$cutiSupervisor->setSupervisorId($inputPost->getSupervisorId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$cutiSupervisor->setJenisCutiId($inputPost->getJenisCutiId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$cutiSupervisor->setDibayar($inputPost->getDibayar(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$cutiSupervisor->setTanggal($inputPost->getTanggal(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$cutiSupervisor->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$cutiSupervisor->setAdminUbah($currentAction->getUserId());
	$cutiSupervisor->setWaktuUbah($currentAction->getTime());
	$cutiSupervisor->setIpUbah($currentAction->getIp());
	$cutiSupervisor->setCutiSupervisorId($inputPost->getCutiSupervisorId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$cutiSupervisor->update();
	$newId = $cutiSupervisor->getCutiSupervisorId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->cuti_supervisor_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::ACTIVATE)
{
	if($inputPost->countableCheckedRowId())
	{
		foreach($inputPost->getCheckedRowId() as $rowId)
		{
			$cutiSupervisor = new CutiSupervisor(null, $database);
			try
			{
				$cutiSupervisor->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->cutiSupervisorId, $rowId))
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
			$cutiSupervisor = new CutiSupervisor(null, $database);
			try
			{
				$cutiSupervisor->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->cutiSupervisorId, $rowId))
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
				$cutiSupervisor = new CutiSupervisor(null, $database);
				$cutiSupervisor->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->cuti_supervisor_id, $rowId))
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
$appEntityLanguage = new AppEntityLanguage(new CutiSupervisor(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-insert">
	<div class="jambi-wrapper">
		<form name="createform" id="createform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getCuti();?></td>
						<td>
							<select class="form-control" name="cuti_id" id="cuti_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new Cuti(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->cutiId, Field::of()->cutiDari)
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSupervisorId();?></td>
						<td>
							<select class="form-control" name="supervisor_id" id="supervisor_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option></select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getJenisCutiId();?></td>
						<td>
							<select class="form-control" name="jenis_cuti_id" id="jenis_cuti_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option></select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getDibayar();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="dibayar" id="dibayar" value="1"/> <?php echo $appEntityLanguage->getDibayar();?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTanggal();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="date" name="tanggal" id="tanggal"/>
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
	$cutiSupervisor = new CutiSupervisor(null, $database);
	try{
		$cutiSupervisor->findOneByCutiSupervisorId($inputGet->getCutiSupervisorId());
		if($cutiSupervisor->issetCutiSupervisorId())
		{
$appEntityLanguage = new AppEntityLanguage(new CutiSupervisor(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-update">
	<div class="jambi-wrapper">
		<form name="updateform" id="updateform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getCuti();?></td>
						<td>
							<select class="form-control" name="cuti_id" id="cuti_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new Cuti(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->cutiId, Field::of()->cutiDari, $cutiSupervisor->getCutiId())
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSupervisorId();?></td>
						<td>
							<select class="form-control" name="supervisor_id" id="supervisor_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option></select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getJenisCutiId();?></td>
						<td>
							<select class="form-control" name="jenis_cuti_id" id="jenis_cuti_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option></select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getDibayar();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="dibayar" id="dibayar" value="1" <?php echo $cutiSupervisor->createCheckedDibayar();?>/> <?php echo $appEntityLanguage->getDibayar();?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTanggal();?></td>
						<td>
							<input class="form-control" type="date" name="tanggal" id="tanggal" value="<?php echo $cutiSupervisor->getTanggal();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="aktif" id="aktif" value="1" <?php echo $cutiSupervisor->createCheckedAktif();?>/> <?php echo $appEntityLanguage->getAktif();?></label>
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
							<input type="hidden" name="cuti_supervisor_id" value="<?php echo $cutiSupervisor->getCutiSupervisorId();?>"/>
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
	$cutiSupervisor = new CutiSupervisor(null, $database);
	try{
		$subqueryMap = array(
		"cutiId" => array(
			"columnName" => "cuti_id",
			"entityName" => "Cuti",
			"tableName" => "cuti",
			"primaryKey" => "cuti_id",
			"objectName" => "cuti",
			"propertyName" => "cuti_dari"
		)
		);
		$cutiSupervisor->findOneWithPrimaryKeyValue($inputGet->getCutiSupervisorId(), $subqueryMap);
		if($cutiSupervisor->issetCutiSupervisorId())
		{
$appEntityLanguage = new AppEntityLanguage(new CutiSupervisor(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
			// define map here
			
?>
<div class="page page-jambi page-detail">
	<div class="jambi-wrapper">
		<?php
		if(UserAction::isRequireNextAction($inputGet) && UserAction::isRequireApproval($cutiSupervisor->getWaitingFor()))
		{
				?>
				<div class="alert alert-info"><?php echo UserAction::getWaitingForMessage($appLanguage, $cutiSupervisor->getWaitingFor());?></div>
				<?php
		}
		?>
		
		<form name="detailform" id="detailform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getCuti();?></td>
						<td><?php echo $cutiSupervisor->issetCuti() ? $cutiSupervisor->getCuti()->getCutiDari() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSupervisorId();?></td>
						<td><?php echo $cutiSupervisor->getSupervisorId();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getJenisCutiId();?></td>
						<td><?php echo $cutiSupervisor->getJenisCutiId();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getDibayar();?></td>
						<td><?php echo $cutiSupervisor->optionDibayar($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTanggal();?></td>
						<td><?php echo $cutiSupervisor->getTanggal();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td><?php echo $cutiSupervisor->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<?php if($userPermission->isAllowedUpdate()){ ?>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->cuti_supervisor_id, $cutiSupervisor->getCutiSupervisorId());?>';"><?php echo $appLanguage->getButtonUpdate();?></button>
							<?php } ?>
		
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonBackToList();?></button>
							<input type="hidden" name="cuti_supervisor_id" value="<?php echo $cutiSupervisor->getCutiSupervisorId();?>"/>
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
$appEntityLanguage = new AppEntityLanguage(new CutiSupervisor(), $appConfig, $currentUser->getLanguageId());

$specMap = array(
    "supervisorId" => PicoSpecification::filter("supervisorId", "number"),
	"jenisCutiId" => PicoSpecification::filter("jenisCutiId", "number")
);
$sortOrderMap = array(
    "cutiId" => "cutiId",
	"supervisorId" => "supervisorId",
	"jenisCutiId" => "jenisCutiId",
	"dibayar" => "dibayar",
	"tanggal" => "tanggal",
	"aktif" => "aktif"
);

// You can define your own specifications
// Pay attention to security issues
$specification = PicoSpecification::fromUserInput($inputGet, $specMap);


// You can define your own sortable
// Pay attention to security issues
$sortable = PicoSortable::fromUserInput($inputGet, $sortOrderMap, array(
	array(
		"sortBy" => "tanggal", 
		"sortType" => PicoSort::ORDER_TYPE_DESC
	)
));

$pageable = new PicoPageable(new PicoPage($inputGet->getPage(), $appConfig->getData()->getPageSize()), $sortable);
$dataLoader = new CutiSupervisor(null, $database);

$subqueryMap = array(
"cutiId" => array(
	"columnName" => "cuti_id",
	"entityName" => "Cuti",
	"tableName" => "cuti",
	"primaryKey" => "cuti_id",
	"objectName" => "cuti",
	"propertyName" => "cuti_dari"
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
		$appEntityLanguage->getCutiSupervisorId() => $headerFormat->getCutiSupervisorId(),
		$appEntityLanguage->getCuti() => $headerFormat->asString(),
		$appEntityLanguage->getSupervisorId() => $headerFormat->asString(),
		$appEntityLanguage->getJenisCutiId() => $headerFormat->asString(),
		$appEntityLanguage->getDibayar() => $headerFormat->asString(),
		$appEntityLanguage->getTanggal() => $headerFormat->getTanggal(),
		$appEntityLanguage->getAktif() => $headerFormat->asString()
	), 
	function($index, $row, $appLanguage){
        
		return array(
			sprintf("%d", $index + 1),
			$row->getCutiSupervisorId(),
			$row->issetCuti() ? $row->getCuti()->getCutiDari() : "",
			$row->getSupervisorId(),
			$row->getJenisCutiId(),
			$row->optionDibayar($appLanguage->getYes(), $appLanguage->getNo()),
			$row->getTanggal(),
			$row->optionAktif($appLanguage->getYes(), $appLanguage->getNo())
		);
	});
	exit();
}
/*ajaxSupport*/
if(!$currentAction->isRequestViaAjax()){
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-list">
	<div class="jambi-wrapper">
		<div class="filter-section">
			<form action="" method="get" class="filter-form">
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getSupervisorId();?></span>
					<span class="filter-control">
							<select name="supervisor_id" class="form-control">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new Supervisor(null, $database), 
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
					<span class="filter-label"><?php echo $appEntityLanguage->getJenisCutiId();?></span>
					<span class="filter-control">
							<select name="jenis_cuti_id" class="form-control">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new JenisCuti(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->jenisCutiId, Field::of()->nama, $inputGet->getJenisCutiId())
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
								<td class="data-controll data-selector" data-key="cuti_supervisor_id">
									<input type="checkbox" class="checkbox check-master" data-selector=".checkbox-cuti-supervisor-id"/>
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
								<td data-col-name="cuti_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getCuti();?></a></td>
								<td data-col-name="supervisor_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getSupervisorId();?></a></td>
								<td data-col-name="jenis_cuti_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getJenisCutiId();?></a></td>
								<td data-col-name="dibayar" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getDibayar();?></a></td>
								<td data-col-name="tanggal" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getTanggal();?></a></td>
								<td data-col-name="aktif" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getAktif();?></a></td>
							</tr>
						</thead>
					
						<tbody data-offset="<?php echo $pageData->getDataOffset();?>">
							<?php 
							$dataIndex = 0;
							while($cutiSupervisor = $pageData->fetch())
							{
								$dataIndex++;
							?>
		
							<tr data-number="<?php echo $pageData->getDataOffset() + $dataIndex;?>">
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-selector" data-key="cuti_supervisor_id">
									<input type="checkbox" class="checkbox check-slave checkbox-cuti-supervisor-id" name="checked_row_id[]" value="<?php echo $cutiSupervisor->getCutiSupervisorId();?>"/>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedUpdate()){ ?>
								<td>
									<a class="edit-control" href="<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->cuti_supervisor_id, $cutiSupervisor->getCutiSupervisorId());?>"><span class="fa fa-edit"></span></a>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedDetail()){ ?>
								<td>
									<a class="detail-control field-master" href="<?php echo $currentModule->getRedirectUrl(UserAction::DETAIL, Field::of()->cuti_supervisor_id, $cutiSupervisor->getCutiSupervisorId());?>"><span class="fa fa-folder"></span></a>
								</td>
								<?php } ?>
								<td class="data-number"><?php echo $pageData->getDataOffset() + $dataIndex;?></td>
								<td data-col-name="cuti_id"><?php echo $cutiSupervisor->issetCuti() ? $cutiSupervisor->getCuti()->getCutiDari() : "";?></td>
								<td data-col-name="supervisor_id"><?php echo $cutiSupervisor->getSupervisorId();?></td>
								<td data-col-name="jenis_cuti_id"><?php echo $cutiSupervisor->getJenisCutiId();?></td>
								<td data-col-name="dibayar"><?php echo $cutiSupervisor->optionDibayar($appLanguage->getYes(), $appLanguage->getNo());?></td>
								<td data-col-name="tanggal"><?php echo $cutiSupervisor->getTanggal();?></td>
								<td data-col-name="aktif"><?php echo $cutiSupervisor->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
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


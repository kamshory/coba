<?php

// This script is generated automatically by AppBuilder
// Visit https://github.com/Planetbiru/MagicAppBuilder

use MagicObject\MagicObject;
use MagicObject\SetterGetter;
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
use Sipro\Entity\Data\Material;
use Sipro\AppIncludeImpl;
use Sipro\Entity\Data\SupervisorMin;
use MagicApp\XLSX\XLSXDocumentWriter;
use MagicApp\XLSX\XLSXDataFormat;

require_once dirname(__DIR__) . "/inc.app/auth.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$currentModule = new PicoModule($appConfig, $database, $appModule, "/admin", "material", "Material");
$userPermission = new AppUserPermission($appConfig, $database, $appUserRole, $currentModule, $currentUser);
$appInclude = new AppIncludeImpl($appConfig, $currentModule);

if(!$userPermission->allowedAccess($inputGet, $inputPost))
{
	require_once $appInclude->appForbiddenPage(__DIR__);
	exit();
}

if($inputPost->getUserAction() == UserAction::CREATE)
{
	$material = new Material(null, $database);
	$material->setNama($inputPost->getNama(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$material->setSatuan($inputPost->getSatuan(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$material->setSupervisorId($inputPost->getSupervisorId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$material->setSortOrder($inputPost->getSortOrder(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$material->setDefaultData($inputPost->getDefaultData(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$material->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$material->setAdminBuat($currentUser->getUserId());
	$material->setWaktuBuat($currentAction->getTime());
	$material->setIpBuat($currentAction->getIp());
	$material->setAdminUbah($currentUser->getUserId());
	$material->setWaktuUbah($currentAction->getTime());
	$material->setIpUbah($currentAction->getIp());
	$material->insert();
	$newId = $material->getMaterialId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->material_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::UPDATE)
{
	$material = new Material(null, $database);
	$material->setNama($inputPost->getNama(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$material->setSatuan($inputPost->getSatuan(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$material->setSupervisorId($inputPost->getSupervisorId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$material->setSortOrder($inputPost->getSortOrder(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$material->setDefaultData($inputPost->getDefaultData(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$material->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$material->setAdminUbah($currentUser->getUserId());
	$material->setWaktuUbah($currentAction->getTime());
	$material->setIpUbah($currentAction->getIp());
	$material->setMaterialId($inputPost->getMaterialId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$material->update();
	$newId = $material->getMaterialId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->material_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::ACTIVATE)
{
	if($inputPost->countableCheckedRowId())
	{
		foreach($inputPost->getCheckedRowId() as $rowId)
		{
			$material = new Material(null, $database);
			try
			{
				$material->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->materialId, $rowId))
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
			$material = new Material(null, $database);
			try
			{
				$material->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->materialId, $rowId))
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
				$material = new Material(null, $database);
				$material->deleteOneByMaterialId($rowId);
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
	$material = new Material(null, $database);
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
			$material->where(PicoSpecification::getInstance()->addAnd(new PicoPredicate(Field::of()->materialId, $primaryKeyValue)))->setSortOrder($sortOrder)->update();
		}
	}
	$currentModule->redirectToItself();
}
if($inputGet->getUserAction() == UserAction::CREATE)
{
$appEntityLanguage = new AppEntityLanguage(new Material(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-insert">
	<div class="jambi-wrapper">
		<form name="createform" id="createform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="nama" id="nama" required="required"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSatuan();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="satuan" id="satuan"/>
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
								->setTextNodeFormat('"%s (%s)", nama, jabatan.nama')
								; ?>
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
	$material = new Material(null, $database);
	try{
		$material->findOneByMaterialId($inputGet->getMaterialId());
		if($material->hasValueMaterialId())
		{
$appEntityLanguage = new AppEntityLanguage(new Material(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-update">
	<div class="jambi-wrapper">
		<form name="updateform" id="updateform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td>
							<input class="form-control" type="text" name="nama" id="nama" value="<?php echo $material->getNama();?>" autocomplete="off" required="required"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSatuan();?></td>
						<td>
							<input class="form-control" type="text" name="satuan" id="satuan" value="<?php echo $material->getSatuan();?>" autocomplete="off"/>
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
								Field::of()->supervisorId, Field::of()->nama, $material->getSupervisorId())
								->setTextNodeFormat('"%s (%s)", nama, jabatan.nama')
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSortOrder();?></td>
						<td>
							<input class="form-control" type="number" step="1" name="sort_order" id="sort_order" value="<?php echo $material->getSortOrder();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getDefaultData();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="default_data" id="default_data" value="1" <?php echo $material->createCheckedDefaultData();?>/> <?php echo $appEntityLanguage->getDefaultData();?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="aktif" id="aktif" value="1" <?php echo $material->createCheckedAktif();?>/> <?php echo $appEntityLanguage->getAktif();?></label>
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
							<input type="hidden" name="material_id" value="<?php echo $material->getMaterialId();?>"/>
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
	$material = new Material(null, $database);
	try{
		$subqueryMap = array(
		"supervisorId" => array(
			"columnName" => "supervisor_id",
			"entityName" => "SupervisorMin",
			"tableName" => "supervisor",
			"primaryKey" => "supervisor_id",
			"objectName" => "supervisor",
			"propertyName" => "nama"
		)
		);
		$material->findOneWithPrimaryKeyValue($inputGet->getMaterialId(), $subqueryMap);
		if($material->hasValueMaterialId())
		{
$appEntityLanguage = new AppEntityLanguage(new Material(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
			// define map here
			
?>
<div class="page page-jambi page-detail">
	<div class="jambi-wrapper">
		<?php
		if(UserAction::isRequireNextAction($inputGet) && UserAction::isRequireApproval($material->getWaitingFor()))
		{
				?>
				<div class="alert alert-info"><?php echo UserAction::getWaitingForMessage($appLanguage, $material->getWaitingFor());?></div>
				<?php
		}
		?>
		
		<form name="detailform" id="detailform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td><?php echo $material->getNama();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSatuan();?></td>
						<td><?php echo $material->getSatuan();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSupervisor();?></td>
						<td><?php echo $material->hasValueSupervisor() ? $material->getSupervisor()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSortOrder();?></td>
						<td><?php echo $material->getSortOrder();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getDefaultData();?></td>
						<td><?php echo $material->optionDefaultData($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td><?php echo $material->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<?php if($inputGet->getNextAction() == UserAction::APPROVAL && UserAction::isRequireApproval($material->getWaitingFor()) && $userPermission->isAllowedApprove()){ ?>
							<button type="submit" class="btn btn-success" name="user_action" value="<?php echo UserAction::APPROVE;?>"><?php echo $appLanguage->getButtonApprove();?></button>
							<button type="submit" class="btn btn-warning" name="user_action" value="<?php echo UserAction::REJECT;?>"><?php echo $appLanguage->getButtonReject();?></button>
							<?php } else if($inputGet->getNextAction() == UserAction::APPROVE && UserAction::isRequireApproval($material->getWaitingFor()) && $userPermission->isAllowedApprove()){ ?>
							<button type="submit" class="btn btn-success" name="user_action" value="<?php echo UserAction::APPROVE;?>"><?php echo $appLanguage->getButtonApprove();?></button>
							<?php } else if($inputGet->getNextAction() == UserAction::REJECT && UserAction::isRequireApproval($material->getWaitingFor()) && $userPermission->isAllowedApprove()){ ?>
							<button type="submit" class="btn btn-warning" name="user_action" value="<?php echo UserAction::REJECT;?>"><?php echo $appLanguage->getButtonReject();?></button>
							<?php } else if($userPermission->isAllowedUpdate()){ ?>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->material_id, $material->getMaterialId());?>';"><?php echo $appLanguage->getButtonUpdate();?></button>
							<?php } ?>
		
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonBackToList();?></button>
							<input type="hidden" name="material_id" value="<?php echo $material->getMaterialId();?>"/>
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
$appEntityLanguage = new AppEntityLanguage(new Material(), $appConfig, $currentUser->getLanguageId());

$specMap = array(
	"nama" => PicoSpecification::filter("nama", "fulltext"),
	"supervisorId" => PicoSpecification::filter("supervisorId", "number")
);
$sortOrderMap = array(
	"nama" => "nama",
	"satuan" => "satuan",
	"supervisorId" => "supervisorId",
	"sortOrder" => "sortOrder",
	"defaultData" => "defaultData",
	"aktif" => "aktif"
);

// You can define your own specifications
// Pay attention to security issues
$specification = PicoSpecification::fromUserInput($inputGet, $specMap);


// You can define your own sortable
// Pay attention to security issues
$sortable = PicoSortable::fromUserInput($inputGet, $sortOrderMap, array(
	array(
		"sortBy" => "sortOrder", 
		"sortType" => PicoSort::ORDER_TYPE_ASC
	)
));

$pageable = new PicoPageable(new PicoPage($inputGet->getPage(), $appConfig->getData()->getPageSize()), $sortable);
$dataLoader = new Material(null, $database);

$subqueryMap = array(
"supervisorId" => array(
	"columnName" => "supervisor_id",
	"entityName" => "SupervisorMin",
	"tableName" => "supervisor",
	"primaryKey" => "supervisor_id",
	"objectName" => "supervisor",
	"propertyName" => "nama"
)
);

if($inputGet->getUserAction() == UserAction::EXPORT)
{
	$exporter = new XLSXDocumentWriter($appLanguage);
	$fileName = $currentModule->getModuleName()."-".date("Y-m-d-H-i-s").".xlsx";
	$sheetName = "Sheet 1";

	$headerFormat = new XLSXDataFormat($dataLoader, 3);
	$pageData = $dataLoader->findAll($specification, null, $sortable, true, $subqueryMap, MagicObject::FIND_OPTION_NO_COUNT_DATA | MagicObject::FIND_OPTION_NO_FETCH_DATA);
	$exporter->write($pageData, $fileName, $sheetName, array(
		$appLanguage->getNumero() => $headerFormat->asNumber(),
		$appEntityLanguage->getMaterialId() => $headerFormat->getMaterialId(),
		$appEntityLanguage->getNama() => $headerFormat->getNama(),
		$appEntityLanguage->getSatuan() => $headerFormat->getSatuan(),
		$appEntityLanguage->getSupervisor() => $headerFormat->asString(),
		$appEntityLanguage->getSortOrder() => $headerFormat->getSortOrder(),
		$appEntityLanguage->getDefaultData() => $headerFormat->asString(),
		$appEntityLanguage->getAktif() => $headerFormat->asString()
	), 
	function($index, $row, $appLanguage){
        
		return array(
			sprintf("%d", $index + 1),
			$row->getMaterialId(),
			$row->getNama(),
			$row->getSatuan(),
			$row->hasValueSupervisor() ? $row->getSupervisor()->getNama() : "",
			$row->getSortOrder(),
			$row->optionDefaultData($appLanguage->getYes(), $appLanguage->getNo()),
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
					<span class="filter-label"><?php echo $appEntityLanguage->getNama();?></span>
					<span class="filter-control">
						<input type="text" name="nama" class="form-control" value="<?php echo $inputGet->getNama();?>" autocomplete="off"/>
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
								<?php if($userPermission->isAllowedSortOrder()){ ?>
								<td class="data-sort data-sort-header"></td>
								<?php } ?>
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-controll data-selector" data-key="material_id">
									<input type="checkbox" class="checkbox check-master" data-selector=".checkbox-material-id"/>
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
								<td data-col-name="nama" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getNama();?></a></td>
								<td data-col-name="satuan" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getSatuan();?></a></td>
								<td data-col-name="supervisor_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getSupervisor();?></a></td>
								<td data-col-name="sort_order" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getSortOrder();?></a></td>
								<td data-col-name="default_data" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getDefaultData();?></a></td>
								<td data-col-name="aktif" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getAktif();?></a></td>
							</tr>
						</thead>
					
						<tbody class="data-table-manual-sort" data-offset="<?php echo $pageData->getDataOffset();?>">
							<?php 
							$dataIndex = 0;
							while($material = $pageData->fetch())
							{
								$dataIndex++;
							?>
		
							<tr data-primary-key="<?php echo $material->getMaterialId();?>" data-sort-order="<?php echo $material->getSortOrder();?>" data-number="<?php echo $pageData->getDataOffset() + $dataIndex;?>">
								<?php if($userPermission->isAllowedSortOrder()){ ?>
								<td class="data-sort data-sort-body data-sort-handler"></td>
								<?php } ?>
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-selector" data-key="material_id">
									<input type="checkbox" class="checkbox check-slave checkbox-material-id" name="checked_row_id[]" value="<?php echo $material->getMaterialId();?>"/>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedUpdate()){ ?>
								<td>
									<a class="edit-control" href="<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->material_id, $material->getMaterialId());?>"><span class="fa fa-edit"></span></a>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedDetail()){ ?>
								<td>
									<a class="detail-control field-master" href="<?php echo $currentModule->getRedirectUrl(UserAction::DETAIL, Field::of()->material_id, $material->getMaterialId());?>"><span class="fa fa-folder"></span></a>
								</td>
								<?php } ?>
								<td class="data-number"><?php echo $pageData->getDataOffset() + $dataIndex;?></td>
								<td data-col-name="nama"><?php echo $material->getNama();?></td>
								<td data-col-name="satuan"><?php echo $material->getSatuan();?></td>
								<td data-col-name="supervisor_id"><?php echo $material->hasValueSupervisor() ? $material->getSupervisor()->getNama() : "";?></td>
								<td data-col-name="sort_order" class="data-sort-order-column"><?php echo $material->getSortOrder();?></td>
								<td data-col-name="default_data"><?php echo $material->optionDefaultData($appLanguage->getYes(), $appLanguage->getNo());?></td>
								<td data-col-name="aktif"><?php echo $material->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
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


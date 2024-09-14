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
use MagicApp\Field;
use MagicApp\PicoModule;
use MagicApp\UserAction;
use Sipro\Entity\Data\Material;
use Sipro\Entity\Data\MaterialPekerjaan;
use Sipro\Util\CommonUtil;

require_once __DIR__ . "/inc.app/auth-supervisor.php";

$currentModule = new PicoModule($appConfig, $database, null, "/", "daftar-material", "Daftar Material");

$inputGet = new InputGet();
$inputPost = new InputPost();

if($inputPost->getUserAction() == UserAction::CREATE)
{
	$material = new Material(null, $database);
	$material->setNama($inputPost->getNama(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$material->setSatuan($inputPost->getSatuan(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$material->setSupervisorId($currentLoggedInSupervisor->getSupervisorId());
	$material->setSortOrder($inputPost->getSortOrder(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$material->setDefaultData($inputPost->getDefaultData(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$material->setWaktuBuat($currentAction->getTime());
	$material->setIpBuat($currentAction->getIp());
	$material->setWaktuUbah($currentAction->getTime());
	$material->setIpUbah($currentAction->getIp());
	$material->insert();
	$newId = $material->getMaterialId();

	CommonUtil::updateMaterialPekerjaan($database, $inputPost->getJenisPekerjaanId(), $newId);

	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->material_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::UPDATE)
{
	$materialId = $inputPost->getMaterialId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true);
	$material = new Material(null, $database);

	try
	{
		$material->findOneByMaterialIdAndSupervisorId($materialId, $currentLoggedInSupervisor->getSupervisorId());

		$material
		->setNama($inputPost->getNama(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true))
		->setSatuan($inputPost->getSatuan(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true))
		->setSortOrder($inputPost->getSortOrder(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true))
		->setDefaultData($inputPost->getDefaultData(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true))
		->setWaktuUbah($currentAction->getTime())
		->setIpUbah($currentAction->getIp())
		->update();
	
		CommonUtil::updateMaterialPekerjaan($database, $inputPost->getJenisPekerjaanId(), $materialId);
	}
	catch(Exception $e)
	{
		// Do something here to handle exception
	}

	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->material_id, $materialId);
}
else if($inputPost->getUserAction() == UserAction::DELETE)
{
	if($inputPost->countableCheckedRowId())
	{
		foreach($inputPost->getCheckedRowId() as $rowId)
		{
			$material = new Material(null, $database);
			try
			{
				$material->findOneByMaterialIdAndSupervisorId($materialId, $currentLoggedInSupervisor->getSupervisorId());

				$materialPekerjaan = new MaterialPekerjaan(null, $database);
        		$materialPekerjaan->deleteByMaterialId($materialId);

				$material->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->setMaterialId($inputPost->getMaterialId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true)))
					->addAnd(PicoPredicate::getInstance()->setSupervisorId($inputPost->getSupervisorId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true)))
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
require_once __DIR__ . "/inc.app/header-supervisor.php";
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
						<td><?php echo $appEntityLanguage->getJenisPekerjaan();?></td>
						<td>
							<?php echo CommonUtil::getMaterialPekerjaan($database, 'check');?>
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
require_once __DIR__ . "/inc.app/footer-supervisor.php";
}
else if($inputGet->getUserAction() == UserAction::UPDATE)
{
	$material = new Material(null, $database);
	try{
		$material->findOneByMaterialIdAndSupervisorId($inputGet->getMaterialId(), $currentLoggedInSupervisor->getSupervisorId());
		if($material->hasValueMaterialId())
		{
$appEntityLanguage = new AppEntityLanguage(new Material(), $appConfig, $currentUser->getLanguageId());
require_once __DIR__ . "/inc.app/header-supervisor.php";
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
						<td><?php echo $appEntityLanguage->getJenisPekerjaan();?></td>
						<td>
							<?php echo CommonUtil::getMaterialPekerjaan($database, 'check', $material->getMaterialId());?>
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
require_once __DIR__ . "/inc.app/footer-supervisor.php";
	}
	catch(Exception $e)
	{
require_once __DIR__ . "/inc.app/header-supervisor.php";
		// Do somtething here when exception
		?>
		<div class="alert alert-danger"><?php echo $e->getMessage();?></div>
		<?php
require_once __DIR__ . "/inc.app/footer-supervisor.php";
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
require_once __DIR__ . "/inc.app/header-supervisor.php";
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
						<td><?php echo $appEntityLanguage->getJenisPekerjaan();?></td>
						<td>
							<?php echo CommonUtil::getMaterialPekerjaan($database, 'list', $material->getMaterialId());?>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSortOrder();?></td>
						<td><?php echo $material->getSortOrder();?></td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<?php if($userPermission->isAllowedUpdate() && $currentLoggedInSupervisor->getSupervisorId() == $material->getSupervisorId()){ ?>
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
require_once __DIR__ . "/inc.app/footer-supervisor.php";
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
require_once __DIR__ . "/inc.app/footer-supervisor.php";
	}
}
else 
{
$appEntityLanguage = new AppEntityLanguage(new Material(), $appConfig, $currentUser->getLanguageId());

$specMap = array(
    "nama" => PicoSpecification::filter("nama", "fulltext")
);
$sortOrderMap = array(
    "nama" => "nama",
	"satuan" => "satuan",
	"sortOrder" => "sortOrder"
);

// You can define your own specifications
// Pay attention to security issues
$specification = PicoSpecification::fromUserInput($inputGet, $specMap);


// Additional filter here
if($inputGet->getFilter() == UserAction::UPDATE)
{
	$specification->add(['supervisorId', $currentUser->getUserId()]);
}
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

/*ajaxSupport*/
if(!$currentAction->isRequestViaAjax()){
require_once __DIR__ . "/inc.app/header-supervisor.php";
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
					<button type="submit" class="btn btn-success"><?php echo $appLanguage->getButtonSearch();?></button>
				</span>
				<?php if($userPermission->isAllowedDetail()){ ?>
		
				<span class="filter-group">
					<button type="submit" name="user_action" value="export" class="btn btn-success"><?php echo $appLanguage->getButtonExport();?></button>
				</span>
				<?php } ?>
				<span class="filter-group">
					<button type="submit" name="filter" value="update" class="btn btn-success"><span class="fa fa-edit"></span></button>
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
								<td data-col-name="sort_order" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getUrutan();?></a></td>
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
								<?php 
								if($userPermission->isAllowedUpdate() && $currentAction->getUserId() == $material->getSupervisorId()){ ?>
								<td>
									<a class="edit-control" href="<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->material_id, $material->getMaterialId());?>"><span class="fa fa-edit"></span></a>
								</td>
								<?php } else { ?>
								<td>
									<span class="fa fa-edit"></span>
								</td>
								<?php } 
								?>
								<?php if($userPermission->isAllowedDetail()){ ?>
								<td>
									<a class="detail-control field-master" href="<?php echo $currentModule->getRedirectUrl(UserAction::DETAIL, Field::of()->material_id, $material->getMaterialId());?>"><span class="fa fa-folder"></span></a>
								</td>
								<?php } ?>
								<td class="data-number"><?php echo $pageData->getDataOffset() + $dataIndex;?></td>
								<td data-col-name="nama"><?php echo $material->getNama();?></td>
								<td data-col-name="satuan"><?php echo $material->getSatuan();?></td>
								<td data-col-name="sort_order" class="data-sort-order-column"><?php echo $material->getSortOrder();?></td>
							</tr>
							<?php 
							}
							?>
		
						</tbody>
					</table>
				</div>
				<div class="button-wrapper">
					<div class="button-area">
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
require_once __DIR__ . "/inc.app/footer-supervisor.php";
}
/*ajaxSupport*/
}


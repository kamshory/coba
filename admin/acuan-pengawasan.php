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
use MagicApp\AppUserPermission;
use Sipro\Entity\Data\AcuanPengawasan;
use Sipro\AppIncludeImpl;


require_once dirname(__DIR__) . "/inc.app/auth.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$currentModule = new PicoModule($appConfig, $database, $appModule, "/admin", "acuan-pengawasan", "Acuan Pengawasan");
$userPermission = new AppUserPermission($appConfig, $database, $appUserRole, $currentModule, $currentUser);
$appInclude = new AppIncludeImpl($appConfig, $currentModule);

if(!$userPermission->allowedAccess($inputGet, $inputPost))
{
	require_once $appInclude->appForbiddenPage(__DIR__);
	exit();
}

if($inputPost->getUserAction() == UserAction::CREATE)
{
	$acuanPengawasan = new AcuanPengawasan(null, $database);
	$acuanPengawasan->setNama($inputPost->getNama(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$acuanPengawasan->setSortOrder($inputPost->getSortOrder(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$acuanPengawasan->setDefaultData($inputPost->getDefaultData(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$acuanPengawasan->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$acuanPengawasan->setAdminBuat($currentAction->getUserId());
	$acuanPengawasan->setWaktuBuat($currentAction->getTime());
	$acuanPengawasan->setIpBuat($currentAction->getIp());
	$acuanPengawasan->setAdminUbah($currentAction->getUserId());
	$acuanPengawasan->setWaktuUbah($currentAction->getTime());
	$acuanPengawasan->setIpUbah($currentAction->getIp());
	try
	{
		$acuanPengawasan->insert();
		$newId = $acuanPengawasan->getAcuanPengawasanId();
		$currentModule->redirectTo(UserAction::DETAIL, Field::of()->acuan_pengawasan_id, $newId);
	}
	catch(Exception $e)
	{
		$currentModule->redirectToItself();
	}
}
else if($inputPost->getUserAction() == UserAction::UPDATE)
{
	$acuanPengawasan = new AcuanPengawasan(null, $database);
	$acuanPengawasan->setNama($inputPost->getNama(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$acuanPengawasan->setSortOrder($inputPost->getSortOrder(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$acuanPengawasan->setDefaultData($inputPost->getDefaultData(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$acuanPengawasan->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$acuanPengawasan->setAdminUbah($currentAction->getUserId());
	$acuanPengawasan->setWaktuUbah($currentAction->getTime());
	$acuanPengawasan->setIpUbah($currentAction->getIp());
	$acuanPengawasan->setAcuanPengawasanId($inputPost->getAcuanPengawasanId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	try
	{
		$acuanPengawasan->update();
		$newId = $acuanPengawasan->getAcuanPengawasanId();
		$currentModule->redirectTo(UserAction::DETAIL, Field::of()->acuan_pengawasan_id, $newId);
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
			$acuanPengawasan = new AcuanPengawasan(null, $database);
			try
			{
				$acuanPengawasan->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->acuanPengawasanId, $rowId))
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
				$error_log($e->getMessage());
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
			$acuanPengawasan = new AcuanPengawasan(null, $database);
			try
			{
				$acuanPengawasan->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->acuanPengawasanId, $rowId))
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
				$error_log($e->getMessage());
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
				$acuanPengawasan = new AcuanPengawasan(null, $database);
				$acuanPengawasan->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->acuan_pengawasan_id, $rowId))
				)
				->delete();
			}
			catch(Exception $e)
			{
				// Do something here to handle exception
				$error_log($e->getMessage());
			}
		}
	}
	$currentModule->redirectToItself();
}
else if($inputPost->getUserAction() == UserAction::SORT_ORDER)
{
	$acuanPengawasan = new AcuanPengawasan(null, $database);
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
			$acuanPengawasan->where(PicoSpecification::getInstance()
				->addAnd(new PicoPredicate(Field::of()->acuanPengawasanId, $primaryKeyValue))
			)
			->setSortOrder($sortOrder)
			->update();
		}
	}
	$currentModule->redirectToItself();
}
if($inputGet->getUserAction() == UserAction::CREATE)
{
$appEntityLanguage = new AppEntityLanguage(new AcuanPengawasan(), $appConfig, $currentUser->getLanguageId());
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
	$acuanPengawasan = new AcuanPengawasan(null, $database);
	try{
		$acuanPengawasan->findOneByAcuanPengawasanId($inputGet->getAcuanPengawasanId());
		if($acuanPengawasan->issetAcuanPengawasanId())
		{
$appEntityLanguage = new AppEntityLanguage(new AcuanPengawasan(), $appConfig, $currentUser->getLanguageId());
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
							<input class="form-control" type="text" name="nama" id="nama" value="<?php echo $acuanPengawasan->getNama();?>" autocomplete="off" required="required"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSortOrder();?></td>
						<td>
							<input class="form-control" type="number" step="1" name="sort_order" id="sort_order" value="<?php echo $acuanPengawasan->getSortOrder();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getDefaultData();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="default_data" id="default_data" value="1" <?php echo $acuanPengawasan->createCheckedDefaultData();?>/> <?php echo $appEntityLanguage->getDefaultData();?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="aktif" id="aktif" value="1" <?php echo $acuanPengawasan->createCheckedAktif();?>/> <?php echo $appEntityLanguage->getAktif();?></label>
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
							<input type="hidden" name="acuan_pengawasan_id" value="<?php echo $acuanPengawasan->getAcuanPengawasanId();?>"/>
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
	$acuanPengawasan = new AcuanPengawasan(null, $database);
	try{
		$subqueryMap = null;
		$acuanPengawasan->findOneWithPrimaryKeyValue($inputGet->getAcuanPengawasanId(), $subqueryMap);
		if($acuanPengawasan->issetAcuanPengawasanId())
		{
$appEntityLanguage = new AppEntityLanguage(new AcuanPengawasan(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
			// define map here
			
?>
<div class="page page-jambi page-detail">
	<div class="jambi-wrapper">
		<?php
		if(UserAction::isRequireNextAction($inputGet) && UserAction::isRequireApproval($acuanPengawasan->getWaitingFor()))
		{
				?>
				<div class="alert alert-info"><?php echo UserAction::getWaitingForMessage($appLanguage, $acuanPengawasan->getWaitingFor());?></div>
				<?php
		}
		?>
		
		<form name="detailform" id="detailform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td><?php echo $acuanPengawasan->getNama();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSortOrder();?></td>
						<td><?php echo $acuanPengawasan->getSortOrder();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getDefaultData();?></td>
						<td><?php echo $acuanPengawasan->optionDefaultData($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td><?php echo $acuanPengawasan->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<?php if($userPermission->isAllowedUpdate()){ ?>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->acuan_pengawasan_id, $acuanPengawasan->getAcuanPengawasanId());?>';"><?php echo $appLanguage->getButtonUpdate();?></button>
							<?php } ?>
		
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonBackToList();?></button>
							<input type="hidden" name="acuan_pengawasan_id" value="<?php echo $acuanPengawasan->getAcuanPengawasanId();?>"/>
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
$appEntityLanguage = new AppEntityLanguage(new AcuanPengawasan(), $appConfig, $currentUser->getLanguageId());

$specMap = array(
	"nama" => PicoSpecification::filter("nama", "fulltext")
);
$sortOrderMap = array(
	"nama" => "nama",
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
$dataLoader = new AcuanPengawasan(null, $database);

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
					<span class="filter-label"><?php echo $appEntityLanguage->getNama();?></span>
					<span class="filter-control">
						<input type="text" name="nama" class="form-control" value="<?php echo $inputGet->getNama();?>" autocomplete="off"/>
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
								<td class="data-controll data-selector" data-key="acuan_pengawasan_id">
									<input type="checkbox" class="checkbox check-master" data-selector=".checkbox-acuan-pengawasan-id"/>
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
								<td data-col-name="sort_order" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getSortOrder();?></a></td>
								<td data-col-name="default_data" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getDefaultData();?></a></td>
								<td data-col-name="aktif" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getAktif();?></a></td>
							</tr>
						</thead>
					
						<tbody class="data-table-manual-sort" data-offset="<?php echo $pageData->getDataOffset();?>">
							<?php 
							$dataIndex = 0;
							while($acuanPengawasan = $pageData->fetch())
							{
								$dataIndex++;
							?>
		
							<tr data-primary-key="<?php echo $acuanPengawasan->getAcuanPengawasanId();?>" data-sort-order="<?php echo $acuanPengawasan->getSortOrder();?>" data-number="<?php echo $pageData->getDataOffset() + $dataIndex;?>">
								<?php if($userPermission->isAllowedSortOrder()){ ?>
								<td class="data-sort data-sort-body data-sort-handler"></td>
								<?php } ?>
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-selector" data-key="acuan_pengawasan_id">
									<input type="checkbox" class="checkbox check-slave checkbox-acuan-pengawasan-id" name="checked_row_id[]" value="<?php echo $acuanPengawasan->getAcuanPengawasanId();?>"/>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedUpdate()){ ?>
								<td>
									<a class="edit-control" href="<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->acuan_pengawasan_id, $acuanPengawasan->getAcuanPengawasanId());?>"><span class="fa fa-edit"></span></a>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedDetail()){ ?>
								<td>
									<a class="detail-control field-master" href="<?php echo $currentModule->getRedirectUrl(UserAction::DETAIL, Field::of()->acuan_pengawasan_id, $acuanPengawasan->getAcuanPengawasanId());?>"><span class="fa fa-folder"></span></a>
								</td>
								<?php } ?>
								<td class="data-number"><?php echo $pageData->getDataOffset() + $dataIndex;?></td>
								<td data-col-name="nama"><?php echo $acuanPengawasan->getNama();?></td>
								<td data-col-name="sort_order" class="data-sort-order-column"><?php echo $acuanPengawasan->getSortOrder();?></td>
								<td data-col-name="default_data"><?php echo $acuanPengawasan->optionDefaultData($appLanguage->getYes(), $appLanguage->getNo());?></td>
								<td data-col-name="aktif"><?php echo $acuanPengawasan->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
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


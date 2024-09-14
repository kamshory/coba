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
use MagicApp\Field;
use MagicApp\PicoModule;
use MagicApp\UserAction;
use MagicApp\AppUserPermission;
use Sipro\Entity\Data\LokasiPekerjaan;
use Sipro\AppIncludeImpl;

require_once dirname(__DIR__) . "/inc.app/auth.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$currentModule = new PicoModule($appConfig, $database, $appModule, "/admin", "lokasi-pekerjaan", "Lokasi Pekerjaan");
$userPermission = new AppUserPermission($appConfig, $database, $appUserRole, $currentModule, $currentUser);
$appInclude = new AppIncludeImpl($appConfig, $currentModule);

if(!$userPermission->allowedAccess($inputGet, $inputPost))
{
	require_once $appInclude->appForbiddenPage(__DIR__);
	exit();
}

if($inputPost->getUserAction() == UserAction::CREATE)
{
	$lokasiPekerjaan = new LokasiPekerjaan(null, $database);
	$lokasiPekerjaan->setLokasiPekerjaanId($inputPost->getLokasiPekerjaanId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$lokasiPekerjaan->setPekerjaanId($inputPost->getPekerjaanId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$lokasiPekerjaan->setBukuHarianId($inputPost->getBukuHarianId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$lokasiPekerjaan->setLokasiProyekId($inputPost->getLokasiProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$lokasiPekerjaan->setLatitude($inputPost->getLatitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$lokasiPekerjaan->setLongitude($inputPost->getLongitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$lokasiPekerjaan->setAltitude($inputPost->getAltitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$lokasiPekerjaan->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$lokasiPekerjaan->setAdminBuat($currentUser->getUserId());
	$lokasiPekerjaan->setWaktuBuat($currentAction->getTime());
	$lokasiPekerjaan->setIpBuat($currentAction->getIp());
	$lokasiPekerjaan->setAdminUbah($currentUser->getUserId());
	$lokasiPekerjaan->setWaktuUbah($currentAction->getTime());
	$lokasiPekerjaan->setIpUbah($currentAction->getIp());
	$lokasiPekerjaan->insert();
	$newId = $lokasiPekerjaan->getLokasiPekerjaanId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->lokasi_pekerjaan_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::UPDATE)
{
	$lokasiPekerjaan = new LokasiPekerjaan(null, $database);
	$lokasiPekerjaan->setLokasiPekerjaanId($inputPost->getLokasiPekerjaanId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$lokasiPekerjaan->setPekerjaanId($inputPost->getPekerjaanId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$lokasiPekerjaan->setBukuHarianId($inputPost->getBukuHarianId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$lokasiPekerjaan->setLokasiProyekId($inputPost->getLokasiProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$lokasiPekerjaan->setLatitude($inputPost->getLatitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$lokasiPekerjaan->setLongitude($inputPost->getLongitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$lokasiPekerjaan->setAltitude($inputPost->getAltitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$lokasiPekerjaan->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$lokasiPekerjaan->setAdminUbah($currentUser->getUserId());
	$lokasiPekerjaan->setWaktuUbah($currentAction->getTime());
	$lokasiPekerjaan->setIpUbah($currentAction->getIp());
	$lokasiPekerjaan->update();

	// update primary key value
	$specification = PicoSpecification::getInstance()->addAnd(new PicoPredicate(Field::of()->lokasiPekerjaanId, $inputPost->getLokasiPekerjaanId()));
	$lokasiPekerjaan = new LokasiPekerjaan(null, $database);
	$lokasiPekerjaan->where($specification)->setLokasiPekerjaanId($inputPost->getAppBuilderNewPkLokasiPekerjaanId())->update();
	$newId = $inputPost->getAppBuilderNewPkLokasiPekerjaanId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->lokasi_pekerjaan_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::ACTIVATE)
{
	if($inputPost->countableCheckedRowId())
	{
		foreach($inputPost->getCheckedRowId() as $rowId)
		{
			$lokasiPekerjaan = new LokasiPekerjaan(null, $database);
			try
			{
				$lokasiPekerjaan->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->lokasiPekerjaanId, $rowId))
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
			$lokasiPekerjaan = new LokasiPekerjaan(null, $database);
			try
			{
				$lokasiPekerjaan->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->lokasiPekerjaanId, $rowId))
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
				$lokasiPekerjaan = new LokasiPekerjaan(null, $database);
				$lokasiPekerjaan->deleteOneByLokasiPekerjaanId($rowId);
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
	$lokasiPekerjaan = new LokasiPekerjaan(null, $database);
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
			$lokasiPekerjaan->where(PicoSpecification::getInstance()->addAnd(new PicoPredicate(Field::of()->lokasiPekerjaanId, $primaryKeyValue)))->setSortOrder($sortOrder)->update();
		}
	}
	$currentModule->redirectToItself();
}
if($inputGet->getUserAction() == UserAction::CREATE)
{
$appEntityLanguage = new AppEntityLanguage(new LokasiPekerjaan(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-insert">
	<div class="jambi-wrapper">
		<form name="createform" id="createform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiPekerjaanId();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="1" name="lokasi_pekerjaan_id" id="lokasi_pekerjaan_id"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getPekerjaanId();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="1" name="pekerjaan_id" id="pekerjaan_id"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getBukuHarianId();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="1" name="buku_harian_id" id="buku_harian_id"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiProyekId();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="1" name="lokasi_proyek_id" id="lokasi_proyek_id"/>
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
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="1" name="aktif" id="aktif"/>
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
	$lokasiPekerjaan = new LokasiPekerjaan(null, $database);
	try{
		$lokasiPekerjaan->findOneByLokasiPekerjaanId($inputGet->getLokasiPekerjaanId());
		if($lokasiPekerjaan->hasValueLokasiPekerjaanId())
		{
$appEntityLanguage = new AppEntityLanguage(new LokasiPekerjaan(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-update">
	<div class="jambi-wrapper">
		<form name="updateform" id="updateform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiPekerjaanId();?></td>
						<td>
							<input class="form-control" type="number" step="1" name="app_builder_new_pk_lokasi_pekerjaan_id" id="lokasi_pekerjaan_id" value="<?php echo $lokasiPekerjaan->getLokasiPekerjaanId();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getPekerjaanId();?></td>
						<td>
							<input class="form-control" type="number" step="1" name="pekerjaan_id" id="pekerjaan_id" value="<?php echo $lokasiPekerjaan->getPekerjaanId();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getBukuHarianId();?></td>
						<td>
							<input class="form-control" type="number" step="1" name="buku_harian_id" id="buku_harian_id" value="<?php echo $lokasiPekerjaan->getBukuHarianId();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiProyekId();?></td>
						<td>
							<input class="form-control" type="number" step="1" name="lokasi_proyek_id" id="lokasi_proyek_id" value="<?php echo $lokasiPekerjaan->getLokasiProyekId();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLatitude();?></td>
						<td>
							<input class="form-control" type="number" step="any" name="latitude" id="latitude" value="<?php echo $lokasiPekerjaan->getLatitude();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLongitude();?></td>
						<td>
							<input class="form-control" type="number" step="any" name="longitude" id="longitude" value="<?php echo $lokasiPekerjaan->getLongitude();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAltitude();?></td>
						<td>
							<input class="form-control" type="number" step="any" name="altitude" id="altitude" value="<?php echo $lokasiPekerjaan->getAltitude();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td>
							<input class="form-control" type="number" step="1" name="aktif" id="aktif" value="<?php echo $lokasiPekerjaan->getAktif();?>" autocomplete="off"/>
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
							<input type="hidden" name="lokasi_pekerjaan_id" value="<?php echo $lokasiPekerjaan->getLokasiPekerjaanId();?>"/>
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
	$lokasiPekerjaan = new LokasiPekerjaan(null, $database);
	try{
		$subqueryMap = null;
		$lokasiPekerjaan->findOneWithPrimaryKeyValue($inputGet->getLokasiPekerjaanId(), $subqueryMap);
		if($lokasiPekerjaan->hasValueLokasiPekerjaanId())
		{
$appEntityLanguage = new AppEntityLanguage(new LokasiPekerjaan(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
			// define map here
			
?>
<div class="page page-jambi page-detail">
	<div class="jambi-wrapper">
		<?php
		if(UserAction::isRequireNextAction($inputGet) && UserAction::isRequireApproval($lokasiPekerjaan->getWaitingFor()))
		{
				?>
				<div class="alert alert-info"><?php echo UserAction::getWaitingForMessage($appLanguage, $lokasiPekerjaan->getWaitingFor());?></div>
				<?php
		}
		?>
		
		<form name="detailform" id="detailform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiPekerjaanId();?></td>
						<td><?php echo $lokasiPekerjaan->getLokasiPekerjaanId();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getPekerjaanId();?></td>
						<td><?php echo $lokasiPekerjaan->getPekerjaanId();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getBukuHarianId();?></td>
						<td><?php echo $lokasiPekerjaan->getBukuHarianId();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLokasiProyekId();?></td>
						<td><?php echo $lokasiPekerjaan->getLokasiProyekId();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLatitude();?></td>
						<td><?php echo $lokasiPekerjaan->getLatitude();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLongitude();?></td>
						<td><?php echo $lokasiPekerjaan->getLongitude();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAltitude();?></td>
						<td><?php echo $lokasiPekerjaan->getAltitude();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td><?php echo $lokasiPekerjaan->getAktif();?></td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<?php if($inputGet->getNextAction() == UserAction::APPROVAL && UserAction::isRequireApproval($lokasiPekerjaan->getWaitingFor()) && $userPermission->isAllowedApprove()){ ?>
							<button type="submit" class="btn btn-success" name="user_action" value="<?php echo UserAction::APPROVE;?>"><?php echo $appLanguage->getButtonApprove();?></button>
							<button type="submit" class="btn btn-warning" name="user_action" value="<?php echo UserAction::REJECT;?>"><?php echo $appLanguage->getButtonReject();?></button>
							<?php } else if($inputGet->getNextAction() == UserAction::APPROVE && UserAction::isRequireApproval($lokasiPekerjaan->getWaitingFor()) && $userPermission->isAllowedApprove()){ ?>
							<button type="submit" class="btn btn-success" name="user_action" value="<?php echo UserAction::APPROVE;?>"><?php echo $appLanguage->getButtonApprove();?></button>
							<?php } else if($inputGet->getNextAction() == UserAction::REJECT && UserAction::isRequireApproval($lokasiPekerjaan->getWaitingFor()) && $userPermission->isAllowedApprove()){ ?>
							<button type="submit" class="btn btn-warning" name="user_action" value="<?php echo UserAction::REJECT;?>"><?php echo $appLanguage->getButtonReject();?></button>
							<?php } else if($userPermission->isAllowedUpdate()){ ?>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->lokasi_pekerjaan_id, $lokasiPekerjaan->getLokasiPekerjaanId());?>';"><?php echo $appLanguage->getButtonUpdate();?></button>
							<?php } ?>
		
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonBackToList();?></button>
							<input type="hidden" name="lokasi_pekerjaan_id" value="<?php echo $lokasiPekerjaan->getLokasiPekerjaanId();?>"/>
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
$appEntityLanguage = new AppEntityLanguage(new LokasiPekerjaan(), $appConfig, $currentUser->getLanguageId());

$specMap = array(
    
);
$sortOrderMap = array(
    "lokasiPekerjaanId" => "lokasiPekerjaanId",
	"pekerjaanId" => "pekerjaanId",
	"bukuHarianId" => "bukuHarianId",
	"lokasiProyekId" => "lokasiProyekId",
	"latitude" => "latitude",
	"longitude" => "longitude",
	"altitude" => "altitude",
	"aktif" => "aktif"
);

// You can define your own specifications
// Pay attention to security issues
$specification = PicoSpecification::fromUserInput($inputGet, $specMap);


// You can define your own sortable
// Pay attention to security issues
$sortable = PicoSortable::fromUserInput($inputGet, $sortOrderMap, null);

$pageable = new PicoPageable(new PicoPage($inputGet->getPage(), $appConfig->getData()->getPageSize()), $sortable);
$dataLoader = new LokasiPekerjaan(null, $database);

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
								<td class="data-controll data-selector" data-key="lokasi_pekerjaan_id">
									<input type="checkbox" class="checkbox check-master" data-selector=".checkbox-lokasi-pekerjaan-id"/>
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
								<td data-col-name="lokasi_pekerjaan_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getLokasiPekerjaanId();?></a></td>
								<td data-col-name="pekerjaan_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getPekerjaanId();?></a></td>
								<td data-col-name="buku_harian_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getBukuHarianId();?></a></td>
								<td data-col-name="lokasi_proyek_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getLokasiProyekId();?></a></td>
								<td data-col-name="latitude" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getLatitude();?></a></td>
								<td data-col-name="longitude" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getLongitude();?></a></td>
								<td data-col-name="altitude" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getAltitude();?></a></td>
								<td data-col-name="aktif" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getAktif();?></a></td>
							</tr>
						</thead>
					
						<tbody class="data-table-manual-sort" data-offset="<?php echo $pageData->getDataOffset();?>">
							<?php 
							$dataIndex = 0;
							while($lokasiPekerjaan = $pageData->fetch())
							{
								$dataIndex++;
							?>
		
							<tr data-primary-key="<?php echo $lokasiPekerjaan->getLokasiPekerjaanId();?>" data-sort-order="<?php echo $lokasiPekerjaan->getSortOrder();?>" data-number="<?php echo $pageData->getDataOffset() + $dataIndex;?>">
								<?php if($userPermission->isAllowedSortOrder()){ ?>
								<td class="data-sort data-sort-body data-sort-handler"></td>
								<?php } ?>
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-selector" data-key="lokasi_pekerjaan_id">
									<input type="checkbox" class="checkbox check-slave checkbox-lokasi-pekerjaan-id" name="checked_row_id[]" value="<?php echo $lokasiPekerjaan->getLokasiPekerjaanId();?>"/>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedUpdate()){ ?>
								<td>
									<a class="edit-control" href="<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->lokasi_pekerjaan_id, $lokasiPekerjaan->getLokasiPekerjaanId());?>"><span class="fa fa-edit"></span></a>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedDetail()){ ?>
								<td>
									<a class="detail-control field-master" href="<?php echo $currentModule->getRedirectUrl(UserAction::DETAIL, Field::of()->lokasi_pekerjaan_id, $lokasiPekerjaan->getLokasiPekerjaanId());?>"><span class="fa fa-folder"></span></a>
								</td>
								<?php } ?>
								<td class="data-number"><?php echo $pageData->getDataOffset() + $dataIndex;?></td>
								<td data-col-name="lokasi_pekerjaan_id"><?php echo $lokasiPekerjaan->getLokasiPekerjaanId();?></td>
								<td data-col-name="pekerjaan_id"><?php echo $lokasiPekerjaan->getPekerjaanId();?></td>
								<td data-col-name="buku_harian_id"><?php echo $lokasiPekerjaan->getBukuHarianId();?></td>
								<td data-col-name="lokasi_proyek_id"><?php echo $lokasiPekerjaan->getLokasiProyekId();?></td>
								<td data-col-name="latitude"><?php echo $lokasiPekerjaan->getLatitude();?></td>
								<td data-col-name="longitude"><?php echo $lokasiPekerjaan->getLongitude();?></td>
								<td data-col-name="altitude"><?php echo $lokasiPekerjaan->getAltitude();?></td>
								<td data-col-name="aktif"><?php echo $lokasiPekerjaan->getAktif();?></td>
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


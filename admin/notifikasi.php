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
use MagicObject\Request\InputGet;
use MagicObject\Request\InputPost;
use MagicApp\AppEntityLanguage;
use MagicApp\AppFormBuilder;
use MagicApp\Field;
use MagicApp\PicoModule;
use MagicApp\UserAction;
use MagicApp\AppUserPermission;
use Sipro\Entity\Data\Notifikasi;
use Sipro\AppIncludeImpl;

require_once dirname(__DIR__) . "/inc.app/auth.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$currentModule = new PicoModule($appConfig, $database, $appModule, "/admin", "notifikasi", "Notifikasi");
$userPermission = new AppUserPermission($appConfig, $database, $appUserRole, $currentModule, $currentUser);
$appInclude = new AppIncludeImpl($appConfig, $currentModule);

if(!$userPermission->allowedAccess($inputGet, $inputPost))
{
	require_once $appInclude->appForbiddenPage(__DIR__);
	exit();
}

if($inputGet->getUserAction() == UserAction::DETAIL)
{
	$notifikasi = new Notifikasi(null, $database);
	try{
		$subqueryMap = array(
		"supervisorId" => array(
			"columnName" => "supervisor_id",
			"entityName" => "SupervisorMin",
			"tableName" => "supervisor",
			"primaryKey" => "supervisor_id",
			"objectName" => "supervisor",
			"propertyName" => "nama"
		), 
		"userId" => array(
			"columnName" => "user_id",
			"entityName" => "UserMin",
			"tableName" => "user",
			"primaryKey" => "user_id",
			"objectName" => "user",
			"propertyName" => "nama"
		)
		);
		$notifikasi->findOneWithPrimaryKeyValue($inputGet->getNotifikasiId(), $subqueryMap);
		if($notifikasi->issetNotifikasiId())
		{
$appEntityLanguage = new AppEntityLanguage(new Notifikasi(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
			// define map here
			$mapForGrupPengguna = array(
				"supervisor" => array("value" => "supervisor", "label" => "Supervisor", "default" => "false"),
				"user" => array("value" => "user", "label" => "Admin", "default" => "false")
			);
			$mapForDibaca = array(
				"0" => array("value" => "0", "label" => "Belum Dibaca", "default" => "false"),
				"1" => array("value" => "1", "label" => "Sudah Dibaca", "default" => "false")
			);
?>
<div class="page page-jambi page-detail">
	<div class="jambi-wrapper">
		<?php
		if(UserAction::isRequireNextAction($inputGet) && UserAction::isRequireApproval($notifikasi->getWaitingFor()))
		{
				?>
				<div class="alert alert-info"><?php echo UserAction::getWaitingForMessage($appLanguage, $notifikasi->getWaitingFor());?></div>
				<?php
		}
		?>
		
		<form name="detailform" id="detailform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getGrupPengguna();?></td>
						<td><?php echo isset($mapForGrupPengguna) && isset($mapForGrupPengguna[$notifikasi->getGrupPengguna()]) && isset($mapForGrupPengguna[$notifikasi->getGrupPengguna()]["label"]) ? $mapForGrupPengguna[$notifikasi->getGrupPengguna()]["label"] : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSupervisor();?></td>
						<td><?php echo $notifikasi->issetSupervisor() ? $notifikasi->getSupervisor()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getUser();?></td>
						<td><?php echo $notifikasi->issetUser() ? $notifikasi->getUser()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIcon();?></td>
						<td><?php echo $notifikasi->getIcon();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSubjek();?></td>
						<td><?php echo $notifikasi->getSubjek();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTeks();?></td>
						<td><?php echo $notifikasi->getTeks();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTautan();?></td>
						<td><?php echo $notifikasi->getTautan();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getDibaca();?></td>
						<td><?php echo isset($mapForDibaca) && isset($mapForDibaca[$notifikasi->getDibaca()]) && isset($mapForDibaca[$notifikasi->getDibaca()]["label"]) ? $mapForDibaca[$notifikasi->getDibaca()]["label"] : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuBuat();?></td>
						<td><?php echo $notifikasi->getWaktuBuat();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpBuat();?></td>
						<td><?php echo $notifikasi->getIpBuat();?></td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<?php if($userPermission->isAllowedUpdate()){ ?>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->notifikasi_id, $notifikasi->getNotifikasiId());?>';"><?php echo $appLanguage->getButtonUpdate();?></button>
							<?php } ?>
		
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonBackToList();?></button>
							<input type="hidden" name="notifikasi_id" value="<?php echo $notifikasi->getNotifikasiId();?>"/>
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
$appEntityLanguage = new AppEntityLanguage(new Notifikasi(), $appConfig, $currentUser->getLanguageId());
$mapForGrupPengguna = array(
	"supervisor" => array("value" => "supervisor", "label" => "Supervisor", "default" => "false"),
	"user" => array("value" => "user", "label" => "Admin", "default" => "false")
);
$mapForDibaca = array(
	"0" => array("value" => "0", "label" => "Belum Dibaca", "default" => "false"),
	"1" => array("value" => "1", "label" => "Sudah Dibaca", "default" => "false")
);
$specMap = array(
    "grupPengguna" => PicoSpecification::filter("grupPengguna", "fulltext"),
	"dibaca" => PicoSpecification::filter("dibaca", "number")
);
$sortOrderMap = array(
    "grupPengguna" => "grupPengguna",
	"supervisorId" => "supervisorId",
	"userId" => "userId",
	"icon" => "icon",
	"subjek" => "subjek",
	"teks" => "teks",
	"tautan" => "tautan",
	"dibaca" => "dibaca"
);

// You can define your own specifications
// Pay attention to security issues
$specification = PicoSpecification::fromUserInput($inputGet, $specMap);

// Additional filter here
$specification->addAnd(PicoPredicate::getInstance()->equals('grupPengguna', 'user'));
$specification->addAnd(PicoPredicate::getInstance()->equals('supervisorId', $currentAction->getUserId()));

// You can define your own sortable
// Pay attention to security issues
$sortable = PicoSortable::fromUserInput($inputGet, $sortOrderMap, array(
	array(
		"sortBy" => "waktuBuat", 
		"sortType" => PicoSort::ORDER_TYPE_DESC
	)
));

$pageable = new PicoPageable(new PicoPage($inputGet->getPage(), $appConfig->getData()->getPageSize()), $sortable);
$dataLoader = new Notifikasi(null, $database);

$subqueryMap = array(
"supervisorId" => array(
	"columnName" => "supervisor_id",
	"entityName" => "SupervisorMin",
	"tableName" => "supervisor",
	"primaryKey" => "supervisor_id",
	"objectName" => "supervisor",
	"propertyName" => "nama"
), 
"userId" => array(
	"columnName" => "user_id",
	"entityName" => "UserMin",
	"tableName" => "user",
	"primaryKey" => "user_id",
	"objectName" => "user",
	"propertyName" => "nama"
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
					<span class="filter-label"><?php echo $appEntityLanguage->getGrupPengguna();?></span>
					<span class="filter-control">
							<select name="grup_pengguna" class="form-control" data-value="<?php echo $inputGet->getGrupPengguna();?>">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="supervisor" <?php echo AppFormBuilder::selected($inputGet->getGrupPengguna(), 'supervisor');?>>Supervisor</option>
								<option value="user" <?php echo AppFormBuilder::selected($inputGet->getGrupPengguna(), 'user');?>>Admin</option>
							</select>
					</span>
				</span>
				
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getDibaca();?></span>
					<span class="filter-control">
							<select name="dibaca" class="form-control" data-value="<?php echo $inputGet->getDibaca();?>">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="" <?php echo AppFormBuilder::selected($inputGet->getDibaca(), '');?>>Semua</option>
								<option value="0" <?php echo AppFormBuilder::selected($inputGet->getDibaca(), '0');?>>Belum Dibaca</option>
								<option value="1" <?php echo AppFormBuilder::selected($inputGet->getDibaca(), '1');?>>Sudah Dibaca</option>
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
								<td class="data-controll data-selector" data-key="notifikasi_id">
									<input type="checkbox" class="checkbox check-master" data-selector=".checkbox-notifikasi-id"/>
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
								<td data-col-name="supervisor_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getSupervisor();?></a></td>
								<td data-col-name="user_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getUser();?></a></td>
								<td data-col-name="icon" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getIcon();?></a></td>
								<td data-col-name="subjek" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getSubjek();?></a></td>
								<td data-col-name="teks" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getTeks();?></a></td>
								<td data-col-name="tautan" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getTautan();?></a></td>
								<td data-col-name="dibaca" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getDibaca();?></a></td>
							</tr>
						</thead>
					
						<tbody data-offset="<?php echo $pageData->getDataOffset();?>">
							<?php 
							$dataIndex = 0;
							while($notifikasi = $pageData->fetch())
							{
								$dataIndex++;
							?>
		
							<tr data-number="<?php echo $pageData->getDataOffset() + $dataIndex;?>">
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-selector" data-key="notifikasi_id">
									<input type="checkbox" class="checkbox check-slave checkbox-notifikasi-id" name="checked_row_id[]" value="<?php echo $notifikasi->getNotifikasiId();?>"/>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedUpdate()){ ?>
								<td>
									<a class="edit-control" href="<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->notifikasi_id, $notifikasi->getNotifikasiId());?>"><span class="fa fa-edit"></span></a>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedDetail()){ ?>
								<td>
									<a class="detail-control field-master" href="<?php echo $currentModule->getRedirectUrl(UserAction::DETAIL, Field::of()->notifikasi_id, $notifikasi->getNotifikasiId());?>"><span class="fa fa-folder"></span></a>
								</td>
								<?php } ?>
								<td class="data-number"><?php echo $pageData->getDataOffset() + $dataIndex;?></td>
								<td data-col-name="grup_pengguna"><?php echo isset($mapForGrupPengguna) && isset($mapForGrupPengguna[$notifikasi->getGrupPengguna()]) && isset($mapForGrupPengguna[$notifikasi->getGrupPengguna()]["label"]) ? $mapForGrupPengguna[$notifikasi->getGrupPengguna()]["label"] : "";?></td>
								<td data-col-name="supervisor_id"><?php echo $notifikasi->issetSupervisor() ? $notifikasi->getSupervisor()->getNama() : "";?></td>
								<td data-col-name="user_id"><?php echo $notifikasi->issetUser() ? $notifikasi->getUser()->getNama() : "";?></td>
								<td data-col-name="icon"><?php echo $notifikasi->getIcon();?></td>
								<td data-col-name="subjek"><?php echo $notifikasi->getSubjek();?></td>
								<td data-col-name="teks"><?php echo $notifikasi->getTeks();?></td>
								<td data-col-name="tautan"><?php echo $notifikasi->getTautan();?></td>
								<td data-col-name="dibaca"><?php echo isset($mapForDibaca) && isset($mapForDibaca[$notifikasi->getDibaca()]) && isset($mapForDibaca[$notifikasi->getDibaca()]["label"]) ? $mapForDibaca[$notifikasi->getDibaca()]["label"] : "";?></td>
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


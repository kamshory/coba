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
use Sipro\Entity\Data\CatatanSalahLogin;
use Sipro\AppIncludeImpl;
use Sipro\Entity\Data\User;
use Sipro\Entity\Data\SupervisorMin;
use MagicApp\XLSX\DocumentWriter;
use MagicApp\XLSX\XLSXDataFormat;

require_once dirname(__DIR__) . "/inc.app/auth.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$currentModule = new PicoModule($appConfig, $database, $appModule, "/admin", "catatan-salah-login", "Catatan Salah Login");
$userPermission = new AppUserPermission($appConfig, $database, $appUserRole, $currentModule, $currentUser);
$appInclude = new AppIncludeImpl($appConfig, $currentModule);

if(!$userPermission->allowedAccess($inputGet, $inputPost))
{
	require_once $appInclude->appForbiddenPage(__DIR__);
	exit();
}

if($inputPost->getUserAction() == UserAction::DELETE)
{
	if($inputPost->countableCheckedRowId())
	{
		foreach($inputPost->getCheckedRowId() as $rowId)
		{
			try
			{
				$catatanSalahLogin = new CatatanSalahLogin(null, $database);
				$catatanSalahLogin->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->catatan_salah_login_id, $rowId))
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

if($inputGet->getUserAction() == UserAction::DETAIL)
{
	$catatanSalahLogin = new CatatanSalahLogin(null, $database);
	try{
		$subqueryMap = array(
		"userId" => array(
			"columnName" => "user_id",
			"entityName" => "User",
			"tableName" => "user",
			"primaryKey" => "user_id",
			"objectName" => "user",
			"propertyName" => "first_name"
		), 
		"supervisorId" => array(
			"columnName" => "supervisor_id",
			"entityName" => "Supervisor",
			"tableName" => "supervisor",
			"primaryKey" => "supervisor_id",
			"objectName" => "supervisor",
			"propertyName" => "nama"
		)
		);
		$catatanSalahLogin->findOneWithPrimaryKeyValue($inputGet->getCatatanSalahLoginId(), $subqueryMap);
		if($catatanSalahLogin->issetCatatanSalahLoginId())
		{
$appEntityLanguage = new AppEntityLanguage(new CatatanSalahLogin(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
			// define map here
			$mapForGrupPengguna = array(
				"supervisor" => array("value" => "supervisor", "label" => "Supervisor", "default" => "false"),
				"user" => array("value" => "user", "label" => "Admin", "default" => "false")
			);
?>
<div class="page page-jambi page-detail">
	<div class="jambi-wrapper">
		<?php
		if(UserAction::isRequireNextAction($inputGet) && UserAction::isRequireApproval($catatanSalahLogin->getWaitingFor()))
		{
				?>
				<div class="alert alert-info"><?php echo UserAction::getWaitingForMessage($appLanguage, $catatanSalahLogin->getWaitingFor());?></div>
				<?php
		}
		?>
		
		<form name="detailform" id="detailform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getGrupPengguna();?></td>
						<td><?php echo isset($mapForGrupPengguna) && isset($mapForGrupPengguna[$catatanSalahLogin->getGrupPengguna()]) && isset($mapForGrupPengguna[$catatanSalahLogin->getGrupPengguna()]["label"]) ? $mapForGrupPengguna[$catatanSalahLogin->getGrupPengguna()]["label"] : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getUser();?></td>
						<td><?php echo $catatanSalahLogin->issetUser() ? $catatanSalahLogin->getUser()->getFirstName() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSupervisor();?></td>
						<td><?php echo $catatanSalahLogin->issetSupervisor() ? $catatanSalahLogin->getSupervisor()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuBuat();?></td>
						<td><?php echo $catatanSalahLogin->getWaktuBuat();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpBuat();?></td>
						<td><?php echo $catatanSalahLogin->getIpBuat();?></td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonBackToList();?></button>
							<input type="hidden" name="catatan_salah_login_id" value="<?php echo $catatanSalahLogin->getCatatanSalahLoginId();?>"/>
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
$appEntityLanguage = new AppEntityLanguage(new CatatanSalahLogin(), $appConfig, $currentUser->getLanguageId());
$mapForGrupPengguna = array(
	"supervisor" => array("value" => "supervisor", "label" => "Supervisor", "default" => "false"),
	"user" => array("value" => "user", "label" => "Admin", "default" => "false")
);
$specMap = array(
	"grupPengguna" => PicoSpecification::filter("grupPengguna", "fulltext"),
	"userId" => PicoSpecification::filter("userId", "fulltext"),
	"supervisorId" => PicoSpecification::filter("supervisorId", "fulltext")
);
$sortOrderMap = array(
	"grupPengguna" => "grupPengguna",
	"userId" => "userId",
	"supervisorId" => "supervisorId",
	"waktuBuat" => "waktuBuat"
);

// You can define your own specifications
// Pay attention to security issues
$specification = PicoSpecification::fromUserInput($inputGet, $specMap);


// You can define your own sortable
// Pay attention to security issues
$sortable = PicoSortable::fromUserInput($inputGet, $sortOrderMap, array(
	array(
		"sortBy" => "waktuBuat", 
		"sortType" => PicoSort::ORDER_TYPE_DESC
	)
));

$pageable = new PicoPageable(new PicoPage($inputGet->getPage(), $appConfig->getData()->getPageSize()), $sortable);
$dataLoader = new CatatanSalahLogin(null, $database);

$subqueryMap = array(
"userId" => array(
	"columnName" => "user_id",
	"entityName" => "User",
	"tableName" => "user",
	"primaryKey" => "user_id",
	"objectName" => "user",
	"propertyName" => "first_name"
), 
"supervisorId" => array(
	"columnName" => "supervisor_id",
	"entityName" => "Supervisor",
	"tableName" => "supervisor",
	"primaryKey" => "supervisor_id",
	"objectName" => "supervisor",
	"propertyName" => "nama"
)
);

if($inputGet->getUserAction() == UserAction::EXPORT)
{
    $exporter = DocumentWriter::getCSVDocumentWriter($appLanguage);
    $fileName = $currentModule->getModuleName()."-".date("Y-m-d-H-i-s").".csv";
    $sheetName = "Sheet 1";

	$headerFormat = new XLSXDataFormat($dataLoader, 3);
	$pageData = $dataLoader->findAll($specification, null, $sortable, true, $subqueryMap, MagicObject::FIND_OPTION_NO_COUNT_DATA | MagicObject::FIND_OPTION_NO_FETCH_DATA);
	$exporter->write($pageData, $fileName, $sheetName, array(
		$appLanguage->getNumero() => $headerFormat->asNumber(),
		$appEntityLanguage->getCatatanSalahLoginId() => $headerFormat->getCatatanSalahLoginId(),
		$appEntityLanguage->getGrupPengguna() => $headerFormat->asString(),
		$appEntityLanguage->getUser() => $headerFormat->asString(),
		$appEntityLanguage->getSupervisor() => $headerFormat->asString(),
		$appEntityLanguage->getWaktuBuat() => $headerFormat->getWaktuBuat()
	), 
	function($index, $row, $appLanguage){
        global $mapForGrupPengguna;
		return array(
			sprintf("%d", $index + 1),
			$row->getCatatanSalahLoginId(),
			isset($mapForGrupPengguna) && isset($mapForGrupPengguna[$row->getGrupPengguna()]) && isset($mapForGrupPengguna[$row->getGrupPengguna()]["label"]) ? $mapForGrupPengguna[$row->getGrupPengguna()]["label"] : "",
			$row->issetUser() ? $row->getUser()->getFirstName() : "",
			$row->issetSupervisor() ? $row->getSupervisor()->getNama() : "",
			$row->getWaktuBuat()
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
					<span class="filter-label"><?php echo $appEntityLanguage->getUser();?></span>
					<span class="filter-control">
							<select name="user_id" class="form-control">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new User(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->active, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->firstName, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->userId, Field::of()->firstName, $inputGet->getUserId())
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
					<button type="submit" class="btn btn-success"><?php echo $appLanguage->getButtonSearch();?></button>
				</span>
				<?php if($userPermission->isAllowedDetail()){ ?>
		
				<span class="filter-group">
					<button type="submit" name="user_action" value="export" class="btn btn-success"><?php echo $appLanguage->getButtonExport();?></button>
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
								<td class="data-controll data-selector" data-key="catatan_salah_login_id">
									<input type="checkbox" class="checkbox check-master" data-selector=".checkbox-catatan-salah-login-id"/>
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
								<td data-col-name="waktu_buat" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getWaktuBuat();?></a></td>
							</tr>
						</thead>
					
						<tbody data-offset="<?php echo $pageData->getDataOffset();?>">
							<?php 
							$dataIndex = 0;
							while($catatanSalahLogin = $pageData->fetch())
							{
								$dataIndex++;
							?>
		
							<tr data-number="<?php echo $pageData->getDataOffset() + $dataIndex;?>">
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-selector" data-key="catatan_salah_login_id">
									<input type="checkbox" class="checkbox check-slave checkbox-catatan-salah-login-id" name="checked_row_id[]" value="<?php echo $catatanSalahLogin->getCatatanSalahLoginId();?>"/>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedDetail()){ ?>
								<td>
									<a class="detail-control field-master" href="<?php echo $currentModule->getRedirectUrl(UserAction::DETAIL, Field::of()->catatan_salah_login_id, $catatanSalahLogin->getCatatanSalahLoginId());?>"><span class="fa fa-folder"></span></a>
								</td>
								<?php } ?>
								<td class="data-number"><?php echo $pageData->getDataOffset() + $dataIndex;?></td>
								<td data-col-name="grup_pengguna"><?php echo isset($mapForGrupPengguna) && isset($mapForGrupPengguna[$catatanSalahLogin->getGrupPengguna()]) && isset($mapForGrupPengguna[$catatanSalahLogin->getGrupPengguna()]["label"]) ? $mapForGrupPengguna[$catatanSalahLogin->getGrupPengguna()]["label"] : "";?></td>
								<td data-col-name="user_id"><?php echo $catatanSalahLogin->issetUser() ? $catatanSalahLogin->getUser()->getFirstName() : "";?></td>
								<td data-col-name="supervisor_id"><?php echo $catatanSalahLogin->issetSupervisor() ? $catatanSalahLogin->getSupervisor()->getNama() : "";?></td>
								<td data-col-name="waktu_buat"><?php echo $catatanSalahLogin->getWaktuBuat();?></td>
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


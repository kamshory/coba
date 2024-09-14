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
use Sipro\Entity\Data\BillOfQuantityHistory;
use Sipro\AppIncludeImpl;
use Sipro\Entity\Data\ProyekMin;
use Sipro\Entity\Data\BillOfQuantityMin;
use MagicApp\XLSX\DocumentWriter;
use MagicApp\XLSX\XLSXDataFormat;

require_once dirname(__DIR__) . "/inc.app/auth.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$currentModule = new PicoModule($appConfig, $database, $appModule, "/admin", "bill-of-quantity-history", "Bill Of Quantity History");
$userPermission = new AppUserPermission($appConfig, $database, $appUserRole, $currentModule, $currentUser);
$appInclude = new AppIncludeImpl($appConfig, $currentModule);

if(!$userPermission->allowedAccess($inputGet, $inputPost))
{
	require_once $appInclude->appForbiddenPage(__DIR__);
	exit();
}

if($inputPost->getUserAction() == UserAction::CREATE)
{
	$billOfQuantityHistory = new BillOfQuantityHistory(null, $database);
	$billOfQuantityHistory->setBillOfQuantityId($inputPost->getBillOfQuantityId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$billOfQuantityHistory->setProyekId($inputPost->getProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$billOfQuantityHistory->setParentId($inputPost->getParentId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$billOfQuantityHistory->setLevel($inputPost->getLevel(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$billOfQuantityHistory->setNama($inputPost->getNama(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$billOfQuantityHistory->setSatuan($inputPost->getSatuan(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$billOfQuantityHistory->setVolume($inputPost->getVolume(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$billOfQuantityHistory->setHarga($inputPost->getHarga(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$billOfQuantityHistory->setSortOrder($inputPost->getSortOrder(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$billOfQuantityHistory->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$billOfQuantityHistory->setAdminBuat($currentUser->getUserId());
	$billOfQuantityHistory->setWaktuBuat($currentAction->getTime());
	$billOfQuantityHistory->setIpBuat($currentAction->getIp());
	$billOfQuantityHistory->setAdminUbah($currentUser->getUserId());
	$billOfQuantityHistory->setWaktuUbah($currentAction->getTime());
	$billOfQuantityHistory->setIpUbah($currentAction->getIp());
	$billOfQuantityHistory->insert();
	$newId = $billOfQuantityHistory->getBillOfQuantityHistoryId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->bill_of_quantity_history_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::UPDATE)
{
	$billOfQuantityHistory = new BillOfQuantityHistory(null, $database);
	$billOfQuantityHistory->setBillOfQuantityId($inputPost->getBillOfQuantityId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$billOfQuantityHistory->setProyekId($inputPost->getProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$billOfQuantityHistory->setParentId($inputPost->getParentId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$billOfQuantityHistory->setLevel($inputPost->getLevel(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$billOfQuantityHistory->setNama($inputPost->getNama(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$billOfQuantityHistory->setSatuan($inputPost->getSatuan(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$billOfQuantityHistory->setVolume($inputPost->getVolume(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$billOfQuantityHistory->setHarga($inputPost->getHarga(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$billOfQuantityHistory->setSortOrder($inputPost->getSortOrder(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$billOfQuantityHistory->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$billOfQuantityHistory->setAdminUbah($currentUser->getUserId());
	$billOfQuantityHistory->setWaktuUbah($currentAction->getTime());
	$billOfQuantityHistory->setIpUbah($currentAction->getIp());
	$billOfQuantityHistory->setBillOfQuantityHistoryId($inputPost->getBillOfQuantityHistoryId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$billOfQuantityHistory->update();
	$newId = $billOfQuantityHistory->getBillOfQuantityHistoryId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->bill_of_quantity_history_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::ACTIVATE)
{
	if($inputPost->countableCheckedRowId())
	{
		foreach($inputPost->getCheckedRowId() as $rowId)
		{
			$billOfQuantityHistory = new BillOfQuantityHistory(null, $database);
			try
			{
				$billOfQuantityHistory->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->billOfQuantityHistoryId, $rowId))
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
			$billOfQuantityHistory = new BillOfQuantityHistory(null, $database);
			try
			{
				$billOfQuantityHistory->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->billOfQuantityHistoryId, $rowId))
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
				$billOfQuantityHistory = new BillOfQuantityHistory(null, $database);
				$billOfQuantityHistory->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->equals(Field::of()->bill_of_quantity_history_id, $rowId))
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
$appEntityLanguage = new AppEntityLanguage(new BillOfQuantityHistory(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-insert">
	<div class="jambi-wrapper">
		<form name="createform" id="createform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getBillOfQuantityId();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="1" name="bill_of_quantity_id" id="bill_of_quantity_id"/>
						</td>
					</tr>
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
						<td><?php echo $appEntityLanguage->getParent();?></td>
						<td>
							<select class="form-control" name="parent_id" id="parent_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new BillOfQuantityMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->billOfQuantityId, Field::of()->nama)
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLevel();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="1" name="level" id="level"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="nama" id="nama"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSatuan();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="satuan" id="satuan"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getVolume();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="volume" id="volume"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getHarga();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="harga" id="harga"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSortOrder();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="number" step="1" name="sort_order" id="sort_order"/>
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
	$billOfQuantityHistory = new BillOfQuantityHistory(null, $database);
	try{
		$billOfQuantityHistory->findOneByBillOfQuantityHistoryId($inputGet->getBillOfQuantityHistoryId());
		if($billOfQuantityHistory->issetBillOfQuantityHistoryId())
		{
$appEntityLanguage = new AppEntityLanguage(new BillOfQuantityHistory(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-update">
	<div class="jambi-wrapper">
		<form name="updateform" id="updateform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getBillOfQuantityId();?></td>
						<td>
							<input class="form-control" type="number" step="1" name="bill_of_quantity_id" id="bill_of_quantity_id" value="<?php echo $billOfQuantityHistory->getBillOfQuantityId();?>" autocomplete="off"/>
						</td>
					</tr>
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
								Field::of()->proyekId, Field::of()->nama, $billOfQuantityHistory->getProyekId())
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getParent();?></td>
						<td>
							<select class="form-control" name="parent_id" id="parent_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new BillOfQuantityMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->billOfQuantityId, Field::of()->nama, $billOfQuantityHistory->getParentId())
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLevel();?></td>
						<td>
							<input class="form-control" type="number" step="1" name="level" id="level" value="<?php echo $billOfQuantityHistory->getLevel();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td>
							<input class="form-control" type="text" name="nama" id="nama" value="<?php echo $billOfQuantityHistory->getNama();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSatuan();?></td>
						<td>
							<input class="form-control" type="text" name="satuan" id="satuan" value="<?php echo $billOfQuantityHistory->getSatuan();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getVolume();?></td>
						<td>
							<input class="form-control" type="text" name="volume" id="volume" value="<?php echo $billOfQuantityHistory->getVolume();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getHarga();?></td>
						<td>
							<input class="form-control" type="text" name="harga" id="harga" value="<?php echo $billOfQuantityHistory->getHarga();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSortOrder();?></td>
						<td>
							<input class="form-control" type="number" step="1" name="sort_order" id="sort_order" value="<?php echo $billOfQuantityHistory->getSortOrder();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="aktif" id="aktif" value="1" <?php echo $billOfQuantityHistory->createCheckedAktif();?>/> <?php echo $appEntityLanguage->getAktif();?></label>
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
							<input type="hidden" name="bill_of_quantity_history_id" value="<?php echo $billOfQuantityHistory->getBillOfQuantityHistoryId();?>"/>
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
	$billOfQuantityHistory = new BillOfQuantityHistory(null, $database);
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
		"parentId" => array(
			"columnName" => "parent_id",
			"entityName" => "BillOfQuantityMin",
			"tableName" => "bill_of_quantity",
			"primaryKey" => "bill_of_quantity_id",
			"objectName" => "billOfQuantityMin",
			"propertyName" => "nama"
		)
		);
		$billOfQuantityHistory->findOneWithPrimaryKeyValue($inputGet->getBillOfQuantityHistoryId(), $subqueryMap);
		if($billOfQuantityHistory->issetBillOfQuantityHistoryId())
		{
$appEntityLanguage = new AppEntityLanguage(new BillOfQuantityHistory(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
			// define map here
			
?>
<div class="page page-jambi page-detail">
	<div class="jambi-wrapper">
		<?php
		if(UserAction::isRequireNextAction($inputGet) && UserAction::isRequireApproval($billOfQuantityHistory->getWaitingFor()))
		{
				?>
				<div class="alert alert-info"><?php echo UserAction::getWaitingForMessage($appLanguage, $billOfQuantityHistory->getWaitingFor());?></div>
				<?php
		}
		?>
		
		<form name="detailform" id="detailform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getBillOfQuantityId();?></td>
						<td><?php echo $billOfQuantityHistory->getBillOfQuantityId();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getProyek();?></td>
						<td><?php echo $billOfQuantityHistory->issetProyek() ? $billOfQuantityHistory->getProyek()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getParent();?></td>
						<td><?php echo $billOfQuantityHistory->issetBillOfQuantityMin() ? $billOfQuantityHistory->getBillOfQuantityMin()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getLevel();?></td>
						<td><?php echo $billOfQuantityHistory->getLevel();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td><?php echo $billOfQuantityHistory->getNama();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSatuan();?></td>
						<td><?php echo $billOfQuantityHistory->getSatuan();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getVolume();?></td>
						<td><?php echo $billOfQuantityHistory->getVolume();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getHarga();?></td>
						<td><?php echo $billOfQuantityHistory->getHarga();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getSortOrder();?></td>
						<td><?php echo $billOfQuantityHistory->getSortOrder();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAdminBuat();?></td>
						<td><?php echo $billOfQuantityHistory->getAdminBuat();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAdminUbah();?></td>
						<td><?php echo $billOfQuantityHistory->getAdminUbah();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuBuat();?></td>
						<td><?php echo $billOfQuantityHistory->getWaktuBuat();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuUbah();?></td>
						<td><?php echo $billOfQuantityHistory->getWaktuUbah();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpBuat();?></td>
						<td><?php echo $billOfQuantityHistory->getIpBuat();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpUbah();?></td>
						<td><?php echo $billOfQuantityHistory->getIpUbah();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td><?php echo $billOfQuantityHistory->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<?php if($userPermission->isAllowedUpdate()){ ?>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->bill_of_quantity_history_id, $billOfQuantityHistory->getBillOfQuantityHistoryId());?>';"><?php echo $appLanguage->getButtonUpdate();?></button>
							<?php } ?>
		
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonBackToList();?></button>
							<input type="hidden" name="bill_of_quantity_history_id" value="<?php echo $billOfQuantityHistory->getBillOfQuantityHistoryId();?>"/>
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
$appEntityLanguage = new AppEntityLanguage(new BillOfQuantityHistory(), $appConfig, $currentUser->getLanguageId());

$specMap = array(
    "proyekId" => PicoSpecification::filter("proyekId", "number"),
	"parentId" => PicoSpecification::filter("parentId", "number"),
	"nama" => PicoSpecification::filter("nama", "fulltext")
);
$sortOrderMap = array(
    "billOfQuantityId" => "billOfQuantityId",
	"proyekId" => "proyekId",
	"parentId" => "parentId",
	"level" => "level",
	"nama" => "nama",
	"satuan" => "satuan",
	"volume" => "volume",
	"harga" => "harga",
	"sortOrder" => "sortOrder",
	"aktif" => "aktif"
);

// You can define your own specifications
// Pay attention to security issues
$specification = PicoSpecification::fromUserInput($inputGet, $specMap);


// You can define your own sortable
// Pay attention to security issues
$sortable = PicoSortable::fromUserInput($inputGet, $sortOrderMap, array(
	array(
		"sortBy" => "parentId", 
		"sortType" => PicoSort::ORDER_TYPE_ASC
	),
	array(
		"sortBy" => "sortOrder", 
		"sortType" => PicoSort::ORDER_TYPE_ASC
	)
));

$pageable = new PicoPageable(new PicoPage($inputGet->getPage(), $appConfig->getData()->getPageSize()), $sortable);
$dataLoader = new BillOfQuantityHistory(null, $database);

$subqueryMap = array(
"proyekId" => array(
	"columnName" => "proyek_id",
	"entityName" => "ProyekMin",
	"tableName" => "proyek",
	"primaryKey" => "proyek_id",
	"objectName" => "proyek",
	"propertyName" => "nama"
), 
"parentId" => array(
	"columnName" => "parent_id",
	"entityName" => "BillOfQuantityMin",
	"tableName" => "bill_of_quantity",
	"primaryKey" => "bill_of_quantity_id",
	"objectName" => "billOfQuantityMin",
	"propertyName" => "nama"
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
		$appEntityLanguage->getBillOfQuantityHistoryId() => $headerFormat->getBillOfQuantityHistoryId(),
		$appEntityLanguage->getBillOfQuantityId() => $headerFormat->getBillOfQuantityId(),
		$appEntityLanguage->getProyek() => $headerFormat->asString(),
		$appEntityLanguage->getParent() => $headerFormat->asString(),
		$appEntityLanguage->getLevel() => $headerFormat->getLevel(),
		$appEntityLanguage->getNama() => $headerFormat->getNama(),
		$appEntityLanguage->getSatuan() => $headerFormat->getSatuan(),
		$appEntityLanguage->getVolume() => $headerFormat->getVolume(),
		$appEntityLanguage->getHarga() => $headerFormat->getHarga(),
		$appEntityLanguage->getSortOrder() => $headerFormat->getSortOrder(),
		$appEntityLanguage->getAdminBuat() => $headerFormat->getAdminBuat(),
		$appEntityLanguage->getAdminUbah() => $headerFormat->getAdminUbah(),
		$appEntityLanguage->getWaktuBuat() => $headerFormat->getWaktuBuat(),
		$appEntityLanguage->getWaktuUbah() => $headerFormat->getWaktuUbah(),
		$appEntityLanguage->getIpBuat() => $headerFormat->getIpBuat(),
		$appEntityLanguage->getIpUbah() => $headerFormat->getIpUbah(),
		$appEntityLanguage->getAktif() => $headerFormat->asString()
	), 
	function($index, $row, $appLanguage){
        
		return array(
			sprintf("%d", $index + 1),
			$row->getBillOfQuantityHistoryId(),
			$row->getBillOfQuantityId(),
			$row->issetProyek() ? $row->getProyek()->getNama() : "",
			$row->issetBillOfQuantityMin() ? $row->getBillOfQuantityMin()->getNama() : "",
			$row->getLevel(),
			$row->getNama(),
			$row->getSatuan(),
			$row->getVolume(),
			$row->getHarga(),
			$row->getSortOrder(),
			$row->getAdminBuat(),
			$row->getAdminUbah(),
			$row->getWaktuBuat(),
			$row->getWaktuUbah(),
			$row->getIpBuat(),
			$row->getIpUbah(),
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
					<span class="filter-label"><?php echo $appEntityLanguage->getProyek();?></span>
					<span class="filter-control">
							<select name="proyek_id" class="form-control">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new ProyekMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->proyekId, Field::of()->nama, $inputGet->getProyekId())
								; ?>
							</select>
					</span>
				</span>
				
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getParent();?></span>
					<span class="filter-control">
							<select name="parent_id" class="form-control">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new BillOfQuantityMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->billOfQuantityId, Field::of()->nama, $inputGet->getParentId())
								; ?>
							</select>
					</span>
				</span>
				
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
								<td class="data-controll data-selector" data-key="bill_of_quantity_history_id">
									<input type="checkbox" class="checkbox check-master" data-selector=".checkbox-bill-of-quantity-history-id"/>
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
								<td data-col-name="bill_of_quantity_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getBillOfQuantityId();?></a></td>
								<td data-col-name="proyek_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getProyek();?></a></td>
								<td data-col-name="parent_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getParent();?></a></td>
								<td data-col-name="level" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getLevel();?></a></td>
								<td data-col-name="nama" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getNama();?></a></td>
								<td data-col-name="satuan" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getSatuan();?></a></td>
								<td data-col-name="volume" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getVolume();?></a></td>
								<td data-col-name="harga" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getHarga();?></a></td>
								<td data-col-name="sort_order" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getSortOrder();?></a></td>
								<td data-col-name="aktif" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getAktif();?></a></td>
							</tr>
						</thead>
					
						<tbody data-offset="<?php echo $pageData->getDataOffset();?>">
							<?php 
							$dataIndex = 0;
							while($billOfQuantityHistory = $pageData->fetch())
							{
								$dataIndex++;
							?>
		
							<tr data-number="<?php echo $pageData->getDataOffset() + $dataIndex;?>">
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-selector" data-key="bill_of_quantity_history_id">
									<input type="checkbox" class="checkbox check-slave checkbox-bill-of-quantity-history-id" name="checked_row_id[]" value="<?php echo $billOfQuantityHistory->getBillOfQuantityHistoryId();?>"/>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedUpdate()){ ?>
								<td>
									<a class="edit-control" href="<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->bill_of_quantity_history_id, $billOfQuantityHistory->getBillOfQuantityHistoryId());?>"><span class="fa fa-edit"></span></a>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedDetail()){ ?>
								<td>
									<a class="detail-control field-master" href="<?php echo $currentModule->getRedirectUrl(UserAction::DETAIL, Field::of()->bill_of_quantity_history_id, $billOfQuantityHistory->getBillOfQuantityHistoryId());?>"><span class="fa fa-folder"></span></a>
								</td>
								<?php } ?>
								<td class="data-number"><?php echo $pageData->getDataOffset() + $dataIndex;?></td>
								<td data-col-name="bill_of_quantity_id"><?php echo $billOfQuantityHistory->getBillOfQuantityId();?></td>
								<td data-col-name="proyek_id"><?php echo $billOfQuantityHistory->issetProyek() ? $billOfQuantityHistory->getProyek()->getNama() : "";?></td>
								<td data-col-name="parent_id"><?php echo $billOfQuantityHistory->issetBillOfQuantityMin() ? $billOfQuantityHistory->getBillOfQuantityMin()->getNama() : "";?></td>
								<td data-col-name="level"><?php echo $billOfQuantityHistory->getLevel();?></td>
								<td data-col-name="nama"><?php echo $billOfQuantityHistory->getNama();?></td>
								<td data-col-name="satuan"><?php echo $billOfQuantityHistory->getSatuan();?></td>
								<td data-col-name="volume"><?php echo $billOfQuantityHistory->getVolume();?></td>
								<td data-col-name="harga"><?php echo $billOfQuantityHistory->getHarga();?></td>
								<td data-col-name="sort_order"><?php echo $billOfQuantityHistory->getSortOrder();?></td>
								<td data-col-name="aktif"><?php echo $billOfQuantityHistory->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
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


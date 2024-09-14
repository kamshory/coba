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
use MagicApp\PicoApproval;
use MagicApp\WaitingFor;
use MagicApp\UserAction;
use MagicApp\AppUserPermission;
use MagicApp\XLSX\DocumentWriter;
use MagicApp\XLSX\XLSXDataFormat;
use MagicObject\Util\PicoPasswordUtil;
use Sipro\Entity\Data\Supervisor;
use Sipro\AppIncludeImpl;
use Sipro\Entity\Data\SupervisorApv;
use Sipro\Entity\Data\SupervisorTrash;
use Sipro\Entity\Data\JabatanMin;

require_once dirname(__DIR__) . "/inc.app/auth.php";

$inputGet = new InputGet();
$inputPost = new InputPost();


$currentModule = new PicoModule($appConfig, $database, $appModule, "/admin", "supervisor", "Supervisor");
$userPermission = new AppUserPermission($appConfig, $database, $appUserRole, $currentModule, $currentUser);
$appInclude = new AppIncludeImpl($appConfig, $currentModule);

if(!$userPermission->allowedAccess($inputGet, $inputPost))
{
	require_once $appInclude->appForbiddenPage(__DIR__);
	exit();
}

if($inputPost->getUserAction() == UserAction::CREATE)
{
	$supervisor = new Supervisor(null, $database);
	$supervisor->setNip($inputPost->getNip(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisor->setUsername($inputPost->getUsername(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$password = $inputPost->getPassword(PicoFilterConstant::FILTER_DEFAULT, false, false, true);
	$util = new PicoPasswordUtil(PicoPasswordUtil::ALG_SHA1);
	try
	{
		$passwordHash = $util->getHash($password);
		$passwordHash = $util->getHash($passwordHash);
		$supervisor->setPassword($passwordHash);
	}
	catch(Exception $e)
	{
		// do nothing
	}
	$supervisor->setNama($inputPost->getNama(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisor->setKoordinator($inputPost->getKoordinator(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisor->setJabatanId($inputPost->getJabatanId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisor->setJenisKelamin($inputPost->getJenisKelamin(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisor->setTempatLahir($inputPost->getTempatLahir(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisor->setTanggalLahir($inputPost->getTanggalLahir(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisor->setEmail($inputPost->getEmail(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisor->setTelepon($inputPost->getTelepon(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisor->setIpTerakhirAktif($inputPost->getIpTerakhirAktif(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisor->setBlokir($inputPost->getBlokir(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisor->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$supervisor->setDraft(true);
	$supervisor->setWaitingFor(WaitingFor::CREATE);
	$supervisor->setAdminBuat($currentUser->getUserId());
	$supervisor->setWaktuBuat($currentAction->getTime());
	$supervisor->setIpBuat($currentAction->getIp());
	$supervisor->setAdminUbah($currentUser->getUserId());
	$supervisor->setWaktuUbah($currentAction->getTime());
	$supervisor->setIpUbah($currentAction->getIp());

	$supervisor->insert();

	$supervisorApv = new SupervisorApv($supervisor, $database);
	$supervisorApv->insert();
	$supervisorUpdate = new Supervisor(null, $database);
	$supervisorUpdate->setSupervisorId($supervisor->getSupervisorId())->setApprovalId($supervisorApv->getSupervisorApvId())->update();
	$newId = $supervisor->getSupervisorId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->supervisor_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::UPDATE)
{
	$supervisorApv = new SupervisorApv(null, $database);
	$supervisorApv->setNip($inputPost->getNip(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisorApv->setUsername($inputPost->getUsername(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$password = $inputPost->getPassword(PicoFilterConstant::FILTER_DEFAULT, false, false, true);
	$util = new PicoPasswordUtil();
	try
	{
		$passwordHash = $util->getHash($password);
		$passwordHash = $util->getHash($passwordHash);
		$supervisor->setPassword($passwordHash);
	}
	catch(Exception $e)
	{
		// do nothing
	}
	$supervisorApv->setNama($inputPost->getNama(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisorApv->setKoordinator($inputPost->getKoordinator(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisorApv->setJabatanId($inputPost->getJabatanId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisorApv->setJenisKelamin($inputPost->getJenisKelamin(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisorApv->setTempatLahir($inputPost->getTempatLahir(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisorApv->setTanggalLahir($inputPost->getTanggalLahir(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisorApv->setEmail($inputPost->getEmail(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisorApv->setTelepon($inputPost->getTelepon(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisorApv->setIpTerakhirAktif($inputPost->getIpTerakhirAktif(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$supervisorApv->setBlokir($inputPost->getBlokir(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$supervisorApv->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$supervisorApv->setAdminUbah($currentUser->getUserId());
	$supervisorApv->setWaktuUbah($currentAction->getTime());
	$supervisorApv->setIpUbah($currentAction->getIp());

	$supervisorApv->insert();

	$supervisor = new Supervisor(null, $database);
	$supervisor->setAdminMintaUbah($currentUser->getUserId());
	$supervisor->setWaktuMintaUbah($currentAction->getTime());
	$supervisor->setIpMintaUbah($currentAction->getIp());
	$supervisor->setSupervisorId($inputPost->getSupervisorId())->setApprovalId($supervisorApv->getSupervisorApvId())->setWaitingFor(WaitingFor::UPDATE)->update();
	$newId = $supervisor->getSupervisorId();
	$currentModule->redirectTo(UserAction::DETAIL, Field::of()->supervisor_id, $newId);
}
else if($inputPost->getUserAction() == UserAction::ACTIVATE)
{
	if($inputPost->countableCheckedRowId())
	{
		foreach($inputPost->getCheckedRowId() as $rowId)
		{
			$supervisor = new Supervisor(null, $database);
			try
			{
				$supervisor->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->setSupervisorId($rowId))
					->addAnd(
						PicoSpecification::getInstance()
							->addOr(PicoPredicate::getInstance()->equals(Field::of()->waitingFor, WaitingFor::NOTHING))
							->addOr(PicoPredicate::getInstance()->equals(Field::of()->waitingFor, null))
					)
					->addAnd(PicoPredicate::getInstance()->notEquals(Field::of()->aktif, true))
				)
				->setAdminMintaUbah($currentUser->getUserId())
				->setWaktuMintaUbah($currentAction->getTime())
				->setIpMintaUbah($currentAction->getIp())
				->setWaitingFor(WaitingFor::ACTIVATE)
				->update();
			}
			catch(Exception $e)
			{
				// Do something here when record is not found
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
			$supervisor = new Supervisor(null, $database);
			try
			{
				$supervisor->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->setSupervisorId($rowId))
					->addAnd(
						PicoSpecification::getInstance()
							->addOr(PicoPredicate::getInstance()->equals(Field::of()->waitingFor, WaitingFor::NOTHING))
							->addOr(PicoPredicate::getInstance()->equals(Field::of()->waitingFor, null))
					)
					->addAnd(PicoPredicate::getInstance()->notEquals(Field::of()->aktif, false))
				)
				->setAdminMintaUbah($currentUser->getUserId())
				->setWaktuMintaUbah($currentAction->getTime())
				->setIpMintaUbah($currentAction->getIp())
				->setWaitingFor(WaitingFor::DEACTIVATE)
				->update();
			}
			catch(Exception $e)
			{
				// Do something here when record is not found
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
			$supervisor = new Supervisor(null, $database);
			try
			{
				$supervisor->where(PicoSpecification::getInstance()
					->addAnd(PicoPredicate::getInstance()->setSupervisorId($rowId))
					->addAnd(
						PicoSpecification::getInstance()
							->addOr(PicoPredicate::getInstance()->equals(Field::of()->waitingFor, WaitingFor::NOTHING))
							->addOr(PicoPredicate::getInstance()->equals(Field::of()->waitingFor, null))
					)
				)
				->setAdminMintaUbah($currentUser->getUserId())
				->setWaktuMintaUbah($currentAction->getTime())
				->setIpMintaUbah($currentAction->getIp())
				->setWaitingFor(WaitingFor::DELETE)
				->update();
			}
			catch(Exception $e)
			{
				// Do something here when record is not found
			}
		}
	}
	$currentModule->redirectToItself();
}
else if($inputPost->getUserAction() == UserAction::APPROVE)
{
	if($inputPost->issetSupervisorId())
	{
		$supervisorId = $inputPost->getSupervisorId();
		$supervisor = new Supervisor(null, $database);
		$supervisor->findOneBySupervisorId($supervisorId);
		if($supervisor->issetSupervisorId())
		{
			$approval = new PicoApproval(
			$supervisor, 
			$entityInfo, 
			$entityApvInfo, 
			function($param1 = null, $param2 = null, $param3 = null, $userId = null) {
				// approval validation here
				// if the return is incorrect, approval cannot take place
				
				// e.g. return $param1->notEqualsAdminMintaUbah($userId);
				return true;
			}, 
			true, 
			new SupervisorTrash() 
			);

			$approvalCallback = new SetterGetter();
			$approvalCallback->setAfterInsert(function($param1 = null, $param2 = null, $param3 = null) {
				// callback on new data
				// your code goes here
				
				return true;
			}); 

			$approvalCallback->setBeforeUpdate(function($param1 = null, $param2 = null, $param3 = null) {
				// callback before update data
				// your code goes here
				
			}); 

			$approvalCallback->setAfterUpdate(function($param1 = null, $param2 = null, $param3 = null) {
				// callback after update data
				// your code goes here
				
			}); 

			$approvalCallback->setAfterActivate(function($param1 = null, $param2 = null, $param3 = null) {
				// callback after activate data
				// your code goes here
				
			}); 

			$approvalCallback->setAfterDeactivate(function($param1 = null, $param2 = null, $param3 = null) {
				// callback after deactivate data
				// your code goes here
				
			}); 

			$approvalCallback->setBeforeDelete(function($param1 = null, $param2 = null, $param3 = null) {
				// callback before delete data
				// your code goes here
				
			}); 

			$approvalCallback->setAfterDelete(function($param1 = null, $param2 = null, $param3 = null) {
				// callback after delete data
				// your code goes here
				
			}); 

			$approvalCallback->setAfterApprove(function($param1 = null, $param2 = null, $param3 = null) {
				// callback after approve data
				// your code goes here
				
			}); 

			// List of properties to be copied from SupervisorApv to Supervisor when when the user approves data modification. You can add or remove them.
			$columToBeCopied = array(
				Field::of()->nip, 
				Field::of()->username, 
				Field::of()->password, 
				Field::of()->nama, 
				Field::of()->koordinator, 
				Field::of()->jabatanId, 
				Field::of()->jenisKelamin, 
				Field::of()->tempatLahir, 
				Field::of()->tanggalLahir, 
				Field::of()->email, 
				Field::of()->telepon, 
				Field::of()->ipTerakhirAktif, 
				Field::of()->blokir, 
				Field::of()->aktif
			);

			$approval->approve($columToBeCopied, new SupervisorApv(), new SupervisorTrash(), 
			$currentUser->getUserId(),  
			$currentAction->getTime(),  
			$currentAction->getIp(), 
			$approvalCallback);
		}
	}
	$currentModule->redirectToItselfWithRequireApproval();
}
else if($inputPost->getUserAction() == UserAction::REJECT)
{
	if($inputPost->issetSupervisorId())
	{
		$supervisorId = $inputPost->getSupervisorId();
		$supervisor = new Supervisor(null, $database);
		$supervisor->findOneBySupervisorId($supervisorId);
		if($supervisor->issetSupervisorId())
		{
			$approval = new PicoApproval(
			$supervisor, 
			$entityInfo, 
			$entityApvInfo, 
			function($param1 = null, $param2 = null, $param3 = null, $userId = null) {
				// approval validation here
				// if the return is incorrect, approval cannot take place
				
				// e.g. return $param1->notEqualsAdminMintaUbah($userId);
				return true;
			}			);


			$approvalCallback = new SetterGetter();
			$approvalCallback->setBeforeReject(function($param1 = null, $param2 = null, $param3 = null) {
				// callback before reject data
				// your code goes here
				
			}); 

			$approvalCallback->setAfterReject(function($param1 = null, $param2 = null, $param3 = null) {
				// callback after reject data
				// your code goes here
				
			}); 

			$approval->reject(new SupervisorApv(),
			$currentUser->getUserId(),  
			$currentAction->getTime(),  
			$currentAction->getIp(), 
			$approvalCallback
			);
		}
	}
	$currentModule->redirectToItselfWithRequireApproval();
}
if($inputGet->getUserAction() == UserAction::CREATE)
{
$appEntityLanguage = new AppEntityLanguage(new Supervisor(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-insert">
	<div class="jambi-wrapper">
		<form name="createform" id="createform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getNip();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="nip" id="nip"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getUsername();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="username" id="username"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getPassword();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="password" name="password" id="password"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="nama" id="nama"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getKoordinator();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="koordinator" id="koordinator" value="1"/> <?php echo $appEntityLanguage->getKoordinator();?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getJabatan();?></td>
						<td>
							<select class="form-control" name="jabatan_id" id="jabatan_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new JabatanMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->jabatanId, Field::of()->nama)
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getJenisKelamin();?></td>
						<td>
							<select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="L">Laki-Laki</option>
								<option value="P">Perempuan</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTempatLahir();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="tempat_lahir" id="tempat_lahir"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTanggalLahir();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="date" name="tanggal_lahir" id="tanggal_lahir"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getEmail();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="email" id="email"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTelepon();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="telepon" id="telepon"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpTerakhirAktif();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="ip_terakhir_aktif" id="ip_terakhir_aktif"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getBlokir();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="blokir" id="blokir" value="1"/> <?php echo $appEntityLanguage->getBlokir();?></label>
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
	$supervisor = new Supervisor(null, $database);
	try{
		$supervisor->findOneBySupervisorId($inputGet->getSupervisorId());
		if($supervisor->hasValueSupervisorId())
		{
$appEntityLanguage = new AppEntityLanguage(new Supervisor(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
		if(!UserAction::isRequireApproval($supervisor->getWaitingFor()))
		{
?>
<div class="page page-jambi page-update">
	<div class="jambi-wrapper">
		<form name="updateform" id="updateform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getNip();?></td>
						<td>
							<input class="form-control" type="text" name="nip" id="nip" value="<?php echo $supervisor->getNip();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getUsername();?></td>
						<td>
							<input class="form-control" type="text" name="username" id="username" value="<?php echo $supervisor->getUsername();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getPassword();?></td>
						<td>
							<input class="form-control" type="password" name="password" id="password" value="" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td>
							<input class="form-control" type="text" name="nama" id="nama" value="<?php echo $supervisor->getNama();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getKoordinator();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="koordinator" id="koordinator" value="1" <?php echo $supervisor->createCheckedKoordinator();?>/> <?php echo $appEntityLanguage->getKoordinator();?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getJabatan();?></td>
						<td>
							<select class="form-control" name="jabatan_id" id="jabatan_id">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new JabatanMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->jabatanId, Field::of()->nama, $supervisor->getJabatanId())
								; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getJenisKelamin();?></td>
						<td>
							<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" data-value="<?php echo $supervisor->getJenisKelamin();?>">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="L" <?php echo AppFormBuilder::selected($supervisor->getJenisKelamin(), 'L');?>>Laki-Laki</option>
								<option value="P" <?php echo AppFormBuilder::selected($supervisor->getJenisKelamin(), 'P');?>>Perempuan</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTempatLahir();?></td>
						<td>
							<input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir" value="<?php echo $supervisor->getTempatLahir();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTanggalLahir();?></td>
						<td>
							<input class="form-control" type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo $supervisor->getTanggalLahir();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getEmail();?></td>
						<td>
							<input class="form-control" type="text" name="email" id="email" value="<?php echo $supervisor->getEmail();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTelepon();?></td>
						<td>
							<input class="form-control" type="text" name="telepon" id="telepon" value="<?php echo $supervisor->getTelepon();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpTerakhirAktif();?></td>
						<td>
							<input class="form-control" type="text" name="ip_terakhir_aktif" id="ip_terakhir_aktif" value="<?php echo $supervisor->getIpTerakhirAktif();?>" autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getBlokir();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="blokir" id="blokir" value="1" <?php echo $supervisor->createCheckedBlokir();?>/> <?php echo $appEntityLanguage->getBlokir();?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td>
							<label><input class="form-check-input" type="checkbox" name="aktif" id="aktif" value="1" <?php echo $supervisor->createCheckedAktif();?>/> <?php echo $appEntityLanguage->getAktif();?></label>
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
							<input type="hidden" name="supervisor_id" value="<?php echo $supervisor->getSupervisorId();?>"/>
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
			?>
			<div class="alert alert-warning"><?php echo $appLanguage->getMessageNoneditableDataWaitingApproval();?></div>
			<div class="button-area"><button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonBackToList();?></button></div>
			<?php
		}
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
	$supervisor = new Supervisor(null, $database);
	try{
		$subqueryMap = array(
		"jabatanId" => array(
			"columnName" => "jabatan_id",
			"entityName" => "JabatanMin",
			"tableName" => "jabatan",
			"primaryKey" => "jabatan_id",
			"objectName" => "jabatan",
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
		$supervisor->findOneWithPrimaryKeyValue($inputGet->getSupervisorId(), $subqueryMap);
		if($supervisor->hasValueSupervisorId())
		{
			// define map here
			$mapForJenisKelamin = array(
				"L" => array("value" => "L", "label" => "Laki-Laki", "default" => "true"),
				"P" => array("value" => "P", "label" => "Perempuan", "default" => "true")
			);
			if(UserAction::isRequireNextAction($inputGet) && $supervisor->notNullApprovalId())
			{
				$supervisorApv = new SupervisorApv(null, $database);
				try
				{
					$supervisorApv->findOneWithPrimaryKeyValue($supervisor->getApprovalId(), $subqueryMap);
				}
				catch(Exception $e)
				{
					// do something here
				}
$appEntityLanguage = new AppEntityLanguage(new Supervisor(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-detail">
	<div class="jambi-wrapper">
		<form name="detailform" id="detailform" action="" method="post">
			<div class="alert alert-info">	
			<?php
			echo UserAction::getWaitingForMessage($appLanguage, $supervisor->getWaitingFor());
			?>
			</div>
			<table class="responsive responsive-three-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<thead>
					<tr>
						<td><?php echo $appLanguage->getColumnName();?></td>
						<td><?php echo $appLanguage->getValueBefore();?></td>
						<td><?php echo $appLanguage->getValueAfter();?></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getNip();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsNip($supervisorApv->getNip()));?>"><?php echo $supervisor->getNip();?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsNip($supervisorApv->getNip()));?>"><?php echo $supervisorApv->getNip();?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getUsername();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsUsername($supervisorApv->getUsername()));?>"><?php echo $supervisor->getUsername();?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsUsername($supervisorApv->getUsername()));?>"><?php echo $supervisorApv->getUsername();?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsNama($supervisorApv->getNama()));?>"><?php echo $supervisor->getNama();?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsNama($supervisorApv->getNama()));?>"><?php echo $supervisorApv->getNama();?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getKoordinator();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsKoordinator($supervisorApv->getKoordinator()));?>"><?php echo $supervisor->optionKoordinator($appLanguage->getYes(), $appLanguage->getNo());?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsKoordinator($supervisorApv->getKoordinator()));?>"><?php echo $supervisorApv->optionKoordinator($appLanguage->getYes(), $appLanguage->getNo());?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getJabatan();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsJabatanId($supervisorApv->getJabatanId()));?>"><?php echo $supervisor->hasValueJabatan() ? $supervisor->getJabatan()->getNama() : "";?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsJabatanId($supervisorApv->getJabatanId()));?>"><?php echo $supervisorApv->hasValueJabatan() ? $supervisorApv->getJabatan()->getNama() : "";?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getJenisKelamin();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsJenisKelamin($supervisorApv->getJenisKelamin()));?>"><?php echo isset($mapForJenisKelamin) && isset($mapForJenisKelamin[$supervisor->getJenisKelamin()]) && isset($mapForJenisKelamin[$supervisor->getJenisKelamin()]["label"]) ? $mapForJenisKelamin[$supervisor->getJenisKelamin()]["label"] : "";?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsJenisKelamin($supervisorApv->getJenisKelamin()));?>"><?php echo isset($mapForJenisKelamin) && isset($mapForJenisKelamin[$supervisorApv->getJenisKelamin()]) && isset($mapForJenisKelamin[$supervisorApv->getJenisKelamin()]["label"]) ? $mapForJenisKelamin[$supervisorApv->getJenisKelamin()]["label"] : "";?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTempatLahir();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsTempatLahir($supervisorApv->getTempatLahir()));?>"><?php echo $supervisor->getTempatLahir();?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsTempatLahir($supervisorApv->getTempatLahir()));?>"><?php echo $supervisorApv->getTempatLahir();?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTanggalLahir();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsTanggalLahir($supervisorApv->getTanggalLahir()));?>"><?php echo $supervisor->getTanggalLahir();?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsTanggalLahir($supervisorApv->getTanggalLahir()));?>"><?php echo $supervisorApv->getTanggalLahir();?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getEmail();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsEmail($supervisorApv->getEmail()));?>"><?php echo $supervisor->getEmail();?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsEmail($supervisorApv->getEmail()));?>"><?php echo $supervisorApv->getEmail();?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTelepon();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsTelepon($supervisorApv->getTelepon()));?>"><?php echo $supervisor->getTelepon();?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsTelepon($supervisorApv->getTelepon()));?>"><?php echo $supervisorApv->getTelepon();?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuBuat();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsWaktuBuat($supervisorApv->getWaktuBuat()));?>"><?php echo $supervisor->getWaktuBuat();?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsWaktuBuat($supervisorApv->getWaktuBuat()));?>"><?php echo $supervisorApv->getWaktuBuat();?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuUbah();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsWaktuUbah($supervisorApv->getWaktuUbah()));?>"><?php echo $supervisor->getWaktuUbah();?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsWaktuUbah($supervisorApv->getWaktuUbah()));?>"><?php echo $supervisorApv->getWaktuUbah();?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuTerakhirAktif();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsWaktuTerakhirAktif($supervisorApv->getWaktuTerakhirAktif()));?>"><?php echo $supervisor->getWaktuTerakhirAktif();?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsWaktuTerakhirAktif($supervisorApv->getWaktuTerakhirAktif()));?>"><?php echo $supervisorApv->getWaktuTerakhirAktif();?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpBuat();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsIpBuat($supervisorApv->getIpBuat()));?>"><?php echo $supervisor->getIpBuat();?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsIpBuat($supervisorApv->getIpBuat()));?>"><?php echo $supervisorApv->getIpBuat();?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpUbah();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsIpUbah($supervisorApv->getIpUbah()));?>"><?php echo $supervisor->getIpUbah();?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsIpUbah($supervisorApv->getIpUbah()));?>"><?php echo $supervisorApv->getIpUbah();?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpTerakhirAktif();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsIpTerakhirAktif($supervisorApv->getIpTerakhirAktif()));?>"><?php echo $supervisor->getIpTerakhirAktif();?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsIpTerakhirAktif($supervisorApv->getIpTerakhirAktif()));?>"><?php echo $supervisorApv->getIpTerakhirAktif();?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAdminBuat();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsAdminBuat($supervisorApv->getAdminBuat()));?>"><?php echo $supervisor->hasValuePembuat() ? $supervisor->getPembuat()->getFirstName() : "";?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsAdminBuat($supervisorApv->getAdminBuat()));?>"><?php echo $supervisorApv->hasValuePembuat() ? $supervisorApv->getPembuat()->getFirstName() : "";?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAdminUbah();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsAdminUbah($supervisorApv->getAdminUbah()));?>"><?php echo $supervisor->hasValuePengubah() ? $supervisor->getPengubah()->getFirstName() : "";?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsAdminUbah($supervisorApv->getAdminUbah()));?>"><?php echo $supervisorApv->hasValuePengubah() ? $supervisorApv->getPengubah()->getFirstName() : "";?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getBlokir();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsBlokir($supervisorApv->getBlokir()));?>"><?php echo $supervisor->optionBlokir($appLanguage->getYes(), $appLanguage->getNo());?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsBlokir($supervisorApv->getBlokir()));?>"><?php echo $supervisorApv->optionBlokir($appLanguage->getYes(), $appLanguage->getNo());?></span>
						</td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsAktif($supervisorApv->getAktif()));?>"><?php echo $supervisor->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></span>
						</td>
						<td>
							<span class="<?php echo AppFormBuilder::classCompareData($supervisor->notEqualsAktif($supervisorApv->getAktif()));?>"><?php echo $supervisorApv->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></span>
						</td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<?php
							if($inputGet->getNextAction() == UserAction::APPROVAL)
							{
							?>
							<button type="submit" class="btn btn-success" name="user_action" value="<?php echo UserAction::APPROVE;?>"><?php echo $appLanguage->getButtonApprove();?></button>
							<button type="submit" class="btn btn-warning" name="user_action" value="<?php echo UserAction::REJECT;?>"><?php echo $appLanguage->getButtonReject();?></button>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonCancel();?></button>
							<input type="hidden" name="supervisor_id" value="<?php echo $supervisor->getSupervisorId();?>"/>
							<?php
							}
							else if($inputGet->getNextAction() == UserAction::APPROVE)
							{
							?>
							<button type="submit" class="btn btn-success" name="user_action" value="<?php echo UserAction::APPROVE;?>"><?php echo $appLanguage->getButtonApprove();?></button>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonCancel();?></button>
							<input type="hidden" name="supervisor_id" value="<?php echo $supervisor->getSupervisorId();?>"/>
							<?php
							}
							else
							{
							?>
							<button type="submit" class="btn btn-warning" name="user_action" value="<?php echo UserAction::REJECT;?>"><?php echo $appLanguage->getButtonReject();?></button>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonCancel();?></button>
							<input type="hidden" name="supervisor_id" value="<?php echo $supervisor->getSupervisorId();?>"/>
							<?php
							}
							?>
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
$appEntityLanguage = new AppEntityLanguage(new Supervisor(), $appConfig, $currentUser->getLanguageId());
require_once $appInclude->mainAppHeader(__DIR__);
?>
<div class="page page-jambi page-detail">
	<div class="jambi-wrapper">
		<?php
		if(UserAction::isRequireNextAction($inputGet) && UserAction::isRequireApproval($supervisor->getWaitingFor()))
		{
				?>
				<div class="alert alert-info"><?php echo UserAction::getWaitingForMessage($appLanguage, $supervisor->getWaitingFor());?></div>
				<?php
		}
		?>
		
		<form name="detailform" id="detailform" action="" method="post">
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td><?php echo $appEntityLanguage->getNip();?></td>
						<td><?php echo $supervisor->getNip();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getUsername();?></td>
						<td><?php echo $supervisor->getUsername();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getNama();?></td>
						<td><?php echo $supervisor->getNama();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getKoordinator();?></td>
						<td><?php echo $supervisor->optionKoordinator($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getJabatan();?></td>
						<td><?php echo $supervisor->hasValueJabatan() ? $supervisor->getJabatan()->getNama() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getJenisKelamin();?></td>
						<td><?php echo isset($mapForJenisKelamin) && isset($mapForJenisKelamin[$supervisor->getJenisKelamin()]) && isset($mapForJenisKelamin[$supervisor->getJenisKelamin()]["label"]) ? $mapForJenisKelamin[$supervisor->getJenisKelamin()]["label"] : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTempatLahir();?></td>
						<td><?php echo $supervisor->getTempatLahir();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTanggalLahir();?></td>
						<td><?php echo $supervisor->getTanggalLahir();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getEmail();?></td>
						<td><?php echo $supervisor->getEmail();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getTelepon();?></td>
						<td><?php echo $supervisor->getTelepon();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuBuat();?></td>
						<td><?php echo $supervisor->getWaktuBuat();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuUbah();?></td>
						<td><?php echo $supervisor->getWaktuUbah();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getWaktuTerakhirAktif();?></td>
						<td><?php echo $supervisor->getWaktuTerakhirAktif();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpBuat();?></td>
						<td><?php echo $supervisor->getIpBuat();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpUbah();?></td>
						<td><?php echo $supervisor->getIpUbah();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getIpTerakhirAktif();?></td>
						<td><?php echo $supervisor->getIpTerakhirAktif();?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAdminBuat();?></td>
						<td><?php echo $supervisor->hasValuePembuat() ? $supervisor->getPembuat()->getFirstName() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAdminUbah();?></td>
						<td><?php echo $supervisor->hasValuePengubah() ? $supervisor->getPengubah()->getFirstName() : "";?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getBlokir();?></td>
						<td><?php echo $supervisor->optionBlokir($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
					<tr>
						<td><?php echo $appEntityLanguage->getAktif();?></td>
						<td><?php echo $supervisor->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
					</tr>
				</tbody>
			</table>
			<table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td></td>
						<td>
							<?php if($inputGet->getNextAction() == UserAction::APPROVAL && UserAction::isRequireApproval($supervisor->getWaitingFor()) && $userPermission->isAllowedApprove()){ ?>
							<button type="submit" class="btn btn-success" name="user_action" value="<?php echo UserAction::APPROVE;?>"><?php echo $appLanguage->getButtonApprove();?></button>
							<button type="submit" class="btn btn-warning" name="user_action" value="<?php echo UserAction::REJECT;?>"><?php echo $appLanguage->getButtonReject();?></button>
							<?php } else if($inputGet->getNextAction() == UserAction::APPROVE && UserAction::isRequireApproval($supervisor->getWaitingFor()) && $userPermission->isAllowedApprove()){ ?>
							<button type="submit" class="btn btn-success" name="user_action" value="<?php echo UserAction::APPROVE;?>"><?php echo $appLanguage->getButtonApprove();?></button>
							<?php } else if($inputGet->getNextAction() == UserAction::REJECT && UserAction::isRequireApproval($supervisor->getWaitingFor()) && $userPermission->isAllowedApprove()){ ?>
							<button type="submit" class="btn btn-warning" name="user_action" value="<?php echo UserAction::REJECT;?>"><?php echo $appLanguage->getButtonReject();?></button>
							<?php } else if($userPermission->isAllowedUpdate()){ ?>
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->supervisor_id, $supervisor->getSupervisorId());?>';"><?php echo $appLanguage->getButtonUpdate();?></button>
							<?php } ?>
		
							<button type="button" class="btn btn-primary" onclick="window.location='<?php echo $currentModule->getRedirectUrl();?>';"><?php echo $appLanguage->getButtonBackToList();?></button>
							<input type="hidden" name="supervisor_id" value="<?php echo $supervisor->getSupervisorId();?>"/>
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
		}
		else
		{
require_once $appInclude->mainAppHeader(__DIR__);
			// Do somtething here when data is not found
			?>
			<div class="alert alert-warning"><?php echo $appLanguage->getMessageDataNotFound();?></div>
			<?php
require_once $appInclude->mainAppFooter(__DIR__);
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
$appEntityLanguage = new AppEntityLanguage(new Supervisor(), $appConfig, $currentUser->getLanguageId());
$mapForJenisKelamin = array(
	"L" => array("value" => "L", "label" => "Laki-Laki", "default" => "true"),
	"P" => array("value" => "P", "label" => "Perempuan", "default" => "true")
);
$specMap = array(
	"nama" => PicoSpecification::filter("nama", "fulltext"),
	"jabatanId" => PicoSpecification::filter("jabatanId", "number"),
	"blokir" => PicoSpecification::filter("blokir", "boolean"),
	"aktif" => PicoSpecification::filter("aktif", "boolean")
);
$sortOrderMap = array(
	"nip" => "nip",
	"username" => "username",
	"nama" => "nama",
	"koordinator" => "koordinator",
	"jabatanId" => "jabatanId",
	"jenisKelamin" => "jenisKelamin",
	"blokir" => "blokir",
	"aktif" => "aktif"
);

// You can define your own specifications
// Pay attention to security issues
$specification = PicoSpecification::fromUserInput($inputGet, $specMap);

if($inputGet->isShowRequireApprovalOnly()){
	$specification->addAnd(PicoPredicate::getInstance()->notEquals(Field::of()->waitingFor, WaitingFor::NOTHING));
	$specification->addAnd(PicoPredicate::getInstance()->notEquals(Field::of()->waitingFor, null));
}

// You can define your own sortable
// Pay attention to security issues
$sortable = PicoSortable::fromUserInput($inputGet, $sortOrderMap, array(
	array(
		"sortBy" => "nama", 
		"sortType" => PicoSort::ORDER_TYPE_ASC
	)
));

$pageable = new PicoPageable(new PicoPage($inputGet->getPage(), $appConfig->getData()->getPageSize()), $sortable);
$dataLoader = new Supervisor(null, $database);

$subqueryMap = array(
"jabatanId" => array(
	"columnName" => "jabatan_id",
	"entityName" => "JabatanMin",
	"tableName" => "jabatan",
	"primaryKey" => "jabatan_id",
	"objectName" => "jabatan",
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

if($inputGet->getUserAction() == UserAction::EXPORT)
{
	$exporter = DocumentWriter::getCSVDocumentWriter($appLanguage);
	$fileName = $currentModule->getModuleName()."-".date("Y-m-d-H-i-s").".csv";
	$sheetName = "Sheet 1";

	$headerFormat = new XLSXDataFormat($dataLoader, 3);
	$pageData = $dataLoader->findAll($specification, null, $sortable, true, $subqueryMap, MagicObject::FIND_OPTION_NO_COUNT_DATA | MagicObject::FIND_OPTION_NO_FETCH_DATA);
	$exporter->write($pageData, $fileName, $sheetName, array(
		$appLanguage->getNumero() => $headerFormat->asNumber(),
		$appEntityLanguage->getSupervisorId() => $headerFormat->getSupervisorId(),
		$appEntityLanguage->getNip() => $headerFormat->getNip(),
		$appEntityLanguage->getUsername() => $headerFormat->getUsername(),
		$appEntityLanguage->getNama() => $headerFormat->getNama(),
		$appEntityLanguage->getKoordinator() => $headerFormat->asString(),
		$appEntityLanguage->getJabatan() => $headerFormat->asString(),
		$appEntityLanguage->getJenisKelamin() => $headerFormat->asString(),
		$appEntityLanguage->getTempatLahir() => $headerFormat->getTempatLahir(),
		$appEntityLanguage->getTanggalLahir() => $headerFormat->getTanggalLahir(),
		$appEntityLanguage->getEmail() => $headerFormat->getEmail(),
		$appEntityLanguage->getTelepon() => $headerFormat->getTelepon(),
		$appEntityLanguage->getWaktuBuat() => $headerFormat->getWaktuBuat(),
		$appEntityLanguage->getWaktuUbah() => $headerFormat->getWaktuUbah(),
		$appEntityLanguage->getWaktuTerakhirAktif() => $headerFormat->getWaktuTerakhirAktif(),
		$appEntityLanguage->getIpBuat() => $headerFormat->getIpBuat(),
		$appEntityLanguage->getIpUbah() => $headerFormat->getIpUbah(),
		$appEntityLanguage->getIpTerakhirAktif() => $headerFormat->getIpTerakhirAktif(),
		$appEntityLanguage->getAdminBuat() => $headerFormat->asString(),
		$appEntityLanguage->getAdminUbah() => $headerFormat->asString(),
		$appEntityLanguage->getBlokir() => $headerFormat->asString(),
		$appEntityLanguage->getAktif() => $headerFormat->asString()
	), 
	function($index, $row, $appLanguage){
		global $mapForJenisKelamin;
		return array(
			sprintf("%d", $index + 1),
			$row->getSupervisorId(),
			$row->getNip(),
			$row->getUsername(),
			$row->getNama(),
			$row->optionKoordinator($appLanguage->getYes(), $appLanguage->getNo()),
			$row->hasValueJabatan() ? $row->getJabatan()->getNama() : "",
			isset($mapForJenisKelamin) && isset($mapForJenisKelamin[$row->getJenisKelamin()]) && isset($mapForJenisKelamin[$row->getJenisKelamin()]["label"]) ? $mapForJenisKelamin[$row->getJenisKelamin()]["label"] : "",
			$row->getTempatLahir(),
			$row->getTanggalLahir(),
			$row->getEmail(),
			$row->getTelepon(),
			$row->getWaktuBuat(),
			$row->getWaktuUbah(),
			$row->getWaktuTerakhirAktif(),
			$row->getIpBuat(),
			$row->getIpUbah(),
			$row->getIpTerakhirAktif(),
			$row->hasValuePembuat() ? $row->getPembuat()->getFirstName() : "",
			$row->hasValuePengubah() ? $row->getPengubah()->getFirstName() : "",
			$row->optionBlokir($appLanguage->getYes(), $appLanguage->getNo()),
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
					<span class="filter-label"><?php echo $appEntityLanguage->getJabatan();?></span>
					<span class="filter-control">
							<select name="jabatan_id" class="form-control">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<?php echo AppFormBuilder::getInstance()->createSelectOption(new JabatanMin(null, $database), 
								PicoSpecification::getInstance()
									->addAnd(new PicoPredicate(Field::of()->aktif, true))
									->addAnd(new PicoPredicate(Field::of()->draft, true)), 
								PicoSortable::getInstance()
									->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
									->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)), 
								Field::of()->jabatanId, Field::of()->nama, $inputGet->getJabatanId())
								; ?>
							</select>
					</span>
				</span>
				
				<span class="filter-group">
					<span class="filter-label"><?php echo $appEntityLanguage->getBlokir();?></span>
					<span class="filter-control">
							<select name="blokir" class="form-control" data-value="<?php echo $inputGet->getBlokir();?>">
								<option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
								<option value="yes" <?php echo AppFormBuilder::selected($inputGet->getBlokir(), 'yes');?>><?php echo $appLanguage->getOptionLabelYes();?></option>
								<option value="no" <?php echo AppFormBuilder::selected($inputGet->getBlokir(), 'no');?>><?php echo $appLanguage->getOptionLabelNo();?></option>
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
				<?php if($userPermission->isAllowedApprove()){ ?>
		
				<span class="filter-group">
					<button type="submit" name="show_require_approval_only" value="true" class="btn btn-success"><?php echo $appLanguage->getButtonShowRequireApproval();?></button>
				</span>
				<?php } ?>
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
								<td class="data-controll data-selector" data-key="supervisor_id">
									<input type="checkbox" class="checkbox check-master" data-selector=".checkbox-supervisor-id"/>
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
								<td data-col-name="nip" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getNip();?></a></td>
								<td data-col-name="username" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getUsername();?></a></td>
								<td data-col-name="nama" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getNama();?></a></td>
								<td data-col-name="koordinator" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getKoordinator();?></a></td>
								<td data-col-name="jabatan_id" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getJabatan();?></a></td>
								<td data-col-name="jenis_kelamin" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getJenisKelamin();?></a></td>
								<td data-col-name="blokir" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getBlokir();?></a></td>
								<td data-col-name="aktif" class="order-controll"><a href="#"><?php echo $appEntityLanguage->getAktif();?></a></td>
								<?php if($userPermission->isAllowedApprove()){ ?>
								<td class="data-controll data-approval"><?php echo $appLanguage->getApproval();?></td>
								<?php } ?>
							</tr>
						</thead>
					
						<tbody data-offset="<?php echo $pageData->getDataOffset();?>">
							<?php 
							$dataIndex = 0;
							while($supervisor = $pageData->fetch())
							{
								$dataIndex++;
							?>
		
							<tr data-number="<?php echo $pageData->getDataOffset() + $dataIndex;?>">
								<?php if($userPermission->isAllowedBatchAction()){ ?>
								<td class="data-selector" data-key="supervisor_id">
									<input type="checkbox" class="checkbox check-slave checkbox-supervisor-id" name="checked_row_id[]" value="<?php echo $supervisor->getSupervisorId();?>"/>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedUpdate()){ ?>
								<td>
									<a class="edit-control" href="<?php echo $currentModule->getRedirectUrl(UserAction::UPDATE, Field::of()->supervisor_id, $supervisor->getSupervisorId());?>"><span class="fa fa-edit"></span></a>
								</td>
								<?php } ?>
								<?php if($userPermission->isAllowedDetail()){ ?>
								<td>
									<a class="detail-control field-master" href="<?php echo $currentModule->getRedirectUrl(UserAction::DETAIL, Field::of()->supervisor_id, $supervisor->getSupervisorId());?>"><span class="fa fa-folder"></span></a>
								</td>
								<?php } ?>
								<td class="data-number"><?php echo $pageData->getDataOffset() + $dataIndex;?></td>
								<td data-col-name="nip"><?php echo $supervisor->getNip();?></td>
								<td data-col-name="username"><?php echo $supervisor->getUsername();?></td>
								<td data-col-name="nama"><?php echo $supervisor->getNama();?></td>
								<td data-col-name="koordinator"><?php echo $supervisor->optionKoordinator($appLanguage->getYes(), $appLanguage->getNo());?></td>
								<td data-col-name="jabatan_id"><?php echo $supervisor->hasValueJabatan() ? $supervisor->getJabatan()->getNama() : "";?></td>
								<td data-col-name="jenis_kelamin"><?php echo isset($mapForJenisKelamin) && isset($mapForJenisKelamin[$supervisor->getJenisKelamin()]) && isset($mapForJenisKelamin[$supervisor->getJenisKelamin()]["label"]) ? $mapForJenisKelamin[$supervisor->getJenisKelamin()]["label"] : "";?></td>
								<td data-col-name="blokir"><?php echo $supervisor->optionBlokir($appLanguage->getYes(), $appLanguage->getNo());?></td>
								<td data-col-name="aktif"><?php echo $supervisor->optionAktif($appLanguage->getYes(), $appLanguage->getNo());?></td>
								<?php if($userPermission->isAllowedApprove()){ ?>
								<td class="data-controll data-approval">
									<?php if(UserAction::isRequireApproval($supervisor->getWaitingFor())){ ?>
									<a class="btn btn-tn btn-success" href="<?php echo $currentModule->getRedirectUrl(UserAction::DETAIL, Field::of()->supervisor_id, $supervisor->getSupervisorId(), array(UserAction::NEXT_ACTION => UserAction::APPROVAL));?>"><?php echo $appLanguage->getButtonApproveTiny();?></a>
									<?php echo UserAction::getWaitingForText($appLanguage, $supervisor->getWaitingFor());?>
									<?php } ?>
								</td>
								<?php } ?>
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
			else if($inputGet->isShowRequireApprovalOnly())
			{
			    ?>
			    <div class="alert alert-info"><?php echo $appLanguage->getMessageNoDataRequireApproval();?></div>
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


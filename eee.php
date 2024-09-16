<?php

use MagicObject\Request\PicoFilterConstant;
use Sipro\Entity\Data\AcuanPengawasanPekerjaan;
use Sipro\Entity\Data\BillOfQuantity;
use Sipro\Entity\Data\BillOfQuantityProyek;
use Sipro\Entity\Data\MaterialProyek;
use Sipro\Entity\Data\Pekerjaan;
use Sipro\Entity\Data\PeralatanProyek;

require_once __DIR__ . "/inc.app/auth-supervisor.php";


if(isset($_POST['add-work']))
{
	$waktuBuat = $currentAction->getTime();
	$waktuUbah = $waktuBuat;
	$ipBuat = $_SERVER['REMOTE_ADDR'];
	$ipUbah = $_SERVER['REMOTE_ADDR'];

	$bukuHarianId = $inputPost->getBukuHarianId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_UINT, false, false, true);
	$proyekId = $inputPost->getProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_UINT, false, false, true);
	$jenis_pekerjaan_id = $inputPost->getJenisPekerjaanId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_UINT, false, false, true);
	$tipe_pondasi_id = $inputPost->getTipePondasiId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_UINT, false, false, true);
	$kelas_tower_id = $inputPost->getKelasTowerId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_UINT, false, false, true);
	$lokasi_proyek_id = $inputPost->getLokasiProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_UINT, false, false, true);
	$kegiatan = $inputPost->getKegiatan(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true);
	$acuan_pengawasan = $inputPost->getAcuanPengawasan(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true);
	$latitude = $inputPost->getLatitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true);
	$longitude = $inputPost->getLongitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true);
	$altitude = $inputPost->getAltitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true);
	$jumlah_pekerja = $inputPost->getJumlahPekerjaan(PicoFilterConstant::FILTER_SANITIZE_NUMBER_UINT, false, false, true);
	
	$arr_peralatan_id = array();
	
	$pekerjaan = new Pekerjaan(null, $database);
	$pekerjaan->setPekerjaanId($inputPost->getPekerjaanId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$pekerjaan->setProyekId($inputPost->getProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$pekerjaan->setBukuHarianId($inputPost->getBukuHarianId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$pekerjaan->setSupervisorId($inputPost->getSupervisorId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$pekerjaan->setJenisPekerjaanId($inputPost->getJenisPekerjaanId(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$pekerjaan->setLokasiProyekId($inputPost->getLokasiProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$pekerjaan->setTipePondasiId($inputPost->getTipePondasiId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$pekerjaan->setKelasTowerId($inputPost->getKelasTowerId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$pekerjaan->setLatitude($inputPost->getLatitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$pekerjaan->setLongitude($inputPost->getLongitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$pekerjaan->setAtitude($inputPost->getAtitude(PicoFilterConstant::FILTER_SANITIZE_NUMBER_FLOAT, false, false, true));
	$pekerjaan->setKegiatan($inputPost->getKegiatan(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$pekerjaan->setJumlahPekerja($inputPost->getJumlahPekerja(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true));
	$pekerjaan->setAcuanPengawasan($inputPost->getAcuanPengawasan(PicoFilterConstant::FILTER_SANITIZE_SPECIAL_CHARS, false, false, true));
	$pekerjaan->setAktif($inputPost->getAktif(PicoFilterConstant::FILTER_SANITIZE_BOOL, false, false, true));
	$pekerjaan->setAdminBuat($currentUser->getUserId());
	$pekerjaan->setWaktuBuat($currentAction->getTime());
	$pekerjaan->setIpBuat($currentAction->getIp());
	$pekerjaan->setAdminUbah($currentUser->getUserId());
	$pekerjaan->setWaktuUbah($currentAction->getTime());
	$pekerjaan->setIpUbah($currentAction->getIp());

	$pekerjaan->insert();

	$pekerjaanId = $pekerjaan->getPekerjaanId();

	$acuan_pengawasan = $inputPost->getAcuanPengawasan();
	$acuanPengawasanPekerjaan = new AcuanPengawasanPekerjaan(null, $database);
	$acuanPengawasanPekerjaan->deleteByPekerjaanId($pekerjaanId);

	if(isset($acuan_pengawasan) && is_array($acuan_pengawasan))
	{
		foreach($acuan_pengawasan as $key=>$acuan_pengawasan_id)
		{
			$acuanPengawasanPekerjaan = new AcuanPengawasanPekerjaan(null, $database);
			$acuanPengawasanPekerjaan->setPekerjaanId($pekerjaanId);
			$acuanPengawasanPekerjaan->setAcuanPengawasan($acuan_pengawasan_id);
			$acuanPengawasanPekerjaan->setAktif(true);
			$acuanPengawasanPekerjaan->insert();
		}
	}

	if(isset($_POST['peralatan_proyek_id']))
	{
		$peralatan_proyek_id = $_POST['peralatan_proyek_id'];
		if(is_array($peralatan_proyek_id))
		{
			foreach($peralatan_proyek_id as $key=>$val)
			{
				if(stripos($val, 'rand_') !== false)
				{
					// insert
					$peralatan_id = $inputPost->get('peralatan_id_'.$val, array(PicoFilterConstant::FILTER_SANITIZE_NUMBER_UINT));
					$jumlah = $inputPost->get('jumlah_'.$val, array(PicoFilterConstant::FILTER_SANITIZE_NUMBER_UINT));

					$pemalatanProyek = new PeralatanProyek(null, $database);
					$pemalatanProyek->setPekerjaanId($pekerjaanId);
					$pemalatanProyek->setPeralatanId($peralatan_id);
					$pemalatanProyek->setJumlah($jumlah);
					$pemalatanProyek->setProyekId($proyekId);
					$pemalatanProyek->setAktif(true);

					$pemalatanProyek->insert();

					$arr_peralatan_id[] = $pemalatanProyek->getPeralatanProyekId();
				}
			}
		}
	}
	if(isset($_POST['material_proyek_id']))
	{
		$material_proyek_id = $_POST['material_proyek_id'];
		if(is_array($material_proyek_id))
		{
			foreach($material_proyek_id as $key=>$val)
			{
				if(stripos($val, 'rand_') !== false)
				{
					// insert
					$materialId = $inputPost->get('material_id_'.$val, array(PicoFilterConstant::FILTER_SANITIZE_NUMBER_UINT));
					$jumlah = $inputPost->get('jumlah_'.$val, array(PicoFilterConstant::FILTER_SANITIZE_NUMBER_UINT));

					$materialProyek = new MaterialProyek(null, $database);
					$materialProyek->setPekerjaanId($pekerjaanId);
					$materialProyek->setMaterialId($materialId);
					$materialProyek->setProyekId($proyekId);
					$materialProyek->setJumlah($jumlah);
					$materialProyek->setAktif(true);

					$materialProyek->insert();

					$arr_material_id[] = $materialProyek->getMaterialProyekId();
				}
			}
		}
	}
	
	if(isset($_POST['boq_proyek_id']))
	{
		$boq_proyek_id = $_POST['boq_proyek_id'];
		if(is_array($boq_proyek_id))
		{
			foreach($boq_proyek_id as $key=>$val)
			{
				if(stripos($val, 'rand_') !== false)
				{
					// insert
					$boqId = $inputPost->get('boq_proyek_id_'.$val, array(PicoFilterConstant::FILTER_SANITIZE_NUMBER_UINT));
					$volumeProyek = $inputPost->get('volume_'.$val, array(PicoFilterConstant::FILTER_SANITIZE_NUMBER_UINT));

					$boq = new BillOfQuantity(null, $database);

					try
					{
						$boq->find($boqId);
						
						$boqProyek = new BillOfQuantityProyek(null, $database);

						


						$boqProyek->setProyekId($proyekId);
						$boqProyek->setBukuHarianId($bukuHarianId);
						$boqProyek->setBillOfQuantityId($boqId);
						$boqProyek->setVolumeProyek($volumeProyek);
						$boqProyek->setVolume($boq->getVolume());
						$boqProyek->setAktif(true);

						$boqProyek->setIpBuat($ipBuat);
						$boqProyek->setIpUbah($ipUbah);
						$boqProyek->setWaktuBuat($waktuBuat);
						$boqProyek->setWaktuUbah($waktuUbah);
						$boqProyek->setSupervisorBuat($currentLoggedInSupervisor->getSupervisorId());
						$boqProyek->setSupervisorUbah($currentLoggedInSupervisor->getSupervisorId());


						$boqProyek->insert();

						echo $boqProyek;

						$arr_boq_id[] = $boqProyek->getBillOfQuantityProyekId();
					}
					catch(Exception $e)
					{

					}
				}
			}
		}
	}
	
	//header("Location: ".basename($_SERVER['PHP_SELF'])."?option=detail&buku_harian_id=$bukuHarianId");
	exit();
}
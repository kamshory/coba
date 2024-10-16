<?php

use MagicObject\Request\InputPost;
use MagicObject\Util\File\FileUtil;
use Sipro\Entity\Data\BukuHarian;
use Sipro\Entity\Data\GaleriProyek;

require_once dirname(__DIR__) . "/inc.app/auth-supervisor.php";

$inputPost = new InputPost();

$option = $inputPost->getOption();
$id = $inputPost->getId();

$supervisorId = $currentLoggedInSupervisor->getSupervisorId();

if($id && $option == 'delete')
{
	$galeryProyek = new GaleriProyek(null, $database);
	try
	{
		$galeryProyek->find($id);
		$proyekId = $galeryProyek->getProyekId();
		$targetdir = dirname(dirname(__FILE__))."/lib.gallery/projects/$proyekId";
		mkdir($targetdir, 0755, true);
		$path1 = $targetdir."/".$file;
		$path2 = str_replace('.jpg', '_100.jpg', $path1);
		if(file_exists($path1))
		{
			chmod($path1, 0755);
			unlink($path1);
		}
		if(file_exists($path2))
		{
			chmod($path1, 0755);
			unlink($path2);
		}
		$galeryProyek->delete();
	}
	catch(Exception $e)
	{
		// do nothing
	}
}
else
{
	include_once dirname(dirname(__FILE__))."/lib.inc/functions-image.php";

	$files = new PicoUploadFile();
	
	$bukuHarianId = $inputPost->getBukuHarianId();
	$pekerjaanId = $inputPost->getPekerjaanId();

	if(isset($files->image) && $bukuHarianId && $pekerjaanId)
	{
		$bukuHarian = new BukuHarian(null, $database);

		try
		{
			$bukuHarian->findOneByBukuHarianIdAndPekerjaanIdAndSupervisorId($bukuHarianId, $pekerjaanId, $supervisorId);

			$proyekId = $bukuHarian->getProyekId();
			$lokasiProyekId = $bukuHarian->getLokasiProyekId();
			$targetdir = dirname(dirname(__FILE__))."/lib.gallery/projects/$proyekId";

			mkdir($targetdir, 0755, true);

			$waktuBuat = date('Y-m-d H:i:s');
			$waktuUbah = date('Y-m-d H:i:s');
			$ipBuat = $_SERVER['REMOTE_ADDR'];
			$ipUbah = $_SERVER['REMOTE_ADDR'];
			$aktif = 1;

			$uploadedFiles = $files->image;
			foreach($uploadedFiles->getAll() as $fileItem)
			{
				$temporaryName = $fileItem->getTmpName();
				$name = $fileItem->getName();
				$originalName = addslashes($name);
				$size = $fileItem->getSize();
				move_uploaded_file($temporaryName, $targetDir."/".$name);

				$info = getimagesize($targetdir."/".$name);
				$extra = "";
				$exifdata = null;
				if(stripos($info['mime'],'image')!==false)
				{
					$newname = $name;
					$md5Original = md5_file($targetdir."/".$name);
					if(stripos($info['mime'],'image/jpeg')!==false)
					{
						$newname = $name.".jpg";
						
						// compress file
						$exifdataraw = ImageUtil::readExifDataFile($targetdir."/".$name);
						
						if(isset($exifdataraw['IFD0']))
						{
							$maker = "";
							$model = "";
							if(isset($exifdataraw['IFD0']['Make']))
							{
								$maker = $exifdataraw['IFD0']['Make'];
							}
							if(isset($exifdataraw['IFD0']['Model']))
							{
								$model = $exifdataraw['IFD0']['Model'];
							}
						}
						$exifdata = ImageUtil::packExifData($exifdataraw);

						
						$extra = addslashes(json_encode($exifdata));
						if($info[0] > 1000 || $info[1] > 1000)
						{
							ImageUtil::imageResizeMax($targetdir."/".$name, $targetdir."/".$newname, 1000, 1000, true, 80);
							$info = getimagesize($targetdir."/".$newname);
						}
						else
						{
							@rename($targetdir."/".$name, $targetdir."/".$newname);
						}
					}
					else if(stripos($info['mime'],'image/png')!==false)
					{
						$newname = $name.".png";
						rename($targetdir."/".$name, $targetdir."/".$newname);
					}
					else if(stripos($info['mime'],'image/gif')!==false)
					{
						$newname = $name.".gif";
						rename($targetdir."/".$name, $targetdir."/".$newname);
					}
					// create thumbnail
					$th100 = $th100 = str_replace(array(".jpg", ".png", ".gif"), "_100.jpg", $newname);
					
					ImageUtil::createThumbImage($targetdir."/".$newname, $targetdir."/".$th100, 100, 100, true, 80);
					$type = addslashes($info['mime']);
					$width = $info[0];
					$height = $info[1];
					if($height==0) 
					{
						$height = 1;
					}
					$width2 = round(100*$width/$height);

					$file = FileUtil::fixFilePath($targetdir."/".$newname);
					
					$md5 = md5_file($targetdir."/".$newname);
					$ip = addslashes($_SERVER['REMOTE_ADDR']);
					$basename = basename($newname);

					$galeryProyek = new GaleriProyek(null, $database);
					$galeryProyek->setProyekId($proyekId);
					$galeryProyek->setLokasiProyekId($lokasiProyekId);
					$galeryProyek->setBukuHarianId($bukuHarianId);
					$galeryProyek->setPekerjaanId($pekerjaanId);
					$galeryProyek->setSupervisorId($supervisorId);
					$galeryProyek->setOriginalName($originalName);
					$galeryProyek->setBasename($basename);
					$galeryProyek->setMd5($md5);
					$galeryProyek->setWidth($width);
					$galeryProyek->setHeight($height);
					$galeryProyek->setWaktuBuat($waktuBuat);
					$galeryProyek->setWaktuUbah($waktuUbah);
					$galeryProyek->setIpBuat($ipBuat);
					$galeryProyek->setIpUbah($ipUbah);
					$galeryProyek->setAktif(true);

					$galeryProyek->insert();

					$galeriProyekId = $galeryProyek->getGaleryProyekId();

					if($exifdata !== null)
					{
						$latitude = @$exifdata['latitude'];
						$longitude = @$exifdata['longitude'];
						
						$lat = str_replace(array(";", "  "), array("", " "), $latitude);
						$arr = explode(" ", $lat);
						$latitude = ImageUtil::dmstoreal(@$arr[0], @$arr[1], @$arr[2]);
						if(strtoupper(@$arr[3]) == 'S') 
						{
							$latitude = $latitude * -1;
						}
						
						$lon = str_replace(array(";", "  "), array("", " "), $longitude);
						$arr = explode(" ", $lon);
						$longitude = ImageUtil::dmstoreal(@$arr[0], @$arr[1], @$arr[2]);
						if(strtoupper(@$arr[3]) == 'W') 
						{
							$longitude = $longitude * -1;
						}
						
						$altitude = @$exifdata['altitude'];

						if($latitude != '-' && $longitude != '-' && $altitude != '-')
						{
							$galeryProyek->setLatitude($latitude);
							$galeryProyek->setLongitude($longitude);
							$galeryProyek->setAltitude($altitude);

							$galeryProyek->update();
						}
						$jsonExif = json_encode($exifdata);

						$galeryProyek->update($jsonExif);
						$galeryProyek->setExif();
					}
					?>    
					<div class="galeri-item">
						<span class="delete-control">
							<a href="#" data-galeri-proyek-id="<?php echo $galeriProyekId;?>"><span class="icon sign-remove"></span></a>
						</span>
						<img src="lib.gallery/projects/<?php echo $proyekId;?>/<?php echo $basename;?>">
					</div>
					<?php
				}
				else if(file_exists($targetdir."/".$name))
				{
					unlink($targetdir."/".$name);
				}


			}
		}
		catch(Exception $e)
		{
			// do nothing
		}
	}
}

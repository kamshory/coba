<?php

// This script is generated automatically by AppBuilder
// Visit https://github.com/Planetbiru/MagicAppBuilder

use MagicApp\PicoModule;
use MagicObject\Database\PicoPredicate;
use MagicObject\Database\PicoSort;
use MagicObject\Database\PicoSortable;
use MagicObject\Database\PicoSpecification;
use MagicObject\Request\InputGet;
use MagicObject\Request\InputPost;
use MagicObject\Request\PicoFilterConstant;
use MagicObject\SetterGetter;
use Sipro\Entity\Data\Kehadiran;
use Sipro\Entity\Data\SupervisorProyek;
use Sipro\Util\CalendarUtil;
use Sipro\Util\DateUtil;

require_once __DIR__ . "/inc.app/auth-supervisor.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$baseAssetsUrl = $appConfig->getSite()->getBaseUrl();
$moduleName = "Kehadiran";
$currentModule = new PicoModule($appConfig, $database, null, "/", "kehadiran", "Kehadiran");

require_once __DIR__ . "/inc.app/header-supervisor.php";
?>

<?php
    $supervisorId = $currentLoggedInSupervisor->getSupervisorId();

    $inputGet = new InputGet();
    
    $periodeOri = date('Y-m');
    $periode = $inputGet->getPeriode();
    if(empty($periode))
    {
        $periode = date('Y-m');
    }
    $periode2 = strtotime($periode."-15");

    $sebelumnya = date('Y-m', $periode2 - (31 * 86400));
    $sesudahnya = date('Y-m', $periode2 + (31 * 86400));

    $periodeArr = explode('-', $periode);

    $calendar = new CalendarUtil(intval($periodeArr[0]), intval($periodeArr[1]), 0, true);
    
    $cal = $calendar->getCalendar();
    $calInline = $calendar->getCalendarInline();
    
    $startDate = $calendar->getStartDate();
    $endDate = $calendar->getEndDate();
    
    $proyekId = $inputGet->getProyekId(PicoFilterConstant::FILTER_SANITIZE_NUMBER_INT, false, false, true);
    if(isset($proyekId) && !empty($proyekId))
    {
        $proyekId = intval($proyekId);
    }

    // Additional filter here

    $specs = PicoSpecification::getInstance()
    ->addAnd(PicoPredicate::getInstance()->equals('supervisorId', $supervisorId))
    ->addAnd(PicoPredicate::getInstance()->equals('grupPengguna', 'supervisor'))
    ->addAnd(PicoPredicate::getInstance()->greaterThanOrEquals('tanggal', $startDate.' 00:00:00'))
    ->addAnd(PicoPredicate::getInstance()->lessThan('tanggal', $endDate.' 23:59:59'))
    ;
    
    $kehadiranFinder = new Kehadiran(null, $database);
    
    $absensi = array();
    $startTime = strtotime($startDate);
    $endTime = strtotime($endDate);
    
    $class = 'kosong';
    for($i = $startTime; $i<$endTime; $i+=86400)
    {
        $tanggal = date('Y-m-d', $i);
        $absensi[$tanggal] = (new SetterGetter())
            ->setBukuHarianId(null)
            ->setTanggal($tanggal)
            ->setClass($class)
            ;
    }
    try
    {
        $pageData = $kehadiranFinder->findAll($specs);
        foreach($pageData->getResult() as $bukuHarian)
        {
            $tanggal = $bukuHarian->getTanggal();
            $class = $bukuHarian->getAccKoordinator() ? 'sudah-acc':'belum-acc';
            $absensi[$tanggal] = (new SetterGetter())
                ->setBukuHarianId($bukuHarian->getBukuHarianId())
                ->setTanggal($tanggal)
                ->setClass($class)
                ;
        }
    }
    catch(Exception $e)
    {
        // 
    }
    
    ?>
    <style>
        .calendar{
            position: relative;
        }
        .jambi-wrapper .calendar .filter-section .filter-control .form-control
        {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .calendar .btn{
            padding: 2px 8px;
        }
    </style>
    <div class="calendar">
        
        

        <table width="100%">
            <thead>
                <tr>
                    <td style="text-align: left;">
                    <button type="button" class="btn btn-secondary" onclick="window.location='<?php echo basename($_SERVER['PHP_SELF']);?>?proyek_id=<?php echo $proyekId;?>&periode=<?php echo $sebelumnya;?>'"><i class="fa-solid fa-chevron-left"></i></button>
                    </td>
                    <td colspan="5" style="font-size: 1rem; text-align: center;"><?php echo DateUtil::translateDate($appLanguage, date('F Y', $periode2));?></td>
                    <td style="text-align: right;">
                    <button type="button" class="btn btn-secondary" onclick="window.location='<?php echo basename($_SERVER['PHP_SELF']);?>?proyek_id=<?php echo $proyekId;?>&periode=<?php echo $sesudahnya;?>'"<?php echo $periode == $periodeOri ? ' disabled':'';?>><i class="fa-solid fa-chevron-right"></i></button>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Min</td>
                    <td>Sen</td>
                    <td>Sel</td>
                    <td>Rab</td>
                    <td>Kam</td>
                    <td>Jum</td>
                    <td>Sab</td>
                </tr>
                <?php
                foreach($cal as $row)
                {
                    ?>
                    <tr>
                    <?php
                    foreach($row as $col)
                    {
                        ?>
                        <td width="14%">
                            <?php
                            if($col['print'])
                            {
                                $class = $col['class'];
                                $tanggal = $col['date'];
                                $class2 = isset($absensi[$tanggal]) ? $absensi[$tanggal]->getClass() : "";
                                $bukuHarianId = isset($absensi[$tanggal]) ? $absensi[$tanggal]->getBukuHarianId() : "";
                                $class = $class.' '.$class2;
                            ?>
                            <button data-proyek-id="<?php echo $proyekId;?>" data-tanggal="<?php echo $tanggal;?>" data-buku-harian-id="<?php echo $bukuHarianId;?>" class="calendar-button buku-harian-button <?php echo $class;?>"><?php echo $col['day'];?></button>
                            <?php
                            }
                            ?>
                        </td>
                        <?php
                    }
                    ?>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>


<?php
require_once __DIR__ . "/inc.app/footer-supervisor.php";

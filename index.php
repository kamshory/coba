<?php

// This script is generated automatically by AppBuilder
// Visit https://github.com/Planetbiru/MagicAppBuilder

use MagicApp\Field;
use MagicApp\PicoModule;
use MagicObject\Database\PicoPredicate;
use MagicObject\Database\PicoSort;
use MagicObject\Database\PicoSortable;
use MagicObject\Database\PicoSpecification;
use MagicObject\Request\InputGet;
use MagicObject\Request\InputPost;
use Sipro\Entity\Data\BillOfQuantity;
use Sipro\Entity\Data\BukuHarian;
use Sipro\Util\DateUtil;

require_once __DIR__ . "/inc.app/auth-supervisor.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$baseAssetsUrl = $appConfig->getSite()->getBaseUrl();
$moduleName = "Home";
$currentModule = new PicoModule($appConfig, $database, null, "/", "index", "Halaman Depan");

require_once __DIR__ . "/inc.app/header-supervisor.php";
?> 

    <?php
    $hari = $appConfig->getHariProyek();
    
    $proyekDipilih = array();
    
    // dapatkan proyek dengan buku harian 3 hari ke belakang
    $specsBukuHarian = PicoSpecification::getInstance()
      ->addAnd(PicoPredicate::getInstance()->greaterThanOrEquals(Field::of()->waktuBuat, date('Y-m-d H:i:s', strtotime("-$hari days"))))
      ->addAnd(PicoPredicate::getInstance()->lessThanOrEquals(Field::of()->waktuBuat, date('Y-m-d H:i:s', strtotime("1 days"))))
    ;
    $sortsBukuHarian = PicoSortable::getInstance()
      ->addSortable(new PicoSort(Field::of()->waktuBuat, PicoSort::ORDER_TYPE_ASC))
    ;
    $finderBukuHarian = new BukuHarian(null, $database);
    $daftarProyek = array();
    $daftarNamaSupervisor = array();
    try
    {
      $pageDataBukuHarian = $finderBukuHarian->findAll($specsBukuHarian, null, $sortsBukuHarian);
      foreach($pageDataBukuHarian->getResult() as $bukuHarian)
      {
        $proyekDipilih[$bukuHarian->getProyekId()] = array(
          'proyek_id'=>$bukuHarian->getProyekId(), 
          'nama'=>$bukuHarian->issetProyek() ? $bukuHarian->getProyek()->getNama() : '',
          'persen'=>$bukuHarian->issetProyek() ? floatval($bukuHarian->getProyek()->getPersen()) : 0
        );
        $daftarProyek[] = intval($bukuHarian->getProyekId());
        $proyekId = $bukuHarian->getProyekId();
        if($bukuHarian->hasValueSupervisor())
        {
          if(!isset($daftarNamaSupervisor[$proyekId]))
          {
            $daftarNamaSupervisor[$proyekId] = array();
          }
          $daftarNamaSupervisor[$proyekId][] = $bukuHarian->getSupervisor()->getNama();
          $daftarNamaSupervisor[$proyekId] = array_unique($daftarNamaSupervisor[$proyekId]);

        }
        
      }
    }
    catch(Exception $e)
    {
      // do nothing
    }

    $daftarProyek = array_unique($daftarProyek);
    

    $specsBOQ = PicoSpecification::getInstance()
      ->addAnd(PicoPredicate::getInstance()->in(Field::of()->proyekId, $daftarProyek))
      ->addAnd(PicoPredicate::getInstance()->equals(Field::of()->aktif, true))
      ->addAnd(PicoPredicate::getInstance()->notEquals(Field::of()->volume, null))
      ->addAnd(PicoPredicate::getInstance()->notEquals(Field::of()->volume, 0))
    ;

    $sortsBOQ = PicoSortable::getInstance()
      ->addSortable(new PicoSort(Field::of()->waktuBuat, PicoSort::ORDER_TYPE_ASC))
    ;

    $finderBOQ = new BillOfQuantity(null, $database);

    $listProyek = array();
    try
    {
      $pageDataBOQ = $finderBOQ->findAll($specsBOQ, null, $sortsBukuHarian);
      $listBOQ = $pageDataBOQ->getResult();
      foreach($listBOQ as $idx=>$boq)
      {
        if(!isset($listProyek[$boq->getProyekId()]))
        {
          $listProyek[$boq->getProyekId()] = array();
        }
        $listProyek[$boq->getProyekId()][] = $boq;
      }
    }
    catch(Exception $e)
    {
      // do nothing
    }

    $proyekDipilihVal = array_values($proyekDipilih);
    $nproyek = count($proyekDipilihVal);

    if($nproyek >= 4)
    {
      $class = "col-sm-12 col-xl-3";
    }
    else if($nproyek == 3)
    {
      $class = "col-sm-12 col-xl-4";
    }
    else if($nproyek == 2)
    {
      $class = "col-sm-12 col-xl-6";
    }
    else if($nproyek == 1)
    {
      $class = "col-sm-12 col-xl-12";
    }

    ?>

    <div class="container">
    <div class="row g-4 mb-4 progres-proyek-container">
      
    <?php
      for($i = $nproyek - 1, $j = 0; $i >= 0 && $j < 4; $i--, $j++)
      {
      ?>
      <div data-index="1" data-proyek-id="<?php echo $proyekDipilihVal[$i]['proyek_id'];?>" class="progres-proyek col-sm-12 col-xl-3">
        <div class="card text-white bg-info pb-3">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start position-relative w-100 box-sizing-border-box">
            <div class="position-relative w-100 box-sizing-border-box">
              <div class="position-relative w-100 box-sizing-border-box fs-5 fw-semibold proyek-persen">Progres <?php echo $proyekDipilihVal[$i]['persen'];?>%</div>
              <div class="position-relative w-100 box-sizing-border-box proyek-nama text-nowrap text-truncate d-inline-block"><?php echo $proyekDipilihVal[$i]['nama'];?></div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3 mx-3" style="height:150px;">
            <canvas class="chart" id="card-chart-<?php echo $j;?>" height="150" style="display: block; box-sizing: border-box; height: 150px; width: 266px;" width="266"></canvas>
          </div>
          <div class="px-3">
            <div class="progress progress-thin">
              <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $proyekDipilihVal[$i]['persen'];?>%" aria-valuenow="<?php echo $proyekDipilihVal[$i]['persen'];?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-->
       <?php
      }
      ?>
      

    </div>

    <!-- /.row-->

    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h4 class="card-title mb-0 text-nowrap text-truncate d-inline-block">Progres Proyek</h4>
            <div class="small text-body-secondary"><span id="min-date"></span> - <span id="max-date"></span></div>
          </div>
          <div class="btn-toolbar d-md-block" role="toolbar" aria-label="Toolbar with buttons">
            <div class="btn-group btn-group-toggle mx-3" data-coreui-toggle="buttons">
            <style>
              #proyek_id{
                max-width: 200px;
              }
            </style>
            <script>
              

              
              document.addEventListener('DOMContentLoaded', function() {
              document.querySelector('#proyek_id').addEventListener('change', function(e){
                if(e.target.value != '')
                {
                  fetch('lib.mobile-tools/ajax-proyek-boq.php?proyek_id='+e.target.value, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                  })
                  .then(response => {
                      if (!response.ok) {
                          throw new Error('Network response was not ok ' + response.statusText);
                      }
                      return response.json();
                  })
                  .then(data => {
                    createChart(data);
                    document.querySelector('#min-date').innerHTML = data.minDate;
                    document.querySelector('#max-date').innerHTML = data.maxDate;
                  })
                  .catch(error => {
                      console.error('There has been a problem with your fetch operation:', error);
                  });
                }
              });
              let proyeks = [];
              $('.progres-proyek').each(function(){
                proyeks.push('proyeks[]='+$(this).attr('data-proyek-id'));
              });


              fetch('lib.mobile-tools/ajax-proyek-progres.php?'+proyeks.join('&'), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
              })
              .then(response => {
                  if (!response.ok) {
                      throw new Error('Network response was not ok ' + response.statusText);
                  }
                  return response.json();
              })
              .then(data => {
                let cardChart = {};
                for(let i in data)
                {
                 let config = data[i];
                 config.options.plugins.tooltip = {
                  callbacks: {
                    label: function(tooltipItem) {
                      let label = tooltipItem.dataset.label;
                      let value = tooltipItem.raw.toFixed(2);
                      return ` ${label}: ${value}%`;
                    }
                  }
                };
                
                if(chart)
                {
                    chart.destroy();
                }
                 cardChart[i] = new Chart(document.getElementById('card-chart-'+i), config);
                }
              })
              .catch(error => {
                  console.error('There has been a problem with your fetch operation:', error);
              });
            });
          
              var chart;
              var ctx;
              function createChart(config)
              {
                ctx = document.getElementById('main-chart2').getContext('2d');
                Chart.register({
                    id: 'moment',
                    beforeInit: function(chart) {
                        chart.data.labels = chart.data.labels.map(function(label) {
                        return moment(label).format('YYYY-MM-DD HH:mm:ss');
                        });
                    }
                });

                config.options.plugins.tooltip = {
                  callbacks: {
                    label: function(tooltipItem) {
                      let label = tooltipItem.dataset.label;
                      let value = tooltipItem.raw.y.toFixed(2);
                      return ` ${label}: ${value}%`;
                    }
                  }
                };
                
                if(chart)
                {
                    chart.destroy();
                }
                chart = new Chart(ctx, config);
            }

            </script>
            <form action="">
            <select class="form-control" id="proyek_id">
            <option value="">- Pilih Proyek -</option>
            <?php
                      
            foreach($proyekDipilih as $proyekObj)
            {
                ?>
                <option value="<?php echo $proyekObj['proyek_id'];?>"><?php echo $proyekObj['nama'];?></option>
                <?php
            }
            ?>
        </select>
        </form>
            </div>

          </div>
        </div>
        <div class="c-chart-wrapper" style="height:400px;margin-top:40px;">
          <canvas class="chart" id="main-chart2" height="400" style="display: block; box-sizing: border-box; height: 400px; width: 1238px;" width="1238"></canvas>
        </div>
      </div>
    </div>
    <!-- /.card-->
    
    <!-- /.row-->
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header">Progress Pekerjaan Proyek</div>
          <div class="card-body">
            
            <?php
            $hari = $appConfig->getHariProyek();
            
            // dapatkan proyek dengan buku harian 3 hari ke belakang
            $specsBukuHarian = PicoSpecification::getInstance()
              ->addAnd(PicoPredicate::getInstance()->greaterThanOrEquals(Field::of()->waktuBuat, date('Y-m-d H:i:s', strtotime("-$hari days"))))
              ->addAnd(PicoPredicate::getInstance()->lessThanOrEquals(Field::of()->waktuBuat, date('Y-m-d H:i:s', strtotime("1 days"))))
            ;
            $sortsBukuHarian = PicoSortable::getInstance()
              ->addSortable(new PicoSort(Field::of()->waktuBuat, PicoSort::ORDER_TYPE_ASC))
            ;
            $finderBukuHarian = new BukuHarian(null, $database);
            $daftarProyek = array();
            $daftarNamaSupervisor = array();
            try
            {
              $pageDataBukuHarian = $finderBukuHarian->findAll($specsBukuHarian, null, $sortsBukuHarian);
              foreach($pageDataBukuHarian->getResult() as $bukuHarian)
              {
                $daftarProyek[] = intval($bukuHarian->getProyekId());
                $proyekId = $bukuHarian->getProyekId();
                if($bukuHarian->hasValueSupervisor())
                {
                  if(!isset($daftarNamaSupervisor[$proyekId]))
                  {
                    $daftarNamaSupervisor[$proyekId] = array();
                  }
                  $daftarNamaSupervisor[$proyekId][] = $bukuHarian->getSupervisor()->getNama();
                  $daftarNamaSupervisor[$proyekId] = array_unique($daftarNamaSupervisor[$proyekId]);
                }
              }
            }
            catch(Exception $e)
            {
              // do nothing
            }

            $daftarProyek = array_unique($daftarProyek);

            $specsBOQ = PicoSpecification::getInstance()
              ->addAnd(PicoPredicate::getInstance()->in(Field::of()->proyekId, $daftarProyek))
              ->addAnd(PicoPredicate::getInstance()->equals(Field::of()->aktif, true))
              ->addAnd(PicoPredicate::getInstance()->notEquals(Field::of()->volume, null))
              ->addAnd(PicoPredicate::getInstance()->notEquals(Field::of()->volume, 0))
            ;

            $sortsBOQ = PicoSortable::getInstance()
              ->addSortable(new PicoSort(Field::of()->waktuBuat, PicoSort::ORDER_TYPE_ASC))
            ;

            $finderBOQ = new BillOfQuantity(null, $database);

            $listProyek = array();
            try
            {
              $pageDataBOQ = $finderBOQ->findAll($specsBOQ, null, $sortsBukuHarian);
              $listBOQ = $pageDataBOQ->getResult();
              foreach($listBOQ as $idx=>$boq)
              {
                if(!isset($listProyek[$boq->getProyekId()]))
                {
                  $listProyek[$boq->getProyekId()] = array();
                }
                $listProyek[$boq->getProyekId()][] = $boq;
              }
            }
            catch(Exception $e)
            {
              // do nothing
            }

            ?>

            <div class="table-responsive">
              <table class="table border mb-0">
                <thead class="fw-semibold text-nowrap">
                  <tr class="align-middle">
                    <th class="bg-body-secondary"><?php echo $appLanguage->getProject();?></th>
                    <th class="bg-body-secondary"><?php echo $appLanguage->getBillOfQuantity();?></th>
                    <th class="bg-body-secondary"><?php echo $appLanguage->getSupervisor();?></th>
                    <th class="bg-body-secondary"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach($listProyek as $bh)
                  {
                    $proyekId = $bh[0]->getProyekId();
                    $namaProyek = $bh[0]->hasValueProyek() ? $bh[0]->getProyek()->getNama() : "";
                    $waktuBuatProyek = $bh[0]->hasValueProyek() ? $bh[0]->getProyek()->getWaktuBuat() : "";
                    if(strlen($namaProyek) > 50)
                    {
                      $namaProyek = substr($namaProyek, 0, 50);
                    }
                  ?>
                  <tr class="align-top">
                    <td>
                      <div class="text-nowrap"><?php echo $namaProyek;?></div>
                      <div class="small text-body-secondary text-nowrap"><?php echo DateUtil::translateDate($appLanguage, date('j F Y H:i', strtotime($waktuBuatProyek)));?></div>
                    </td>
                    <td>
                      <?php
                      $bobotTotal = 0;
                      $persenTotal = 0;
                      $persenItem = 0;
                      foreach($bh as $boq)
                      {
                        $namaBoq = $boq->getNama();
                        if(strlen($namaBoq) > 50)
                        {
                          $namaBoq = substr($namaBoq, 0, 50);
                        }
                        $percent = $boq->getVolume() > 0 ? (100 * $boq->getVolumeProyek() / $boq->getVolume()) : 0; 
                        $bobot = $boq->getBobot();
                        if($bobot == 0)
                        {
                          $bobot = 1;
                        }
                        $bobotTotal += $bobot;
                        $persenTotal += ($percent * $bobot);
                        $persenItem++;
                        ?>
                      <div>
                      <div class="d-flex justify-content-between align-items-baseline">
                        <div class="text-nowrap small text-body-secondary me-3"><?php echo $namaBoq;?></div>
                        <div class="fw-semibold"><?php echo number_format($percent, 2, ",", ".");?>%</div>
                      </div>
                      <div class="progress progress-thin">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $percent;?>%" aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      </div>
                      <?php
                      }
                      $persenRata = $bobotTotal > 0 ? $persenTotal/$bobotTotal : 0; 
                      ?>
                      <hr style="height: 2px; line-height: 2px; margin-bottom:0px">
                      <div>
                      <div class="d-flex justify-content-between align-items-baseline">
                        <div class="text-nowrap small text-body-secondary me-3">Rata-Rata Progres</div>
                        <div class="fw-semibold"><?php echo number_format($persenRata, 2, ",", ".");?>%</div>
                      </div>
                      <div class="progress progress-thin">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $persenRata;?>%" aria-valuenow="<?php echo $persenRata;?>" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      </div>
                    </td>

                    <td>
                      <div class="small text-body-secondary"><?php echo implode("<br>\r\n", $daftarNamaSupervisor[$proyekId]);?></div>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg class="icon">
                            <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="bill-of-quantity-proyek.php?user_action=chart&proyek_id=<?php echo $boq->getProyekId();?>">Grafik</a>
                          <a class="dropdown-item" href="bill-of-quantity-proyek.php?proyek_id=<?php echo $boq->getProyekId();?>">Edit</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- /.row-->
          
    <!-- Plugins and scripts required by this view-->
    <link rel="stylesheet" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/chartjs/css/coreui-chartjs.css">
    <script src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/chart.js/js/chart.umd.js"></script>
    <script src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
    <script src='<?php echo $baseAssetsUrl;?>lib.assets/chart/chart.js'></script>
    <script src='<?php echo $baseAssetsUrl;?>lib.assets/chart/date-fns.js'></script>
    <script src='<?php echo $baseAssetsUrl;?>lib.assets/chart/chartjs-adapter-date-fns.js'></script>
    <script src='<?php echo $baseAssetsUrl;?>lib.assets/chart/moment.min.js'></script>
    <script src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/utils/js/index.js"></script>
    
    <script>
      Chart.defaults.pointHitDetectionRadius = 1;
      Chart.defaults.plugins.tooltip.enabled = false;
      Chart.defaults.plugins.tooltip.mode = 'index';
      Chart.defaults.plugins.tooltip.position = 'nearest';
      Chart.defaults.plugins.tooltip.external = coreui.ChartJS.customTooltips;
      Chart.defaults.defaultFontColor = coreui.Utils.getStyle('--cui-body-color');
      document.documentElement.addEventListener('ColorSchemeChange', () => {
        cardChart1.data.datasets[0].pointBackgroundColor = coreui.Utils.getStyle('--cui-primary');
        cardChart2.data.datasets[0].pointBackgroundColor = coreui.Utils.getStyle('--cui-info');
        mainChart.options.scales.x.grid.color = coreui.Utils.getStyle('--cui-border-color-translucent');
        mainChart.options.scales.x.ticks.color = coreui.Utils.getStyle('--cui-body-color');
        mainChart.options.scales.y.border.color = coreui.Utils.getStyle('--cui-border-color-translucent');
        mainChart.options.scales.y.grid.color = coreui.Utils.getStyle('--cui-border-color-translucent');
        mainChart.options.scales.y.ticks.color = coreui.Utils.getStyle('--cui-body-color');
        cardChart1.update();
        cardChart2.update();
        mainChart.update();
      });
      const random = (min, max) =>
      // eslint-disable-next-line no-mixed-operators
      Math.floor(Math.random() * (max - min + 1) + min);
    </script>
        
    <?php
require_once __DIR__ . "/inc.app/footer-supervisor.php";

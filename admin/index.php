<?php

// This script is generated automatically by AppBuilder
// Visit https://github.com/Planetbiru/AppBuilder

use MagicObject\Request\InputGet;
use MagicObject\Request\InputPost;
use MagicApp\PicoModule;
use MagicApp\AppEntityLanguage;
use MagicApp\Field;
use MagicObject\Database\PicoPredicate;
use MagicObject\Database\PicoSort;
use MagicObject\Database\PicoSortable;
use MagicObject\Database\PicoSpecification;
use Sipro\AppIncludeImpl;
use Sipro\Entity\Data\BillOfQuantity;
use Sipro\Entity\Data\BukuHarian;
use Sipro\Entity\Data\Proyek;
use Sipro\Util\DateUtil;

require_once dirname(__DIR__) . "/inc.app/auth.php";

$inputGet = new InputGet();
$inputPost = new InputPost();

$currentModule = new PicoModule($appConfig, $database, $appModule, "/admin", "depan", "Depan");
$inputGet = new InputGet();
$inputPost = new InputPost();

$appInclude = new AppIncludeImpl($appConfig, $currentModule);


require_once $appInclude->mainAppHeader(__DIR__);
$appEntityLanguage = new AppEntityLanguage(new Proyek(), $appConfig, $currentUser->getLanguageId());

$baseAssetsUrl = $appConfig->getSite()->getBaseUrl();
?>
<div class="container">
            
          
          <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-3">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">26K <span class="fs-6 fw-normal">(-12.4%
                        <svg class="icon">
                          <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                        </svg>)</span></div>
                    <div>Users</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart1" height="70" style="display: block; box-sizing: border-box; height: 70px; width: 266px;" width="266"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-xl-3">
              <div class="card text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">$6.200 <span class="fs-6 fw-normal">(40.9%
                        <svg class="icon">
                          <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                        </svg>)</span></div>
                    <div>Income</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart2" height="70" style="display: block; box-sizing: border-box; height: 70px; width: 266px;" width="266"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-xl-3">
              <div class="card text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">2.49% <span class="fs-6 fw-normal">(84.7%
                        <svg class="icon">
                          <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                        </svg>)</span></div>
                    <div>Conversion Rate</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
                <div class="c-chart-wrapper mt-3" style="height:70px;">
                  <canvas class="chart" id="card-chart3" height="70" style="display: block; box-sizing: border-box; height: 70px; width: 298px;" width="298"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-xl-3">
              <div class="card text-white bg-danger">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">44K <span class="fs-6 fw-normal">(-23.6%
                        <svg class="icon">
                          <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                        </svg>)</span></div>
                    <div>Sessions</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart4" height="70" style="display: block; box-sizing: border-box; height: 70px; width: 266px;" width="266"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>
          <!-- /.row-->


          <div class="card mb-4">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <div>
                  <h4 class="card-title mb-0">Traffic</h4>
                  <div class="small text-body-secondary">January - July 2023</div>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                  <div class="btn-group btn-group-toggle mx-3" data-coreui-toggle="buttons">
                    <input class="btn-check" id="option1" type="radio" name="options" autocomplete="off">
                    <label class="btn btn-outline-secondary"> Day</label>
                    <input class="btn-check" id="option2" type="radio" name="options" autocomplete="off" checked="">
                    <label class="btn btn-outline-secondary active"> Month</label>
                    <input class="btn-check" id="option3" type="radio" name="options" autocomplete="off">
                    <label class="btn btn-outline-secondary"> Year</label>
                  </div>
                  <button class="btn btn-primary" type="button">
                    <svg class="icon">
                      <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-cloud-download"></use>
                    </svg>
                  </button>
                </div>
              </div>
              <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                <canvas class="chart" id="main-chart" height="300" style="display: block; box-sizing: border-box; height: 300px; width: 1238px;" width="1238"></canvas>
              </div>
            </div>
            <div class="card-footer">
              <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 g-4 mb-2 text-center">
                <div class="col">
                  <div class="text-body-secondary">Visits</div>
                  <div class="fw-semibold text-truncate">29.703 Users (40%)</div>
                  <div class="progress progress-thin mt-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col">
                  <div class="text-body-secondary">Unique</div>
                  <div class="fw-semibold text-truncate">24.093 Users (20%)</div>
                  <div class="progress progress-thin mt-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col">
                  <div class="text-body-secondary">Pageviews</div>
                  <div class="fw-semibold text-truncate">78.706 Views (60%)</div>
                  <div class="progress progress-thin mt-2">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col">
                  <div class="text-body-secondary">New Users</div>
                  <div class="fw-semibold text-truncate">22.123 Users (80%)</div>
                  <div class="progress progress-thin mt-2">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col d-none d-xl-block">
                  <div class="text-body-secondary">Bounce Rate</div>
                  <div class="fw-semibold text-truncate">40.15%</div>
                  <div class="progress progress-thin mt-2">
                    <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-->


          
          <div class="row g-4 mb-4">
            <div class="col-sm-6 col-lg-4">
              <div class="card" style="--cui-card-cap-bg: #3b5998">
                <div class="card-header position-relative d-flex justify-content-center align-items-center">

                  <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                    <canvas id="social-box-chart-1" height="90"></canvas>
                  </div>
                </div>
                <div class="card-body row text-center">
                  <div class="col">
                    <div class="fs-5 fw-semibold">89k</div>
                    <div class="text-uppercase text-body-secondary small">friends</div>
                  </div>
                  <div class="vr"></div>
                  <div class="col">
                    <div class="fs-5 fw-semibold">459</div>
                    <div class="text-uppercase text-body-secondary small">feeds</div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-4">
              <div class="card" style="--cui-card-cap-bg: #00aced">
                <div class="card-header position-relative d-flex justify-content-center align-items-center">

                  <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                    <canvas id="social-box-chart-2" height="90"></canvas>
                  </div>
                </div>
                <div class="card-body row text-center">
                  <div class="col">
                    <div class="fs-5 fw-semibold">973k</div>
                    <div class="text-uppercase text-body-secondary small">followers</div>
                  </div>
                  <div class="vr"></div>
                  <div class="col">
                    <div class="fs-5 fw-semibold">1.792</div>
                    <div class="text-uppercase text-body-secondary small">tweets</div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-4">
              <div class="card" style="--cui-card-cap-bg: #4875b4">
                <div class="card-header position-relative d-flex justify-content-center align-items-center">

                  <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                    <canvas id="social-box-chart-3" height="90"></canvas>
                  </div>
                </div>
                <div class="card-body row text-center">
                  <div class="col">
                    <div class="fs-5 fw-semibold">500+</div>
                    <div class="text-uppercase text-body-secondary small">contacts</div>
                  </div>
                  <div class="vr"></div>
                  <div class="col">
                    <div class="fs-5 fw-semibold">292</div>
                    <div class="text-uppercase text-body-secondary small">feeds</div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>
          <!-- /.row-->
          <div class="row">
            <div class="col-md-12">
              <div class="card mb-4">
                <div class="card-header">Traffic &amp; Sales</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-6">
                          <div class="border-start border-start-4 border-start-info px-3 mb-3">
                            <div class="small text-body-secondary text-truncate">New Clients</div>
                            <div class="fs-5 fw-semibold">9.123</div>
                          </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-6">
                          <div class="border-start border-start-4 border-start-danger px-3 mb-3">
                            <div class="small text-body-secondary text-truncate">Recuring Clients</div>
                            <div class="fs-5 fw-semibold">22.643</div>
                          </div>
                        </div>
                        <!-- /.col-->
                      </div>
                      <!-- /.row-->
                      <hr class="mt-0">
                      <div class="progress-group mb-4">
                        <div class="progress-group-prepend"><span class="text-body-secondary small">Monday</span></div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 34%" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group mb-4">
                        <div class="progress-group-prepend"><span class="text-body-secondary small">Tuesday</span></div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 94%" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group mb-4">
                        <div class="progress-group-prepend"><span class="text-body-secondary small">Wednesday</span></div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group mb-4">
                        <div class="progress-group-prepend"><span class="text-body-secondary small">Thursday</span></div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 91%" aria-valuenow="91" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group mb-4">
                        <div class="progress-group-prepend"><span class="text-body-secondary small">Friday</span></div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 73%" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group mb-4">
                        <div class="progress-group-prepend"><span class="text-body-secondary small">Saturday</span></div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 53%" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group mb-4">
                        <div class="progress-group-prepend"><span class="text-body-secondary small">Sunday</span></div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 9%" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 69%" aria-valuenow="69" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-6">
                          <div class="border-start border-start-4 border-start-warning px-3 mb-3">
                            <div class="small text-body-secondary text-truncate">Pageviews</div>
                            <div class="fs-5 fw-semibold">78.623</div>
                          </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-6">
                          <div class="border-start border-start-4 border-start-success px-3 mb-3">
                            <div class="small text-body-secondary text-truncate">Organic</div>
                            <div class="fs-5 fw-semibold">49.123</div>
                          </div>
                        </div>
                        <!-- /.col-->
                      </div>
                      <!-- /.row-->
                      <hr class="mt-0">
                      <div class="progress-group">
                        <div class="progress-group-header">
                          <svg class="icon icon-lg me-2">
                            <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                          </svg>
                          <div>Male</div>
                          <div class="ms-auto fw-semibold">43%</div>
                        </div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group mb-5">
                        <div class="progress-group-header">
                          <svg class="icon icon-lg me-2">
                            <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-user-female"></use>
                          </svg>
                          <div>Female</div>
                          <div class="ms-auto fw-semibold">37%</div>
                        </div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group">
                        <div class="progress-group-header">

                          <div>Organic Search</div>
                          <div class="ms-auto fw-semibold me-2">191.235</div>
                          <div class="text-body-secondary small">(56%)</div>
                        </div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group">
                        <div class="progress-group-header">

                          <div>Facebook</div>
                          <div class="ms-auto fw-semibold me-2">51.223</div>
                          <div class="text-body-secondary small">(15%)</div>
                        </div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group">
                        <div class="progress-group-header">

                          <div>Twitter</div>
                          <div class="ms-auto fw-semibold me-2">37.564</div>
                          <div class="text-body-secondary small">(11%)</div>
                        </div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 11%" aria-valuenow="11" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="progress-group">
                        <div class="progress-group-header">

                          <div>LinkedIn</div>
                          <div class="ms-auto fw-semibold me-2">27.319</div>
                          <div class="text-body-secondary small">(8%)</div>
                        </div>
                        <div class="progress-group-bars">
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 8%" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.col-->
                  </div>
                  <!-- /.row--><br>

                  <?php
                  $hari = 14;
                  
                  
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
                      if($bukuHarian->hasValueSupervisor())
                      {
                        $daftarNamaSupervisor[] = $bukuHarian->getSupervisor()->getNama();
                      }
                      
                    }
                  }
                  catch(Exception $e)
                  {
                    // do nothing
                  }

                  $daftarProyek = array_unique($daftarProyek);
                  $daftarNamaSupervisor = array_unique($daftarNamaSupervisor);
                  

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
                            <div class="small text-body-secondary"><?php echo implode("<br>\r\n", $daftarNamaSupervisor);?></div>
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
    <script src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/utils/js/index.js"></script>
    <script src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>js/main.js"></script>
        
        <?php

require_once $appInclude->mainAppFooter(__DIR__);
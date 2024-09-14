<?php
use Sipro\Util\MenuUtil;

require_once dirname(dirname(dirname(__DIR__))) . "/inc.app/auth.php";

$baseAssetsUrl = $appConfig->getSite()->getBaseUrl();

if(isset($currentModule) && $currentModule->getModuleTitle() != null)
{
  $__siteTitle = trim($appConfig->getSite()->getTitle().' - '.$currentModule->getModuleTitle(), ' - ');
}
else
{
  $__siteTitle = $appConfig->getSite()->getTitle();
}

?><!DOCTYPE html><html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Planetbiru/MagicAppBuilder">
    <meta name="keyword" content="Planetbiru/MagicAppBuilder">
    <title><?php echo $__siteTitle;?></title>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <script type="text/javascript" src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>js/config.js"></script>
    <script type="text/javascript" src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>js/color-modes.js"></script>
    <script type="text/javascript" src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/jquery/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/datetime-picker/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>js/custom.min.js"></script>
    <script type="text/javascript" src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>js/ajax.min.js"></script>
    <link rel="stylesheet" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>css/vendors/simplebar.css">
    <link rel="stylesheet" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>css/style.css">
    <link rel="stylesheet" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>css/custom.css">
    <link rel="stylesheet" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/datetime-picker/bootstrap-datetimepicker.min.css">
  </head>
  <body>
    <div class="sidebar sidebar-fixed border-end" id="sidebar">
      <div class="sidebar-header border-bottom">
        <div class="sidebar-brand">
          <div class="sidebar-brand-full">
            
          </div>
          <div class="sidebar-brand-narrow">
            
          </div>
        </div>
        <button class="btn-close d-lg-none" type="button" data-coreui-dismiss="offcanvas" data-coreui-theme="dark" aria-label="Close" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"></button>
      </div>
      
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="./">
            <svg class="nav-icon">
              <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
            </svg> Dashboard</a></li>      
        <li class="nav-title"><?php echo $appLanguage->getMainMenu();?></li>   
        
        <?php

        $mainMenu = MenuUtil::getMainMenu($database, $appConfig, $currentUser);     

        foreach($mainMenu->getMenu() as $menuGroup)
        {
            $parent = $menuGroup['menuGroup'];
            $parentIcon = $parent->getIcon();
            echo '<li class="nav-group"><a class="nav-link nav-group-toggle" href="#">'."\r\n";
            echo '<svg class="nav-icon">'."\r\n";
            echo '<use xlink:href="'.$baseAssetsUrl.$themePath.'vendors/@coreui/icons/svg/free.svg#cil-'.$parentIcon.'"></use>'."\r\n";
            echo '</svg> '.$parent->getName().'</a>'."\r\n";
            echo '<ul class="nav-group-items compact">';
            foreach($menuGroup['menuItem'] as $menuItem)
            {
                $menuIcon = $menuItem->getIcon();
                echo '<li class="nav-item"><a class="nav-link" href="'.$menuItem->getUrl().'"><svg class="nav-icon">
                <use xlink:href="'.$baseAssetsUrl.$themePath.'vendors/@coreui/icons/svg/free.svg#cil-'.$menuIcon.'"></use>
              </svg> '.$menuItem->getName().'</a></li>'."\r\n";
            }
            echo '</ul>';
            echo '</li>';
        }

        ?>
      </ul>

      <div class="sidebar-footer border-top d-none d-md-flex">
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
      </div>
    
    </div>
    <div class="wrapper d-flex flex-column min-vh-100">
      <header class="header header-sticky p-0 mb-3">
        <div class="container-fluid border-bottom px-3">
          <button class="header-toggler" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()" style="margin-inline-start: -14px;">
            <svg class="icon icon-lg">
              <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
          </button>
          <ul class="header-nav d-none d-lg-flex">
            <li class="nav-item"><a class="nav-link" href="./">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link">&raquo;</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo $currentModule->getRedirectUrl();?>"><?php echo $currentModule->getModuleTitle();?></a></li>
          </ul>      
          
          <ul class="header-nav d-md-flex ms-auto">
            
            <li class="nav-item dropdown">
              <a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <svg class="icon icon-lg my-1 mx-2">
                  <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                </svg><span class="badge rounded-pill position-absolute top-0 end-0 bg-danger-gradient">5</span>
              </a>
              
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg pt-0">
                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2" data-coreui-i18n="notificationsCounter, { 'counter': 5 }">You have 5 notifications</div>
                
                <a class="dropdown-item" href="#">
                  <div class="dropdown-menu-body">
                  <svg class="icon me-2 text-success">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-user-follow"></use>
                  </svg><span data-coreui-i18n="newUserRegistered">New user registered</span></div>
                </a>
                
                <a class="dropdown-item" href="#">
                  <svg class="icon me-2 text-danger">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-user-unfollow"></use>
                  </svg><span data-coreui-i18n="userDeleted">User deleted</span>
                </a>
                
                <a class="dropdown-item" href="#">
                  <svg class="icon me-2 text-info">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-chart"></use>
                  </svg><span data-coreui-i18n="salesReportIsReady">Sales report is ready</span>
                </a>
                
                <a class="dropdown-item" href="#">
                  <svg class="icon me-2 text-success">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-basket"></use>
                  </svg><span data-coreui-i18n="newClient">New client</span></a><a class="dropdown-item" href="#">
                  <svg class="icon me-2 text-warning">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                  </svg><span data-coreui-i18n="serverOverloaded">Server overloaded</span>
                </a>
                
                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2" data-coreui-i18n="server">Server</div>
                
                <a class="dropdown-item d-block py-2" href="#">
                  <div class="text-uppercase small fw-semibold mb-1" data-coreui-i18n="cpuUsage">CPU Usage</div>
                  <div class="progress progress-thin">
                    <div class="progress-bar bg-info-gradient" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="small text-body-secondary" data-coreui-i18n="cpuUsageDescription, { 'number_of_processes': 358, 'number_of_cores': '1/4' }">358 processes. 1/4 cores</div>
                </a>
                
                <a class="dropdown-item d-block py-2" href="#">
                  <div class="text-uppercase small fw-semibold mb-1" data-coreui-i18n="memoryUsage">Memory Usage</div>
                  <div class="progress progress-thin">
                    <div class="progress-bar bg-warning-gradient" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="small text-body-secondary">11444MB/16384MB</div>
                </a>
                
                <a class="dropdown-item d-block py-2" href="#">
                  <div class="text-uppercase small fw-semibold mb-1" data-coreui-i18n="ssdUsage">SSD Usage</div>
                  <div class="progress progress-thin">
                    <div class="progress-bar bg-danger-gradient" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="small text-body-secondary">243GB/256GB</div>
                </a>
              </div>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <svg class="icon icon-lg my-1 mx-2">
                  <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
                </svg><span class="badge rounded-pill position-absolute top-0 end-0 bg-warning-gradient">5</span>
              </a>
              
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg pt-0">
                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2" data-coreui-i18n="taskCounter, { 'counter': 5 }">You have 5 pending tasks</div>
                <div class="dropdown-menu-body-with-footer">
                
                  <a class="dropdown-item d-block py-2" href="#">
                    <div class="d-flex justify-content-between mb-1">
                      <div class="small">Upgrade NPM</div>
                      <div class="fw-semibold">0%</div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </a>
                  
                  <a class="dropdown-item d-block py-2" href="#">
                    <div class="d-flex justify-content-between mb-1">
                      <div class="small">ReactJS Version</div>
                      <div class="fw-semibold">25%</div>
                    </div><span class="progress progress-thin">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </span>
                  </a>
                  
                  <a class="dropdown-item d-block py-2" href="#">
                    <div class="d-flex justify-content-between mb-1">
                      <div class="small">VueJS Version</div>
                      <div class="fw-semibold">50%</div>
                    </div><span class="progress progress-thin">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </span>
                  </a>
                  
                  <a class="dropdown-item d-block py-2" href="#">
                    <div class="d-flex justify-content-between mb-1">
                      <div class="small">Add new layouts</div>
                      <div class="fw-semibold">75%</div>
                    </div><span class="progress progress-thin">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </span>
                  </a>
                  
                  <a class="dropdown-item d-block py-2" href="#">
                    <div class="d-flex justify-content-between mb-1">
                      <div class="small">Angular Version</div>
                      <div class="fw-semibold">100%</div>
                    </div><span class="progress progress-thin">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </span>
                  </a>
                  
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center fw-semibold" href="#" data-coreui-i18n="viewAllTasks">View all tasks</a>
              </div>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <svg class="icon icon-lg my-1 mx-2">
                  <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                </svg><span class="badge rounded-pill position-absolute top-0 end-0 bg-info-gradient">7</span>
              </a>
              
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-md pt-0 dropdown-message-header">
                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2" data-coreui-i18n="messagesCounter, { 'counter': 7 }">You have 7 messages</div>
                <div class="dropdown-menu-body-with-footer">
                
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/img/avatars/1.jpg" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                      <div class="message text-wrap">
                        <div class="d-flex justify-content-between mt-1">
                          <div class="small text-body-secondary">Jessica Williams</div>
                          <div class="small text-body-secondary">Just now</div>
                        </div>
                        <div class="fw-semibold"><span class="text-danger">! </span>Urgent: System Maintenance Tonight</div>
                        <div class="small text-body-secondary">Attention team, we'll be conducting critical system maintenance tonight from 10 PM to 2 AM. Plan accordingly...</div>
                      </div>
                    </div>
                  </a>
                  
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/img/avatars/2.jpg" alt="user@email.com"><span class="avatar-status bg-warning"></span></div>
                      <div class="message text-wrap">
                        <div class="d-flex justify-content-between mt-1">
                          <div class="small text-body-secondary">Richard Johnson</div>
                          <div class="small text-body-secondary">5 minutes ago</div>
                        </div>
                        <div class="fw-semibold"><span class="text-danger">! </span>Project Update: Milestone Achieved</div>
                        <div class="small text-body-secondary">Kudos on hitting sales targets last quarter! Let's keep the momentum. New goals, new victories ahead...</div>
                      </div>
                    </div>
                  </a>
                  
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/img/avatars/4.jpg" alt="user@email.com"><span class="avatar-status bg-secondary"></span></div>
                      <div class="message text-wrap">
                        <div class="d-flex justify-content-between mt-1">
                          <div class="small text-body-secondary">Angela Rodriguez</div>
                          <div class="small text-body-secondary">1:52 PM</div>
                        </div>
                        <div class="fw-semibold">Social Media Campaign Launch</div>
                        <div class="small text-body-secondary">Exciting news! Our new social media campaign goes live tomorrow. Brace yourselves for engagement...</div>
                      </div>
                    </div>
                  </a>
                  
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/img/avatars/5.jpg" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                      <div class="message text-wrap">
                        <div class="d-flex justify-content-between mt-1">
                          <div class="small text-body-secondary">Jane Lewis</div>
                          <div class="small text-body-secondary">4:03 PM</div>
                        </div>
                        <div class="fw-semibold">Inventory Checkpoint</div>
                        <div class="small text-body-secondary">Team, it's time for our monthly inventory check. Accurate counts ensure smooth operations. Let's nail it...</div>
                      </div>
                    </div>
                  </a>
                  
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/img/avatars/3.jpg" alt="user@email.com"><span class="avatar-status bg-secondary"></span></div>
                      <div class="message text-wrap">
                        <div class="d-flex justify-content-between mt-1">
                          <div class="small text-body-secondary">Ryan Miller</div>
                          <div class="small text-body-secondary">3 days ago</div>
                        </div>
                        <div class="fw-semibold">Customer Feedback Results</div>
                        <div class="small text-body-secondary">Our latest customer feedback is in. Let's analyze and discuss improvements for an even better service...</div>
                      </div>
                    </div>
                  </a>
                  
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center fw-semibold" href="#" data-coreui-i18n="viewAllMessages">View all messages</a>
              </div>
            </li>
          </ul>
          <ul class="header-nav ms-auto ms-md-0">
            <li class="nav-item py-1">
              <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
            </li>
            <li class="nav-item dropdown">
              <button class="btn btn-link nav-link" type="button" aria-expanded="false" data-coreui-toggle="dropdown">
                <svg class="icon icon-lg">
                  <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-language"></use>
                </svg>
              </button>
              <div class="dropdown-menu-body">
                <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem;">
                  
                  <li>
                    <button class="dropdown-item d-flex align-items-center active" type="button" data-coreui-language-value="en" onclick="i18next.changeLanguage('id')" style="padding-left: 5px;">
                    <svg class="icon icon-lg my-1 mx-2">
                      <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/flag.svg#cif-id"></use>
                    </svg>
                    Indonesia
                    </button>
                  </li>
                  
                  <li>
                    <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-language-value="en" onclick="i18next.changeLanguage('en')" style="padding-left: 5px;">
                    <svg class="icon icon-lg my-1 mx-2">
                      <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/flag.svg#cif-gb"></use>
                    </svg>
                    English
                    </button>
                  </li>

                </ul>
              </div>
            </li>
            
            <li class="nav-item dropdown">
              <button class="btn btn-link nav-link" type="button" aria-expanded="false" data-coreui-toggle="dropdown">
                <svg class="icon icon-lg theme-icon-active">
                  <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-sun"></use>
                </svg>
              </button>
              
              <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem;">
                <li>
                  <button class="dropdown-item d-flex align-items-center active" type="button" data-coreui-theme-value="light">
                    <svg class="icon icon-lg me-3">
                      <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-sun"></use>
                    </svg><span data-coreui-i18n="light">Light</span>
                  </button>
                </li>
                
                <li>
                  <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="dark">
                    <svg class="icon icon-lg me-3">
                      <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-moon"></use>
                    </svg><span data-coreui-i18n="dark">Dark</span>
                  </button>
                </li>
                
                <li>
                  <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="auto">
                    <svg class="icon icon-lg me-3">
                      <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-contrast"></use>
                    </svg>Auto
                  </button>
                </li>
                
              </ul>
            </li>
            <li class="nav-item py-1">
              <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md"><img class="avatar-img" src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/img/avatars/8.jpg" alt="user@email.com"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2" data-coreui-i18n="account">Account</div><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                  </svg><span data-coreui-i18n="updates">Updates</span><span class="badge badge-sm bg-info-gradient ms-2">42</span></a><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                  </svg><span data-coreui-i18n="messages">Messages</span><span class="badge badge-sm badge-sm bg-success ms-2">42</span></a><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-task"></use>
                  </svg><span data-coreui-i18n="tasks">Tasks</span><span class="badge badge-sm bg-danger-gradient ms-2">42</span></a><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-comment-square"></use>
                  </svg><span data-coreui-i18n="comments">Comments</span><span class="badge badge-sm bg-warning-gradient ms-2">42</span></a>
                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2" data-coreui-i18n="settings">Settings</div><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                  </svg><span data-coreui-i18n="profile">Profile</span></a><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                  </svg><span data-coreui-i18n="settings">Settings</span></a><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-credit-card"></use>
                  </svg><span data-coreui-i18n="payments">Payments</span><span class="badge badge-sm bg-secondary-gradient text-dark ms-2">42</span></a><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                  </svg><span data-coreui-i18n="projects">Projects</span><span class="badge badge-sm bg-primary-gradient ms-2">42</span></a>
                <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                  </svg><span data-coreui-i18n="lockAccount">Lock Account</span></a><a class="dropdown-item" href="logout.php">
                  <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                  </svg><span data-coreui-i18n="logout">Logout</span></a>
              </div>
            </li>
          </ul>
        </div>
      </header>

      <div class="pb-container">    
        <div class="progress progress-infinite">
          <div class="progress-loading" >
          </div>                       
        </div> 
      </div>
      <div class="body flex-grow-1">
        <div class="px-3">




      
<?php

use MagicApp\Field;
use MagicObject\Database\PicoPage;
use MagicObject\Database\PicoPageable;
use MagicObject\Database\PicoPredicate;
use MagicObject\Database\PicoSort;
use MagicObject\Database\PicoSortable;
use MagicObject\Database\PicoSpecification;
use Sipro\Entity\Data\Notifikasi;

$notifSize = 8;

?>
<style>
    .notification-subject{
        display: inline-block;
        max-width: 160px;
        white-space: nowrap;
        overflow-x: hidden;
        text-overflow: ellipsis;
    }
    .dropdown-item svg.icon{
        vertical-align: text-top;
        margin-top: -3px;
        margin-left: 0px !important;
        margin-right: 2px !important;
    }
</style>
<ul class="header-nav d-md-flex ms-auto">
    <li class="nav-item dropdown"><a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <svg class="icon icon-lg my-1 mx-2">
            <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
        </svg><span class="badge rounded-pill position-absolute top-0 end-0 bg-danger-gradient">5</span></a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg pt-0">
            
            <?php
            
            $notifFinder = new Notifikasi(null, $database);
            
            $specsNotif = PicoSpecification::getInstance()
            ->addAnd(PicoPredicate::getInstance()->equals(Field::of()->supervisorId, $currentLogedInSupervisor->getSupervisorId()))
            ->addAnd(PicoPredicate::getInstance()->equals(Field::of()->dibaca, false))
            ;
            
            $sortableNotif = PicoSortable::getInstance()
            ->add(new PicoSort(Field::of()->waktuBuat, PicoSort::ORDER_TYPE_DESC))
            ->add(new PicoSort(Field::of()->notifikasiId, PicoSort::ORDER_TYPE_DESC))
            ;
            
            $pageableNotif = new PicoPageable(new PicoPage(1, $notifSize), $sortableNotif);
            $totalNotif = 0;
            $resultNotif = array();
            try
            {
                $pageDataNotif = $notifFinder->findAll($specsNotif, $pageableNotif, $sortableNotif, true);
                $totalNotif = $pageDataNotif->getTotalResult();
                $resultNotif = $pageDataNotif->getResult();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
            
            ?>
        
            <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2" data-coreui-i18n="notificationsCounter, { 'counter': <?php echo $totalNotif;?> }">
            <?php echo $appLanguage->getUnreadNotifications();?>
            </div>
            
            <div class="dropdown-menu-body">
            <?php
            
            foreach($resultNotif as $notif)
            {
            ?>    
            <a class="dropdown-item" href="notifikasi.php?open=<?php echo $notif->getNotifikasiId();?>">              
                <svg class="icon me-2 text-primary">
                    <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-envelope-closed"></use>
                </svg>
                <span class="notification-subject"><?php echo $notif->getSubjek();?></span>
            </a>
            <?php
            }
            
            ?>
            
        </div>
        
        <div class="dropdown-menu-body">
            <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2" data-coreui-i18n="server"><?php echo $appLanguage->getAllNotifications();?></div>
            
            <a class="dropdown-item" href="notifikasi.php">              
                <svg class="icon me-2 text-primary">
                    <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-envelope-closed"></use>
                </svg>
                <span class="notification-subject"><?php echo $appLanguage->getShowAllNotifications();?></span>
            </a>
            
            </div>
        </div>
    </li>
    
    
    <li class="nav-item dropdown"><a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <svg class="icon icon-lg my-1 mx-2">
                <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
            </svg><span class="badge rounded-pill position-absolute top-0 end-0 bg-info-gradient">7</span></a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-md pt-0 dropdown-message-header">
            <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2" data-coreui-i18n="messagesCounter, { 'counter': 7 }">You have 7 messages</div>
            <div class="dropdown-menu-body-with-footer">
                <a class="dropdown-item" href="#">
                    <div class="d-flex">
                        <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>assets/img/avatars/1.jpg" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                        <div class="message text-wrap">
                            <div class="d-flex justify-content-between mt-1">
                                <div class="small text-body-secondary">Jessica Williams</div>
                                <div class="small text-body-secondary">Just now</div>
                            </div>
                            <div class="fw-semibold"><span class="text-danger">! </span>Urgent: System Maintenance Tonight</div>
                            <div class="small text-body-secondary">Attention team, we'll be conducting critical system maintenance tonight from 10 PM to 2 AM. Plan accordingly...</div>
                        </div>
                    </div>
                </a><a class="dropdown-item" href="#">
                    <div class="d-flex">
                        <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>assets/img/avatars/2.jpg" alt="user@email.com"><span class="avatar-status bg-warning"></span></div>
                        <div class="message text-wrap">
                            <div class="d-flex justify-content-between mt-1">
                                <div class="small text-body-secondary">Richard Johnson</div>
                                <div class="small text-body-secondary">5 minutes ago</div>
                            </div>
                            <div class="fw-semibold"><span class="text-danger">! </span>Project Update: Milestone Achieved</div>
                            <div class="small text-body-secondary">Kudos on hitting sales targets last quarter! Let's keep the momentum. New goals, new victories ahead...</div>
                        </div>
                    </div>
                </a><a class="dropdown-item" href="#">
                    <div class="d-flex">
                        <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>assets/img/avatars/4.jpg" alt="user@email.com"><span class="avatar-status bg-secondary"></span></div>
                        <div class="message text-wrap">
                            <div class="d-flex justify-content-between mt-1">
                                <div class="small text-body-secondary">Angela Rodriguez</div>
                                <div class="small text-body-secondary">1:52 PM</div>
                            </div>
                            <div class="fw-semibold">Social Media Campaign Launch</div>
                            <div class="small text-body-secondary">Exciting news! Our new social media campaign goes live tomorrow. Brace yourselves for engagement...</div>
                        </div>
                    </div>
                </a><a class="dropdown-item" href="#">
                    <div class="d-flex">
                        <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>assets/img/avatars/5.jpg" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                        <div class="message text-wrap">
                            <div class="d-flex justify-content-between mt-1">
                                <div class="small text-body-secondary">Jane Lewis</div>
                                <div class="small text-body-secondary">4:03 PM</div>
                            </div>
                            <div class="fw-semibold">Inventory Checkpoint</div>
                            <div class="small text-body-secondary">Team, it's time for our monthly inventory check. Accurate counts ensure smooth operations. Let's nail it...</div>
                        </div>
                    </div>
                </a><a class="dropdown-item" href="#">
                    <div class="d-flex">
                        <div class="avatar flex-shrink-0 my-3 me-3"><img class="avatar-img" src="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>assets/img/avatars/3.jpg" alt="user@email.com"><span class="avatar-status bg-secondary"></span></div>
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
            <div class="dropdown-divider"></div><a class="dropdown-item text-center fw-semibold" href="#" data-coreui-i18n="viewAllMessages">View all messages</a>
        </div>
    </li>
</ul>
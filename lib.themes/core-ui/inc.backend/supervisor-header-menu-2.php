<ul class="header-nav ms-auto ms-md-0">
    <li class="nav-item py-1">
        <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
    </li>
    <li class="nav-item dropdown">
        <button class="btn btn-link nav-link" type="button" aria-expanded="false" data-coreui-toggle="dropdown">
            <svg class="icon icon-lg">
                <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-language"></use>
            </svg>
        </button>
        <div class="dropdown-menu-body">
            <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem;">

                <li>
                    <button class="dropdown-item d-flex align-items-center active" type="button" data-coreui-language-value="en" onclick="i18next.changeLanguage('id')">
                        Indonesia
                    </button>
                </li>
                <li>
                    <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-language-value="en" onclick="i18next.changeLanguage('en')">
                        English
                    </button>
                </li>

            </ul>
        </div>
    </li>
    <li class="nav-item dropdown">
        <button class="btn btn-link nav-link" type="button" aria-expanded="false" data-coreui-toggle="dropdown">
            <svg class="icon icon-lg theme-icon-active">
                <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-sun"></use>
            </svg>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem;">
            <li>
                <button class="dropdown-item d-flex align-items-center active" type="button" data-coreui-theme-value="light">
                    <svg class="icon icon-lg me-3">
                        <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-sun"></use>
                    </svg><span data-coreui-i18n="light">Light</span>
                </button>
            </li>
            <li>
                <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="dark">
                    <svg class="icon icon-lg me-3">
                        <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-moon"></use>
                    </svg><span data-coreui-i18n="dark">Dark</span>
                </button>
            </li>
            <li>
                <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="auto">
                    <svg class="icon icon-lg me-3">
                        <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-contrast"></use>
                    </svg>Auto
                </button>
            </li>
        </ul>
    </li>
    <li class="nav-item py-1">
        <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
    </li>
    <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <div class="avatar avatar-md"><img class="avatar-img" src="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>assets/img/avatars/8.jpg" alt="user@email.com"></div>
        </a>
        <div class="dropdown-menu dropdown-menu-end pt-0">
            <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2" data-coreui-i18n="account">Account</div><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                </svg><span data-coreui-i18n="updates">Updates</span><span class="badge badge-sm bg-info-gradient ms-2">42</span></a><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                </svg><span data-coreui-i18n="messages">Messages</span><span class="badge badge-sm badge-sm bg-success ms-2">42</span></a><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-task"></use>
                </svg><span data-coreui-i18n="tasks">Tasks</span><span class="badge badge-sm bg-danger-gradient ms-2">42</span></a><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-comment-square"></use>
                </svg><span data-coreui-i18n="comments">Comments</span><span class="badge badge-sm bg-warning-gradient ms-2">42</span></a>
            <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2" data-coreui-i18n="settings">Settings</div><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                </svg><span data-coreui-i18n="profile">Profile</span></a><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                </svg><span data-coreui-i18n="settings">Settings</span></a><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-credit-card"></use>
                </svg><span data-coreui-i18n="payments">Payments</span><span class="badge badge-sm bg-secondary-gradient text-dark ms-2">42</span></a><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                </svg><span data-coreui-i18n="projects">Projects</span><span class="badge badge-sm bg-primary-gradient ms-2">42</span></a>
            <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                </svg><span data-coreui-i18n="lockAccount">Lock Account</span></a><a class="dropdown-item" href="logout.php">
                <svg class="icon me-2">
                    <use xlink:href="<?php echo $baseAssetsUrl; ?><?php echo $themePath; ?>vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                </svg><span data-coreui-i18n="logout">Logout</span></a>
        </div>
    </li>
</ul>